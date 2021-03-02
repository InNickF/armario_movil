$(function () {
  //
  // EXAMPLE CODE FOR PAYMENTEZ INTEGRATION
  // ---------------------------------------------------------------------------
  //
  //  1.) You need to import the Paymentez JS -> https://cdn.paymentez.com/js/v1.0.1/paymentez.min.js
  //
  //  2.) You need to import the Paymentez CSS -> https://cdn.paymentez.com/js/v1.0.1/paymentez.min.css
  //
  //  3.) Add The Paymentez Form
  //  <div class="paymentez-form" id="my-card" data-capture-name="true"></div>
  //
  //  3.) Init library
  //  Replace "PAYMENTEZ_CLIENT_APP_CODE" and "PAYMENTEZ_CLIENT_APP_KEY" with your own Paymentez Client Credentials.
  //
  // 4.) Add Card: converts sensitive card data to a single-use token which you can safely pass to your server to charge the user.
  /**
   * Init library
   *
   * @param env_mode `prod`, `stg`, `local` to change environment. Default is `stg`
   * @param paymentez_client_app_code provided by Paymentez.
   * @param paymentez_client_app_key provided by Paymentez.
   */


  Paymentez.init(process.env.MIX_PAYMENTEZ_ENV, process.env.MIX_PAYMENTEZ_CLIENT_APP_CODE, process.env.MIX_PAYMENTEZ_CLIENT_APP_KEY);

  var form = $("#add-card-form");
  var submitButton = form.find("button");
  var submitInitialText = submitButton.text();
  $("#add-card-form").submit(function (e) {
    e.preventDefault();
    var myCard = $('#my-card');
    $('#messages').text("");
    var cardToSave = myCard.PaymentezForm('card');
    if (cardToSave == null) {
      $('#messages').text("Los datos de la tarjeta son incorrectos, por favor revísalos y vuelve a intentar");
    } else {
      submitButton.attr("disabled", "disabled").text("Card Processing...");

      /*
      After passing all the validations cardToSave should have the following structure:
       var cardToSave = {
                          "card": {
                            "number": "5119159076977991",
                            "holder_name": "Martin Mucito",
                            "expiry_month": 9,
                            "expiry_year": 2020,
                            "cvc": "123",
                            "type": "vi"
                          }
                        };
      */
      var uid = $('#userIdField').val();
      var email = $('#userEmailField').val();
      /* Add Card converts sensitive card data to a single-use token which you can safely pass to your server to charge the user.
       *
       * @param uid User identifier. This is the identifier you use inside your application; you will receive it in notifications.
       * @param email Email of the user initiating the purchase. Format: Valid e-mail format.
       * @param card the Card used to create this payment token
       * @param success_callback a callback to receive the token
       * @param failure_callback a callback to receive an error
       */
      Paymentez.addCard(uid, email, cardToSave, successHandler, errorHandler);
    }

  });

  var successHandler = function (cardResponse) {
    if (cardResponse.card.status === 'valid') {
      // $('#add-card-form').hide();
      // $('.js-paymentez-checkout').show();

      $('#messages').html('Tarjeta validada, agregando a tu perfil...<br>' +
        // 'status: ' + cardResponse.card.status + '<br>' +
        // "Card Token: " + cardResponse.card.token + "<br>" +
        "Referencia: " + cardResponse.card.transaction_reference
      );
      /**
       * Save in server
       */
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      $.ajax({
        type: 'POST',
        url: process.env.MIX_API_URL + '/add_card',
        data: {
          card_token: cardResponse.card.token,
          holder_name: cardResponse.card.holder_name ? cardResponse.card.holder_name : 'No holder name',
        },
        success: function (data) {
          $('#messages').html('Tarjeta agregada a tu perfil<br>');
          location.reload()
        },
        error: function (data) {
          console.error('Error guardando tarjeta en servidor');
          console.error(data);
          location.reload()
        }
      });

    } else if (cardResponse.card.status === 'review') {
      $('#messages').html('Tarjeta bajo revisión<br>' +
        'status: ' + cardResponse.card.status + '<br>' +
        "Card Token: " + cardResponse.card.token + "<br>" +
        "transaction_reference: " + cardResponse.card.transaction_reference
      );
    } else {
      // $('#messages').html('Error<br>' +
      //   'status: ' + cardResponse.card.status + '<br>' +
      //   "message Token: " + cardResponse.card.message + "<br>"
      // );
      console.error(cardResponse.card)
      $('#messages').html('Ha ocurrido un error, por favor revisa los datos y vuelve a intentar');
    }
    submitButton.removeAttr("disabled");
    submitButton.text(submitInitialText);
  };
  var errorHandler = function (err) {
    console.error(err.error);
    $('#messages').html(err.error.type);
    submitButton.removeAttr("disabled");
    submitButton.text(submitInitialText);
  };


});
