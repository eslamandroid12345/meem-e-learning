<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use App\Http\Traits\Sortable;
use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory , LanguageToggle, Sortable;
    protected $guarded = [];

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function activeCategories()
    {
        return $this->categories()->where('is_active', true);
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

    public function commonQuestions() : Attribute {
        return Attribute::make(
            get: function ($value) {
                return json_decode($value, true);
            },
            set: function ($value) {
                return json_encode($value);
            }
        );
    }
}
