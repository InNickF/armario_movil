<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $transaction->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $transaction->user_id !!}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{!! $transaction->transaction_id !!}</p>
</div>

<!-- Authorization Code Field -->
<div class="form-group">
    {!! Form::label('authorization_code', 'Authorization Code:') !!}
    <p>{!! $transaction->authorization_code !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $transaction->amount !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $transaction->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $transaction->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $transaction->updated_at !!}</p>
</div>

