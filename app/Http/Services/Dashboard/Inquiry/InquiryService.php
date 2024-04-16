<?php

namespace App\Http\Services\Dashboard\Inquiry;

use App\Http\Requests\Dashboard\Inquiry\InquiryRequest;
use App\Http\Services\Dashboard\DeviceToken\DeviceTokenService;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CourseInquireRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class InquiryService
{
    private CourseInquireRepositoryInterface $courseInquireRepository;
    private FileManagerService $fileManager;
    private DeviceTokenService $deviceToken;
    public function __construct(
        CourseInquireRepositoryInterface $courseInquireRepository,
        FileManagerService $fileManager,
        DeviceTokenService $deviceToken,
    )
    {
        $this->courseInquireRepository = $courseInquireRepository;
        $this->fileManager = $fileManager;
        $this->deviceToken = $deviceToken;
    }

    public function update(InquiryRequest $request, $id) {
        $inquiry = $this->courseInquireRepository->getById($id);
        abort_unless(Gate::allows('control-course', $inquiry->course), 401);
        if (Gate::allows('operate-inquiry', $inquiry)) {
            $data = $request->validated();
            if(isset($data['answer_voice'])){
                $data['answer_voice'] = $this->fileManager->handle('answer_voice', 'courses/inquiries/answers/');
            }
            DB::beginTransaction();
            try {
                $this->courseInquireRepository->update($id, $data);
                if ($inquiry->user?->devicetokens !== null) {
                    $this->deviceToken->notify(
                        $inquiry->user?->devicetokens?->pluck('token')->toArray(),
                        'تم الرد على استفسارك',
                        $inquiry->course->t('name'),
                    );
                }

                DB::commit();
                return redirect()->route('inquiries.index')->with(['success' => __('messages.Answer saved successfully')]);
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with(['error' => __('messages.Something went wrong')]);
            }
        } else {
            abort(403);
        }
    }

    public function destroy($id) {
        $inquiry = $this->courseInquireRepository->getById($id);
        abort_unless(Gate::allows('control-course', $inquiry->course), 401);
        if (Gate::allows('operate-inquiry', $inquiry)) {
            DB::beginTransaction();
            try {
                $this->courseInquireRepository->delete($id);
                DB::commit();
                return redirect()->back()->with(['success' => __('messages.Question deleted successfully')]);
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with(['error' => __('messages.Something went wrong')]);
            }
        } else {
            abort(403);
        }
    }
}
