@section('css')
    @include('layouts.datatables_css')
@endsection

<div id="adminOrdersDataTable">
  {!! $dataTable->table(['width' => '100%']) !!}
</div>

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection
