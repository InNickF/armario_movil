<div class="d-flex flex-wrap w-xl-100 align-items-center justify-content-xl-between my-4">
    <div class="d-none d-sm-flex justify-content-center mt-2 mt-xl-0 w-xl-100 align-items-center">
    <a target="_blank" href="{{$export_excel_url}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2"><i
          class="fas fa-download fa-sm"></i><small>
        Descargar EXCEL</small></a>
      
      {{-- Fake button handles saving graphs as images before generating report --}}
      <button id="downloadDashboardPdfFakeButton" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
          class="fas fa-download fa-sm"></i><small>
        Descargar PDF</small></button>

        <a target="_blank" id="downloadDashboardPdfRealButton" href="{{$export_pdf_url}}" class="d-none"></a>
    </div>
  
  
    <form class="w-xl-100" action="">


      @if (request('filter'))
    <input type="hidden" value="{{request('filter')}}" name="filter">
      @endif
      <div class="d-flex justify-content-center align-items-center mt-2 mt-xl-0 justify-content-xl-end">
        <div class="form-group my-0 d-flex align-items-center mx-2">
          <date-selector label="Fecha inicio" field-name="start" old-value="{{$start}}">
          </date-selector>
        </div> 
        <div class="form-group my-0 d-flex align-items-center mx-2">
          <date-selector label="Fecha fin" field-name="end" old-value="{{$end}}">
          </date-selector>
          
        </div>
        <div class="form-group my-0 d-flex align-items-center justify-content-between mb-0">
          <button class="btn btn-primary-gradient-2 btn-sm">Filtrar<img src="{{asset('images/dashboards/filter-lines.png')}}" alt="" class=" ml-2 icon-xxs"></button>
        </div>
      </div>
    </form>
  
   

  </div>
  