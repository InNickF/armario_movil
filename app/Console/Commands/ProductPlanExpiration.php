<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminProductPlanSummary;
use App\Notifications\ProductPlanExpired;

class ProductPlanExpiration extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'products:expire';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Check expiration for product plan subscriptions';

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
    $this->info('Notificando expiración de planes de productos...');

    $products = Product::all();

    $payments = [
      'success' => [],
      'failed' => [],
      'omitted' => [],
    ];

    foreach ($products as $key => $product) {
      $subscription = app('rinvex.subscriptions.plan_subscription')
      ->where('user_type', 'App\Models\Product')
      ->where('user_id', $product->id)
      ->where('name->es', 'main')
      ->whereNull('canceled_at')
      ->whereDate('ends_at', Carbon::now()->format('Y-m-d'))
      ->latest()
      ->first();

      $this->line('Producto: ' . $product->name);

      if (!$subscription) {
        $this->info('No tiene suscripción que caduque hoy, omitiendo...');
        continue;
      }

      $plan = app('rinvex.subscriptions.plan')->with('features')->find($subscription->plan_id);

      if ($plan->isFree()) {
        $this->info('Plan ' . $plan->name . ' es gratuito, renovando automáticamente...');
        $subscription->renew();
        continue;
      }


      try {
        $this->info('Usuario: ' . $product->store->user->full_name);
        // $this->info('User FCM token: ' . $product->store->user->fcm_token);
        // Notify to Store Owner
        $message = 'El plan de producto caduca hoy, se ha enviado la notificacion';
        $product->store->user->notify(new ProductPlanExpired($product));
        $payments['success'][] = [
          'product' => $product->id,
          'subscription' => $subscription->id,
          'message' => $message,
        ];
        $this->info($message);
      } catch (\Throwable $th) {
        $message = 'El plan de producto caduca hoy, pero no se ha enviado la notificacion';
        $payments['failed'][] = [
          'product' => $product->id,
          'subscription' => $subscription->id,
          'message' => $message,
          'error' => $th
        ];
        $this->error($message);
        $this->error($th);
      }
    }

    $this->info('Planes de producto expirados notificados');

    Mail::to(User::whereIs('super-user')->get())->send(new AdminProductPlanSummary($payments));
  }
}
