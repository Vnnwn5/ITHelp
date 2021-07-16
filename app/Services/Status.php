<?php

namespace App\Services;

class Status
{
    public function get()
    {
        return ['Recibido' => 'Recibido',
            'Procesando' => 'Procesando',
            'Terminado' => 'Terminado',
            'Entregado' => 'Entregado'];
    }
}
