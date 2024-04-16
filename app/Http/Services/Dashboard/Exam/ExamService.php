<?php

namespace App\Http\Services\Dashboard\Exam;

use App\Http\Requests\Dashboard\CourseBankQuestion\ExamBankQuestionsRequest;
use App\Http\Requests\Dashboard\Exam\ExamRequest;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\CourseBankQuestionRepositoryInterface;
use App\Repository\ExamRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExamService
{
    private ExamRepositoryInterface $examRepository;

    protected CourseBankQuestionRepositoryInterface $courseBankQuestionRepository;

    protected QuestionRepositoryInterface $questionRepository;
    protected AnswerRepositoryInterface $answerRepository;

    public function __construct(ExamRepositoryInterface $examRepository,CourseBankQuestionRepositoryInterface $courseBankQuestionRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository){
        $this->examRepository = $examRepository;
        $this->courseBankQuestionRepository = $courseBankQuestionRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }


    public function store(ExamRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            $data['is_free'] = $request['is_free'] == 'on';
            $this->examRepository->create($data);
            DB::commit();
            return redirect()->route('exams.index')->with(['success' => __('messages.Exam created successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($id , ExamRequest $request){
        $exam = $this->examRepository->getById($id);
        abort_unless(Gate::allows('control-course', $exam->course), 401);
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            $data['is_free'] = $request['is_free'] == 'on';
            $this->examRepository->update($id , $data);
            DB::commit();
            return redirect()->route('exams.index')->with(['success' => __('messages.Exam updated successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }



    public function delete($id) {
        $exam = $this->examRepository->getById($id);
        abort_unless(Gate::allows('control-course', $exam->course), 401);
        if (Gate::allows('delete-exam', $exam)) {
            $exam->delete();
            return redirect()->route('exams.index')->with(['success' => __('messages.Exam deleted successfully')]);
        } else {
            return redirect()->route('exams.index')->with(['error' => __('messages.Exam cannotBeDeleted')]);
        }
    }



    public function storeBankQuestions(ExamBankQuestionsRequest $request,$examId){

        foreach ($request->questions as $id){

            $courseBankQuestion = $this->courseBankQuestionRepository->getById($id);

            $question = $this->questionRepository->create([
                'content' => $courseBankQuestion->content,
                'exam_id' =>  $examId,
                'standard_id' => $request->standard_id ?? null,
                'indicator_id' => $request->indicator_id ?? null,
                'course_bank_question_id' => $id,
                'is_active' => $courseBankQuestion->is_active,

            ]);

            foreach ($courseBankQuestion->answers as $answer){
                $this->answerRepository->create([
                    'question_id' => $question->id,
                    'content' => $answer->content,
                    'comment' => $answer->comment,
                    'is_correct' => $answer->is_correct,
                    'course_bank_answer_id' => $answer->id,
                ]);
            }

        }

        return redirect()->route('exams.index')->with(['success' => __('messages.created successfully')]);

    }

}
