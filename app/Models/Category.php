<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, LanguageToggle, Sortable;
    protected $guarded = [];

    public function field(){
        return $this->belongsTo(Field::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }


    public function image() : Attribute {
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
