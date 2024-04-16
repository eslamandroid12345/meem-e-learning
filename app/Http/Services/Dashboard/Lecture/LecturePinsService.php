<?php

namespace App\Http\Services\Dashboard\Lecture;

use App\Repository\LecturePinRepositoryInterface;

class LecturePinsService
{
    private LecturePinRepositoryInterface $lecturePinRepository;

    public function __construct(
        LecturePinRepositoryInterface $lecturePinRepository,
    )
    {
        $this->lecturePinRepository = $lecturePinRepository;
    }

    public function sync($lecture, $pins) {
        $lecturePins = $pins !== null
            ? array_map(function ($pins) use ($lecture) {
                $pins['lecture_id'] = $lecture->id;
                return $pins;
            }, $pins)
            : [];
        $lecture->pins()->delete();
        return $this->lecturePinRepository->insert($lecturePins);
    }

}
