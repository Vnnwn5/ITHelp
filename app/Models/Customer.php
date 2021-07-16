<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'last_name',
        'id_number',
        'email',
        'address',
        'phone'
    ];
public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }
    public static function customersFilter($data)
    {
        return Customer::clientData($data)->paginate(6);
    }

    public function scopeClientData($query, $client_data)
    {
        if (!empty($client_data)) {
            return $query->where('id_number', $client_data)
                ->orWhere('name', 'LIKE', "%$client_data%")
                ->orWhere('last_name', 'LIKE', "%$client_data%");
        }
    }
}
