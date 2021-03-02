<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SoldProductsExport implements FromCollection, WithMapping, WithHeadings
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
        $data = Auth::user()->store->getOrderItems($this->start, $this->end)->latest()->get();
        return $data;
    }



    public function headings(): array
    {
        return [
            '# de pedido',
            'Categoría',
            'Producto',
            'Cantidad',
            'Fecha de creación',
            'Ganancia',
            'Estado',
        ];
    }



    public function map($order_item): array
    {
        return [
            $order_item->order->id,
            $order_item->product_variant->product->category->name,
            $order_item->product_variant->product->name,
            $order_item->quantity,
            $order_item->created_at,
            $order_item->earning,
            $order_item->status,
        ];
    }
}