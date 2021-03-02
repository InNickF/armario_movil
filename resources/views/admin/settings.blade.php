@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col my-2">
      <h1>Ajustes</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      {!! Form::open(['route' => 'admin.settings.update']) !!}
      <div class="mb-2">
        <button class="btn btn-primary">Guardar</button>
      </div>

      <b-tabs content-class="mt-3">
        <b-tab title="Generales" active>

          <div class="row">
            <div class="col-12">
              <h3>Generales</h3>
            </div>
            <div class="form-group col-sm-6">
              {!! Form::label('app_name', 'Nombre de la plataforma:', ['class' => 'font-weight-bold text-primary']) !!}
              {!! Form::text('app_name', $settings['app_name']??null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group col-sm-6">
              {!! Form::label('admin_email', 'Email de administrador:', ['class' => 'font-weight-bold text-primary'])
              !!}
              {!! Form::email('admin_email', $settings['admin_email']??null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group col-sm-6">
              {!! Form::label('seo_title', 'Nombre SEO:', ['class' => 'font-weight-bold text-primary']) !!}
              {!! Form::text('seo_title', $settings['seo_title']??null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
              {!! Form::label('seo_description', 'Descripción SEO:', ['class' => 'font-weight-bold text-primary']) !!}
              {!! Form::text('seo_description', $settings['seo_description']??null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
              {!! Form::label('seo_keywords', 'Palabras clave SEO separadas por coma:', ['class' => 'font-weight-bold
              text-primary']) !!}
              {!! Form::textarea('seo_keywords', $settings['seo_keywords']??null, ['class' => 'form-control']) !!}
            </div>


            <div class="col-12">
              <h3>Imágenes</h3>
            </div>


            <div class="form-group col-sm-6">
              <p class="text-primary font-weight-bold">Imagen de logo:</p>

              <upload-single-image title="Cambiar imagen de logo" class="btn-cambiar-foto"
                old-image="{{ isset($settings['logo_image']) ? json_encode($settings['logo_image']) : "" }}"
                field-name="logo_image">
              </upload-single-image>
            </div>

            <div class="form-group col-sm-6">
              <p class="text-primary font-weight-bold">Imagen de logo PNG:</p>

              <upload-single-image title="Cambiar imagen de logo" class="btn-cambiar-foto"
                old-image="{{ isset($settings['logo_image_png']) ? json_encode($settings['logo_image_png']) : "" }}"
                field-name="logo_image_png">
              </upload-single-image>
            </div>


            <div class="form-group col-sm-6">
              <p class="text-primary font-weight-bold">Imagen de fondo de cabecera:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['header_bg_image']) ? json_encode($settings['header_bg_image']) : "" }}"
                field-name="header_bg_image">
              </upload-single-image>
            </div>

            <div class="form-group col-sm-4">
              <p class="text-primary font-weight-bold">Ícono de buscador en SVG:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['search_icon']) ? json_encode($settings['search_icon']) : "" }}"
                field-name="search_icon">
              </upload-single-image>
            </div>

            <div class="form-group col-sm-4">
              <p class="text-primary font-weight-bold">Ícono de landing Best Seller en SVG:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['landing_icon']) ? json_encode($settings['landing_icon']) : "" }}"
                field-name="landing_icon">
              </upload-single-image>
            </div>

            <div class="form-group col-sm-4">
              <p class="text-primary font-weight-bold">Ícono de carrito de compras en SVG:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['cart_icon']) ? json_encode($settings['cart_icon']) : "" }}"
                field-name="cart_icon">
              </upload-single-image>
            </div>

            <div class="form-group col-sm-4">
              <p class="text-primary font-weight-bold">Ícono de perfil de usuario en SVG:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['user_icon']) ? json_encode($settings['user_icon']) : "" }}"
                field-name="user_icon">
              </upload-single-image>
            </div>


            <div class="form-group col-sm-4">
              <p class="text-primary font-weight-bold">Ícono de VENDER:</p>

              <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
                old-image="{{ isset($settings['sell_icon']) ? json_encode($settings['sell_icon']) : "" }}"
                field-name="sell_icon">
              </upload-single-image>
            </div>

          </div>




          <div class="row">
            <div class="col-12">
              <h3>Enlaces</h3>
            </div>

            <div class="form-group col-sm-6">
              {!! Form::label('landing_url', 'Enlace landing Best Seller:', ['class' => 'font-weight-bold
              text-primary']) !!}
              {!! Form::text('landing_url', $settings['landing_url']??null, ['class' => 'form-control']) !!}
            </div>
          </div>


        </b-tab>

        <b-tab title="Enlaces Footer">
          <div class="row">

            <div class="col-12 mb-4">
              <h3>Columna 1</h3>
              <footer-links-form :links-prop="{{(json_encode($settings['footer_links_column_1']) ?? [])}}"
                field-name="footer_links_column_1"></footer-links-form>
            </div>

            <div class="col-12 mb-4">
              <h3>Columna 2</h3>
              <footer-links-form :links-prop="{{(json_encode($settings['footer_links_column_2']) ?? [])}}"
                field-name="footer_links_column_2"></footer-links-form>
            </div>

            <div class="col-12 mb-4">
              <h3>Columna 3</h3>
              <footer-links-form :links-prop="{{(json_encode($settings['footer_links_column_3']) ?? [])}}"
                field-name="footer_links_column_3"></footer-links-form>
            </div>

            <div class="col-12 mb-4">
              <h3>Columna 4</h3>
              <footer-links-form :links-prop="{{(json_encode($settings['footer_links_column_4']) ?? [])}}"
                field-name="footer_links_column_4"></footer-links-form>
            </div>

          </div>
        </b-tab>

        {{-- COMISIONES --}}
        <b-tab title="Comisiones">

          <div class="row">
            <div class="col-12">
              <h3>Comisiones de Planes Armarios</h3>
            </div>
            <div class="form-group col-sm-6">
              {!! Form::label('ropero_commission_percentage', '% Comisión plan Ropero:', ['class' => 'font-weight-bold
              text-primary']) !!}
              {!! Form::number('ropero_commission_percentage', $settings['ropero_commission_percentage']??null, ['class'
              => 'form-control', 'step' => 'any'])
              !!}
            </div>


            <div class="form-group col-sm-6">
              {!! Form::label('closet_commission_percentage', '% Comisión plan Closet:', ['class' => 'font-weight-bold
              text-primary']) !!}
              {!! Form::number('closet_commission_percentage', $settings['closet_commission_percentage']??null, ['class'
              => 'form-control', 'step' => 'any'])
              !!}
            </div>


            <div class="form-group col-sm-6">
              {!! Form::label('armario_commission_percentage', '% Comisión plan Armario:', ['class' => 'font-weight-bold
              text-primary']) !!}
              {!! Form::number('armario_commission_percentage', $settings['armario_commission_percentage']??null,
              ['class' => 'form-control', 'step' => 'any'])
              !!}
            </div>


          </div>


        </b-tab>

        {{-- HOMEPAGE --}}
        <b-tab title="Home">
          {{-- <div class="row">
            <div class="col-12">
              <h3>Slider</h3>
              <div id="homeSliderForm">
                <slider-form :old-slides="{{ json_encode($settings['home.slider'] ?? null) }}"></slider-form>
    </div>
  </div>
</div> --}}



<div class="row">
  <div class="col-12">
    <h3>Estadísticas</h3>
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('statistics_1_title', 'Título 1:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('statistics_1_title', $settings['statistics_1_title']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
    {!! Form::label('statistics_1_value', 'Valor 1:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::number('statistics_1_value', $settings['statistics_1_value']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('statistics_2_title', 'Título 2:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('statistics_2_title', $settings['statistics_2_title']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
    {!! Form::label('statistics_2_value', 'Valor 2:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::number('statistics_2_value', $settings['statistics_2_value']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('statistics_3_title', 'Título 3:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('statistics_3_title', $settings['statistics_3_title']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
    {!! Form::label('statistics_3_value', 'Valor 3:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::number('statistics_3_value', $settings['statistics_3_value']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
      {!! Form::label('statistics_4_title', 'Título 4:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::text('statistics_4_title', $settings['statistics_4_title']??null, ['class' =>
      'form-control', 'multiple' => 'multiple']) !!}
    </div>
  
  
    <div class="form-group col-sm-6">
      {!! Form::label('statistics_4_value', 'Valor 4:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::number('statistics_4_value', $settings['statistics_4_value']??null, ['class' =>
      'form-control', 'multiple' => 'multiple']) !!}
    </div>


</div>



<div class="row">
  <div class="col-12">
    <h3>Menú fotográfico</h3>
  </div>

  <div class="form-group col-sm-6">
    <p class="text-primary font-weight-bold">Imagen 1:</p>

    <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
      old-image="{{ isset($settings['home_photo_menu_1_image']) ? json_encode($settings['home_photo_menu_1_image']) : "" }}"
      field-name="home_photo_menu_1_image">
    </upload-single-image>
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('home_photo_menu_1_link', 'Enlace 1:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('home_photo_menu_1_link', $settings['home_photo_menu_1_link']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
    <p class="text-primary font-weight-bold">Imagen 2:</p>

    <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
      old-image="{{ isset($settings['home_photo_menu_2_image']) ? json_encode($settings['home_photo_menu_2_image']) : "" }}"
      field-name="home_photo_menu_2_image">
    </upload-single-image>
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('home_photo_menu_2_link', 'Enlace 2:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('home_photo_menu_2_link', $settings['home_photo_menu_2_link']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>

  <div class="form-group col-sm-6">
    <p class="text-primary font-weight-bold">Imagen 3:</p>

    <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
      old-image="{{ isset($settings['home_photo_menu_3_image']) ? json_encode($settings['home_photo_menu_3_image']) : "" }}"
      field-name="home_photo_menu_3_image">
    </upload-single-image>
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('home_photo_menu_3_link', 'Enlace 3:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('home_photo_menu_3_link', $settings['home_photo_menu_3_link']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>


  <div class="form-group col-sm-6">
    <p class="text-primary font-weight-bold">Imagen 4:</p>

    <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
      old-image="{{ isset($settings['home_photo_menu_4_image']) ? json_encode($settings['home_photo_menu_4_image']) : "" }}"
      field-name="home_photo_menu_4_image">
    </upload-single-image>
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('home_photo_menu_4_link', 'Enlace 4:', ['class' => 'font-weight-bold
    text-primary']) !!}
    {!! Form::text('home_photo_menu_4_link', $settings['home_photo_menu_4_link']??null, ['class' =>
    'form-control', 'multiple' => 'multiple']) !!}
  </div>

</div>


<div class="row">
    <div class="col-12">
      <h3>Menú armarios</h3>
    </div>
  
    <div class="form-group col-sm-6">
      <p class="text-primary font-weight-bold">Imagen 1:</p>
  
      <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
        old-image="{{ isset($settings['home_plan_menu_1_image']) ? json_encode($settings['home_plan_menu_1_image']) : "" }}"
        field-name="home_plan_menu_1_image">
      </upload-single-image>
    </div>
  
    <div class="form-group col-sm-6">
      {!! Form::label('home_plan_menu_1_link', 'Enlace 1:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::text('home_plan_menu_1_link', $settings['home_plan_menu_1_link']??null, ['class' =>
      'form-control', 'multiple' => 'multiple']) !!}
    </div>
  
  
    <div class="form-group col-sm-6">
      <p class="text-primary font-weight-bold">Imagen 2:</p>
  
      <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
        old-image="{{ isset($settings['home_plan_menu_2_image']) ? json_encode($settings['home_plan_menu_2_image']) : "" }}"
        field-name="home_plan_menu_2_image">
      </upload-single-image>
    </div>
  
    <div class="form-group col-sm-6">
      {!! Form::label('home_plan_menu_2_link', 'Enlace 2:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::text('home_plan_menu_2_link', $settings['home_plan_menu_2_link']??null, ['class' =>
      'form-control', 'multiple' => 'multiple']) !!}
    </div>
  
    <div class="form-group col-sm-6">
      <p class="text-primary font-weight-bold">Imagen 3:</p>
  
      <upload-single-image title="Cambiar imagen" class="btn-cambiar-foto"
        old-image="{{ isset($settings['home_plan_menu_3_image']) ? json_encode($settings['home_plan_menu_3_image']) : "" }}"
        field-name="home_plan_menu_3_image">
      </upload-single-image>
    </div>
  
    <div class="form-group col-sm-6">
      {!! Form::label('home_plan_menu_3_link', 'Enlace 3:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::text('home_plan_menu_3_link', $settings['home_plan_menu_3_link']??null, ['class' =>
      'form-control', 'multiple' => 'multiple']) !!}
    </div>
  
  
  </div>

</b-tab>
<b-tab title="Costos de envío">
  <div class="row">

    <div class="col-12">
      <h3>Envíos locales</h3>
    </div>
    <!-- local_shipping_base_price Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('local_shipping_base_price', 'Precio base del envío:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::number('local_shipping_base_price', $settings['local_shipping_base_price']??null, ['class' =>
      'form-control', 'step' => 'any']) !!}
    </div>

    <!-- local_shipping_price_per_extra_product Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('local_shipping_price_per_extra_product', 'Precio por producto adicional:', ['class' =>
      'font-weight-bold text-primary']) !!}
      {!! Form::number('local_shipping_price_per_extra_product',
      $settings['local_shipping_price_per_extra_product']??null, ['class' => 'form-control', 'step' => 'any'])
      !!}
    </div>

    <div class="col-12">

      <h3>Envíos nacionales</h3>
    </div>
    <!-- national_shipping_base_price Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('national_shipping_base_price', 'Precio base del envío:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::number('national_shipping_base_price', $settings['national_shipping_base_price']??null, ['class'
      => 'form-control', 'step' => 'any']) !!}
    </div>

    <!-- national_shipping_price_per_extra_product Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('national_shipping_price_per_extra_product', 'Precio por producto adicional:', ['class' =>
      'font-weight-bold text-primary']) !!}
      {!! Form::number('national_shipping_price_per_extra_product',
      $settings['national_shipping_price_per_extra_product']??null, ['class' => 'form-control', 'step' =>
      'any'])
      !!}
    </div>

    <div class="col-12">

      <h3>Envíos Galápagos</h3>
    </div>
    <!-- galapagos_shipping_base_price Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('galapagos_shipping_base_price', 'Precio base del envío:', ['class' => 'font-weight-bold
      text-primary']) !!}
      {!! Form::number('galapagos_shipping_base_price', $settings['galapagos_shipping_base_price']??null,
      ['class'
      => 'form-control', 'step' => 'any']) !!}
    </div>

    <!-- galapagos_shipping_price_per_extra_product Field -->
    <div class="form-group col-sm-6">
      {!! Form::label('galapagos_shipping_price_per_extra_product', 'Precio por producto adicional:', ['class'
      =>
      'font-weight-bold text-primary']) !!}
      {!! Form::number('galapagos_shipping_price_per_extra_product',
      $settings['galapagos_shipping_price_per_extra_product']??null, ['class' => 'form-control', 'step' =>
      'any']) !!}
    </div>
  </div>

</b-tab>
</b-tabs>

{!! Form::close() !!}
</div>
</div>




</div>
@endsection


