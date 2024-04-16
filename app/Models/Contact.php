<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getIsReadedAttribute()
    {
        if(app()->getLocale()=='en')
        {
            if($this->attributes['is_readed'] == 0)
            {
                return __('dashboard.notreply');
            }
            else
            {
                return __('dashboard.reply');
            }
        }
        else
        {
            if($this->attributes['is_readed'] == 0)
            {
                return __('dashboard.notreply');
            }
            else
            {
                return __('dashboard.reply');
            }
        } 
    }
}
