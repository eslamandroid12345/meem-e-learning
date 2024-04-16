<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasUuids;
    protected $guarded = [];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function isCorrect() : Attribute {
        return Attribute::make(
            set: function ($value) {
                if ($value !== null) {
                    return $value == 'on' || $value == 1;
                }
                return false;
            }
        );
    }
}
