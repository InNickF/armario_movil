<?php

namespace App\DataTables\Admin;

use App\Models\Slider;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SliderDataTable extends DataTable
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

        $dataTable->addColumn('slides_count', function (Slider $slider) {
            return  $slider->slides->count();
            // return [
            //     "count' => $store->slides()->get()->count(),
            //     'store_id' => $store->id
            // ];
        })->rawColumns(['slides_count'], true);

        return $dataTable->addColumn('action', 'admin.sliders.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {
        return $model->with(['category', 'slides']);
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Nombre', 'searchable' => true],
            ['data' => 'position', 'name' => 'position', 'title' => 'Posición', 'searchable' => true],
            ['data' => 'type', 'name' => 'type', 'title' => 'Tipo', 'searchable' => true],
            // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            [
                'title' => 'Categoría',
                'data' => 'category.name',
                'name' => 'category.name',
                'orderable' => false,
                'searchable' => true,
                'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.name
                // }',
            ],
            [
                'title' => 'Diapositivas',
                'data' => 'slides_count',
                'name' => 'slides_count',
                'orderable' => false,
                'searchable' => false,
                'defaultContent' => '',
                // 'render' => 'function(){
                //     return data.length
                // }',
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
        return 'slidersdatatable_' . time();
    }
}