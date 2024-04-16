<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasIsActive;
    protected $table = 'course_user';
    protected $guarded = [];

    public function isActive() : Attribute
    {
        return Attribute::make(
            set: fn($value) => $value == 'on'
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
