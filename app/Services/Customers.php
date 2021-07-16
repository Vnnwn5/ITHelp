<?php
namespace App\Services;
use App\Models\Customer;


class Customers
{
    public function  get()
     {
         $customers =Customer::all();
         $data= [];
         foreach ($customers as $customer){
             $data[$customer->id]= $customer->name;
         }
         return $data;
     }
    public function getCustomersFromDevice($tech)
     {
             $data= [];
             $ids=[];

        foreach ($tech->devices as $device){
         if (!in_array($device->customer->id, $ids)){
             $data []= $device->customer()->first();
             $ids []= $device->customer->id;
             }
        }
            return $data;
     }
}
