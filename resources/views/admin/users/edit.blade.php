@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Editar perfil de {{ $user->full_name }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="card o-hidden border-0 shadow-lg my-5">
           <div class="card-body">
               {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}
               <div class="row">

                    @include('admin.users.fields')

                </div>
                {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection