<?php
namespace App\Services;

use App\Models\Maintenance;

class Maintenances
{
    public function get()
    {
        $maintenances = Maintenance::all();
        $data = [];

        foreach ($maintenances as $maintenance) {
            $data[$maintenance->id] = $maintenance->name;
        }

        return $data;
    }
}
