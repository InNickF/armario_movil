
function updateUserPlan(userId) {
  var planId = $('#planId_' + userId).val();

  axios.post('/api/admin/users/' + userId + '/plan', {
      planId: planId,
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha cambiado el plan del usuario',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido cambiar el plan del usuario',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}



function updateProductPlan(productId) {
  var planId = $('#planId_' + productId).val();

  axios.post('/api/admin/products/' + productId + '/plan', {
      planId: planId,
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha cambiado el plan del producto',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido cambiar el plan del producto',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}


function productToggleActive(productId) {
  var element = $('#productIsActiveButton_' + productId);
  var comment = $('#productIsActiveComment_' + productId).val();

  axios.post('/api/admin/products/' + productId + '/toggleActive', {
      comment: comment
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha actualizado el producto',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

      if (element.text() == 'Activo') {
        element.text('Inactivo')
        element.addClass('btn-danger')
        element.removeClass('btn-success')
      } else {
        element.text('Activo')
        element.removeClass('btn-danger')
        element.addClass('btn-success')
      }

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido cambiar el producto',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}



function storyToggleActive(storyId) {
  var element = $('#storyIsActiveButton_' + storyId);
  var comment = $('#storyIsActiveComment_' + storyId).val();

  axios.post('/api/admin/stories/' + storyId + '/toggleActive', {
      comment: comment
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha actualizado la historia',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

      if (element.text() == 'Activo') {
        element.text('Inactivo')
        element.addClass('btn-danger')
        element.removeClass('btn-success')
      } else {
        element.text('Activo')
        element.removeClass('btn-danger')
        element.addClass('btn-success')
      }

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido cambiar la historia',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}



function questionToggleActive(questionId) {
  var element = $('#questionIsActiveButton_' + questionId);
  // var comment = $('#questionIsActiveComment_' + questionId).val();

  axios.post('/api/admin/questions/' + questionId + '/toggleActive', {
      // comment: comment
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha actualizado la pregunta',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

      if (element.text() == 'Activo') {
        element.text('Inactivo')
        element.addClass('btn-danger')
        element.removeClass('btn-success')
      } else {
        element.text('Activo')
        element.removeClass('btn-danger')
        element.addClass('btn-success')
      }

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido cambiar la pregunta',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}




function buildOrderItemDetails(item) {
  return `
  <div class="row mb-3">
    <div class="col-md-4">
      <div class="d-flex align-items-center">
        <div class="mr-2 text-primary">${item.quantity }</div>` +

    (item.product_variant ?
      `<div class="">
          <a href="${item.product_variant.product.url || '?'}">
            <div class="avatar-sm rounded-circle mr-3 my-3 bg-center bg-cover"
              style="background-image:url('${item.product_variant.product.main_image}')">
            </div>
          </a>
        </div>
        <div>
          <a href="${item.product_variant.product.url}" target="_blank">
            <div class="text-primary">${item.product_variant.product.name }</div>
          </a>
          <div>
            <small>${item.status}</small>
          </div>` : '') +

    (item.shipping_order ?
      `<small class="text-light-grey"> Código de tracking: #${item.shipping_order.tracking_number}</small>
                <p>
                  <a href="${item.tracking_url}" class="btn btn-primary btn-sm  mb-3">Trackear ${item.shipping_order.provider}</a>
                  </p>` :
      `<small>No enviado</small>`) +

    (item.order && item.order.shipping_orders && item.shipping_order && item.shipping_order.provider == 'Urbano' ?

      (item.order.shipping_orders.map(guia => {

        if (guia.code == item.shipping_order.tracking_number) {
          return `<a href="/admin/shipping_orders/${guia.id}"
          class="btn btn-primary btn-sm"><small>Guía electrónica</small></a>`
        }

        return ''
      }))

      :
      '') +


    `</div>` +

    `</div>` +

    ` <div class="mt-4" >
      <div class="text-primary text-bold" > Precio: </div>
      <div class="d-flex align-items-center" >
      <div class="text-primary" > $${item.sum_price_final} </div>
      </div>
       <div class="text-primary text-bold" > IVA: </div>
      <div class="d-flex align-items-center" >
      <div class="text-primary" > $${item.vat_price} </div>
      </div>
       <div class="text-primary text-bold" > Ganancia: </div>
      <div class="d-flex align-items-center" >
      <div class="text-primary" > $${item.earning} (Comisión ${item.commission_percentage}%: $${item.commission_price} ) </div>
      </div>
      </div>` +

    `</div>` +

    (item.product_variant && item.product_variant.product && item.product_variant.product.store ?
      `<div class="col-md-4">
        <div class="text-primary">Tienda:</div>
        <a href="${item.product_variant.product.store.url}" target="_blank">
          <div class="d-flex align-items-center">
            <div class="avatar-sm rounded-circle mr-3 my-3 bg-center bg-cover"
              style="background-image:url('${item.product_variant.product.store.logo_image_thumbnail}')">
            </div>
            <div class="text-primary">${item.product_variant.product.store.name }</div>
            </div>
            <div class="text-sm">Calificación: ${item.product_variant.product.store.rating }</div>
        </a>
        </div>` : '') +
    `<div class="col-md-4">
      <div class="text-primary">Opciones:</div>

      <div class="form-group">
        <label class="form-check-label">
          <input id="is_valid_store_bill_${item.id}" type="checkbox" name="is_valid_store_bill" class="form-control" ${item.is_valid_store_bill ? 'checked' : ''}>
          Facturación válida
        </label>
      </div>

      <div class="form-group">
        <label class="form-check-label">
          <input id="is_paid_earning_${item.id}" type="checkbox" name="is_paid_earning" class="form-control" ${item.is_paid_earning ? 'checked' : ''}>
          Ganancia pagada
        </label>
      </div>

      <div class="mt-3">
        <div class="form-group">
          <label for="">Observaciones</label>
          <textarea class="form-control" name="" id="comment_${item.id}"
            rows="3">${item.admin_comment ? item.admin_comment : ''}</textarea>
        </div>


      <button onclick="updateOrderItem(${item.id})" class="btn btn-primary btn-sm mt-2">
        Guardar cambios
      </button>` +
    (item.product_variant && item.product_variant.product && item.product_variant.product.store && item.product_variant.product.store.user && item.product_variant.product.store.user.collecting_method ?
      `<p>
        <div class="text-primary">Datos cuenta bancaria</div>` +
      (item.product_variant.product.store.user.collecting_method.bank.logo ? `<img class="img-xs" src="${item.product_variant.product.store.user.collecting_method.bank.logo}">` : '') +
      `<p>
        <small>
        Tipo de persona: ${item.product_variant.product.store.user.collecting_method.person_type}<br>
        Tipo de documento: ${item.product_variant.product.store.user.collecting_method.document_type}<br>
        Nº de documento: ${item.product_variant.product.store.user.collecting_method.document_number}<br>
        Nombre: ${item.product_variant.product.store.user.collecting_method.name}<br>
        Banco: ${item.product_variant.product.store.user.collecting_method.bank.name}<br>
        Tipo de cuenta: ${item.product_variant.product.store.user.collecting_method.account_type}<br>
        Nº de cuenta: ${item.product_variant.product.store.user.collecting_method.account_number}<br>
        Email: ${item.product_variant.product.store.user.collecting_method.email}<br>
        Teléfono: ${item.product_variant.product.store.user.collecting_method.phone}<br>
        </small>
      </p>` : '<p><small>No se ha encontrado datos de cta bancaria</small></p>') +

    `</div>
      </div>
    <div class="w-100"><hr></div>
  </div>`

}


/* Formatting row details - modify as you need */
function buildOrderChildRow(d) {

  var items = `<div class="show-fields">
    <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="col">` +
    // (d.shipping_address ?
    //   `<div class="text-primary got-medium text-sm">Enviado a:</div>
    //       <p class="text-sm">` +
    //   d.shipping_address.street + ', ' + d.shipping_address.property_number + ', ' + d.shipping_address.secondary_street + `</p></div>` :
    //   'Dirección no encontrada') +

    (d.coupon ?
      `<div class="col">
          <div class="text-primary got-medium text-sm">Cupón:</div>
          <p class="text-sm">${d.coupon.code}</p>
        </div>` :
      '') +

    // (d.billing_document_id ?
    //   `<div class="col" >
    // <div class="text-primary got-medium text-sm" > Nº de factura: </div>
    //   <p>
    //   <small> ${d.billing_document_id} </small>
    //   </p>
    // </div>` :
    //   '') +

    // `<div class="col">
    //       <div class="text-primary got-medium text-sm" > Datos de facturación: </div>
    //         <p>` +
    // (d.billing_address ?
    //   `<small>Nombre: ${d.billing_address.given_name} </small><br>
    //         <small>Apellido: ${d.billing_address.family_name} </small><br>
    //         <small>Tipo documento: ${d.billing_address.document_type} </small><br>
    //         <small>Nº documento: ${d.billing_address.document_number} </small><br>
    //         <small>Email: ${d.billing_address.email} </small><br>
    //         <small>Teléfono: ${d.billing_address.phone} </small><br>
    //         <small>Provincia: ${d.billing_address.state} </small><br>
    //         <small>Ciudad: ${d.billing_address.city} </small><br>
    //         <small>Dirección: ${d.billing_address.street} </small><br>` :
    //   `<small>Nombre: Consumidor </small><br>
    //         <small>Apellido: Finales </small><br>
    //         <small>Tipo documento: Cédula </small><br>
    //         <small>Nº documento: 9999999999 </small><br>
    //         <small>Email: facturas@armariomovil.com </small><br>
    //         <small>Teléfono: 022652229 </small><br>
    //         <small>Provincia: Pichincha </small><br>
    //         <small>Ciudad: Quito </small><br>
    //         <small>Dirección: Juan Lagos S11-77 y Pedro Capiro </small><br>`) +
    `</p>
          </div>
        </div>
      </div>

    <div class="col-12" >
      <div class="text-primary got-medium text-sm">Items del pedido: </div>
        <div class="row">
          <div class="col-12" >
    `
  d.items.forEach(orderItem => {
    items += buildOrderItemDetails(orderItem)
  });


  // if(d.status_slug == 'delivery') {
    items += `
    <div class="row" id="markAsDeliveredButton_${d.id}">
      <div class="col">
        <br>
        <div class="mt-4">
            <div>
              <button onclick="markAsDelivered(${d.id})" class='btn btn-success btn-sm float-left'>
                <i class="fas fa-check"></i>
                <small>
                  Marcar como recibido
                </small>
              </button>
            </div>
        </div>
      </div>
    </div>
    `
  // }

  items += `<div class="col-sm-12 col-lg-12 pl-1">

  <div class="row">` +
    (d.can_refund ?
      `<div class="col-12">
      <button data-toggle="modal" data-target="#refundModal_${d.id}" id="refundButton_${d.id}"
        class='btn btn-danger btn-sm float-left'><i class=""></i>Reembolsar</button>
      </div>` : '') +
    `<div class="col-12" >
        <div class="text-primary got-medium text-sm"> Facturas: </div>
      </div>` +
    (d.bill_documents != null && d.bill_documents != 'undefined' && d.bill_documents.length > 0 ?
      `<div class="col-12 mt-4">
        <div class="">
          <h5>Facturas subidas</h5>
          <ul>` +
      (d.bill_documents.map(bill => {
        return `<li>
            <a href="${bill.path}" target="_blank">${bill.created_at}</a>
          </li>`
      })) +

      `</ul>
        </div>
      </div>` :
      '<div class="col-12">No se han subido facturas</div>') +
    `</div>

    <div class="modal fade" id="refundModal_${d.id}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pedir reembolso de pedido</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Confirma que deseas hacer la devolución del valor este pedido</div>
        <p>VALOR: $${d.total_price}</p>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary btn-flat"
            onclick="refundOrder(${d.id})">
            Confirmar reembolso

        </div>
      </div>
    </div>
  </div>


</div>`





  // `d ` is the original data object for the row
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:20px;">' +
    '<tr>' +
    '<td>' + items + '</td>' +
    '</tr>' +
    '</table>';
}

$(document).ready(function () {
  // Add event listener for opening and closing details
  $('#adminOrdersDataTable tbody').on('click', 'td.expand-details', function () {
    var table = $('#adminOrdersDataTable table#dataTableBuilder').DataTable();

    var tr = $(this).closest('tr');
    var row = table.row(tr);

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown'); // parent
    } else {
      // Open this row
      row.child(buildOrderChildRow(row.data())).show();
      tr.addClass('shown'); // parent
    }
  });
});




function refundOrder(orderId) {

  axios.post('/api/admin/orders/' + orderId + '/refund', {})
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha reembolsado del pedido',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

      $('#refundModal_' + orderId).modal('hide');
      $('#refundButton_' + orderId).hide();

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido reembolsar el pedido',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}

function markAsDelivered(orderId) {

  axios.post('/api/admin/orders/' + orderId + '/delivered', {})
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha marcado el pedido como entregado',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

      $('#markAsDeliveredButton_' + orderId).hide();

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido modificar el pedido',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}





function updateOrderItem(orderItemId) {
  var is_valid_store_bill = $('#is_valid_store_bill_' + orderItemId).is(":checked")
  var is_paid_earning = $('#is_paid_earning_' + orderItemId).is(":checked")
  var comment = $('#comment_' + orderItemId).val()

  axios.post('/api/admin/order_items/' + orderItemId, {
      is_valid_store_bill: is_valid_store_bill,
      is_paid_earning: is_paid_earning,
      admin_comment: comment,
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha actualizado el ítem del pedido',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido actualizar el ítem del pedido',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}




function storeToggleIsOfficial(storeId) {
  // var element = $('#storeIsOfficialButton_' + storeId);
  var is_official = $('#storeIsOfficialInput_' + storeId).is(":checked")

  axios.post('/api/admin/stores/' + storeId + '/toggleIsOfficial', {
      is_official: is_official
    })
    .then(function (response) {
      // console.log(response);

      // Show swettalert
      Swal.fire({
        title: 'Se ha actualizado la tienda',
        type: 'success',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })

    })
    .catch(function (error) {
      console.log(error);
      Swal.fire({
        title: 'No se ha podido editar la tienda',
        type: 'error',
        showConfirmButton: false,
        // confirmButtonText: 'Cool'
      })
    });
}


