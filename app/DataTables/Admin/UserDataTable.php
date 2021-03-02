<?php

namespace App\DataTables\Admin;

use App\User;
use App\Models\Category;
use App\Models\UserStore;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\Scopes\UsersFollowingStore;

class UserDataTable extends DataTable
{

    protected $excludeFromExport = ['actions'];
    protected $excludeFromPrint = ['actions'];
    /**
     * Build DataTable class.
     *
     * @param mixed $query results from query() method
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = new EloquentDataTable($query);

        $parents = Category::parents()->get()->pluck('id');


        $followed_categories = Category::where(function ($cat) use ($parents) {
            $cat->parents()
                ->orWhereIn('parent_id', $parents);
        })->get()->mapWithKeys(function ($cat) {
            return ['f' . $cat->id => $cat];
        });

        foreach ($followed_categories as $key => $cat) {
            $dataTable->addColumn($key, function (User $user) use ($cat) {
                return $user->isFollowing($cat);
            });
        }

        $dataTable->addColumn('store_document_number', function (User $user) {
            return $user->store && $user->store->address ? $user->store->address->document_number : '?';
        });


        $dataTable->addColumn('role_title', function (User $user) {
            return $user->getRoles() ? $user->getRoles()[0] : 'Sin asignar';
        });

        $dataTable->filter(function ($query) {
            // if (request('start') && request('end')) {
            //     $query->whereBetween('created_at', [request('start'), request('end')]);
            // }
            $keyword = request('search') && request('search')['value'] ? request('search')['value'] : null;

            if (!$keyword) {
                return;
            }

            $query->orWhereHas('store.address', function ($s) use ($keyword) {
                $s->where('addresses.document_number', 'like', "%{$keyword}%");
            });
        }, true);

        // $dataTable->addColumn('avatar_image_html', function (User $user) {
        //     return "<img src='$user->avatar_image' class='img-fluid'>";
        // });


        $dataTable->addColumn('addresses_summary', function (User $user) {
            $result = '';

            foreach ($user->addresses as $key => $address) {
                $result .= "<p>$address->street, $address->property_number, $address->secondary_street, $address->reference</p>";
            }
            return $result;
        })->rawColumns(['addresses_summary'], true);


        return $dataTable->addColumn('action', 'admin.users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if (request()->has('followingStoreId')) {
            $store = UserStore::find(request('followingStoreId'));

            if ($store) {
                $model = $model->followingStore($store);
            }
        }

        $model = $model->with(['addresses', 'store']);

        return $model;
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
                'followingStoreId' => request('followingStoreId')
            ])
            ->addAction(['width' => '120px', 'title' => 'Acciones'])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-plus"></i> Crear'],
                    [
                        'extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-download"></i> Exportar',
                        'exportOptions' => [
                            'stripHtml' => false,
                        ],
                    ],
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
        $columns = [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID', 'searchable' => true],
            ['data' => 'role_title', 'name' => 'role_title', 'title' => 'Rol', 'searchable' => true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Fecha creación'],
            // Image column
            [
                'data' => 'avatar_image',
                'name' => 'avatar_image',
                'title' => 'Foto',
                'searchable' => false,
                'orderable' => false,
                'render' => 'function(){
                    return `<img src="${data}" class="img-fluid">`
                }',
            ],
            ['data' => 'first_name', 'name' => 'first_name', 'title' => 'Nombre'],
            ['data' => 'last_name', 'name' => 'last_name', 'title' => 'Apellido'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            [
                'data' => 'store_document_number',
                'name' => 'store_document_number',
                'title' => 'RUC/CC',
                'render' => 'function(){
                    return data ? data : "?"
                }',
                'searchable' => true,
                'orderable' => false,
            ],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Teléfono'],
            ['data' => 'dob', 'name' => 'dob', 'title' => 'Fecha nacimiento'],
            ['data' => 'country', 'name' => 'country', 'title' => 'País'],
            ['data' => 'state', 'name' => 'state', 'title' => 'Provincia'],
            ['data' => 'city', 'name' => 'city', 'title' => 'Ciudad'],
            // Manually translated column
            [
                'data' => 'gender',
                'name' => 'gender',
                'title' => 'Género',
                'render' => 'function(){
                    return data == "male" ? "Masculino" : (data == "female" ? "Femenino" : "Otro" )
                }',
            ],
            // Column relation data NEEDS ::with() in query 
            [
                'data' => 'addresses_summary',
                'name' => 'addresses_summary',
                'title' => 'Direcciones',
                // 'render' => 'function(){
                //     return data ? data.map( (a) => `${a.street}, ${a.property_number || ""}, ${a.secondary_street || ""} ${a.reference || ""}` ) : "?"
                // }',
                'searchable' => false,
                'orderable' => false,
            ],
        ];


        $parentCategories = Category::parents()->get();

        foreach ($parentCategories as $key => $parent) {

            // Parent parent column
            $columns[] = [

                'data' => 'f' . $parent->id,
                'name' => $parent->name,
                'title' => $parent->name,
                'render' => 'function(){
                        return data ? `<i class="fa fa-check text-success"></i>` : `<i class="fa fa-times"></i>`
                    }',
                'searchable' => false,
                'orderable' => false,

            ];


            // Children category columns
            foreach ($parent->children as $key => $subcategory) {
                $columns[] = [

                    'data' => 'f' . $subcategory->id,
                    'name' => $subcategory->name,
                    'title' => $parent->name . ': ' . $subcategory->name,
                    'render' => 'function(){
                        return data ? `<i class="fa fa-check text-success"></i>` : `<i class="fa fa-times"></i>`
                    }',
                    'searchable' => false,
                    'orderable' => false,

                ];
            }
        }
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }



    // public function excel()
    // {
    //     $excel = $this->buildExcelFile();
    //     $excel->download('xls');
    // }
}