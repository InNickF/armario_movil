<div class="card o-hidden border-0 shadow-lg my-5" v-bind:class="{'d-none' : hideForm }">
    @include('adminlte-templates::common.errors')
    <div class="card-body">
        <h3>Dirección de facturación</h3>
        {!! Form::open(['route' => 'account.addresses.store'])!!}
        <div class="row">

            @include('account.addresses.fields')

        </div>
        {!! Form::close() !!}
    </div>
</div>
