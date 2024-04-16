<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBook extends Model
{
    use HasFactory, LanguageToggle;
    protected $guarded = [];


    public function showInStore() : Attribute {
        return Attribute::make(
            set: fn ($value) => $value == 'on'
        );
    }

    public function isPurchasedBefore() : Attribute {
        return Attribute::get(function () {
            return auth('api')->check() && $this->users()->where('users.id', auth('api')->id())->exists();
        });
    }

    public function isPrintedBefore() : Attribute {
        return Attribute::get(function () {
            return auth('api')->check() && $this->printRequests()->where('user_id', auth('api')?->id())->exists();
        });
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function cart(){
        return $this->morphOne(CartContent::class , 'cartable');
    }

    public function printRequests(){
        return $this->hasMany(PrintRequest::class, 'book_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'book_user');
    }

    public function payment() {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function parts(){
        return $this->hasMany(BookPart::class , 'book_id');
    }

    public function bookPdf() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
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

    public function appPrice(): Attribute{

        return Attribute::get(function (){
            return $this->price;
        });
    }
}
