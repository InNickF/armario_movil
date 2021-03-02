<?php

namespace App\Exports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FunnelExport implements FromCollection, WithHeadings
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
        $rawData = Auth::user()->store->getFunnelData($this->start, $this->end);

        $data = new Collection();
        $rawData->each(function($eventItemsByMonth, $eventName) use (&$data) {
            // dd($eventItemsByMonth);

           $row = [$eventName];
           $row = array_merge($row, collect($eventItemsByMonth)->map(function($event_data){ return (string)$event_data; })->flatten()->toArray());
           $data[] = $row;
        });

        // dd($data);
        return $data;
    }



    public function headings(): array
    {
        $cols = [
            'Categoría'
        ];

        $period = CarbonPeriod::create($this->start, '1 month', $this->end);
        foreach ($period as $key => $dt) {
            $cols[] = $dt->format('M/Y');
        }

        $cols[] = 'TOTAL';
        return $cols;
    }





}
