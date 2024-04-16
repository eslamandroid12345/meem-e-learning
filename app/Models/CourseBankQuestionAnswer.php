<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseBankQuestionAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function question(): BelongsTo
    {
        return $this->belongsTo(CourseBankQuestion::class,'question_id','id');
    }

    public function isCorrect() : Attribute {
        return Attribute::make(
            set: function ($value) {
                if ($value !== null) {
                    return $value == 'on';
                }
                return false;
            }
        );
    }

}
