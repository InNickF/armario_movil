<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Review;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(Order::class, 25)->create([
            'created_at' => $faker->dateTimeBetween($startDate = '-6 months', 'now')
        ])->each(function ($order) {
            $faker = Faker\Factory::create();

            for ($i = 0; $i < 5; $i++) {
                $variant = ProductVariant::find($faker->numberBetween(1, ProductVariant::all()->count()));
                $quantity = $faker->numberBetween(1, 50);

                $unit_price_subtotal = $variant->product->final_price;
                $unit_price_final = $variant->product->final_price - $faker->randomFloat(2, 1, 2);
                $sum_price_subtotal = $unit_price_subtotal * $quantity;
                $sum_price_final = $unit_price_final * $quantity;

                $coupon_id = $order->coupon ? $order->coupon_id : null;
                $coupon_discount = $order->coupon ? ($order->coupon->type == 'money' ? ($order->coupon->value / $quantity) : ($sum_price_subtotal * $order->coupon->value) / 100) : 0;

                $vat_price = $sum_price_final - ($sum_price_final / 1.12);
                $commission_price = ((($sum_price_final - $vat_price) * $order->user->plan->features->firstWhere('name', 'commission_percentage')->value) / 100) ?? 1.99;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'unit_price_subtotal' => $unit_price_subtotal,
                    'unit_price_final' => $unit_price_final,
                    'sum_price_subtotal' => $sum_price_subtotal,
                    'sum_price_final' => $sum_price_final,
                    'commission_percentage' => $order->user->plan->commission_percentage ?? 0,
                    'commission_price' => $commission_price ?? 0,
                    'vat_price' => $vat_price,
                    'coupon_id' => $coupon_id,
                    'coupon_discount' => $coupon_discount ?? 0,
                    'earning' => $sum_price_final - $vat_price - $commission_price,
                    'is_valid_store_bill' => $faker->boolean(),
                    'is_paid_earning' => $faker->boolean(),
                    'created_at' => $faker->dateTimeBetween($startDate = '-6 months', 'now'),
                    'status' => $faker->randomElement(['Pendiente', 'En camino', 'Entregado', 'Devuelto']),
                    'shipping_provider' => $faker->randomElement(['Urbano', 'Glovo'])
                ]);

                factory(Review::class, $faker->numberBetween(1, 2))->create([
                    'reviewable_type' => 'App\Models\OrderItem',
                    'reviewable_id' => $orderItem->id,
                ]);
            }
        });
    }
}
