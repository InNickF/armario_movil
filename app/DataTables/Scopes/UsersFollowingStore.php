<?php

namespace App\DataTables\Scopes;

use App\Models\UserStore;
use Yajra\DataTables\Contracts\DataTableScope;

class UsersFollowingStore implements DataTableScope
{
    public $store;

    public function __construct(UserStore $store) {
        $this->store = $store;
    }
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->followingStore($this->store);
    }
}
