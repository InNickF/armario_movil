<?php

namespace App\DataTables\Admin;

use App\Models\UserStore;
use App\Services\DaysService;
use Rinvex\Subscriptions\Models\Plan;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserStoreDataTable extends DataTable
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
        $dataTable->addColumn('action', 'admin.user_stores.datatables_actions');

        $dataTable->addColumn('followers_count', function (UserStore $store) {
            return '<a href="' . url('admin/users/?followingStoreId=' . $store->id) . '") >' . $store->followers()->get()->count() . '</a>';
            // return [
            //     "count' => $store->followers()->get()->count(),
            //     'store_id' => $store->id
            // ];
        });
        $dataTable->addColumn('gmap_link', function (UserStore $store) {
            if (!$store->address) {
                return '';
            }
            return 'https://www.google.com/maps/search/?api=1&query=' . $store->address->latitude . ',' . $store->address->longitude;
        });

        $dataTable->addColumn('opening_hours_formatted', function (UserStore $store) {
            $result = '';

            if (!$store->opening_hours) {
                return 'Sin datos';
            }

            // Get days translations
            $daysTranslated = DaysService::getDays();
            foreach ($store->opening_hours as $dayName => $ranges) {
                $result .= '<p>' . $daysTranslated[$dayName] . ': ' . $ranges[0] ?? 'Cerrado' . '</p>';
            }
            return $result;
        });

        $dataTable->addColumn('address_summary', function (UserStore $store) {
            $result = '';

            if (!$store->address) {
                return '';
            }

            $result .= "<p>" . $store->address->street . "," . $store->address->property_number . "," . $store->address->secondary_street . "," . $store->address->reference . "</p>";

            return $result;
        });

        $dataTable->rawColumns(['address_summary', 'opening_hours_formatted', 'plan_name', 'followers_count'], true);

        $plans = app('rinvex.subscriptions.plan')->whereIn('slug', ['armario', 'closet', 'ropero'])->get();

        $dataTable->addColumn('plan_name', function (UserStore $store) use ($plans) {
            return (string) view('admin.user_stores.datatables_plan', compact('plans', 'store'));
        });

        $dataTable->addColumn('plan_name_export', function (UserStore $store) use ($plans) {
            return $store->user->plan->name ?? 'No tiene plan';
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserStore $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserStore $model)
    {
        return $model->with('user', 'followers', 'address');
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
            'id',
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Nombre'],
            [
                'data' => 'logo_image_thumbnail',
                'name' => 'logo_image_thumbnail',
                'title' => 'Logo',
                'searchable' => false,
                'orderable' => false,
                'render' => 'function(){
                    return `<img src="${data}" class="img-fluid">`
                }',
            ],
            ['data' => 'description', 'name' => 'description', 'title' => 'Descripción'],
            [
                'data' => 'user.first_name',
                'name' => 'user.first_name',
                'title' => 'Nombre usuario',
                // 'render' => 'function(){
                //     return data ? (data || "?") : "?"
                // }',
                'searchable' => true,
                'orderable' => true,
            ],
            [
                'data' => 'user.last_name',
                'name' => 'user.last_name',
                'title' => 'Apellido usuario',
                // 'render' => 'function(){
                //     return data ? (data || "?") : "?"
                // }',
                'searchable' => true,
                'orderable' => true,
            ],
            [
                'data' => 'user.email',
                'name' => 'user.email',
                'title' => 'Email usuario',
                // 'render' => 'function(){
                //     return data ? (data || "?") : "?"
                // }',
                'searchable' => true,
                'orderable' => true,
            ],
            [
                'data' => 'followers_count',
                'name' => 'followers_count',
                'title' => 'Seguidores',
                // 'render' => 'function(){
                //     return `<a href="' . url('admin/users/?followingStoreId=') . '${data.store_id}" >${data.count || 0}</a>`
                // }',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'address.phone',
                'name' => 'address.phone',
                'title' => 'Teléfono',
                'render' => 'function(){
                    return data ? data : "?"
                }',
            ],
            [
                'data' => 'address.document_number',
                'name' => 'address.document_number',
                'title' => 'RUC/CC',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'is_offline', 'name' => 'is_offline', 'title' => 'Modo vacaciones',
                'render' => 'function(){
                       return data ? "Sí" : "No"
                    }',
            ],
            [
                'data' => 'address.country_code',
                'name' => 'address.country_code',
                'title' => 'País',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'address.state',
                'name' => 'address.state',
                'title' => 'Provincia',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'address.city',
                'name' => 'address.city',
                'title' => 'Ciudad',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'address.district',
                'name' => 'address.district',
                'title' => 'Distrito',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'address.reference',
                'name' => 'address.reference',
                'title' => 'Referencia',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'address_summary',
                'name' => 'address_summary',
                'title' => 'Dirección',
                'render' => 'function(){
                    return data ? data : "Sin dirección"
                }',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'gmap_link',
                'name' => 'gmap_link',
                'title' => 'Ubicación',
                'render' => 'function(){
                    return data ? `<a href="${data}" target="_blank">Abrir en Google Maps</a>` : `Sin dirección`
                }',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'is_always_open', 'name' => 'is_always_open', 'title' => 'Abierto 24 horas',
                'render' => 'function(){
                       return data ? "Sí" : "No"
                    }',
            ],
            [
                'data' => 'opening_hours_formatted', 'name' => 'opening_hours_formatted', 'title' => 'Horarios',
                'render' => 'function(){
                       return data ? data : "?"
                    }',
                'searchable' => false,
                'orderable' => false,
            ],
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
                'data' => 'plan_name_export', 'name' => 'plan_name_export', 'title' => 'Plan',
                'searchable' => false,
                'orderable' => false,
                'exportable' => true,
                'visible' => false
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
        return 'user_storesdatatable_' . time();
    }
}