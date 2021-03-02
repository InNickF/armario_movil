<?php

namespace App\Services;


class DaysService
{
    
    public function __construct()
    {
    }

    public static function getDays() {
       return [
           'monday' => 'Lunes',
           'tuesday' => 'Martes',
           'wednesday' => 'Miércoles',
           'thursday' => 'Jueves',
           'friday' => 'Viernes',
           'saturday' => 'Sábado',
           'sunday' => 'Domingo',
       ];
    }


}
