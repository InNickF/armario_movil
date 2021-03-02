<?php

namespace App\DataTables\Admin;

use App\Models\Transaction;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TransactionDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.transactions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
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
            ->addAction(['width' => '120px', 'title' => 'Acciones'])
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
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'ID de usuario', 'searchable' => true],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Cantidad', 'searchable' => true],
            ['data' => 'description', 'name' => 'description', 'title' => 'Descripción', 'searchable' => true],
            ['data' => 'transaction_id', 'name' => 'transaction_id', 'title' => 'ID de transacción', 'searchable' => true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Estatus', 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactionsdatatable_' . time();
    }
}