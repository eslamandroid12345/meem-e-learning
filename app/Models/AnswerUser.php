<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AnswerUser extends Model
{
    use HasUuids;

    protected $table = 'answer_user';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answer() {
        return $this->belongsTo(Answer::class);
    }

    public function question() {
        return $this->belongsTo(Question::class)->withTrashed();
    }

    public function standard() {
        return $this->hasOneThrough(Standard::class, Question::class)->withTrashedParents();
    }

    public function indicator() {
        return $this->hasOneThrough(Indicator::class, Question::class)->withTrashedParents();
    }

    public function exam() {
        return $this->belongsTo(ExamUser::class, 'exam_user_id');
    }

    public function scopeIsCorrect($query) {
        return $query->where('is_correct', true);
    }
}
