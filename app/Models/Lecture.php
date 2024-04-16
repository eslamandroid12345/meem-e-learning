<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use App\Http\Traits\LanguageToggle;
use App\Http\Traits\Sortable;
use App\Models\Scopes\LectureSortScope;
use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use LanguageToggle, HasIsActive;
    protected $guarded = [];

    protected static function booted(): void {
        static::addGlobalScope(new LectureSortScope);
    }

//    public function course() {
//        return $this->hasOneThrough(Course::class, Standard::class);
//    }

    public function standard() {
        return $this->belongsTo(Standard::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }

    public function pins() {
        return $this->hasMany(LecturePin::class)->orderByRaw("TIME_FORMAT(time, '%H:%i:%s') ASC");
    }

    public function indicators() {
        return $this->hasMany(Indicator::class);
    }

    public function isActive() : Attribute {
        return Attribute::make(
            set: fn ($value) => $value == 'on'
        );
    }

    public function isFree() : Attribute {
        return Attribute::make(
            set: fn ($value) => $value == 'on'
        );
    }

    public function scopeWatchable(Builder $query){
        $query->where(['is_published' => true , 'is_active' => true])->where(function ($query){
           $query->whereNotNull('live_link')->orWhereNotNull('record_link');
        });
    }


}
