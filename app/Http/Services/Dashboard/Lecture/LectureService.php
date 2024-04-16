<?php

namespace App\Http\Services\Dashboard\Lecture;

use App\Http\Requests\Dashboard\Lecture\LectureRequest;
use App\Repository\IndicatorRepositoryInterface;
use App\Repository\LecturePinRepositoryInterface;
use App\Repository\LectureRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class LectureService
{
    private LectureRepositoryInterface $lectureRepository;
    protected LecturePinsService $lecturePins;
    protected LectureIndicatorsService $lectureIndicators;

    public function __construct(
        LectureRepositoryInterface $lectureRepository,
        LecturePinsService $lecturePinsService,
        LectureIndicatorsService $lectureIndicatorsService,
    )
    {
        $this->lectureRepository = $lectureRepository;
        $this->lecturePins = $lecturePinsService;
        $this->lectureIndicators = $lectureIndicatorsService;
    }

    public function store(LectureRequest $request) {
        $lectureData = $request->only(['type', 'standard_id', 'name_ar', 'name_en','description_ar' , 'description_en' ,  'duration' , 'record_link', 'publish_at', 'live_link', 'starts_at', 'ends_at', 'is_active', 'is_free', 'link_platform', 'sort']);
        DB::beginTransaction();
        try {
            //TODO Change In Production With Publish_at CronJob
            $lectureData['is_published'] = true;

            $lecture = $this->lectureRepository->create($lectureData);
            $this->lecturePins->sync($lecture, $request->pins);
            $this->lectureIndicators->sync($lecture, $request->indicators);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Lecture created successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update(LectureRequest $request, $id) {
        $lectureData = $request->only(['type', 'standard_id', 'name_ar', 'name_en', 'record_link', 'publish_at', 'live_link', 'starts_at', 'ends_at', 'is_active', 'is_free' , 'link_platform','description_ar' , 'description_en' , 'sort', 'duration']);
        DB::beginTransaction();
        try {
            $lecture = $this->lectureRepository->getById($id);
            abort_unless(Gate::allows('control-course', $lecture->standard->course), 401);
            $lecture->update($lectureData);
            $this->lecturePins->sync($lecture, $request->pins);
            $this->lectureIndicators->sync($lecture, $request->indicators);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Lecture updated successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id) {
        $lecture = $this->lectureRepository->getById($id);
        abort_unless(Gate::allows('control-course', $lecture->standard->course), 401);
        if (Gate::allows('delete-lecture', $lecture)) {
            $lecture->delete();
            return redirect()->back()->with(['success' => __('messages.Lecture deleted successfully')]);
        } else {
            return redirect()->back()->with(['error' => __('messages.Lecture cannotBeDeleted')]);
        }
    }

}
