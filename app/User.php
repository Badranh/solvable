<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //roles:
    //0 = admin
    //1 = user
    protected $attributes = [
        'approved' => false,
        'role' => 1,
        'iteration' => 1,
        'workshop_id' => 0,
        'workshop_pos' => 0,
    ];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function card() {
        return $this->hasOne(Card::class);
    }
    
}
