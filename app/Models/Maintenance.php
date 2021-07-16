<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable= ['name','price'];

    public function devices()
    {
        return $this->belongsToMany('App\Models\Device')->withTimestamps();
    }
    public static function maintenancesFilter($name)
    {
        return Maintenance::name($name)->paginate(15);
    }
    public function scopeName($query, $name)
    {
        if(!empty($name)){
            return $query->where('name','LIKE', "%$name%");
        }
    }
}
