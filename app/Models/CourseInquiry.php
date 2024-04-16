<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInquiry extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['is_answered'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attachment() : Attribute{
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }

    public function isAnswered() : Attribute {
        return Attribute::get(fn($value) => !empty($this->answer) || !empty($this->answer_voice));
    }

    public function isPublic() : Attribute {
        return Attribute::make(
            set: fn ($value) => $value == 'on'
        );
    }


}
