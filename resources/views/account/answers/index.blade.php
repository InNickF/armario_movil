@extends('layouts.account')



@section('title')
    Preguntas recibidas
@endsection


@section('content')
    {{-- <div class="content mt-5">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @foreach ($questions as $question)
        <div class="card o-hidden border-0 shadow-lg my-2">
          <div class="card-body">
            <p>{{ $question->created_at->diffForHumans() }}</p>
      
            @if ($question->product)
            <p>Producto: {{ $question->product->name }}</p>
            @endif
            <p> {{ $question->body }} </p>
      
            <p>Respuestas: {{ count($question->answers )}}</p>
            <a href="{{ route('account.questions.edit', $question->id)}}" class="btn btn-primary">Detalles</a>
          </div>
        </div>
        @endforeach
        <div class="text-center">
        
        </div>
    </div> --}}


    <div class="content mt-4 container-fluid">
      <div class="clearfix"></div>
    
      @include('flash::message')
    
    {{-- <div class="d-flex flex-wrap justify-content-start">
    <div class="btn btn-primary btn-sm my-2 my-sm-0"><b>Todas</b></div>
    <div class="btn btn-outline-primary btn-sm mx-3 my-2 my-sm-0"><b>Por responder</b></div>
    <div class="btn btn-outline-primary btn-sm my-2 my-sm-0"><b>Respondidas</b></div>
    </div> --}}
    
      <div class="clearfix"></div>
      @foreach ($questions as $question)
      <div class="card card-preguntas o-hidden border-0 shadow-sm my-4 px-2">
        <div class="card-body d-flex flex-wrap">
    
          <div class="container p-0 border-preguntas">
            <!-- inicio row header -->
            <div class="row">
              <div class="col-md-2 col-lg-2 order-lg-1 order-2">
                <div class="mr-2 mb-2">
                  <img class="rounded-circle img-sm d-block mx-auto img-fluid" src="{{ $question->user->avatar_image }}">
                </div>
              </div>
    
              <div class="col-md-10 col-lg-8 p-0 order-lg-2 order-3">
                <div class="d-flex flex-wrap align-items-center pb-2 ">
                  <p class="h5 text-primary mr-3 mb-0 text-xs-center font-weight-bold">{{ $question->user->full_name }}</p>
                  <div class="text-sm">{{ $question->created_at->diffForHumans() }}</div>
                </div>
                <div class="d-flex flex-wrap align-items-center pb-2 ">
                    @if ($question->product && $question->product->store)
                    <p class=" mb-0 mr-1">Tienda:
                      <p class="mb-0 font-weight-bold border-right pr-2"> {{ $question->product->store->name }}</p>
                       </p>
                    @endif
    
                  @if ($question->product)
                  <p class="mr-1 mb-0 pl-2">Producto:</p>
                    <p class="font-weight-bold mb-0">{{ $question->product->name }}</p>
                  @endif
    
                 
                </div>
                <div class="container w-100 border-top" ></div>
              </div>
              <div class="col-12 col-lg-2 order-lg-3 order-1 my-2">
                <div class="d-flex flex-wrap align-items-center">
                  @if ($question->answers->count())
                  <div class="btn mx-auto my-3 my-md-0 btn-green-strong btn-sm">Respondido</div>
                  @else
                  <div class="btn mx-auto btn-yellow btn-sm text-white">Pendiente</div>
                  @endif
                </div>
              </div>
              
             
            </div>
    
          </div> <!-- fin row header -->
          
          <div class="container p-0"> <!--  row pregunta -->
          <div class="col-12 col-md-10  offset-md-2 p-0  my-2">
                <div class="txt-pregunta">{{ $question->body }}</div>
              </div>
          </div><!-- fin row pregunta -->
    
    
    
    
          @foreach ($question->answers as $answer)
          <div class="container p-0">
            <!-- row for each respuestas -->
            <div class="row">
    
              <div class="col-12 col-md-10  offset-md-2">
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="d-flex align-items-center">
    
                      @if ($answer->user_id)
    
                      @if ($question->product && $question->product->store)
                      <div class="img-logo-store">
                        <img class="rounded-circle icon-sm mr-2" src="{{ $question->product->store->logo_image }}">
                      </div>
                      @endif
    
                      <div class="cont-nom-hora">
                        <div class="d-flex align-items-center">
                          @if ($question->product && $question->product->store)
                          <p class="h5 text-primary mb-0 mr-3 got-medium">{{ $question->product->store->name }}</p>
                          @endif
                          <p class="h6 text-primary mb-0 mr-3 ">{{ $question->created_at->diffForHumans() }}</p>
                        </div>
                      </div>
                      @else
                      <div class="img-logo-store">
                        <img class="rounded-circle icon-sm mr-2" src="{{ $question->user->avatar_image }}">
                      </div>
                      
                      <div class="cont-nom-hora">
                        <div class="d-flex align-items-center">
                          <p class="h5 text-primary mb-0 mr-3 got-medium">{{ $question->user->full_name }}</p>
                          <p class="h6 text-primary mb-0 mr-3 text-sm">{{ $question->created_at->diffForHumans() }}</p>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <p class="pl-5"> {{ $answer->body }} </p>
    
              </div>
            </div>
          </div> <!-- fin row for each respuestas -->
          @endforeach
    
          <div class="container mt-5">
            <!-- row # respuestas -->
            <div class="row">
              <div class="col-2"></div>
         <div class="col-10 px-0">
               <div class="d-flex justify-content-between align-items-start">
                  <p class="cant-respuestas bg-light-grey-2 text-primary">Respuestas: {{ count($question->answers )}}</p>
                  <a href="{{ route('account.answers.edit', $question->id)}}"
                    class="btn btn-outline-primary got-medium">Responder</a>
                </div>
              </div>
            </div>
            
          </div> <!-- fin row # respuestas -->
        </div>
    
      </div>
      @endforeach
      
      <div>
        {{$questions->links()}}
      </div>
    </div>

@endsection

