<?php

namespace App\DataTables\Admin;

use App\Models\FormRequest;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class FormRequestDataTable extends DataTable
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

        $dataTable->filter(function ($query) {
            if (request('start_at') && request('end_at')) {
                $query->whereBetween('created_at', [request('start_at'), request('end_at')]);
            }
            // $keyword = request('search') && request('search')['value'] ? request('search')['value'] : null;

            // if (!$keyword) {
            //     return;
            // }
            // $query->orWhereHas('items.product_variant.product.store', function ($s) use ($keyword) {
            //     $s->where('user_stores.name', 'like', "%{$keyword}%");
            // });
        }, true);


        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FormRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FormRequest $model)
    {
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
            // ->addAction(['width' => '120px', 'title' => 'Acciones'])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-plus"></i> Crear'],
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
            ['data' => 'email', 'name' => 'email', 'title' => 'Email', 'searchable' => true],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Teléfono', 'searchable' => true],
            ['data' => 'message', 'name' => 'message', 'title' => 'Mensaje', 'searchable' => true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha', 'searchable' => false],
            ['data' => 'first_name', 'name' => 'first_name', 'title' => 'Nombre', 'searchable' => true],
            ['data' => 'last_name', 'name' => 'last_name', 'title' => 'Apellidos', 'searchable' => true],
            ['data' => 'subject', 'name' => 'subject', 'title' => 'Motivo', 'searchable' => true],
            ['data' => 'origin', 'name' => 'origin', 'title' => 'Origen', 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'form_requestsdatatable_' . time();
    }
}
