<?php

namespace App\Console\Commands;

use App\Mail\AdminShippingTaskSummary;
use App\Models\Order;
use App\Models\OrderStatus;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ShipOrderItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order_items:ship {orderId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ship pending OrderItems';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orderId = $this->argument('orderId');

        $adminEmailData = [
            'errors' => [
                'local' => [],
                'national' => [],
            ],
            'success' => [
                'local' => [],
                'national' => [],
            ],
            'pending_orders' => 0,
        ];

        if ($orderId) {
            $orders = Order::where('id', $orderId)->get();
        } else {
            $orders = Order::pendingDelivery()->get();
        }

        $this->line('Pedidos obtenidos: '.$orders->count());
        $adminEmailData['pending_orders'] = $orders->count();

        foreach ($orders as $key => $order) {
            $this->line('--- Inicio Pedido: '.$order->id);
            // Shipping local products with local provider

            if ($order->getLocalItems()) {
                $this->line('Items locales: '.$order->getLocalItems()->count());
                $local = $order->generateLocalShippingOrder();
                if (isset($local['error'])) {
                    $this->error('Error al procesar envío local: '.$local['error']);
                    $adminEmailData['errors']['local'][] = 'Pedido #'.$order->id.'(Productos envío local): '.$local['error'];

                    continue;
                }

                if ($local && !empty($local)) {
                    $adminEmailData['success']['local'][] = $local;
                    $this->info('Envios locales procesados');
                    $this->info(json_encode($local));

                    $order->status_id = OrderStatus::whereSlug('delivery')->first()->id;
                    $order->save();
                } else {
                    $this->info('No hay productos pendientes o tiendas abiertas en este pedido');
                    // $adminEmailData['errors']['local'][] = $local;
                }
            }

            if ($order->getNationalItems()) {
                // Shipping URBANO if national products
                $this->line('Items nacionales: '.$order->getNationalItems()->count());
                $national = $order->generateNationalShippingOrder();
                if (isset($national['error'])) {
                    $this->error('Error al procesar envío nacional: '.$national['error']);
                    $adminEmailData['errors']['national'][] = 'Pedido #'.$order->id.'(Productos envío nacional): '.$national['error'];

                    continue;
                }

                if (!empty($national)) {
                    $adminEmailData['success']['national'][] = $national;
                    $this->info('Envios nacionales procesados');
                    $this->info(json_encode($national));

                    $order->status_id = OrderStatus::whereSlug('delivery')->first()->id;
                    $order->save();
                } else {
                    $this->info('No hay productos pendientes o tiendas abiertas en este pedido');
                    // $adminEmailData['errors']['national'][] = $national;
                }
            }
            $this->line('--- Fin Pedido: '.$order->id);
        }
        $this->info('Envios finalizados');

        $mail = Mail::to(User::whereIs('super-user')->get())->cc(setting('admin_email', 'info@armariomovil.com'));

        $mail->send(new AdminShippingTaskSummary($adminEmailData));
        // TODO: Send data too onSuccess callback too for logging
    }
}