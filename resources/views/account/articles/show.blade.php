@extends('layouts.account')


@section('title')

{{$article->categories[0]->name}}
    
@endsection

@section('content')
        
        <div class="content col-8 mx-auto mt-3 pl-3">
                <div style="background-image:url('{{ $article->main_image }}')" class="bg-center img-lg mx-auto mb-4"></div>
            <h1 class="text-primary text-left">
                    {{$article->title}}
                </h1>
        <div class="box box-primary">
            
            <div class="box-body">
                <div class="row">
                    
                    @include('account.articles.show_fields')

                    <a href="{!! url()->previous() !!}" class="btn-sm btn btn-outline-primary font-weight-bold px-5 mt-4">Volver</a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
