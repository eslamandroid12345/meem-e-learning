<?php

namespace App\Repository;

interface AnswerUserRepositoryInterface extends RepositoryInterface
{

    public function correct($examUser, $answer);

    public function isCorrectCount($examUserId);

    public function countByType($examUserId, $typeRelationName, $typeId, $isCorrectOnly = true);

    public function getQuestionsByType($examUserId, $typeRelationName, $typeId, $isCorrectOnly = true);

    public function getExamNumbersDetails($exam_id);

}
