import Swal from 'sweetalert2'


$(function () {
  var paymentezCheckout = new PaymentezCheckout.modal({
    client_app_code: process.env.MIX_PAYMENTEZ_CLIENT_APP_CODE, // Client Credentials Provied by Paymentez
    client_app_key: process.env.MIX_PAYMENTEZ_CLIENT_APP_KEY, // Client Credentials Provied by Paymentez
    locale: 'es', // User's preferred language (es, en, pt). English will be used by default.
    env_mode: process.env.MIX_PAYMENTEZ_ENV, // `prod`, `stg` to change environment. Default is `stg`
    onOpen: function () {},
    onClose: function () {
      var btnOpenCheckout = $('#js-paymentez-checkout');
      btnOpenCheckout.text('Pago corriente')
      btnOpenCheckout.prop('disabled', false)

      var btnOpenCheckoutDeferred = $('#js-paymentez-checkout-deferred');
      btnOpenCheckoutDeferred.text('Pagar diferido')
      btnOpenCheckoutDeferred.prop('disabled', false)

    },
    onResponse: function (response) { // The callback to invoke when the Checkout process is completed

      /*
        In Case of an error, this will be the response.
        response = {
          "error": {
            "type": "Server Error",
            "help": "Try Again Later",
            "description": "Sorry, there was a problem loading Checkout."
          }
        }

        When the User completes all the Flow in the Checkout, this will be the response.
        response = {
           "transaction": {
              "status": "success", // success, failure or pending
              "payment_date": "2017-09-26T21:03:04",
              "amount": 99.0,
              "authorization_code": "148177",
              "installments": 1,
              "dev_reference": "referencia",
              "message": "Operation Successful",
              "carrier_code": "6",
              "id": "CI-490", // transaction_id
              "status_detail": 3 // for the status detail please refer to: https://paymentez.github.io/api-doc/#status-details
           },
           "card": {
              "bin": "453254",
              "status": "valid",
              "token": "",
              "expiry_year": "2020",
              "expiry_month": "9",
              "transaction_reference": "CI-490",
              "type": "vi",
              "number": "8311"
          }
       }

      */

      if (response.transaction) {
        var productId = $('#productId').val();
        var planId = $('#planId').val();
        var planUuid = $('#planUuid').val();

        const axios = require('axios');
        axios.post(process.env.MIX_API_URL + '/products/' + productId + '/pay/' + planId, {
            planUuid: planUuid,
            payment: response,
          })
          .then(function (response) {
            // Redirect to bill 
            // Show swettalert
            Swal.fire({
              title: 'Se ha realizado el pago exitosamente, a continuación puedes ingresar tus datos de facturación',
              text: 'Redirigiendo...',
              type: 'success',
              showConfirmButton: false,
              // confirmButtonText: 'Cool'
            })

            setTimeout(function () {
              // Redirect to plans 
              window.location = process.env.MIX_APP_URL + '/account/products/' + productId + '/bill'
            }, 3000);

          })
          .catch(function (error) {
            console.error(error);
            document.getElementById('response').innerHTML = error.message ? error.message : 'Error desconocido al procesar la solicitud';
          });


      } else {
        document.getElementById('response').innerHTML = response.error ? response.error.description : 'Error desconocido en pago';
      }
    }
  });

  var btnOpenCheckout = $('#js-paymentez-checkout');
  btnOpenCheckout.on('click', function () {

    makePayment(false)
  });


  var btnOpenCheckoutDeferred = $('#js-paymentez-checkout-deferred');
  btnOpenCheckoutDeferred.on('click', function () {
    makePayment(true)
  });

  function makePayment(isDeferred) {
    btnOpenCheckout.html('Procesando...')
    btnOpenCheckout.prop('disabled', true)
    btnOpenCheckoutDeferred.html('Procesando...')
    btnOpenCheckoutDeferred.prop('disabled', true)

    var orderId = $('#orderId').val();
    var planVat = $('#planVat').val();
    var planAmount = $('#planAmount').val();
    var planDescription = $('#planDescription').val();
    var userId = $('#userId').val();
    var userEmail = $('#userEmail').val();
    var userPhone = $('#userPhone').val();

    // Open Checkout with further options:
    paymentezCheckout.open({
      user_id: userId,
      user_email: userEmail, //optional        
      user_phone: userPhone, //optional
      order_description: planDescription,
      order_amount: parseFloat(planAmount),
      order_vat: parseFloat(planVat),
      order_reference: orderId,
      order_installments_type: isDeferred ? 2 : 0, // optional: For Colombia an Brazil to show installments should be 0, For Ecuador the valid values are: https://paymentez.github.io/api-doc/#payment-methods-cards-debit-with-token-installments-type
      //order_taxable_amount: 0, // optional: Only available for Ecuador. The taxable amount, if it is zero, it is calculated on the total. Format: Decimal with two fraction digits.
      //order_tax_percentage: 10 // optional: Only available for Ecuador. The tax percentage to be applied to this order.
    });
  }

  // Close Checkout on page navigation:
  window.addEventListener('popstate', function () {
    paymentezCheckout.close();
  });


});
