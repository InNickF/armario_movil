<?php

namespace App\DataTables\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->addColumn('billing_summary', function (Order $order) {
            $result = '';

            if ($order->billing_address) {

                $result .= '<p>Nombre: ' . $order->billing_address->given_name . ' </p> ';

                $result .= '<p>Apellidos: ' . $order->billing_address->family_name . '</p> ';
                $result .= '<p>Tipo documento: ' . $order->billing_address->document_type . '</p> ';
                $result .= '<p>Nº documento: ' . $order->billing_address->document_number . '</p> ';
                $result .= '<p>Dirección: ' . $order->billing_address->street . '</p> ';
                $result .= '<p>Teléfono celular: ' . $order->billing_address->phone . '</p> ';
                $result .= '<p>Email: ' . $order->billing_address->email . '</p> ';
            } else {
                $result .= '<p>Nombre: Consumidor </p>
                    <p>Apellido: Finales </p>
                    <p>Tipo documento: Cédula </p>
                    <p>Nº documento: 9999999999 </p>
                    <p>Email: facturas@armariomovil.com </p>
                    <p>Teléfono: 022652229 </p>
                    <p>Provincia: Pichincha </p>
                    <p>Ciudad: Quito </p>
                    <p>Dirección: Juan Lagos S11-77 y Pedro Capiro </p>';
            }

            return $result;
        });



        $dataTable->addColumn('client_summary', function (Order $order) {
          $result = '';


              $result .= '<p>Nombre: ' . $order->user->full_name . ' </p> ';

              $result .= '<p>Email: ' . $order->user->email . '</p> ';
              $result .= '<p>Teléfono celular: ' . $order->user->phone . '</p> ';
              $result .= '<p>Fecha nacimiento: ' . $order->user->dob->format('d-m-Y') . '</p> ';
              $result .= '<p>País: ' . $order->user->country . '</p> ';
              $result .= '<p>Género: ' . $order->user->gender . '</p> ';

          return $result;
      });

        $dataTable->addColumn('items_summary', function (Order $order) {
            $result = '';

            foreach ($order->items as $key => $item) {

                if($item->product_variant) {
                    $result .= "<p>Producto: {$item->product_variant->product->name} (ID: {$item->product_variant->product->id})  </p>/ ";
                    $result .= "<p>Link producto: {$item->product_variant->product->url}  </p>/ ";
                    $result .= "<p>Tienda: {$item->product_variant->product->store->name} (ID: {$item->product_variant->product->store->id})  </p>/ ";
                    $result .= "<p>Calificación tienda: {$item->product_variant->product->store->rating} </p>/ ";
                    $result .= "<p>Link tienda: {$item->product_variant->product->store->url}  </p>/ ";

                    if ($item->product_variant->product->store->user->collecting_method) {
                        $result .= "<p>Datos bancarios: Banco {$item->product_variant->product->store->user->collecting_method->bank->name}, Tipo persona: {$item->product_variant->product->store->user->collecting_method->person_type}, Nombre: {$item->product_variant->product->store->user->collecting_method->name}, Tipo documento: {$item->product_variant->product->store->user->collecting_method->document_type}, Nro documento: {$item->product_variant->product->store->user->collecting_method->document_number}, Tipo cuenta: {$item->product_variant->product->store->user->collecting_method->account_type}, Nro cuenta: {$item->product_variant->product->store->user->collecting_method->account_number}, Email: {$item->product_variant->product->store->user->collecting_method->email}, Telf: {$item->product_variant->product->store->user->collecting_method->phone} </p>/ ";
                    } else {
                        $result .= "<p>Sin datos bancarios </p>/ ";
                    }
                } else {
                    $result .= "<p>No se ha encontrado el producto</p>/ ";
                }
                $result .= "<p>Estado: {$item->status}  </p>/ ";
                $result .= "<p>Tracking: {$item->tracking_url}  </p>/ ";
                $result .= "<p>Factura válida: {$item->is_valid_store_bill}  </p>/ ";
                $result .= "<p>Ganancia pagada: {$item->is_paid_earning}  </p>/ ";
                $result .= "<p>Observaciones: {$item->admin_comment}  </p>/ ";
                $result .= "<p>Precio: {$item->sum_price_final}  </p>/ ";
                $result .= "<p>IVA: {$item->vat_price}  </p>/ ";
                $result .= "<p>Comisión: {$item->commission_price} ({$item->commission_price}%)  </p>/ ";
                $result .= "<p>Ganancia: {$item->earning}  </p>/ ";
                $result .= "--------------------------";
            }
            return $result;
        });


        $dataTable->addColumn('address_summary', function (Order $order) {
            $result = '';

            $result .= "<p>" . ($order->shipping_address ? $order->shipping_address->full_address : '?') . "</p>";

            return $result;
        });


        $dataTable->rawColumns(['billing_summary', 'address_summary', 'items_summary', 'client_summary'], true);


        $dataTable->addColumn('status', function (Order $order) {

            return $order->status->name;
        });

        $dataTable->addColumn('status_slug', function (Order $order) {

          return $order->status->slug;
      });


        $dataTable->filter(function ($query) {
            // if (request('start_at') && request('end_at')) {
            //     $query->whereBetween('created_at', [request('start_at'), request('end_at')]);
            // }
            $keyword = request('search') && request('search')['value'] ? request('search')['value'] : null;
            if (!$keyword) {
                return;
            }
            $query = $query->orWhereHas('items.product_variant.product.store', function ($s) use ($keyword) {
                $s->where('name', 'like', "%{$keyword}%");
            });
        }, true);


        return $dataTable->addColumn('action', 'admin.orders.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {

        $startFilter =  request('start_at') ? Carbon::parse(request('start_at'))->format('Y/m/d') : null;
        $endFilter = request('end_at') ? Carbon::parse(request('end_at'))->format('Y/m/d') : null;
        if ($startFilter) {
            $model = $model->whereDate('created_at', '>=', $startFilter);
        }
        if ($endFilter) {
            $model = $model->whereDate('created_at', '<=', $endFilter);
        }

        // $searchFilter = request('search') && request('search')['value'] ? request('search')['value'] : null;

        // if ($searchFilter) {
        //     $model->whereHas('items.product_variant.product.store', function ($s) use ($searchFilter) {
        //         $s->where('user_stores.name', 'like', "%{$searchFilter}%");
        //     });
        // }
        return $model->with('items.product_variant.product.store.user.collecting_method.bank', 'shipping_address', 'items.order.shipping_orders', 'billing_address', 'items.shipping_order');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax('', null, [
                'start_at' => request('start_at'),
                'end_at' => request('end_at'),
            ])
            // ->addAction(['width' => '120px', 'title' => 'Acciones'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-download"></i> Exportar'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-print"></i> Imprimir'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-undo"></i> Recargar'],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-undo"></i> Reestablecer'],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $expandIcon = 'fa-plus-circle';
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID', 'searchable' => true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            [
                'title' => 'Estatus',
                'data' => 'status',
                'name' => 'status.name',
                'orderable' => false,
                'searchable' => true,
                'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.name
                // }',
            ],
            [
                'title' => 'Total',
                'data' => 'total_price',
                'name' => 'total_price',
                'orderable' => false,
                'searchable' => true,
                // 'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.name
                // }',
            ],
            [
                'title' => 'IVA',
                'data' => 'vat_price',
                'name' => 'vat_price',
                'orderable' => false,
                'searchable' => true,
                // 'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.name
                // }',
            ],
            [
                'title' => 'Costo envío',
                'data' => 'total_shipping_price',
                'name' => 'total_shipping_price',
                'orderable' => false,
                'searchable' => true,
                // 'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.name
                // }',
            ],
            [
                'title' => 'Nº Factura',
                'data' => 'billing_document_id',
                'name' => 'billing_document_id',
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'title' => 'Datos factura',
                'data' => 'billing_summary',
                'name' => 'billing_summary',
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'title' => 'Datos cliente',
                'data' => 'client_summary',
                'name' => 'client_summary',
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'data' => 'address_summary',
                'name' => 'address_summary',
                'title' => 'Dirección de envío',
                // 'render' => 'function(){
                //     return data ? data.street + ", " + data.secondary_street + ", " + data.property_number : "?"
                // }',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'items_summary',
                'name' => 'items_summary',
                'title' => 'Productos',
                // 'render' => 'function(){
                //     return data ? data.street + ", " + data.secondary_street + ", " + data.property_number : "?"
                // }',
                'searchable' => false,
                'orderable' => false,
                'visible' => false
            ],
            [
                'name' => 'actions',
                'title' => 'Detalles / Acciones',
                'data' => 'id',
                'className' => 'expand-details',
                'orderable' => false,
                'searchable' => false,
                'defaultContent' => '',
                'render' => 'function(){
                    return `<i class="fa ' . $expandIcon . ' text-success cursor-pointer"></i>`
                }',
                'exportable' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ordersdatatable_' . time();
    }



    // public function excel()
    // {

    //     dd($this);
    //     $excel = $this->buildExcelFile();
    //     $excel->download('xls');
    // }

}
