<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSolution extends Model
{
    use HasFactory , LanguageToggle;
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
