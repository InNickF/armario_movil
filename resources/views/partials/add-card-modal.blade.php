<!-- Logout Modal-->
<div class="modal fade" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar tarjeta</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-12 mt-2">
                            <form id="add-card-form" class="card">
                              <div id="my-card" data-capture-name="true" class="paymentez-form card-body" data-icon-colour="#3490dc">
                                <input class="card-number form-control">
                                <input class="name form-control">
                                <input class="expiry-month form-control">
                                <input class="expiry-year form-control">
                              </div>
                              <div class="px-3 text-center">
                                  <button id="payOrderAddCardButton" class="btn btn-primary btn-block font-weight-bold">Agregar
                                  tarjeta</button></div>
                              <br />
                              <div class="text-center text-primary" id="messages"></div>
                            </form>
                  
                          </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
