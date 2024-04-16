<?php

namespace App\Http\Services\Api\Payment;

use App\Http\Requests\Api\Payment\PaymentRequest;
use App\Http\Traits\Responser;
use App\Models\Course;
use App\Models\CourseBook;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebPaymentService extends PaymentService
{
    public function initiate(PaymentRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($data['type'] == 'CASH') {
                $data['transfer_image'] = $this->fileManager->handle('transfer_image', 'payments/transfers');
            }
            $amount = $this->{$this->payable[$data['pay']]['repository']}->getById($data[$data['pay'].'_id'], $this->payable[$data['pay']]['columns'])->{$this->payable[$data['pay']]['amount']};
            $printRequestData = $request->only(['name', 'email', 'phone', 'qualification', 'address', 'nationality', 'national_id']);
            $payment = $this->paymentRepository->create([
                'payment_type' => $data['type'],
                'payable_type' => $this->payable[$data['pay']]['type'],
                'payable_id' => $data[$data['pay'].'_id'],
                'user_id' => auth('api')->id(),
                'amount' => $amount,
                'transfer_image' => $data['transfer_image'] ?? null,
                'bank_account_name' => $data['bank_account_name'] ?? null,
                'bank_account_number' => $data['bank_account_number'] ?? null,
                'from_bank' => $data['from_bank'] ?? null,
                'to_bank' => $data['to_bank'] ?? null,
                'transfer_amount' => $data['transfer_amount'] ?? null,
                'transfer_date' => $data['transfer_date'] ?? null,
                'transfer_time' => $data['transfer_time'] ?? null,
                'is_confirmed' => false,
                ...$printRequestData
            ]);

            if ($data['type'] == 'EPAYMENT') {
                return $this->ePayment($payment, $request->token, $request->certificate_user_id);
            }
            elseif($data['type'] == 'TAMARA') {
                return $this->tamaraPayment($payment, $request->certificate_user_id);
            } else {
                $this->assign->handle($payment, $request->certificate_user_id);
                DB::commit();

                return $this->responseSuccess(message: __('messages.Payment will be reviewed'));
            }
        } catch (Exception $e) {
            DB::rollBack();
//            return $e->getMessage();
            return $this->responseFail(message: __('messages.An error occurred while processing the payment'));
        }
    }

    private function ePayment($payment, $token, $certificate_user_id = null)
    {
        if($payment->amount == 0){
            $this->assign->handle($payment, $certificate_user_id, true);
            $this->paymentRepository->update($payment->id, ['is_confirmed' => true, 'is_declined' => false]);

            DB::commit();

            return $this->responseSuccess(message: __('messages.Payment completed successfully'));
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('TAP_PAYMENT_SK'),
            'lang_code' => 'AR',
        ])->post('https://api.tap.company/v2/charges', [
            'amount' => $payment->amount,
            'currency' => 'SAR',
            'customer_initiated' => true,
            'threeDSecure' => true,
            'save_card' => false,
            'description' => 'منصة ميم التعليمية',
            'metadata' => [
                'udf1' => auth('api')?->id(),
                'udf2' => Carbon::now()->toDateTimeString(),
                'udf3' => $payment->id,
                'udf4' => $certificate_user_id ?? '',
            ],
            'receipt' => [
                'email' => true,
                'sms' => false
            ],
            'customer' => [
                'first_name' => auth('api')->user()->name,
                'last_name' => '',
                'email' => auth('api')->user()->email,
            ],
            'source' => [
                'id' => $token
            ],
            'reference' => [
                ''
            ],
            'post' => [
                'url' => route('w.payment.webhook')
            ],
            'redirect' => [
                'url' => env('TAP_PAYMENT_REDIRECT_URL')
            ]
        ])->json();

        Log::info('payment::: '. print_r($response, true));

        if (isset($response['transaction']['url'])) {

            DB::commit();

            return $this->responseSuccess(data: ['redirect_url' => $response['transaction']['url']]);

        } elseif (isset($response['status']) && $response['status'] == 'CAPTURED') {

            $this->assign->handle($payment, $response['metadata']['udf4'], true);

            $this->paymentRepository->update($payment->id, ['is_confirmed' => true]);

            DB::commit();

            return $this->responseSuccess(message: __('messages.Payment completed successfully'));

        } else {
            $this->paymentRepository->delete($payment->id);

            DB::commit();
            if (isset($response['response'])) {
                return $this->responseFail(message: __('messages.Payment failed because', ['cause' => $response['response']['message']]));
            } else {
                return $this->responseFail(message: __('messages.An error occurred while processing the payment'));
            }

        }
    }
    private function tamaraPayment($payment, $certificate_user_id = null)
    {
        $items = [];

        if($payment->payable_type == $this->payable['cart']['type']) {
            foreach ($payment->payable->items as $item) {
                if ($item->cartable_type == Course::class) {
                    $items[] = [
                        'name' => __('dashboard.course') . ': ' . $item->cartable->t('name'),
                        'quantity' => 1,
                        'reference_id' => $item->id,
                        'type' => 'Digital',
                        'sku' => '0',
                        'total_amount' => $item->cartable->price
                    ];
                } elseif ($item->cartable_type == CourseBook::class) {
                    if ($item->option == 'PDF') {
                        $items[] = [
                            'name' => __('dashboard.courseBook') . ': ' . $item->cartable->t('name'),
                            'quantity' => 1,
                            'reference_id' => $item->id,
                            'type' => 'Digital',
                            'sku' => '0',
                            'total_amount' => $item->cartable->price
                        ];
                    } elseif($item->option == 'PRINT') {
                        $items[] = [
                            'name' => __('dashboard.printRequest') . ': ' . $item->cartable->t('name'),
                            'quantity' => $item->quantity,
                            'reference_id' => $item->id,
                            'type' => 'Physical',
                            'sku' => '0',
                            'total_amount' => $item->cartable->price
                        ];
                    }
                }
            }
        } elseif ($payment->payable_type == $this->payable['certificate_user']['type']) {
            $certificate = $this->certificateUserRepository->getById($certificate_user_id);

            $items[] = [
                'name' => __('dashboard.Certificate of Course') . ': ' . $certificate->course->t('name'),
                'quantity' => 1,
                'reference_id' => $certificate->id,
                'type' => 'Physical',
                'sku' => '0',
                'total_amount' => $certificate->course->certificate_price
            ];
        }






        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.env('TAMARA_PAYMENT_KEY'),
        ])->post('https://api.tamara.co/checkout', [
            'total_amount' => [
                'amount' => $payment->amount,
                'currency' => 'SAR'
            ],
            'shipping_amount' => [
                'amount' => 0,
                'currency' => 'SAR'
            ],
            'tax_amount' => [
                'amount' => 0,
                'currency' => 'SAR'
            ],
            'order_reference_id' => $payment->id,
            'items' => $items,
            'consumer' => [
                'email' => auth('api')->user()->email,
                'first_name' => auth('api')->user()->name,
                'last_name' => ' ',
                'phone_number' => auth('api')->user()->phone
            ],
            'country_code' => 'SA',
            'description' => 'منصة ميم التعليمية',
            'merchant_url' => [
                'cancel' => 'https://meemedu.com/tamara-pay-result/cancel',
                'failure' => 'https://meemedu.com/tamara-pay-result/failure',
                'success' => 'https://meemedu.com/tamara-pay-result/success',
                'notification' => route('w.tamara.payment.notification')
            ],
//            'customer' => [
//                'first_name' => auth('api')->user()->name,
//                'last_name' => '',
//                'email' => auth('api')->user()->email,
//            ],
//            'source' => [
//                'id' => $token
//            ],
//            'reference' => [
//                ''
//            ],
//            'post' => [
//                'url' => route('w.payment.webhook')
//            ],
//            'redirect' => [
//                'url' => env('TAP_PAYMENT_REDIRECT_URL')
//            ]
        ])->json();

        if (isset($response['transaction']['url'])) {

            DB::commit();

            return $this->responseSuccess(data: ['redirect_url' => $response['transaction']['url']]);

        } elseif (isset($response['status']) && $response['status'] == 'CAPTURED') {

            $this->assign->handle($payment, $response['metadata']['udf4'], true);

            $this->paymentRepository->update($payment->id, ['is_confirmed' => true]);

            DB::commit();

            return $this->responseSuccess(message: __('messages.Payment completed successfully'));

        } else {
            $this->paymentRepository->delete($payment->id);

            DB::commit();
            if (isset($response['response'])) {
                return $this->responseFail(message: __('messages.Payment failed because', ['cause' => $response['response']['message']]));
            } else {
                return $this->responseFail(message: __('messages.An error occurred while processing the payment'));
            }

        }
    }

}