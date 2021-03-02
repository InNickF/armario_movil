<?php

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $category = factory(FaqCategory::class)->create([
            'name' => 'Productos',
            'slug' => 'productos',
            'order' => 1
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/product-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');


         $category = factory(FaqCategory::class)->create([
            'name' => 'Ventas',
            'slug' => 'ventas',
            'order' => 2
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/sales-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');
        
                            
        $category = factory(FaqCategory::class)->create([
            'name' => 'Envíos',
            'slug' => 'envios',
            'order' => 3
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/delivery-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');    


       $category = factory(FaqCategory::class)->create([
            'name' => 'Métodos de cobro',
            'slug' => 'metodos-de-cobro',
            'order' => 4
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/card-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');         
                            
                            

        $category = factory(FaqCategory::class)->create([
            'name' => 'Políticas de devoluciones',
            'slug' => 'politicas-de-devoluciones',
            'order' => 5
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/cart-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');


        $category = factory(FaqCategory::class)->create([
            'name' => 'Soporte técnico',
            'slug' => 'soporte-tecnico',
            'order' => 6
        ]);

        $category->addMedia(public_path('images/icons/faqs/categories/technical-support-05.svg'))
                            ->withCustomProperties(['isIcon' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('faqs');


    }
}
