<?php

use App\Models\Order;
use App\User;
use Illuminate\Database\Seeder;
use Rinvex\Subscriptions\Models\Plan;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app_name = env('APP_NAME', 'Armario Móvil');
        setting(['app_name' => $app_name])->save();
        setting(['admin_email' => 'info@armariomovil.com'])->save();
        setting(['seo_title' => $app_name])->save();
        setting(['seo_description' => $app_name])->save();
        setting(['seo_keywords' => 'armario movil, e-commerce'])->save();

        setting(['logo_image' => url('images/icons/armario-movil-logo.svg')])->save();
        setting(['header_bg_image' => url('images/backgrounds/home-background.png')])->save();
        setting(['search_icon' => url('images/icons/top-menu/search-icon.svg')])->save();
        setting(['landing_icon' => url('images/icons/top-menu/medal-icon.svg')])->save();
        setting(['cart_icon' => url('images/icons/top-menu/bag-cart-icon.svg')])->save();
        setting(['user_icon' => url('images/icons/profile-menu/profile-grey-icon.svg')])->save();
        setting(['sell_icon' => url('images/icons/top-menu/shirt-money.svg')])->save();

        setting(['landing_url' => url('promociones')])->save();


        // $faker = Faker\Factory::create();
        setting(['footer_links_column_1' => ['Preguntas frecuentes' => url('/preguntas-frecuentes')]])->save();
        setting(['footer_links_column_2' => ['Escríbenos' => url('/contacto')]])->save();
        setting(['footer_links_column_3' => ['Términos y condiciones' => url('pdf/Terminos-y-condiciones-Politicas-de-privacidad-de-Armario-Movil.pdf')]])->save();
        setting(['footer_links_column_4' => ['Blog' => url('/blog')]])->save();

        // Estadisticas HOME
        setting(['statistics_1_title' => 'VENTAS CERRADAS'])->save();
        setting(['statistics_1_value' => Order::all()->count()])->save();
        setting(['statistics_2_title' => 'USUARIOS REGISTRADOS'])->save();
        setting(['statistics_2_value' => User::all()->count()])->save();
        setting(['statistics_3_title' => 'USUARIOS SATISFECHOS'])->save();
        setting(['statistics_3_value' => 0])->save();
        setting(['statistics_4_title' => 'ENTREGAS COMPLETADAS'])->save();
        setting(['statistics_4_value' => 0])->save();


        // MENU FOTOGRAFICO HOME
        setting(['home_photo_menu_1_image' => url('images/examples/featured-products-example-1.png')])->save();
        setting(['home_photo_menu_1_link' => url('/')])->save();
        setting(['home_photo_menu_2_image' => url('images/examples/featured-products-example-1.png')])->save();
        setting(['home_photo_menu_2_link' => url('/')])->save();
        setting(['home_photo_menu_3_image' => url('images/examples/featured-products-example-1.png')])->save();
        setting(['home_photo_menu_3_link' => url('/')])->save();
        setting(['home_photo_menu_4_image' => url('images/examples/featured-products-example-1.png')])->save();
        setting(['home_photo_menu_4_link' => url('/')])->save();

        //  HOME MENU ARMARIOS
        setting(['home_plan_menu_1_image' => url('images/examples/armario.png')])->save();
        setting(['home_plan_menu_1_link' => url('/plans')])->save();
        setting(['home_plan_menu_2_image' => url('images/examples/closet.png')])->save();
        setting(['home_plan_menu_2_link' => url('/plans')])->save();
        setting(['home_plan_menu_3_image' => url('images/examples/ropero.png')])->save();
        setting(['home_plan_menu_3_link' => url('/plans')])->save();

        $plans = Plan::all();
        foreach ($plans as $key => $plan) {
            if (!setting($plan->slug . '_commission_percentage')) {
                setting([
                    $plan->slug . '_commission_percentage' => Plan::where('slug', $plan->slug)->first()->features->firstWhere('name', 'commission_percentage')->value
                ])->save();
            }
        }

        setting(['local_shipping_base_price' => 3.50])->save();
        setting(['local_shipping_price_per_extra_product' => 0.875])->save();
        setting(['national_shipping_base_price' => 6.00])->save();
        setting(['national_shipping_price_per_extra_product' => 3.0])->save();
        setting(['galapagos_shipping_base_price' => 13.0])->save();
        setting(['galapagos_shipping_price_per_extra_product' => 7.00])->save();
    }
}
