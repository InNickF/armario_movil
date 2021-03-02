<?php

namespace App\DataTables\Admin;

use App\Models\PushNotification;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PushNotificationDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.push_notifications.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PushNotification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PushNotification $model)
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
            ->addAction(['width' => '120px'])
            ->parameters([
                'createdRow' => 'function(row, data, dataIndex, cells) { 
                    rowArray = Array.from(data);
                    for (var key in data) {
                        field = data[key]
                        const upper = key.replace(/^\w/, c => c.toUpperCase());
                        header = $(".dataTable th:contains(" + upper + ")")
                        if(header.length){
                            if(field && !field.length) {
                                $(row).find("td:nth-child(" + (header.index()+1) + ")").html(field["en"]);
                            }
                        }
                    }
                }',
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm ',],
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm ',],
                    // ['extend' => 'print', 'className' => 'btn btn-default btn-sm ',],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm ',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm ',],
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
            'id',
            'title',
            'body',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'notificationsdatatable_' . time();
    }
}
