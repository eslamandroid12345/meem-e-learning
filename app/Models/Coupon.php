<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, HasIsActive;
    protected $guarded = [];


    public function carts() {
        return $this->hasMany(Cart::class)->withTrashed();
    }

    public function cartItems() {
        return $this->hasMany(CartContent::class);
    }

    public function couponable(){
        return $this->morphTo();
    }
    public function coupon() : Attribute {
        return Attribute::set(fn($value) => strtolower($value));
    }

    public function isActive() : Attribute {
        return Attribute::make(
            set: fn ($value) => $value == 'on'
        );
    }

    public function uses(){
        return collect($this->carts)->merge($this->cartItems);
    }
}
