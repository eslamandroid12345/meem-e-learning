<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
