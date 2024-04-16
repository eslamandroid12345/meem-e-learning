<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturePin extends Model
{
    use LanguageToggle;

    protected $table = 'lectures_pins';
    protected $guarded = [];

    public function lecture() {
        return $this->belongsTo(Lecture::class);
    }
}
