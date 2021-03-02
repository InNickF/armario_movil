<div class="my-2">
    <div class="card-body">
            <table class="table w-100" id="sell-records-table">
                    <thead>
                      <tr>
                        <th>Interacción</th>
                        @foreach ($interactions['keys'] as $key)
                          <th>{{$key}}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($interactions['data'] as $key => $interaction)
                      <tr>
                        <td>{!! ($key) !!}</td>
                        @foreach($interaction as $i)
                          <td>{!! ($i) !!}</td>
                        @endforeach
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  
                  {{-- {{ $interactions->appends(request()->query())->links() }} --}}
    </div>
</div>