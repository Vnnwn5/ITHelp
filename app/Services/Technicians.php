<?php
namespace App\Services;

use App\Models\User;

class Technicians
{
    public function get()
    {
        $technicians = User::where ('id', '!=', 1)->get(); // id1 = admin
        $data = [];

        foreach ($technicians as $technician) {
            $data[$technician->id] = $technician->name;
        }

        return $data;
    }
}
