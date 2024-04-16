<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPart extends Model
{
    use HasFactory , LanguageToggle;
    protected $guarded = [];


    public function book(){
        return $this->belongsTo(CourseBook::class , 'book_id');
    }

    public function pdfFile() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }
}
