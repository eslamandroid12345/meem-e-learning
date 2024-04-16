<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use LanguageToggle, Sortable;
    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }

    public function indicators() {
        return $this->hasMany(Indicator::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

}
