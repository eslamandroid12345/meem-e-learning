<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Support\Facades\DB;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use LanguageToggle;
    public $guarded = [];

    public function managersCount(){
        return DB::table('role_user')->where('role_id' , $this->id)->count();
    }

    public function users() {
        return $this->belongsToMany(Manager::class , 'role_user' , 'role_id' , 'user_id');
    }
}
