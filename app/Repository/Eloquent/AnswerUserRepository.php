<?php

namespace App\Repository\Eloquent;

use App\Models\AnswerUser;
use App\Repository\AnswerUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AnswerUserRepository extends Repository implements AnswerUserRepositoryInterface
{
    protected Model $model;

    public function __construct(AnswerUser $model)
    {
        parent::__construct($model);
    }

    public function correct($examUser, $answer) {
        $answerUser = $this->getById($answer['question_id']);
        $question = $answerUser?->question()?->withTrashed()->active()->first();
        $payload = [];
        $answer = $question?->answers()?->where('id', $answer['answer_id']);
        if ($answer?->exists()) {
            $answer = $answer->first();
            $payload['answer_id'] = $answer->id;
            $payload['is_correct'] = $answer->is_correct;
        }
        return $this->update($answerUser->id, $payload);
    }

    public function isCorrectCount($examUserId) {
        return $this->model::query()->where('exam_user_id', $examUserId)->isCorrect()->count();
    }

    private function byType($examUserId, $typeRelationName, $typeId, $isCorrectOnly = true) {
        return $this->model::query()
            ->where('exam_user_id', $examUserId)
            ->where(function ($query) use ($typeRelationName, $typeId) {
                $query->whereHas('question', function ($query) use ($typeRelationName, $typeId) {
                    $query->whereHas($typeRelationName, function ($query) use ($typeRelationName, $typeId) {
                        $query->where($typeRelationName.'s.id', $typeId);
                    });
                });
            })
            ->when($isCorrectOnly, function ($query) {
                $query->isCorrect();
            });
    }

    public function countByType($examUserId, $typeRelationName, $typeId, $isCorrectOnly = true)
    {
        return $this->byType($examUserId, $typeRelationName, $typeId, $isCorrectOnly)->count();
    }

    public function getQuestionsByType($examUserId, $typeRelationName, $typeId, $isCorrectOnly = true)
    {
        return $this->byType($examUserId, $typeRelationName, $typeId, $isCorrectOnly)->get();
    }
    public function getExamNumbersDetails($exam_id){
        $degrees = [];
        $totalAttempts = 0;
        $examAttempts =  $this->model::query()->whereHas('exam' , function ($query) use ($exam_id){
            $query->where('exam_id' , $exam_id)->where('is_ended' , true);
        })->get()->groupBy('exam_user_id');
        if ($examAttempts->count() > 0){
            foreach ($examAttempts as $attempts){
                $totalAttempts++;
                $totalNumber = 0;
                $correctNumber = 0;
                foreach ($attempts as $answer){
                    $totalNumber++;
                    if ($answer['is_correct'])
                        $correctNumber++;
                }
                $result = ($correctNumber / $totalNumber) * 100;

                if (isset($degrees["$result"]))
                    $degrees["$result"]['count']++;
                else{
                    $degrees["$result"]['degree'] = $result;
                    $degrees["$result"]['count'] = 1;
                }

            }
            $maxDegree = max($degrees);
            $minDegree = min($degrees);
            return [
                'total' => $totalAttempts,
                'max' => $maxDegree,
                'min' => $minDegree
            ];
        }

        return [
            'total' => 0,
            'max' => 0,
            'min' => 0
        ];




    }

}
