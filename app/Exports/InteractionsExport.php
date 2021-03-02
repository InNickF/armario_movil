<?php

namespace App\Exports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InteractionsExport implements FromCollection, WithHeadings
{

    private $start;
    private $end;

    public function __construct($start = null, $end = null) {
        $this->start = $start;
        $this->end = $end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $rawData = Auth::user()->store->getInteractions($this->start, $this->end);

        $data = new Collection([[
            $rawData['visits']->avg(),
            $rawData['avg_session_duration'], // avg_session_duration
            $rawData['data_pages_per_session']->avg() // avg_session_duration
        ]]);
        
        // dd($data);
        return $data;
    }



    public function headings(): array
    {
        $cols = [
            'Promedio de visitas',
            'Promedio de duración de la sesión',
            'Promedio de páginas por visita',
        ];
        return $cols;
    }



    

}
