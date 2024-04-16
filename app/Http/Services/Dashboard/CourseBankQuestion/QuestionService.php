<?php

namespace App\Http\Services\Dashboard\CourseBankQuestion;

use App\Http\Requests\Dashboard\CourseBankQuestion\QuestionRequest;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\CourseBankQuestionRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionService
{

    private CourseBankQuestionRepositoryInterface $questionRepository;

    protected QuestionRepositoryInterface $questionExamRepository;

    protected AnswerRepositoryInterface $answerExamRepository;

    public function __construct(CourseBankQuestionRepositoryInterface $questionRepository,QuestionRepositoryInterface $questionExamRepository, AnswerRepositoryInterface $answerExamRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->questionExamRepository = $questionExamRepository;
        $this->answerExamRepository = $answerExamRepository;
    }

    public function store(QuestionRequest $request,$courseId) {
        DB::beginTransaction();
        try {
            $this->createQuestion($request,$courseId);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Question created successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }

    }

    public function update(QuestionRequest $request, $questionId) {

        DB::beginTransaction();
        try {
            $data = $request->only('content');
            $question = $this->questionRepository->getById($questionId);

            $examQuestions = $this->questionExamRepository->get('course_bank_question_id',$question->id);

            $this->updateQuestion($request, $data, $question,$examQuestions);

            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Question updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($courseId,$questionId) {
        DB::beginTransaction();
        try {
            $this->questionRepository->delete($questionId);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Question deleted successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function createQuestion(QuestionRequest $request,$courseId) {
        $data = $request->only('content');
        $data['course_id'] = $courseId;
        $data['is_active'] = $request->is_active == 1 ? 1 : 0;
        $question = $this->questionRepository->create($data);

        $question->answers()->createMany($request->answers);
        return $question;
    }

    private function recreateQuestion(QuestionRequest $request, $courseId, $question) {
        $newQuestion = $this->createQuestion($request, $courseId);
        $newQuestion->update([
            'created_at' => $question->created_at,
            'updated_at' => $question->updated_at,
        ]);
        $question->update(['is_active' => 0]);
        $question->delete();
        return $newQuestion;
    }

    private function updateQuestion($request, $data, $question,$examQuestions) {

        $data['is_active'] = $request->is_active == 1 ? 1 : 0;

        $editedAnswers = $request['answers'];
        $question->update($data);
        $question->answers()->delete();

        $question->answers()->createMany($editedAnswers);

        foreach ($examQuestions as $examQuestion){

            $this->questionExamRepository->update($examQuestion->id,$data);

            $model = $this->questionExamRepository->getById($examQuestion->id);

            $model->answers()->delete();

            $model->answers()->createMany($editedAnswers);

        }

    }

}
