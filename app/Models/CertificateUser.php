<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateUser extends Model
{
    protected $table = 'certificate_user';
    protected $appends = ['amount'];
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function printRequest() {
        return $this->belongsTo(PrintRequest::class, 'print_request_id');
    }

    public function amount() : Attribute {
        return Attribute::get(function ($value) {
            return $this->course->certificate_price;
        });
    }
}
