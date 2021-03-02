@if (auth()->check() && auth()->user()->hasCompleteStoreProfile())
<!-- CREATE STORY MODAL -->
<div>
  <b-modal modal-class="modal-bg modal-body-bg-gradient offer-24-card p-0" size="lg" ref="createStoryModal" hide-footer>

    
    @if (auth()->check() && auth()->user()->store->active_stories->count() <= 4) <!-- CREATE STORY MODAL -->
      <create-story-form></create-story-form>
      @else
      <div class="text-center">
        <p>No puedes tener más de 5 historias publicadas, elimina alguna o espera a que expire para poder seguir
          publicando</p>
        <a class="btn btn-primary" href="{{url('account/stories')}}">Administrar historias</a>
      </div>
      @endif
  </b-modal>

</div>

@endif
