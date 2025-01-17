<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    use HasIsActive;
    protected $table = 'book_user';
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

    public function book(){
        return $this->belongsTo(CourseBook::class , 'course_book_id');
    }


}
