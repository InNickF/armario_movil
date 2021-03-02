<?php

namespace App\Exports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;

class CityVisitsExport implements FromCollection, WithHeadings
{

    private $start;
    private $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rawData = Auth::user()->store->getVisitsByCities($this->start, $this->end);

        $data = new Collection();
        $rawData->each(function($cityItemsByMonth, $cityName) use (&$data) {
           $row = [$cityName];
           $row = array_merge($row, $cityItemsByMonth->flatten()->toArray());
           $data[] = $row;
        });
        return $data;
    }



    public function headings(): array
    {
        $cols = [
            'Ciudad'
        ];

        $period = CarbonPeriod::create($this->start, '1 month', $this->end);
        foreach ($period as $key => $dt) {
            $cols[] = $dt->format('M/Y');
        }
        $cols[] = 'TOTAL';
        return $cols;
    }



    // public function map($order_item): array
    // {
    //     return [
    //         $order_item->order->id,
    //         $order_item->product_variant->product->category->name,
    //         $order_item->product_variant->product->name,
    //         $order_item->quantity,
    //         $order_item->created_at,
    //         $order_item->earning,
    //         $order_item->status,
    //     ];
    // }
}
