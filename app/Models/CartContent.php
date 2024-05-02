<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartContent extends Model
{
    use SoftDeletes;
    protected $table = 'carts_contents';
    protected $guarded = [];
    protected $with = ['cartable'];
    protected $appends = [
        'amount',
        'discount_amount',
        'final_amount',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function cartable(){
        return $this->morphTo();
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function amount() : Attribute {
        return Attribute::get(function ($value) {
            return ($this->cartable?->price * $this->quantity);
        });
    }


    public function appAmount() : Attribute {
        return Attribute::get(function ($value) {
            return ($this->cartable?->app_price * $this->quantity);
        });
    }

    public function total() : Attribute {
        return Attribute::get(function ($value) {
            return ($this->cartable?->getRawOriginal('price') * $this->quantity);
        });
    }

    //Added


    public function discountAmount() : Attribute {
        return Attribute::get(function ($value) {
            if ($this->coupon()->exists()) {
                $amount = $this->amount;
                return ($amount * $this->coupon->discount / 100);
            }
            return 0;
        });
    }

    public function finalAmount()  : Attribute{
        return Attribute::get(function ($value) {
           return $this->amount -  $this->discount_amount;
        });
    }

}
