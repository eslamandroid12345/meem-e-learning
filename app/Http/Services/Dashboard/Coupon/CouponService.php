<?php

namespace App\Http\Services\Dashboard\Coupon;

use App\Http\Requests\Dashboard\Coupons\CouponRequest;
use App\Models\Course;
use App\Models\CourseBook;
use App\Repository\CouponRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CouponService
{
    private CouponRepositoryInterface $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function store(CouponRequest $request){
        DB::beginTransaction();
        try 
        {
            $mobile_only = $request->mobile_only ? 1 : 0;
            $data = $request->validated();
            $this->couponRepository->create([
                'coupon' => $data['coupon'],
                'discount' => $data['discount'],
                'max_uses' => $data['max_uses'],
                'couponable_type' => $data['couponable_type'] ?? null,
                'couponable_id' =>$data['couponable_type'] ? $data['couponable_id'] : null,
                'mobile_only' => $mobile_only,
            ]);
            DB::commit();
            return to_route('coupons.index')->with('success' , __('messages.Coupon created successfully'));
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($id , CouponRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $mobile_only = $request->mobile_only ? 1 : 0;
            $data = $request->validated();
            $data['couponable_id'] = $data['couponable_type'] != null ? $data['couponable_id'] : null;
            $data['mobile_only'] = $mobile_only;
            $this->couponRepository->update($id , $data);
            DB::commit();
            return to_route('coupons.index')->with('success' , __('messages.Coupon updated successfully'));
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function delete($id) {
        $this->couponRepository->delete($id);
        return to_route('coupons.index')->with('success' , __('messages.Coupon deleted successfully'));

    }

}
