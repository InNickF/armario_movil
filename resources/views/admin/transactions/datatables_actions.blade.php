@if ($model->status == 'success' && $model->transaction_id != null && $model->amount > 0 && !$model->is_refund)
<div class="col-12">
  <button data-toggle="modal" data-target="#refundModal_{{$model->id}}" class='btn btn-danger btn-sm float-left'><i
      class=""></i>Reembolsar</button>
</div>

<!-- Refund Modal-->
<div class="modal fade" id="refundModal_{{$model->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reembolsar transacción</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Confirma que deseas hacer la devolución del valor esta transacción
          <p>VALOR: @money($model->amount)</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary btn-flat"
          onclick="event.preventDefault(); document.getElementById('refund-form-{{ $model->id }}').submit(); ">
          Confirmar reembolso
        </button>
        <form id="refund-form-{{ $model->id }}" action="{{ url('/admin/transactions/refund/' . $model->id) }}" method="POST"
          style="display: none;">
          {{ csrf_field() }}
        </form>

      </div>
    </div>
  </div>
</div>
@endif
