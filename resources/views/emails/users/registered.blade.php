{{-- @component('mail::message')
# Bienvenido

Hola {{$user->full_name}}, bienvenido Armario Móvil.

Para ingresar usa esta dirección de correo {{$user->email}} y la contraseña que estableciste en el formulario de registro.

@component('mail::button', ['url' => url('/')])
Iniciar sesión
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent --}}


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                text-align: center!important
            }
        }
        
        @media only screen and (max-width:596px) {
            table.body img {
                width: auto;
                height: auto
            }
            table.body center {
                min-width: 0!important
            }
            table.body .container {
                width: 95%!important
            }
            table.body .columns {
                height: auto!important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 16px!important;
                padding-right: 16px!important
            }
            table.body .columns .columns {
                padding-left: 0!important;
                padding-right: 0!important
            }
            th.small-2 {
                display: inline-block!important;
                width: 16.66667%!important
            }
            th.small-3 {
                display: inline-block!important;
                width: 25%!important
            }
            th.small-4 {
                display: inline-block!important;
                width: 33.33333%!important
            }
            th.small-6 {
                display: inline-block!important;
                width: 50%!important
            }
            th.small-9 {
                display: inline-block!important;
                width: 75%!important
            }
            th.small-12 {
                display: inline-block!important;
                width: 100%!important
            }
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,700&display=swap&subset=latin-ext');
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
</head>

<body style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;background:#f3f3f3!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important"><span class="preheader" style="color:#f3f3f3;display:none!important;font-size:1px;line-height:1px;max-height:0;max-width:0;mso-hide:all!important;opacity:0;overflow:hidden;visibility:hidden"></span>
    <table class="body" style="Margin:0;background:#f3f3f3!important;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
        <tr style="padding:0;text-align:left;vertical-align:top">
            <td class="center" align="center" valign="top" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <center data-parsed style="min-width:580px;width:100%">
                    <!-- Header -->
                    <table style="Margin:0 auto;background-image:url({{asset('images/emails/gradient.png')}});background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:0 0 12px 12px;border-spacing:0;box-shadow:0 0 13px 8px rgba(0,0,0,.1);float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%" align="center" class="wrapper float-center">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="10px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row" style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><img style="-ms-interpolation-mode:bicubic;clear:both;display:block;margin:auto;max-width:130px;outline:0;text-decoration:none;width:auto" src="{{setting('logo_image_png', asset('images/icons/logo-armario-movil.png'))}}" alt></th>
                                                        <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="10px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row" style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-4 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-right small-text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:strong;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:right"><img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%" src="{{asset('/images/emails/credit-card-icon.png')}}" alt> TARJETAS DE CRÉDITO/DÉBITO</p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-12 large-4 columns" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:177.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-center small-text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:strong;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center"><img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%" src="{{asset('/images/emails/delivery-small-icon.png')}}" alt> ENTREGAS LOCALES EN 3 HORAS</p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-12 large-4 columns last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p class="text-left small-text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:strong;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:left"><img style="-ms-interpolation-mode:bicubic;clear:both;display:inline-block;height:auto;margin:auto;max-width:12px;outline:0;position:relative;text-decoration:none;top:3px;width:100%" src="{{asset('/images/emails/offert-icon.png')}}" alt> OFERTAS EXCLUSIVAS</p>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="4px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:4px;font-weight:400;hyphens:auto;line-height:4px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="165px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:165px;font-weight:400;hyphens:auto;line-height:165px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END Header -->
                    <!-- Content Header -->
                    <table style="Margin:0 auto;background:#fefefe;border-collapse:collapse;border-radius:18px;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px" align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table style="background-image:url({{asset('images/emails/banner.png')}});background-position:center center;background-repeat:no-repeat;background-size:cover;border-collapse:collapse;border-radius:12px;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%" class="wrapper" align="center">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table><img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;margin-top:-28%;max-width:260px;outline:0;padding-bottom:8px;text-decoration:none;width:100%" src="{{asset('/images/emails/woman.png')}}" alt>
                                                                            <h1 class="text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:34px;font-weight:700!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center;word-wrap:normal">¡Felicidades, {{ $user->first_name }}!</h1>
                                                                            <p class="text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:lighter!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0 3%;text-align:center">Te damos la bienvenida a Armario Móvil</p>
                                                                        </th>
                                                                        <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-6 large-6 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:274px">
                                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th class="small-3 large-3 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:25%">
                                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;max-width:32px;outline:0;text-decoration:none;width:100%" src="{{asset('/images/emails/user.png')}}" alt></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th class="small-9 large-9 columns last" valign="middle" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:75%">
                                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <h6 style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left;word-wrap:normal">Usuario:</h6>
                                                                                                        <p style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left">{{ $user->first_name }} {{ $user->last_name }}</p>
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
                                                            <th class="small-6 large-6 columns last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:274px">
                                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                            <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                        <th class="small-3 large-3 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:25%">
                                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><img style="-ms-interpolation-mode:bicubic;clear:both;display:block;height:auto;margin:auto;max-width:32px;outline:0;text-decoration:none;width:100%" src="{{asset('/images/emails/password.png')}}" alt></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th class="small-9 large-9 columns last" valign="middle" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0!important;padding-right:0!important;text-align:left;width:75%">
                                                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                                    <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                                                        <h6 style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left;word-wrap:normal">Contraseña:</h6>
                                                                                                        <p style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;padding-left:8px;text-align:left">La contraseña seleccionada</p>
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
                                    <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END Content Header -->
                                    <!-- Email Body -->
                                    <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p style="Margin:0;Margin-bottom:10px;color:#181b48;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center"><strong>{{ $user->first_name }}</strong>, esperamos que tu estadía en Armario Móvil sea la mejor ¡Conoce <strong>nuestras categorías</strong> y crea tu propio camino de la moda!</p>
                                                            </th>
                                                            <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @foreach ($categories->chunk(3) as $chunk)
                                    <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">

                                                @foreach ($chunk as $category)
                                                    
                                                <td class="small-4 large-4 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:193.77px">
                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;background-image:url({{asset('images/emails/gradient.png')}});background-position:center center;background-repeat:no-repeat;background-size:100% 100%;height:160px;width:160px !important;border-radius:50%;">
                                                                <div class="text-center small-text-center" style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:strong;line-height:1.3;margin:0;margin-bottom:5px;padding:0 3%;text-align:center;height:150px;width:150px !important;border-radius:50%;background-color:white;margin-top:5px;margin-left:5px;">
                                                                    <a target="_blank" href="{{ $category->url }}" style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:center;text-decoration:none;">
                                                                        <!-- ADD LINK -->
                                                                        <img style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:inline-block;height:auto;margin:auto;max-width:125px;outline:0;text-decoration:none;width:100%;width:50px;height:50px;margin-top:30px;border-radius:150px;" src="{{$category->icon_image_jpg}}" alt>
                                                                        <p style="font-size:18px;color:#181b48!important;text-align:center;margin-top:10px">{{$category->name}}</p>
                                                                    </a>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                @endforeach
                                                
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endforeach    


                                    <!-- END Email Body -->

                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Footer -->
                    <table class="spacer float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="12px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" class="float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="row" style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><a target="_blank" style="Margin:0;color:#85869d;display:block;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none" href="http://www.armariomovil.com">Ir a Armario Móvil</a></th>
                                                        <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="spacer float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="48px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="Margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px" align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">


                                                @foreach ($categories as $category)
                                                    
                                                <th class="small-4 large-4 columns first" style="Margin:0 auto;border-bottom:solid 1px #181b48;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><a target="_blank" style="padding-top:18px; Margin: 0; color: #181b48; display: block; font-family: Helvetica,Arial,sans-serif; font-size: 10px; font-weight: normal; line-height: 1.3; margin: 0; padding: 0; padding-top: 10px; text-align: center; text-decoration: none" href="{{ $category->url }}">{{ $category->name }}</a>
                                                                <!-- ADD LINK -->
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="spacer float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="Margin:0 auto;background-image:url({{asset('images/emails/gradient.png')}});background-position:center center;background-repeat:no-repeat;background-size:100% 100%;border-collapse:collapse;border-radius:12px;border-spacing:0;box-shadow:0 0 13px 8px rgba(0,0,0,.1);float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%" align="center" class="wrapper float-center">
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td class="wrapper-inner" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row" style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-2 large-4 columns first" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:8px;text-align:left;width:177.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"></th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none" href="https://api.whatsapp.com/send?phone=5930987167802&amp;text=Hola,%20me%20gustaría%20ser%20parte%20de%20Armario%20Móvil" target="_blank"><img style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto" src="{{asset('/images/emails/whatsapp@2x.png')}}" alt></a>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none" href="https://www.facebook.com/ArmarioMovilOficial/" target="_blank"><img style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto" src="{{asset('/images/emails/facebook@2x.png')}}" alt></a>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none" href="https://www.instagram.com/armariomovil/" target="_blank"><img style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto" src="{{asset('/images/emails/instagram@2x.png')}}" alt></a>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-1 columns" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:8px;text-align:left;width:32.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <a style="Margin:0;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:auto;padding:0;text-align:left;text-decoration:none" href="https://www.pinterest.com/armariomovil/" target="_blank"><img style="-ms-interpolation-mode:bicubic;border:none;clear:both;display:block;height:auto;margin:auto;max-width:20px;outline:0;text-decoration:none;width:auto" src="{{asset('/images/emails/pinterest@2x.png')}}" alt></a>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="small-2 large-4 columns last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:8px;padding-right:16px;text-align:left;width:177.33px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"></th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row" style="border-collapse:collapse;border-spacing:0;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                            <p style="Margin:0;Margin-bottom:10px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:lighter!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">Este mensaje fue enviado por Armario Móvil S.A.
                                                                <br>Quito - Ecuador © 2019 Derechos Reservados</p><a target="_blank" style="Margin:0;color:#fff;display:block;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:lighter!important;line-height:1.3;margin:0;padding:0;padding-top:10px;text-align:center;text-decoration:none" href="http://www.armariomovil.com">www.armariomovil.com</a></th>
                                                        <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                    </tr>
                                                </table>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="12px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;hyphens:auto;line-height:12px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="Margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px" align="center" class="container float-center">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="48px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;hyphens:auto;line-height:48px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left">
                                                                <p style="Margin:0;Margin-bottom:10px;color:#85869d;font-family:Helvetica,Arial,sans-serif;font-size:9px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">Este e-mail fue enviado a {{ $user->email }}
                                                                    <br>
                                                                    <br><strong>AVISO:</strong> Este e-mail así como cualquier información, archivo o documento adjunto son para el uso exclusivo y confidencial del destinatario(s) a quien(es) iban dirigidos. Este mensaje contiene información confidencial y de propiedad exclusiva de Armario Móvil que no puede ser leída, buscadas, distribuidas, ni utilizada por nadie más que el destinatario a quien iba dirigida. Si usted no es la persona a quien debía ir dirigido este e-mail, por favor no lea, no distribuya ni emprenda ninguna acción en relación con este mensaje. Si cree haber recibido este e-mail por error, avísele a quien se lo envió y elimine inmediatamente de su computadora este mensaje y sus documentos adjuntos.</p>
                                                            </th>
                                                            <th class="expander" style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
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
                    <table class="spacer float-center" style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td height="24px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:400;hyphens:auto;line-height:24px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END Footer -->
                </center>
            </td>
        </tr>
    </table>
    <!-- prevent Gmail on iOS font size manipulation -->
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>

</html>


 
