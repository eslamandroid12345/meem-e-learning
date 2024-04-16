<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable, LaratrustUserTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'phone',
        'gender',
        'image',
        'cv_pdf',
        'cv_description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    public function courses(){
        return $this->belongsToMany(Course::class , 'course_teacher');
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

    public function cvPdf() : Attribute {
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
