<?php

namespace App\DataTables\Admin;

use App\Models\Article;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ArticleDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.articles.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
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
            // ->addColumn($this->buildImageColumn())
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
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            ['data' => 'title', 'name' => 'title', 'title' => 'Título', 'searchable' => true],
            ['data' => 'description', 'name' => 'description', 'title' => 'Descripción', 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'articlesdatatable_' . time();
    }


    // public function buildImageColumn()
    // {
    //     return [
    //         'defaultContent' => 'No plan',
    //         'data' => 'plan',
    //         'name' => 'plan',
    //         'title' => 'Plan',
    //         'render' => null,
    //         'orderable' => false,
    //         'searchable' => false,
    //         'exportable' => false,
    //         'printable' => true,
    //         'footer' => '',
    //         'width' => '120px',
    //     ];
    // }
}
