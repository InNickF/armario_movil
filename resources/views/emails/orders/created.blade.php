 {{-- @component('mail::message')
# Tu pedido ha sido creado

Hola {{$order->user->full_name}}, se ha creado tu pedido.

ID del pedido: {{$order->id}}

TOTAL: {{$order->total_price}}

@component('mail::button', ['url' => url('/account/orders/' )])
Ver mis pedidos
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent  --}}


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" style="background:#f3f3f3!important">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Detalles de la compra</title>
    <style>
        @media only screen {
            html {
                min-height: 100%;
                background: #f3f3f3
            }
        }

        @media only screen and (max-width:596px) {
            table.body img {
                width: auto;
                height: auto
            }

            table.body center {
                min-width: 0 !important
            }

            table.body .container {
                width: 95% !important
            }

            table.body .columns {
                height: auto !important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 16px !important;
                padding-right: 16px !important
            }

            th.small-1 {
                display: inline-block !important;
                width: 8.33333% !important
            }

            th.small-2 {
                display: inline-block !important;
                width: 16.66667% !important
            }

            th.small-6 {
                display: inline-block !important;
                width: 50% !important
            }

            th.small-9 {
                display: inline-block !important;
                width: 75% !important
            }

            th.small-12 {
                display: inline-block !important;
                width: 100% !important
            }
        }
    </style>
</head>

<body
    style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;background:#f3f3f3!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
    <span class="preheader"
        style="color:#f3f3f3;display:none!important;font-family:Montserrat,sans-serif;font-size:1px;hyphens:none!important;line-height:1px;max-height:0;max-width:0;mso-hide:all!important;opacity:0;overflow:hidden;visibility:hidden"></span>
    <table class="body"
        style="Margin:0;background:#f3f3f3!important;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
        <tr style="padding:0;text-align:left;vertical-align:top">
            <td class="center" align="center" valign="top"
                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <center data-parsed style="min-width:580px;width:100%">
                    <!-- Header -->
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="48px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" class="float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;margin:auto;max-width:130px;outline:0;text-decoration:none;width:auto"
                                    src="{{asset('/images/emails/armario-movil-mailing.png')}}" alt>
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="12px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="12px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="Margin:0 auto;background:#fefefe;border-collapse:collapse;border-radius:18px;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px"
                        align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table
                                        style="background-image:url({{asset('/images/emails/gradient.png')}});background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:12px;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%"
                                        class="wrapper" align="center">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="spacer"
                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td height="24px"
                                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                            &#xA0;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table><img
                                                                                style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;max-width:120px;outline:0;padding-bottom:8px;text-decoration:none;width:100%"
                                                                                src="{{asset('/images/emails/icon-map.png')}}" alt>
                                                                            <h1 class="text-center"
                                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif;font-size:34px;font-weight:700!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center;word-wrap:normal">
                                                                                ¡Hola, {{$order->user->first_name}}!</h1>
                                                                            <p class="text-center"
                                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif;font-size:16px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 10%;text-align:center">
                                                                                Tu compra ya ha sido enviada, mira los
                                                                                detalles aquí</p>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Header -->
                                    <!-- Detalles -->
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h4
                                                                    style="Margin:0;Margin-bottom:10px;color:#747691;font-family:Montserrat,sans-serif;font-size:24px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Detalles del tracking</h4>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-6 large-6 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:274px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Pedido:</h6>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:grey;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    #{{$order->id}}</p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-6 large-6 columns last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:274px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Enviado a nombre de:</h6>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:grey;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    {{ $order->shipping_address->given_name }} {{ $order->shipping_address->family_name }}</p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="wrapper" align="center"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;background-color:#ffffff;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <div
                                                                                style="width:100%;height:1px;background-color:#e6e6e6">
                                                                                &nbsp;&nbsp;</div>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-6 large-6 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:274px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Fecha del pedido:</h6>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:grey;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    {{ $order->created_at }}</p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-6 large-6 columns last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:274px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Dirección de envío:</h6>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:grey;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    {{ $order->shipping_address->full_address }}</p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="wrapper" align="center"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;background-color:#ffffff;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <div
                                                                                style="width:100%;height:1px;background-color:#e6e6e6">
                                                                                &nbsp;&nbsp;</div>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table><!-- END Detalles -->
                                    <!-- Items -->
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Items del pedido:</h6>
                                                            </th>

                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    </h6>
                                                            </th>

                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @foreach ($order->items as $item)
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-4 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <div style="-ms-interpolation-mode:bicubic;border-radius:50%;clear:both;display:block;;margin:auto;outline:0;text-decoration:none;width:150px;height:150px;background-size:cover;background-position:center;background-image:url('{{ $item->product_variant->product->main_image_thumbnail }}')"
                                                                    ></div>
                                                                </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-12 large-8 columns last" valign="middle"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;padding-top:5px;text-align:left;width:370.67px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <table class="row collapse"
                                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <th class="small-12 large-12 columns first last"
                                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:100%">
                                                                                <table
                                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                            <h4 class="small-text-center"
                                                                                                style="Margin:0;Margin-bottom:10px;color:inherit;font-family:Montserrat,sans-serif!important;font-size:24px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                                                {{ $item->product_variant->product->name }}</h4>
                                                                                        </th>
                                                                                        <th class="expander"
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table class="row"
                                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <th class="small-6 large-5 columns first"
                                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:41.66667%">
                                                                                <table
                                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                            <p class="small-text-center"
                                                                                                style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                                                <strong>Color
                                                                                                    solicitado:</strong>
                                                                                                <!-- Color --> <span
                                                                                                    style="background-image:url({{asset('images/emails/gradient.png')}});background-position:center center;background-size:cover;border-radius:100px;box-sizing:border-box;display:inline-block;font-family:Montserrat,sans-serif!important;height:13px;hyphens:none!important;padding:1px;width:13px"><span
                                                                                                        style="background-color: {{ $item->product_variant->color }};border:solid 1px #fff;border-radius:100px;box-sizing:border-box;display:inline-block;font-family:Montserrat,sans-serif!important;height:11px;hyphens:none!important;width:11px"></span>
                                                                                                </span>
                                                                                                <!-- END Color -->
                                                                                            </p>
                                                                                            <p class="small-text-center"
                                                                                                style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                                                <strong>Talla de
                                                                                                    producto:</strong>  {{ $item->product_variant->size }}
                                                                                            </p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                            <th class="small-6 large-7 columns last"
                                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:58.33333%">
                                                                                <table
                                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                            <p class="small-text-center"
                                                                                                style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                                                <strong>Cantidad
                                                                                                    solicitada:</strong>
                                                                                                    {{ $item->quantity }}</p>
                                                                                            <p class="small-text-center"
                                                                                                style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                                                <strong>No. de
                                                                                                    producto:</strong>
                                                                                                    {{ $item->product_variant->product->id }}</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table class="row"
                                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <th class="small-12 large-12 columns first last"
                                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:100%">
                                                                                <table
                                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th class="" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0px;padding-right:16px;text-align:left;width:width:41.66667%">
                                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        @if ($item->shipping_order && $item->shipping_order->provider == "Urbano")
                                                                                                        <h6 style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">Envío:</h6>
                                                                                                        <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;max-width:90px;outline:0;text-decoration:none;width:100%" src="{{asset('/images/logos/urbano-logo.png')}}" alt="Urbano">
                                                                                                        @elseif ($item->shipping_order && $item->shipping_order->provider == "Glovo")
                                                                                                        <h6 style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">Envío:</h6>
                                                                                                        <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;max-width:90px;outline:0;text-decoration:none;width:100%" src="{{asset('/images/logos/glovo-logo.png')}}" alt="Glovo">
                                                                                                        @endif



                                                                                                    </th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>

                                                                                        <th
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                            <a target="_blank"
                                                                                                style="Margin:0;border:1px solid #181b48;border-radius:150px;box-sizing:border-box;color:#181b48;display:block;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:.7em 0;text-align:center;text-decoration:none;width:100%"
                                                                                                href=" {{ $item->getTrackingUrl ()}}">Traking del
                                                                                                producto</a>
                                                                                            <!-- ADD LINK -->
                                                                                        </th>
                                                                                        <th class="expander"
                                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Item 1 -->
                                    @endforeach

                                    {{-- @foreach ($order->items->chunk(2) as $chunk)
                                    <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">

                                            @foreach ($chunk as $index=>$item)
                                            <th class="small-1 large-1 columns {{ $index == 0 ? 'first' : '' }}"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:32.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:right">
                                                                    {{ $item->quantity }}</p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-2 large-1 columns"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <img style="-ms-interpolation-mode:bicubic;border-radius:50px;clear:both;display:block;height:auto;margin:auto;max-width:40px;outline:0;text-decoration:none;width:100%"
                                                                    src="https://picsum.photos/50" alt></th>
                                                        </tr>
                                                    </table>
                                                </th>


                                                <th class="small-9 large-4 columns {{ $index == 1 ? 'last' : '' }}"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <h6
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    {{ $item->product_variant->product->name }}</h6>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#b3b3b3;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    #{{ $item->product_variant->product->id }}</p><a target="_blank"
                                                                    style="Margin:0;box-sizing:border-box;color:#181b48;font-family:Montserrat,sans-serif;font-size:11px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:underline"
                                                                    href="#">Traking del producto</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th><!-- second item -->
                                                @endforeach --}}

                                                {{-- <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="18px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:font-family:Montserrat,sans-serif;font-size:18px;font-weight:400;hyphens:auto;line-height:18px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                                        </tr>
                                                        <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                <tbody>
                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Montserrat,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Montserrat,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><a target="_blank" style="Margin:0;background-image:url({{asset('images/emails/gradient.png')}});background-position:center center;background-size:cover;border-radius:150px;box-sizing:border-box;color:#fff;display:block;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:auto;padding:.7em 0;text-align:center;text-decoration:none;width:85%" href="{{ url('account/orders') }}">Ir a mis órdenes</a>
                                                                                        <!-- ADD LINK -->

                                                                                    </th>
                                                                                    <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </tbody>
                                                </table>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Items -->

                                    {{-- @endforeach --}}



                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Items -->
                                </td>
                            </tr>
                        </tbody>
                    </table><!-- Footer -->
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="12px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>



                    <table align="center" class="float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a target="_blank"
                                                                style="Margin:0;color:#85869d;display:block;font-family:Montserrat,sans-serif;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none"
                                                                href="http://www.armariomovil.com">Ir a Armario
                                                                Móvil</a></th>
                                                        <th class="expander"
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="48px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="Margin:0 auto;background-image:url({{asset('/images/emails/gradient.png')}});background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:12px;border-spacing:0;box-shadow:0 0 13px 8px rgba(0,0,0,.1);float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%"
                        align="center" class="wrapper float-center">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="24px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-2 large-4 columns first"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://api.whatsapp.com/send?phone=5930987167802&amp;text=Hola,%20me%20gustaría%20ser%20parte%20de%20Armario%20Móvil"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="{{asset('/images/emails/whatsapp@2x.png')}}" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.facebook.com/ArmarioMovilOficial/"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="{{asset('/images/emails/facebook@2x.png')}}" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.instagram.com/armariomovil/"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="{{asset('/images/emails/instagram@2x.png')}}" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.pinterest.com/armariomovil/"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="{{asset('/images/emails/pinterest@2x.png')}}" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-4 columns last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p
                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif;font-size:14px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                Este mensaje fue enviado por Armario Móvil S.A.<br>Quito
                                                                - Ecuador © 2019 Derechos Reservados</p><a
                                                                target="_blank"
                                                                style="Margin:0;color:#fff;display:block;font-family:Montserrat,sans-serif;font-size:14px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none"
                                                                href="http://www.armariomovil.com">www.armariomovil.com</a>
                                                        </th>
                                                        <th class="expander"
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="12px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table
                        style="Margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px"
                        align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="48px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#85869d;font-family:Montserrat,sans-serif;font-size:9px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                    Este e-mail fue enviado a
                                                                    {{ $order->user->email }} <br><br><strong>AVISO:</strong>
                                                                    Este e-mail así como cualquier información, archivo
                                                                    o documento adjunto son para el uso exclusivo y
                                                                    confidencial del destinatario(s) a quien(es) iban
                                                                    dirigidos. Este mensaje contiene información
                                                                    confidencial y de propiedad exclusiva de Armario
                                                                    Móvil que no puede ser leída, buscadas,
                                                                    distribuidas, ni utilizada por nadie más que el
                                                                    destinatario a quien iba dirigida. Si usted no es la
                                                                    persona a quien debía ir dirigido este e-mail, por
                                                                    favor no lea, no distribuya ni emprenda ninguna
                                                                    acción en relación con este mensaje. Si cree haber
                                                                    recibido este e-mail por error, avísele a quien se
                                                                    lo envió y elimine inmediatamente de su computadora
                                                                    este mensaje y sus documentos adjuntos.</p>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="24px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table><!-- END Footer -->
                </center>
            </td>
        </tr>
    </table><!-- prevent Gmail on iOS font size manipulation -->
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>

</html>


{{--
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" style="background:#f3f3f3!important">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Nuevo Usuario</title>
    <style>
        @media only screen {
            html {
                min-height: 100%;
                background: #f3f3f3
            }
        }

        @media only screen and (max-width:596px) {
            .small-text-center {
                text-align: center !important
            }
        }

        @media only screen and (max-width:596px) {
            table.body img {
                width: auto;
                height: auto
            }

            table.body center {
                min-width: 0 !important
            }

            table.body .container {
                width: 95% !important
            }

            table.body .columns {
                height: auto !important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 16px !important;
                padding-right: 16px !important
            }

            table.body .columns .columns {
                padding-left: 0 !important;
                padding-right: 0 !important
            }

            th.small-2 {
                display: inline-block !important;
                width: 16.66667% !important
            }

            th.small-3 {
                display: inline-block !important;
                width: 25% !important
            }

            th.small-4 {
                display: inline-block !important;
                width: 33.33333% !important
            }

            th.small-6 {
                display: inline-block !important;
                width: 50% !important
            }

            th.small-9 {
                display: inline-block !important;
                width: 75% !important
            }

            th.small-12 {
                display: inline-block !important;
                width: 100% !important
            }
        }
    </style>
</head>

<body
    style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;background:#f3f3f3!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
    <span class="preheader"
        style="color:#f3f3f3;display:none!important;font-family:Montserrat,sans-serif!important;font-size:1px;hyphens:none!important;line-height:1px;max-height:0;max-width:0;mso-hide:all!important;opacity:0;overflow:hidden;visibility:hidden"></span>
    <table class="body"
        style="Margin:0;background:#f3f3f3!important;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
        <tr style="padding:0;text-align:left;vertical-align:top">
            <td class="center" align="center" valign="top"
                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <center data-parsed style="min-width:580px;width:100%">
                    <!-- Header -->
                    <table
                        style="Margin:0 auto;background-image:url(../img/gradient.png);background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:0 0 12px 12px;border-spacing:0;box-shadow:0 0 13px 8px rgba(0,0,0,.1);float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%"
                        align="center" class="wrapper float-center">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="10px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;margin:auto;max-width:130px;outline:0;text-decoration:none;width:auto"
                                                                src="../img/Armario-Móvil-white-logo.png" alt></th>
                                                        <th class="expander"
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="10px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-4 columns first"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-right small-text-center"
                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:right">
                                                                <img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%"
                                                                    src="../img/credit-card-icon.png" alt> TARJETAS DE
                                                                CRÉDITO/DÉBITO</p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-12 large-4 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-center small-text-center"
                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                <img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%"
                                                                    src="../img/delivery-small-icon.png" alt> ENTREGAS
                                                                LOCALES EN 2 HORAS</p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-12 large-4 columns last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-left small-text-center"
                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:left">
                                                                <img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%"
                                                                    src="../img/offert-icon.png" alt> OFERTAS EXCLUSIVAS
                                                            </p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="4px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:4px;font-weight:400;hyphens:auto;line-height:4px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="165px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:165px;font-weight:400;hyphens:auto;line-height:165px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table><!-- END Header -->
                    <!-- Content Header -->
                    <table
                        style="Margin:0 auto;background:#fefefe;border-collapse:collapse;border-radius:18px;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px"
                        align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table
                                        style="background-image:url(../img/banner.png);background-position:center center;background-repeat:no-repeat;background-size:cover;border-collapse:collapse;border-radius:12px;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%"
                                        class="wrapper" align="center">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="spacer"
                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td height="24px"
                                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                            &#xA0;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table><img
                                                                                style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;margin-top:-28%;max-width:260px;outline:0;padding-bottom:8px;text-decoration:none;width:100%"
                                                                                src="../img/woman.png" alt>
                                                                            <h1 class="text-center"
                                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:34px;font-weight:700!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center;word-wrap:normal">
                                                                                ¡Felicidades, #Nombre!</h1>
                                                                            <p class="text-center"
                                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                                Te damos la bienvenida a Armario Móvil,
                                                                                aquí están tus datos de acceso:</p>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="spacer"
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="24px"
                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &#xA0;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-6 large-6 columns first"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:274px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="row"
                                                                                style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th class="small-3 large-3 columns first"
                                                                                            style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:25%">
                                                                                            <table
                                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr
                                                                                                    style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th
                                                                                                        style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;max-width:32px;outline:0;text-decoration:none;width:100%"
                                                                                                            src="../img/user.png"
                                                                                                            alt></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th class="small-9 large-9 columns last"
                                                                                            valign="middle"
                                                                                            style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:75%">
                                                                                            <table
                                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr
                                                                                                    style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th
                                                                                                        style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <h6
                                                                                                            style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left;word-wrap:normal">
                                                                                                            Usuario:
                                                                                                        </h6>
                                                                                                        <p
                                                                                                            style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left">
                                                                                                            Nombre de
                                                                                                            usuario</p>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            <th class="small-6 large-6 columns last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:274px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="row"
                                                                                style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th class="small-3 large-3 columns first"
                                                                                            style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:25%">
                                                                                            <table
                                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr
                                                                                                    style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th
                                                                                                        style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;max-width:32px;outline:0;text-decoration:none;width:100%"
                                                                                                            src="../img/password.png"
                                                                                                            alt></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th class="small-9 large-9 columns last"
                                                                                            valign="middle"
                                                                                            style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:75%">
                                                                                            <table
                                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr
                                                                                                    style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th
                                                                                                        style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <h6
                                                                                                            style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:700;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left;word-wrap:normal">
                                                                                                            Contraseña:
                                                                                                        </h6>
                                                                                                        <p
                                                                                                            style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left">
                                                                                                            La
                                                                                                            contraseña
                                                                                                            seleccionada
                                                                                                        </p>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Content Header -->
                                    <!-- Email Body -->
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                    <strong>#Nombre</strong>, esperamos que tu estadía
                                                                    en Armario Móvil sea la mejor ¡Conoce
                                                                    <strong>nuestras categorías</strong> y crea tu
                                                                    propio camino de la moda!</p>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-4 large-4 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/hombre.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/mujer.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/nino.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-4 large-4 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/nina.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/bebes.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/mascotas.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-4 large-4 columns first"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <span
                                                                    style="font-family:Montserrat,sans-serif!important;hyphens:none!important"></span>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p class="text-center small-text-center"
                                                                    style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:12px;font-weight:strong;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">
                                                                    <a target="_blank" href="#"
                                                                        style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">
                                                                        <!-- ADD LINK --> <img
                                                                            style="-ms-interpolation-mode:bicubic;border:none;border-radius:150px;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%"
                                                                            src="../img/hogar.png" alt></a></p>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <span
                                                                    style="font-family:Montserrat,sans-serif!important;hyphens:none!important"></span>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Montserrat,sans-serif!important;font-size:10px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                    También puedes completar todos tus datos de usuario,
                                                                    obtener ofertas y notificaciones de tu interés aquí.
                                                                </p>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style="Margin:0;background:url(../img/gradient.png);background-position:center center;background-size:cover;border-radius:150px;box-sizing:border-box;color:#fff;display:block;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:.7em 0;text-align:center;text-decoration:none;width:85%"
                                                                    href="#">Obtener ofertas y notificaciones de
                                                                    interés</a><!-- ADD LINK -->
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table><!-- END Email Body -->
                                </td>
                            </tr>
                        </tbody>
                    </table><!-- Footer -->
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="12px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" class="wrapper float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a target="_blank"
                                                                style="Margin:0;color:#85869d;display:block;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none"
                                                                href="http://www.armariomovil.com">Ir a Armario
                                                                Móvil</a></th>
                                                        <th class="expander"
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="48px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="Margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px"
                        align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-4 large-4 columns first"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Hombre</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Mujer</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-4 large-4 columns"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Niño</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-3 large-3 columns"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:129px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Niña</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-3 large-3 columns"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:129px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Bebés</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-3 large-3 columns"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:129px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Mascotas</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-3 large-3 columns last"
                                                    style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:129px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <a target="_blank"
                                                                    style=";padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: 'Montserrat',sans-serif !important; font-size: 10px; font-weight: normal; hyphens: none !important; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none"
                                                                    href="#">Hogar</a><!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="24px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="Margin:0 auto;background-image:url(../img/gradient.png);background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:12px;border-spacing:0;box-shadow:0 0 13px 8px rgba(0,0,0,.1);float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%"
                        align="center" class="wrapper float-center">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner"
                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="24px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-2 large-4 columns first"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://api.whatsapp.com/send?l=es&phone=5930987167802&text=Hola%2C%20me%20gustar%C3%ADa%20ser%20parte%20de%20Armario%20M%C3%B3vil"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="../img/whatsapp@2x.png" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.facebook.com/pg/ArmarioMovilOficial"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="../img/facebook@2x.png" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.instagram.com/armariomovil/"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="../img/instagram@2x.png" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Montserrat,sans-serif!important;font-weight:400;hyphens:none!important;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none"
                                                                href="https://www.pinterest.com/armariomovil/"
                                                                target="_blank"><img
                                                                    style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto"
                                                                    src="../img/pinterest@2x.png" alt></a></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-4 columns last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last"
                                                style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p
                                                                style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                Este mensaje fue enviado por Armario Móvil S.A.<br>Quito
                                                                - Ecuador © 2019 Derechos Reservados</p><a
                                                                target="_blank"
                                                                style="Margin:0;color:#fff;display:block;font-family:Montserrat,sans-serif!important;font-size:14px;font-weight:lighter!important;hyphens:none!important;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none"
                                                                href="http://www.armariomovil.com">www.armariomovil.com</a>
                                                        </th>
                                                        <th class="expander"
                                                            style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer"
                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="12px"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table
                        style="Margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px"
                        align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="spacer"
                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="48px"
                                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    &#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#85869d;font-family:Montserrat,sans-serif!important;font-size:9px;font-weight:400;hyphens:none!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                    Este e-mail fue enviado a
                                                                    {{ $question->product->store->user}}<br><br><strong>AVISO:</strong>
                                                                    Este e-mail así como cualquier información, archivo
                                                                    o documento adjunto son para el uso exclusivo y
                                                                    confidencial del destinatario(s) a quien(es) iban
                                                                    dirigidos. Este mensaje contiene información
                                                                    confidencial y de propiedad exclusiva de Armario
                                                                    Móvil que no puede ser leída, buscadas,
                                                                    distribuidas, ni utilizada por nadie más que el
                                                                    destinatario a quien iba dirigida. Si usted no es la
                                                                    persona a quien debía ir dirigido este e-mail, por
                                                                    favor no lea, no distribuya ni emprenda ninguna
                                                                    acción en relación con este mensaje. Si cree haber
                                                                    recibido este e-mail por error, avísele a quien se
                                                                    lo envió y elimine inmediatamente de su computadora
                                                                    este mensaje y sus documentos adjuntos.</p>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="spacer float-center"
                        style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="24px"
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    &#xA0;</td>
                            </tr>
                        </tbody>
                    </table><!-- END Footer -->
                </center>
            </td>
        </tr>
    </table><!-- prevent Gmail on iOS font size manipulation -->
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>

</html> --}}
