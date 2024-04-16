<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'users_addresses';
    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
