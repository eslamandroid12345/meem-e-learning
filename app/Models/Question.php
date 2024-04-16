<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasIsActive;

    protected $guarded = [];

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function userAnswers() {
        return $this->hasMany(AnswerUser::class);
    }

    public function indicator() {
        return $this->belongsTo(Indicator::class);
    }

    public function standard() {
        return $this->belongsTo(Standard::class);
    }

    public function isActive() : Attribute
    {
        return Attribute::make(
            set: fn($value) => $value == 'on' || $value == 1
        );
    }

    public function allAnswers(){
        return $this->hasMany(AnswerUser::class)->count();
    }
    public function correctAnswers(){
        return $this->hasMany(AnswerUser::class)->where('is_correct' , true)->count();
    }

}
