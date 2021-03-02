<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TransactionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTransactionRequest;
use App\Http\Requests\Admin\UpdateTransactionRequest;
use App\Repositories\Admin\TransactionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Transaction;

class TransactionController extends \App\Http\Controllers\Controller
{
  /** @var  TransactionRepository */
  private $transactionRepository;

  public function __construct(TransactionRepository $transactionRepo)
  {
    $this->transactionRepository = $transactionRepo;
  }

  /**
   * Display a listing of the Transaction.
   *
   * @param TransactionDataTable $transactionDataTable
   * @return Response
   */
  public function index(TransactionDataTable $transactionDataTable)
  {
    return $transactionDataTable->render('admin.transactions.index');
  }


  public function show($id)
  {
    $transaction = $this->transactionRepository->findWithoutFail($id);

    if (empty($transaction)) {
      alert()->error('Transaction not found');

      return redirect(route('admin.transactions.index'));
    }

    return view('admin.transactions.show')->with('transaction', $transaction);
  }

  public function refund($id)
  {
    $transaction = Transaction::find($id);
    \Log::info('refundind transaction ' . $id);
    \Log::info($transaction);

    if (empty($transaction)) {
      alert()->error('Transacción no encontrad@');

      return back();
    }

    $refunded = $transaction->refund();

    if (isset($refunded['error'])) {
      $message = $refunded['error'];

      alert()->error('No se ha procesado el reembolso: ' . $message);
      return back();
    }

    alert()->success('Se ha procesado el reembolso');
    return back();
  }
}
