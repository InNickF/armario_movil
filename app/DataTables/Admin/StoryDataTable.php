<?php

namespace App\DataTables\Admin;

use Carbon\Carbon;
use App\Models\Story;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class StoryDataTable extends DataTable
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
            $keyword = request('search') && request('search')['value'] ? request('search')['value'] : null;

            if (!$keyword) {
                return;
            }

            $query->whereHas('store', function ($s) use ($keyword) {
                $s->orWhere('name', 'like', "%{$keyword}%");
            });
        }, true);

        return $dataTable->addColumn('action', 'admin.stories.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Story $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Story $model)
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
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación', 'searchable' => false],
            [
                'data' => 'image',
                'name' => 'image',
                'title' => 'Imagen/video',
                'searchable' => false,
                'orderable' => false,
                'render' => 'function(){

                    if(data.search(".mp4") != -1) {
                        
                        return `
                        <div class="embed-responsive embed-responsive-16by9">
                            <video class="embed-responsive-item" controls>
                                <source src="${data}" type="video/mp4">
                                Tu navegador no es compatible con video HTML
                            </video>
                        </div>`
                    }
                    return `<img src="${data}" class="" width="400">`
                }',
            ],
            ['data' => 'body', 'name' => 'body', 'title' => 'Texto', 'searchable' => true],
            [
                'data' => 'store.name',
                'name' => 'store.name',
                'title' => 'Tienda',
                'searchable' => true,
                'orderable' => false,
                // 'render' => 'function(){
                //     return data ? data.name : "?"
                // }',
            ],
            ['data' => 'url', 'name' => 'url', 'title' => 'URL', 'searchable' => true],
            ['data' => 'clicks', 'name' => 'clicks', 'title' => 'Clics', 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'storiesdatatable_' . time();
    }
}