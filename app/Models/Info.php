<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory,LanguageToggle;
    protected $guarded = [];
    public function getNameAttribute(){
        return $this->t('name');
    }

    public function value() : Attribute
    {
        return Attribute::get(function ($value) {
            return $this->type == 'image' && $value !== null ? url($value) : $value;
        });
    }
}
