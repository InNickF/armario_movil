<?php

use Illuminate\Database\Seeder;
use Rinvex\Subscriptions\Models\PlanFeature;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Cool',
            'description' => 'Plan gratuito',
            'price' => 0.00,
            'signup_fee' => 0.00,
            'invoice_period' => 365,
            'invoice_interval' => 'day',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Pago Único', 'value' => 0, 'sort_order' => 1]),
            // new PlanFeature(['name' => 'Visualización', 'value' => 1, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Presencia página principal', 'value' => 0, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Página principal de categoría', 'value' => 0, 'sort_order' => 4]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 30, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'days_published', 'value' => 10, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en boletín web', 'value' => 0, 'sort_order' => 7]),
        ]);

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Fashion',
            'description' => 'Plan PRO',
            'price' => 7.99,
            'signup_fee' => 0.00,
            'invoice_period' => 365,
            'invoice_interval' => 'day',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 2,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Visualización', 'value' => 1, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Presencia página principal', 'value' => 1, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Página principal de categoría', 'value' => 1, 'sort_order' => 4]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 20, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'days_published', 'value' => 365, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en boletín web', 'value' => 1, 'sort_order' => 7]),
        ]);

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Chic',
            'description' => 'Plan regular',
            'price' => 4.99,
            'signup_fee' => 0.00,
            'invoice_period' => 365,
            'invoice_interval' => 'day',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 3,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Visualización', 'value' => 1, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Presencia página principal', 'value' => 1, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Página principal de categoría', 'value' => 0, 'sort_order' => 4]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 25, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'days_published', 'value' => 30, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en boletín web', 'value' => 0, 'sort_order' => 7]),
        ]);

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Ropero',
            'description' => 'Gratis',
            'price' => 0.00,
            'signup_fee' => 0.00,
            'invoice_period' => 365,
            'invoice_interval' => 'day',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Suscripción con cédula', 'value' => 1, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Suscripción con RUC', 'value' => 1, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Perfil comercial', 'value' => 0, 'sort_order' => 4]),
            new PlanFeature(['name' => 'max_products', 'value' => 5, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'Días de anuncios activos', 'value' => 15, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en productos outfit', 'value' => 0, 'sort_order' => 7]),
            // new PlanFeature(['name' => 'Botón de pago', 'value' => 1, 'sort_order' => 8]),
            // new PlanFeature(['name' => 'Servicio logístico', 'value' => 0, 'sort_order' => 9]),
            // new PlanFeature(['name' => 'Calculadora de precios, impuestos y comisiones', 'value' => 1, 'sort_order' => 10]),
            // new PlanFeature(['name' => 'Códigos de descuento', 'value' => 0, 'sort_order' => 11]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 30, 'sort_order' => 12]),
            // new PlanFeature(['name' => 'Certificado SSL (venta y envío seguro)', 'value' => 1, 'sort_order' => 13]),

            // new PlanFeature(['name' => 'Dashboard Historial de ventas', 'value' => 1, 'sort_order' => 14]),
            // new PlanFeature(['name' => 'Dashboard Perfil comercial', 'value' => 1, 'sort_order' => 15]),
            // new PlanFeature(['name' => 'Dashboard profesional Visitas', 'value' => 0, 'sort_order' => 16]),
            // new PlanFeature(['name' => 'Dashboard profesional Ventas', 'value' => 0, 'sort_order' => 17]),

            // new PlanFeature(['name' => 'Asesoría en moda', 'value' => 0, 'sort_order' => 18]),
            // new PlanFeature(['name' => 'Asesoría en fotografía profesional', 'value' => 0, 'sort_order' => 19]),
            // new PlanFeature(['name' => 'Asesoría en marketing', 'value' => 0, 'sort_order' => 20]),
            // new PlanFeature(['name' => 'Asesoría en comercio electrónico', 'value' => 0, 'sort_order' => 21]),
            // new PlanFeature(['name' => 'Tutoría personalizada', 'value' => 0, 'sort_order' => 22]),

            // new PlanFeature(['name' => 'Ofertas 24 horas', 'value' => 1, 'sort_order' => 23]),
            // new PlanFeature(['name' => 'Subastas', 'value' => 0, 'sort_order' => 24]),
            // new PlanFeature(['name' => 'Anuncios destacados foto (Chic)', 'value' => 0, 'sort_order' => 25]),
            // new PlanFeature(['name' => 'Anuncios destacados banner (fashion)', 'value' => 0, 'sort_order' => 26]),

            // new PlanFeature(['name' => 'Campaña de productos (e mail masivo)', 'value' => 0, 'sort_order' => 27]),
            // new PlanFeature(['name' => 'Campaña de productos (banners externos)', 'value' => 0, 'sort_order' => 28]),
            // new PlanFeature(['name' => 'Video promocional trimestral', 'value' => 0, 'sort_order' => 29]),
        ]);

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Armario',
            'description' => 'Pago mensual',
            'price' => 14.99,
            'signup_fee' => 0.00,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Suscripción con cédula', 'value' => 0, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Suscripción con RUC', 'value' => 1, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Perfil comercial', 'value' => 1, 'sort_order' => 4]),
            new PlanFeature(['name' => 'max_products', 'value' => 99999, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'Días de anuncios activos', 'value' => 999, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en productos outfit', 'value' => 1, 'sort_order' => 7]),
            // new PlanFeature(['name' => 'Botón de pago', 'value' => 1, 'sort_order' => 8]),
            // new PlanFeature(['name' => 'Servicio logístico', 'value' => 1, 'sort_order' => 9]),
            // new PlanFeature(['name' => 'Calculadora de precios, impuestos y comisiones', 'value' => 1, 'sort_order' => 10]),
            // new PlanFeature(['name' => 'Códigos de descuento', 'value' => 1, 'sort_order' => 11]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 20, 'sort_order' => 12]),
            // new PlanFeature(['name' => 'Certificado SSL (venta y envío seguro)', 'value' => 1, 'sort_order' => 13]),

            // new PlanFeature(['name' => 'Dashboard Historial de ventas', 'value' => 1, 'sort_order' => 14]),
            // new PlanFeature(['name' => 'Dashboard Perfil comercial', 'value' => 1, 'sort_order' => 15]),
            // new PlanFeature(['name' => 'Dashboard profesional Visitas', 'value' => 1, 'sort_order' => 16]),
            // new PlanFeature(['name' => 'Dashboard profesional Ventas', 'value' => 1, 'sort_order' => 17]),

            // new PlanFeature(['name' => 'Asesoría en moda', 'value' => 1, 'sort_order' => 18]),
            // new PlanFeature(['name' => 'Asesoría en fotografía profesional', 'value' => 1, 'sort_order' => 19]),
            // new PlanFeature(['name' => 'Asesoría en marketing', 'value' => 1, 'sort_order' => 20]),
            // new PlanFeature(['name' => 'Asesoría en comercio electrónico', 'value' => 1, 'sort_order' => 21]),
            // new PlanFeature(['name' => 'Tutoría personalizada', 'value' => 1, 'sort_order' => 22]),

            // new PlanFeature(['name' => 'Ofertas 24 horas', 'value' => 1, 'sort_order' => 23]),
            // new PlanFeature(['name' => 'Subastas', 'value' => 1, 'sort_order' => 24]),
            // new PlanFeature(['name' => 'Anuncios destacados foto (Chic)', 'value' => 1, 'sort_order' => 25]),
            // new PlanFeature(['name' => 'Anuncios destacados banner (fashion)', 'value' => 1, 'sort_order' => 26]),

            // new PlanFeature(['name' => 'Campaña de productos (e mail masivo)', 'value' => 1, 'sort_order' => 27]),
            // new PlanFeature(['name' => 'Campaña de productos (banners externos)', 'value' => 1, 'sort_order' => 28]),
            // new PlanFeature(['name' => 'Video promocional trimestral', 'value' => 1, 'sort_order' => 29]),
        ]);

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => 'Closet',
            'description' => 'Pago mensual',
            'price' => 8.99,
            'signup_fee' => 0.00,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create multiple plan features at once
        $plan->features()->saveMany([
            // new PlanFeature(['name' => 'Suscripción con cédula', 'value' => 1, 'sort_order' => 2]),
            // new PlanFeature(['name' => 'Suscripción con RUC', 'value' => 1, 'sort_order' => 3]),
            // new PlanFeature(['name' => 'Perfil comercial', 'value' => 1, 'sort_order' => 4]),
            new PlanFeature(['name' => 'max_products', 'value' => 15, 'sort_order' => 5]),
            // new PlanFeature(['name' => 'Días de anuncios activos', 'value' => 30, 'sort_order' => 10, 'resettable_period' => 1, 'resettable_interval' => 'day']),
            // new PlanFeature(['name' => 'Publicación en productos outfit', 'value' => 1, 'sort_order' => 7]),
            // new PlanFeature(['name' => 'Botón de pago', 'value' => 1, 'sort_order' => 8]),
            // new PlanFeature(['name' => 'Servicio logístico', 'value' => 1, 'sort_order' => 9]),
            // new PlanFeature(['name' => 'Calculadora de precios, impuestos y comisiones', 'value' => 1, 'sort_order' => 10]),
            // new PlanFeature(['name' => 'Códigos de descuento', 'value' => 1, 'sort_order' => 11]),
            new PlanFeature(['name' => 'commission_percentage', 'value' => 25, 'sort_order' => 12]),
            // new PlanFeature(['name' => 'Certificado SSL (venta y envío seguro)', 'value' => 1, 'sort_order' => 13]),

            // new PlanFeature(['name' => 'Dashboard Historial de ventas', 'value' => 1, 'sort_order' => 14]),
            // new PlanFeature(['name' => 'Dashboard Perfil comercial', 'value' => 1, 'sort_order' => 15]),
            // new PlanFeature(['name' => 'Dashboard profesional Visitas', 'value' => 1, 'sort_order' => 16]),
            // new PlanFeature(['name' => 'Dashboard profesional Ventas', 'value' => 0, 'sort_order' => 17]),

            // new PlanFeature(['name' => 'Asesoría en moda', 'value' => 1, 'sort_order' => 18]),
            // new PlanFeature(['name' => 'Asesoría en fotografía profesional', 'value' => 1, 'sort_order' => 19]),
            // new PlanFeature(['name' => 'Asesoría en marketing', 'value' => 0, 'sort_order' => 20]),
            // new PlanFeature(['name' => 'Asesoría en comercio electrónico', 'value' => 0, 'sort_order' => 21]),
            // new PlanFeature(['name' => 'Tutoría personalizada', 'value' => 0, 'sort_order' => 22]),

            // new PlanFeature(['name' => 'Ofertas 24 horas', 'value' => 1, 'sort_order' => 23]),
            // new PlanFeature(['name' => 'Subastas', 'value' => 0, 'sort_order' => 24]),
            // new PlanFeature(['name' => 'Anuncios destacados foto (Chic)', 'value' => 1, 'sort_order' => 25]),
            // new PlanFeature(['name' => 'Anuncios destacados banner (fashion)', 'value' => 0, 'sort_order' => 26]),

            // new PlanFeature(['name' => 'Campaña de productos (e mail masivo)', 'value' => 1, 'sort_order' => 27]),
            // new PlanFeature(['name' => 'Campaña de productos (banners externos)', 'value' => 0, 'sort_order' => 28]),
            // new PlanFeature(['name' => 'Video promocional trimestral', 'value' => 0, 'sort_order' => 29]),
        ]);
    }
}