<?php

namespace App\DataTables\Admin;

use App\Models\Question;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class QuestionDataTable extends DataTable
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

        $dataTable->addColumn('store_name', function (Question $question) {
            return $question->product->store->name;
        });

        $dataTable->addColumn('product_link', function (Question $question) {
            return '<a target="_blank" href="' . $question->product->url . '">' . $question->product->name . '</a>';
        });

        $dataTable->addColumn('answers_summary', function (Question $question) {
            $result = '';
            foreach ($question->answers as $key => $answer) {
                if (!$answer->user) {
                    $result .= '<p><span class="text-primary">' . $answer->question->product->store->user->full_name . ':</span> ' . $answer->body . '   </p>';
                    continue;
                }
                $result .= '<p><span class="text-primary">' . $answer->user->full_name . ':</span> ' . $answer->body . '   </p>';
            }
            return $result;
        })->rawColumns(['product_link', 'answers_summary'], true);

        return $dataTable->addColumn('action', 'admin.questions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Question $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Question $model)
    {
        return $model->with(['user', 'product', 'answers']);
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
            ['data' => 'store_name', 'name' => 'store_name', 'title' => 'Tienda', 'searchable' => true],
            [
                'data' => 'user.first_name', 'name' => 'user.first_name', 'title' => 'Nombre', 'searchable' => true,
                // 'render' => 'function(){
                //     return data ? data.first_name : null
                // }',
            ],
            [
                'data' => 'user.last_name', 'name' => 'user.last_name', 'title' => 'Apellido', 'searchable' => true,
                // 'render' => 'function(){
                //     return data ? data.last_name : null
                // }',
            ],
            [
                'data' => 'user.email', 'name' => 'user.email', 'title' => 'Email', 'searchable' => true,
                // 'render' => 'function(){
                //     return data ? data.email : null
                // }',
            ],
            [
                'data' => 'user.phone', 'name' => 'user.phone', 'title' => 'Teléfono',
                // 'render' => 'function(){
                //     return data ? data.phone : null
                // }',
                'searchable' => true
            ],
            ['data' => 'product_link', 'name' => 'product_link', 'title' => 'Producto', 'searchable' => true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            ['data' => 'body', 'name' => 'body', 'title' => 'Pregunta', 'searchable' => true],
            ['data' => 'answers_summary', 'name' => 'answers_summary', 'title' => 'Respuestas', 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'questionsdatatable_' . time();
    }
}
