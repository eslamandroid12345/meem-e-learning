<?php

namespace App\Http\Services\Dashboard\Exam;

use App\Http\Requests\Dashboard\Exam\QuestionRequest;
use App\Repository\CourseBankQuestionAnswerRepositoryInterface;
use App\Repository\CourseBankQuestionRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    private QuestionRepositoryInterface $questionRepository;

    public function __construct(
        QuestionRepositoryInterface $questionRepository,

    )
    {
        $this->questionRepository = $questionRepository;

    }

    public function store(QuestionRequest $request, $examId) {
        DB::beginTransaction();
        try {
            $this->createQuestion($request, $examId);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Question created successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }

    }

    public function update(QuestionRequest $request, $examId, $questionId) {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $question = $this->questionRepository->getById($questionId);
            if($question->userAnswers->count() > 0) {
                $newQuestion = $this->recreateQuestion($request, $examId, $question);
                DB::commit();
                return redirect()->route('questions.edit', [$examId, $newQuestion->id])->with(['success' => __('messages.Question updated successfully')]);
            } else {
                $this->updateQuestion($request, $data, $question);
                DB::commit();
                return redirect()->back()->with(['success' => __('messages.Question updated successfully')]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($questionId) {
        DB::beginTransaction();
        try {
            $this->questionRepository->delete($questionId);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Question deleted successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function createQuestion(QuestionRequest $request, $examId) {
        $data = $request->validated();

        $question = $data['question'];
        $question['exam_id'] = $examId;
        $question = $this->questionRepository->create($question);

        $answers = $request['answers'];
        $answers = array_map(function ($item) use ($question) {
            return ['question_id' => $question->id] + $item;
        }, $answers);
        $question->answers()->createMany($answers);
        return $question;
    }

    private function recreateQuestion(QuestionRequest $request, $examId, $question) {
        $newQuestion = $this->createQuestion($request, $examId);
        $newQuestion->update([
            'created_at' => $question->created_at,
            'updated_at' => $question->updated_at,
        ]);
        $question->update(['is_active' => 0]);
        $question->delete();
        return $newQuestion;
    }

    private function updateQuestion($request, $data, $question) {
        $editedQuestion = $data['question'];
        $editedAnswers = $request['answers'];

        $editedAnswers = array_map(function ($item) use ($question) {
            return ['question_id' => $question->id] + $item;
        }, $editedAnswers);

        $question->update($editedQuestion);
        $question->answers()->delete();
        return $question->answers()->createMany($editedAnswers);
    }
}
