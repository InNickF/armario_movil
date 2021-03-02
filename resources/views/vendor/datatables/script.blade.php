(function (window, $) {

    {{-- TODO: Defautls --}}
  // Datatables config
  $.extend(true, $.fn.dataTable.defaults, {
    // "dom": "<'row'<'col-md-4 col-sm-12'<'pull-left'f>><'col-md-8 col-sm-12'<'table-group-actions pull-right'B>>r><'table-container't><'row'<'col-md-12 col-sm-12'pli>>", // datatable layout
    // "pagingType": "bootstrap4",
    // "buttons": [],
    // "renderer": "bootstrap",
    // "searchDelay": 1500,
    // "deferRender": true,
    // "autoWidth": false, // disable fixed width and enable fluid table
    // "pageLength": 10, // default records per page
    "language": { // language settings
      "lengthMenu": "<span class='dt-length-style'><i class='fa fa-bars'></i> &nbsp;Ver &nbsp;&nbsp;_MENU_ &nbsp;registros&nbsp;&nbsp; </span>",
      "info": "<span class='dt-length-records'><i class='fa fa-globe'></i> &nbsp;Encontrados&nbsp;<span class='badge bold badge-dt'>_TOTAL_</span>&nbsp;registros </span>",
      "infoEmpty": "<span class='dt-length-records'>No hay resultados</span>",
      "emptyTable": "No hay resultados",
      "infoFiltered": "<span class=' '>(filtrado de <span class='badge bold badge-dt'>_MAX_</span> registros en total)</span>",
      "zeroRecords": "No hay resultados",
      // "search": "<i class='fa fa-search'></i>",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente",
        "last": " Último",
        "first": "Primero",
        "page": "<span class=' '><i class='fa fa-eye'></i> &nbsp;Página&nbsp;&nbsp;</span>",
        "pageOf": "<span class=' '>&nbsp;de&nbsp;</span>",
      },
      "sProcessing": "Espere..."
    }
  });


  window.LaravelDataTables = window.LaravelDataTables || {};
  window.LaravelDataTables["%1$s"] = $("#%1$s").DataTable(%2$s);
})(window, jQuery);
