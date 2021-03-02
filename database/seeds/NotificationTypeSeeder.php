<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(NotificationType::class)->create([
            'name' => 'Descuentos y rebajas',
            'description' => 'Que nadie se entere de nuestras rebajas antes que tú.',
            'icon' => asset('images/icons/sale-tag-icon.svg'),
        ]);
        factory(NotificationType::class)->create([
            'name' => 'Solo para ti',
            'description' => 'Esperemos que te guste tu regalo de cumpleaños, y más detalles y actualizaciones
            especialmente seleccionados para ti.',
            'icon' => asset('images/icons/star-icon.svg'),
        ]);
        factory(NotificationType::class)->create([
            'name' => 'Novedades',
            'description' => 'Esperemos que te guste tu regalo de cumpleaños, y más detalles y actualizaciones
            especialmente seleccionados para ti.',
            'icon' => asset('images/icons/newspaper-icon.svg'),
        ]);
    }
}
