<?php

namespace App\DataTables\Admin;

use Carbon\Carbon;
use App\Models\Product;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
        $plans = app('rinvex.subscriptions.plan')->whereIn('slug', ['cool', 'chic', 'fashion'])->get();

        $dataTable->addColumn('plan_name', function (Product $product) use ($plans) {
            return (string) view('admin.products.datatables_plan', compact('plans', 'product'));
        });

        $dataTable->addColumn('plan_name_export', function (Product $product) use ($plans) {
            return $product->plan->name ?? 'Sin plan';
        });

        $dataTable->addColumn('name', function (Product $product) {
            return (string) '<a href="' . $product->url . '" target="_blank">' . $product->name . '</a>';
        });


        $dataTable->addColumn('subcategories', function (Product $product) {

            $result = '';

            if ($product->subcategory) {
                $result .= '<p>' . $product->subcategory->name . ' </p>';
            }

            if ($product->subsubcategory) {
                $result .= '<p>' . $product->subsubcategory->name . ' </p>';
            }

            return (string) $result;
        });


        $dataTable->addColumn('colors_html', function (Product $product) {
            $result = '<div class="d-flex">';

            foreach ($product->colors as $key => $color) {
                $result .= '<div style="background-color:' . $color . ';width:20px;height:20px;margin:3px;" ></div>';
            }

            $result .= '</div>';

            return (string) $result;
        });


        $dataTable->addColumn('colors_html_export', function (Product $product) {
            $result = '<div class="d-flex">';

            foreach ($product->colors as $key => $color) {
                $result .= '<div>' . $color . ' </div>';
            }

            $result .= '</div>';

            return (string) $result;
        });


        $dataTable->addColumn('sizes_html', function (Product $product) {
            $result = '';

            foreach ($product->sizes as $size) {
                $result .= '<p>' . $size . ' </p>';
            }

            return (string) $result;
        });

        $dataTable->filter(function ($query) {

            $keyword = request('search') && request('search')['value'] ? request('search')['value'] : null;

            if (!$keyword) {
                return;
            }

            $query->whereHas('store.user', function ($s) use ($keyword) {
                $s->orWhere('users.first_name', 'like', "%{$keyword}%")
                    ->orWhere('users.last_name', 'like', "%{$keyword}%")
                    ->orWhere('users.email', 'like', "%{$keyword}%")
                    ->orWhere('users.city', 'like', "%{$keyword}%")
                    ->orWhere('users.state', 'like', "%{$keyword}%");
            });

            $query->whereHas('store.address', function ($s) use ($keyword) {
                $s->orWhere('addresses.email', 'like', "%{$keyword}%")
                    ->orWhere('addresses.city', 'like', "%{$keyword}%")
                    ->orWhere('addresses.state', 'like', "%{$keyword}%")
                    ->orWhere('addresses.district', 'like', "%{$keyword}%")
                    ->orWhere('addresses.country_code', 'like', "%{$keyword}%")
                    ->orWhere('addresses.document_number', 'like', "%{$keyword}%");
            });
        }, true);

        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->orWhere('name', 'like', "%{$keyword}%");
        }, true);

        $dataTable->rawColumns(['name', 'plan_name', 'subcategories', 'colors_html', 'colors_html_export', 'sizes_html'], true);
        return $dataTable->addColumn('action', 'admin.products.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        $startFilter =  request('start_at') ? Carbon::parse(request('start_at'))->format('Y/m/d') : null;
        $endFilter = request('end_at') ? Carbon::parse(request('end_at'))->format('Y/m/d') : null;
        if ($startFilter) {
            $model = $model->whereDate('created_at', '>=', $startFilter);
        }
        if ($endFilter) {
            $model = $model->whereDate('created_at', '<=', $endFilter);
        }

        return $model->newQuery();
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
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'title' => 'Acciones'])
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
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID', 'searchable' => true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación'],
            [
                'data' => 'plan_name', 'name' => 'plan_name', 'title' => 'Plan',
                'render' => 'function(){
                       return data ? data : "?"
                    }',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ],
            [
                'data' => 'plan_name_export', 'name' => 'plan_name', 'title' => 'Plan',
                'render' => 'function(){
                       return data ? data : "?"
                    }',
                'searchable' => false,
                'orderable' => false,
                'visible' => false
            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Nombre',
                'searchable' => true,
                'orderable' => false,
            ],
            ['data' => 'description', 'name' => 'description', 'title' => 'Descripción'],
            [
                'data' => 'main_image',
                'name' => 'main_image',
                'title' => 'Foto',
                'searchable' => false,
                'orderable' => false,
                'render' => 'function(){
                    return `<img src="${data}" class="img-fluid">`
                }',
            ],
            [
                'data' => 'store.name',
                'name' => 'store.name',
                'title' => 'Tienda',
                'searchable' => true,
                'orderable' => false,
                'render' => 'function(){
                    return data ? data : "?"
                }',
            ],
            [
                'data' => 'category.name',
                'name' => 'category.name',
                'title' => 'Categoría',
                'searchable' => true,
                'orderable' => false,
                // 'render' => 'function(){
                //     return data
                // }',
            ],
            [
                'data' => 'subcategories',
                'name' => 'subcategories',
                'title' => 'Subcategorías',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'colors_html',
                'name' => 'colors_html',
                'title' => 'Colores',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ],
            [
                'data' => 'colors_html_export',
                'name' => 'colors_html_export',
                'title' => 'Colores',
                'searchable' => false,
                'orderable' => false,
                'visible' => false
            ],
            [
                'data' => 'sizes_html',
                'name' => 'sizes_html',
                'title' => 'Tallas',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'total_stock',
                'name' => 'total_stock',
                'title' => 'Stock total',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'has_guarantee', 'name' => 'has_guarantee', 'title' => 'Tiene garantía',
                'render' => 'function(){
                       return data ? "Sí" : "No"
                    }',
            ],
            [
                'data' => 'guarantee_time_months', 'name' => 'guarantee_time_months', 'title' => 'Meses garantía',
            ],
            [
                'data' => 'price', 'name' => 'price', 'title' => 'Precio inicial',
                'render' => 'function(){
                       return `$${data}`
                    }',
            ],
            [
                'data' => 'final_price', 'name' => 'final_price', 'title' => 'Precio final',
                'render' => 'function(){
                       return `$${data}`
                    }',
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
        return 'productsdatatable_' . time();
    }
}
