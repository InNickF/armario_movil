<?php

namespace App\Exports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategorySalesExport implements FromCollection, WithHeadings
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
        $rawData = Auth::user()->store->getSalesBySubcategories($this->start, $this->end);

        $data = new Collection();
        $rawData->each(function($catItemsByMonth, $catName) use (&$data) {
           $row = [$catName];
           $row = array_merge($row, collect($catItemsByMonth)->map(function($cat_data){ return (string)$cat_data; })->flatten()->toArray());
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
