<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function gender ()
    {
        return $this->belongsTo('\App\Models\Gender', 'user_gender');
    }

    public function role ()
    {
        return $this->belongsTo('\App\Models\Role', 'user_role');
    }

    public function country ()
    {
        return $this->belongsTo('\App\Models\Country', 'user_country');
    }

    public function permission ()
    {
        return $this->belongsToMany('\App\Models\Permission', 'user_permission', 'user_id', 'permission_id');
    }
    
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
}
