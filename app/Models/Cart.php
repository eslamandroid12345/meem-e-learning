<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = [
        'subtotal_amount',
        'discount_amount',
        'total_amount',
        'items_count'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(CartContent::class);
    }

    public function payment() {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function hasAddress(){
        return $this->items()->where(['cartable_type' => CourseBook::class , 'option' => "PRINT"])->exists();
    }
    public function subtotalAmount() : Attribute {
        return Attribute::get(function ($value) {
            return $this->items->sum('amount');
//            return $this->items->sum('final_amount');
        });
    }

    public function discountAmount() : Attribute {
        return Attribute::get(function ($value) {
            $subtotal = $this->items->sum('amount');
            // $finalValue = 0;
            if ($this->coupon()->exists()) {
                $finalValue = $subtotal * $this->coupon->discount / 100;
            } else {
                $finalValue = $subtotal - $this->items->sum('final_amount');
            }

            $finalValue += $this->items?->sum(function ($item) {
                return abs($item->cartable->getRawOriginal('price') - $item->cartable->price);
            });
            return $finalValue;
        });
    }

    public function totalAmount() : Attribute {
        return Attribute::get(function ($value) {
            $subtotal = $this->items->sum('final_amount');
            if ($this->coupon()->exists()) {
                return $subtotal * (100 - $this->coupon->discount) / 100;
            }
            return $subtotal;
        });
    }

    public function itemsCount() : Attribute {
        return Attribute::get(function () {
            return $this->items()?->sum('quantity');
        });
    }
}
