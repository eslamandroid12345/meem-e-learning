<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function payable() {
        return $this->morphTo();
    }

    public function printRequests(){
        return $this->hasMany(PrintRequest::class , 'payment_id');
    }

}
