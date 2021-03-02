<?php

namespace App\Repositories\Admin;

use App\Models\Transaction;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories\Admin
 * @version August 1, 2019, 4:47 pm -05
 *
 * @method Transaction findWithoutFail($id, $columns = ['*'])
 * @method Transaction find($id, $columns = ['*'])
 * @method Transaction first($columns = ['*'])
*/
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'transaction_id',
        'authorization_code',
        'amount',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }
}
