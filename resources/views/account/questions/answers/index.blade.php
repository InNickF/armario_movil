
    <section class="content-header">
        <h1 class="pull-left">Respuestas</h1>
        {{-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.answers.create') !!}">Crear</a>
        </h1> --}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @foreach ($answers as $answer)
        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body">
                <p>
                @if ($answer->user)
                <strong>Publicado por: {{ $answer->user->full_name }}</strong>
                @endif
                        <small>{{ $answer->created_at->diffForHumans() }}</small></p>
                   <p> {{ $answer->body }} </p>
            </div>
        </div>
        @endforeach
        <div class="text-center">
        
        </div>
    </div>

