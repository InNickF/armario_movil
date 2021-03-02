<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = OrderStatus::create([
            'name' =>  "Pendiente",
            'slug' => "pending",
            'description' => "Estado de pedido inicial",
            'send_email' => true,
            'color' => '#f7e3cbff',
        ]);

        // $status = OrderStatus::create([
        //     'name' =>  "Pagado",
        //     'slug' => "paid",
        //     'description' => "Estado de pedido",
        //     'send_email' => true,
        //     'color' => '#f7e3cbff',
        // ]);

        $status = OrderStatus::create([
            'name' =>  "Facturación",
            'slug' => "billing",
            'description' => "Pedido pagado pendiente de facturar",
            'send_email' => true,
            'color' => '#f7e3cbff',
        ]);

        $status = OrderStatus::create([
            'name' =>  "Por enviar",
            'slug' => "shipping",
            'description' => "Pedido pagado y facturado pendiente de enviar",
            'send_email' => true,
            'color' => '#f7e3cbff',
        ]);

        $status = OrderStatus::create([
            'name' =>  "Procesando envío",
            'slug' => "delivery",
            'description' => "Orden de envio generada",
            'send_email' => true,
            'color' => '#f7e3cbff',
        ]);

        $status = OrderStatus::create([
            'name' =>  "Entregado",
            'slug' => "completed",
            'description' => "Entregado al cliente",
            'send_email' => true,
            'color' => '#d8f8ef'
        ]);

        $status = OrderStatus::create([
            'name' =>  "En proceso de devolución",
            'slug' => "refund",
            'description' => "Se ha solicitado devolución",
            'send_email' => true,
            'color' => '#f7e3cbff'
        ]);


        $status = OrderStatus::create([
            'name' =>  "Devuelto",
            'slug' => "refunded",
            'description' => "Devolución finalizada",
            'send_email' => true,
            'color' => '#ffaaaa'
        ]);

        $status = OrderStatus::create([
            'name' =>  "Cancelado",
            'slug' => "cancelled",
            'description' => "Pedido cancelado",
            'send_email' => true,
            'color' => '#ffaaaa'
        ]);
    }
}
