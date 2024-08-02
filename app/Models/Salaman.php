<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Salaman extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "salaman";
    protected $primaryKey = "id";

//    protected $fillable = [
//
//        'nama_user',
//        'email_user',
//        'password',
//        'no_hp',
//        'roles',
//
//    ];
    protected $guarded = [
        "id"
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
