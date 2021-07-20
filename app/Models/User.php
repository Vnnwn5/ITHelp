<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
        'last_name',
        'email', 'password'
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

    public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }

    public static function techniciansFilter($data)
    {
        return User::techData($data)->paginate(10);
    }

    public function scopeTechData($query, $tech_data)
    {
        if (!empty($tech_data)) {
            return $query->where('name', 'LIKE', "%$tech_data%")
                       ->orWhere('last_name', 'LIKE', "%$tech_data%")
                       ->orWhere('email', 'LIKE', "%$tech_data%");
        }
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function isAdmin()
    {
        return $this->type == 1;
    }
}
