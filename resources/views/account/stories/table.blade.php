<div class="" id="orders-table">
    <h3 class="h6">Historias de mi tienda</h3>
  
    <div class="card">
      <div class="card-header bg-light-2">
        <div class="row">
          <div class="col text-primary nombre-rows">Título</div>
          <div class="col text-primary nombre-rows">Descripción</div>
          <div class="col text-primary nombre-rows">Link</div>
          <div class="col text-primary nombre-rows">Expiración</div>
          <div class="col text-primary nombre-rows">Estado</div>
          <div class="col text-primary nombre-rows">Observaciones</div>
          <div class="col"></div>
        </div>
      </div>
    </div>
    <div>
      <div id="accordion">
        @forelse($stories as $key =>$story)
        <div class="card border-0">
          <div class="card-header rounded-0 border-0 {{ $key%2 == 0 ? 'bg-light-grey' : 'bg-white' }}" id="headingOne{{$story->id}}">
            <div class="mb-0">
              <div class="row">
                <div class="col text-primary text-sm">{!! $story->title !!}</div>
                <div class="col text-primary text-sm">{!! $story->body !!}</div>
                <div class="col text-primary text-sm">{!! $story->url !!}</div>
                <div class="col text-primary text-sm">{!! $story->getExpirationDate()->format('Y/m/d h:i:s') !!}</div>
                <div class="col text-primary text-sm"><strong>{{$story->getStatus()}}</strong></div>
                <div class="col text-primary text-sm"><strong>{{$story->admin_comment}}</strong></div>
                <div class="col">
                  <div class='btn-group'>

                        {!! Form::open(['route' => ['account.stories.destroy', $story->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'onclick' => "return confirm('¿Estás seguro de borrar permanentemente esta historia?')"
                            ]) !!}
                        
                        </div>
                        {!! Form::close() !!}

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
       <div class="text-center my-4">
            <p>No se han encontrado historias</p>
       </div>
        @endforelse

        
      </div>
      {{$stories->links()}}
    </div>
  </div>
  