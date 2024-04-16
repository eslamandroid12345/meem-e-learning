<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
