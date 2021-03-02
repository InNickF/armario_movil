<?php

namespace App\Exports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BusinessProfileExport implements FromCollection, WithHeadings
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
        $rawData = Auth::user()->store->getBusinessProfileSummary($this->start, $this->end);

        $data = collect([$rawData]);
        // dd($data);
        return $data;
    }



    public function headings(): array
    {
        $cols = [
            'Número de seguidores',
            'Número de ventas',
            'Valor de venta promedio',
            'Productos publicados',
            'Venta global'
        ];

        return $cols;
    }



    

}
