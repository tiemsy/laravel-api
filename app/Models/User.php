<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'api_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Undocumented function
     *
     * @param [type] $publishedAt
     * @return void
     */
    public function setEmailVerifiedAtAttribute($emailVerifiedAt)
    {
        $emailVerifiedAt = now();
        $this->attributes['email_verified_at'] = $emailVerifiedAt;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'email_verified_at'];
    }
}
