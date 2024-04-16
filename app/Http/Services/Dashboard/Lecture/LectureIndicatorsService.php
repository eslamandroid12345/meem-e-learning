<?php

namespace App\Http\Services\Dashboard\Lecture;

use App\Repository\IndicatorRepositoryInterface;
use App\Repository\LecturePinRepositoryInterface;
use App\Repository\LectureRepositoryInterface;

class LectureIndicatorsService
{
    private IndicatorRepositoryInterface $indicatorRepository;

    public function __construct(
        IndicatorRepositoryInterface $indicatorRepository,
    )
    {
        $this->indicatorRepository = $indicatorRepository;
    }

    public function sync($lecture, $indicators) {
        $lectureIndicators = $indicators !== null
            ? array_map(function ($indicators) use ($lecture) {
                $indicators['standard_id'] = $lecture->standard_id;
                $indicators['lecture_id'] = $lecture->id;
                return $indicators;
            }, $indicators)
            : [];
        $lecture->indicators()->delete();
        return $this->indicatorRepository->insert($lectureIndicators);
    }

}
