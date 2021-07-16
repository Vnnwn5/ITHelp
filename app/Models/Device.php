<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Device extends Model
{
    use HasFactory;

    protected $fillable =['customer_id','user_id','description','status','entry_date','departure_date'];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
    public function maintenances(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Maintenance')->withTimestamps();;
    }
    public function getEntryDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getDepartureDateAttribute($value)
    {
        if(is_null($value)){
            return '';
        }

        return Carbon::parse($value)->format('d/m/Y');
    }


    public static function devicesFilter($status, $entry_date_from, $entry_date_to)
    {
        return Device::status($status)->entryDate($entry_date_from, $entry_date_to)->paginate(3);
            }
            /**
             * Scope a query to only include devices of a given status.
             *
             * @param \Illuminate\Database\Eloquent\Builder $query
             * @param mixed $status
             * @return \Illuminate\Database\Eloquent\Builder
             */

        public function scopeStatus($query, $status)
        {
            if(!is_null($status)){
                return $query->where('status', $status);
            }

        }
    /**
     * Scope a query to only include devices of a given ebtry dates.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeEntryDate($query, $entry_date_from, $entry_date_to)
    {
        if(!is_null($entry_date_from) && !is_null($entry_date_to)) {
            return $query->whereBetween('entry_date', [$entry_date_from, $entry_date_to]);
        } elseif (!is_null($entry_date_from) && is_null ($entry_date_to)) {
            return $query->where('$entry_date','>=',$entry_date_from);
        }elseif (is_null($entry_date_from) && !is_null ($entry_date_to)) {
            return $query->where('$entry_date','<=',$entry_date_to);
        }
    }
}

