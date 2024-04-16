<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintRequest extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['btnColor'];


    public function getBtnColorAttribute(): string{
        return match ($this->status) {
            "ORDERED" => 'info',
            "APPROVED" => 'primary',
            "DELIVERED" => "success",
            "CANCELED" => "danger",
        };
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function book(){
        return $this->belongsTo(CourseBook::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function address(){
        return $this->belongsTo(UserAddress::class , 'address_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }


}
