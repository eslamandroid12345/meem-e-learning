<?php

namespace App\Http\Controllers\Dashboard\CourseBankQuestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CourseBankQuestion\QuestionRequest;
use App\Http\Services\Dashboard\CourseBankQuestion\QuestionService;
use App\Repository\CourseBankQuestionRepositoryInterface;
use App\Repository\CourseRepositoryInterface;

class CourseBankQuestionController extends Controller
{

    private CourseBankQuestionRepositoryInterface $questionRepository;

    protected QuestionService $question;

    protected CourseRepositoryInterface $courseRepository;

    public function __construct(
        CourseBankQuestionRepositoryInterface $questionRepository,
        CourseRepositoryInterface $courseRepository,
        QuestionService $questionService,
    )
    {

        $this->questionRepository = $questionRepository;
        $this->question = $questionService;
        $this->courseRepository = $courseRepository;
    }

    public function create($courseId)
    {
        $course = $this->courseRepository->getById($courseId);
        return view('dashboard.site.course_bank_questions.create', ['course' => $course]);
    }

    public function store(QuestionRequest $request,$courseId)
    {
        return $this->question->store($request,$courseId);
    }

    public function edit($courseId,$questionId)
    {

        $question = $this->questionRepository->getById($questionId);
        $course = $this->courseRepository->getById($courseId);

        return view('dashboard.site.course_bank_questions.edit', ['question' => $question,'course' => $course]);
    }

    public function update(QuestionRequest $request, $questionId)
    {
        return $this->question->update($request, $questionId);
    }

    public function destroy($courseId,$questionId)
    {

        return $this->question->destroy($courseId,$questionId);
    }
}
