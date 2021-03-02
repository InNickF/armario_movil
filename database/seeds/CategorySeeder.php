<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $category = factory(Category::class)->create([
            'name' => 'Mujer',
            'slug' => 'mujer',
            'order' => 1

        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/woman-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Hombre',
            'slug' => 'hombre',
            'order' => 2
        ]);

        $category->addMedia(public_path('images/icons/wizard/man-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/man-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category = factory(Category::class)->create([
            'name' => 'Niñas',
            'slug' => 'ninas',
            'order' => 3
        ]);

        $category->addMedia(public_path('images/icons/wizard/girl-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/girl-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Niños',
            'slug' => 'ninos',
            'order' => 4
        ]);

        $category->addMedia(public_path('images/icons/wizard/boy-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/boy-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Bebés',
            'slug' => 'bebes',
            'order' => 5
        ]);

        $category->addMedia(public_path('images/icons/wizard/baby-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/baby-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category = factory(Category::class)->create([
            'name' => 'Mascotas',
            'slug' => 'mascotas',
            'order' => 6
        ]);

        $category->addMedia(public_path('images/icons/wizard/pet-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/pet-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category = factory(Category::class)->create([
            'name' => 'Hogar',
            'slug' => 'hogar',
            'order' => 7
        ]);

        $category->addMedia(public_path('images/icons/wizard/house-icon.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/house-icon.jpg'))
            ->withCustomProperties(['isJpg' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        /**
         * Subcategories
         */

//MUJER

        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-mujer',
            'order' => 8,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-shirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Blusas',
            'slug' => 'blusas-mujer',
            'order' => 9,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-blouse.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-mujer',
            'order' => 10,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-jacket.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Pantalones',
            'slug' => 'pantalones-mujer',
            'order' => 11,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-pants.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Vestidos',
            'slug' => 'vestidos-mujer',
            'order' => 12,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-dress.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-mujer',
            'order' => 13,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-shoes.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Ropa Interior',
            'slug' => 'ropa-interior-mujer',
            'order' => 14,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-underwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Accesorios',
            'slug' => 'accesorios-mujer',
            'order' => 15,
            'parent_id' => 1
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-accesories.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Belleza',
            'slug' => 'belleza-mujer',
            'order' => 16,
            'parent_id' => 1
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-beauty.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

//HOMBRE

        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-hombre',
            'order' => 17,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Camisas',
            'slug' => 'camisas-hombre',
            'order' => 18,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-long-sleeve.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-hombre',
            'order' => 19,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-jacket.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Pantalones',
            'slug' => 'pantalones-hombre',
            'order' => 20,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-pants.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Ternos',
            'slug' => 'ternos-hombre',
            'order' => 21,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-suit.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-hombre',
            'order' => 22,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-shoes.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Ropa interior',
            'slug' => 'ropa-interior-hombre',
            'order' => 23,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-underwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Accesorios',
            'slug' => 'accesorios-hombre',
            'order' => 24,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-accesories.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Belleza',
            'slug' => 'belleza-hombre',
            'order' => 25,
            'parent_id' => 2
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-beauty.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-ninas',
            'order' => 26,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Blusas',
            'slug' => 'blusas-ninas',
            'order' => 27,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-blouse.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-ninas',
            'order' => 28,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-jacket.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Pantalones',
            'slug' => 'pantalones-ninas',
            'order' => 29,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-pants.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Vestidos',
            'slug' => 'vestidos-ninas',
            'order' => 30,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-dress.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-ninas',
            'order' => 31,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-shoes.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Ropa interior',
            'slug' => 'ropa-interior-ninas',
            'order' => 32,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/girl-underwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Accesorios',
            'slug' => 'accesorios-ninas',
            'order' => 33,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-accesories.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Belleza',
            'slug' => 'belleza-ninas',
            'order' => 34,
            'parent_id' => 3
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-beauty.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-ninos',
            'order' => 35,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Camisas',
            'slug' => 'camisas-ninos',
            'order' => 36,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-long-sleeve.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-ninos',
            'order' => 37,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-jacket.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Pantalones',
            'slug' => 'pantalones-ninos',
            'order' => 38,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-pants.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Ternos',
            'slug' => 'ternos-ninos',
            'order' => 39,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-suit.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-ninos',
            'order' => 40,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-shoes.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Ropa interior',
            'slug' => 'ropa-interior-ninos',
            'order' => 41,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-underwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Accesorios',
            'slug' => 'accesorios-ninos',
            'order' => 42,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-accesories.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Belleza',
            'slug' => 'belleza-ninos',
            'order' => 43,
            'parent_id' => 4
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-beauty.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/camisetas/',
            'order' => 44,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Pantalones',
            'slug' => 'pantalones-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/pantalones/',
            'order' => 45,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-pants.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Conjuntos',
            'slug' => 'conjuntos-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/conjuntos/',
            'order' => 46,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-outfit.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-bebe',
            'order' => 47,
            'parent_id' => 5
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-shoes.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Chompas',
            'slug' => 'chompas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/chompas/',
            'order' => 48,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-sweater.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Camisas',
            'slug' => 'camisas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/camisas/',
            'order' => 49,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-long-sleeve.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Blusas',
            'slug' => 'blusas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/blusas/',
            'order' => 50,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/women/women-blouse.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Bermudas',
            'slug' => 'bermudas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/pantalones/',
            'order' => 51,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-bermuda.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Bodys',
            'slug' => 'bodys-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/camisetas/',
            'order' => 52,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Buzos',
            'slug' => 'buzos-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/camisetas/',
            'order' => 53,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-long-sleeve.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Enterizos',
            'slug' => 'enterizos-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/camisetas/',
            'order' => 54,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Pijamas',
            'slug' => 'pijamas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/conjuntos/',
            'order' => 55,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-pijama.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Faldas',
            'slug' => 'faldas-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/vestidos/',
            'order' => 56,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-skirt.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Ropa interior',
            'slug' => 'ropa-interior-bebe',
            'order' => 57,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-underwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Shorts',
            'slug' => 'shorts-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/pantalones/',
            'order' => 58,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-short.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Sacos',
            'slug' => 'sacos-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/chompas/',
            'order' => 59,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-coat.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Trajes de baño',
            'slug' => 'trajes-de-bano-bebe',
            'order' => 60,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-swimwear.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Medias',
            'slug' => 'medias-bebe',
            'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
            'order' => 61,
            'parent_id' => 346
        ]);

        $category->addMedia(public_path('images/icons/wizard/woman-icon.svg'))
            ->withCustomProperties(['isPDF' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-sock.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Vestimenta',
            'slug' => 'vestimenta-mascotas',
            'order' => 62,
            'parent_id' => 6
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-clothing.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Calzado',
            'slug' => 'calzado-mascotas',
            'order' => 63,
            'parent_id' => 6
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/baby/baby-sock.svg'))
        ->withCustomProperties(['isMain' => true])
        ->preservingOriginal()
        ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Camas',
            'slug' => 'camas-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/camas/',
            'order' => 64,
            'parent_id' => 344
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-bed.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
            'name' => 'Platos',
            'slug' => 'platos-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/platos/',
            'order' => 65,
            'parent_id' => 344
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-dish.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Juguetes',
            'slug' => 'juguetes-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/juguetes/',
            'order' => 66,
            'parent_id' => 344
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-toy.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Collares',
            'slug' => 'collares-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/collar/',
            'order' => 67,
            'parent_id' => 344
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Arnés',
            'slug' => 'arnes-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/arnes/',
            'order' => 68,
            'parent_id' => 344
        ]);





        $category = factory(Category::class)->create([
            'name' => 'Chaleco',
            'slug' => 'chaleco-mascotas',
            'link' => 'https://tallas.armariomovil.com/mascotas/vestimenta/',
            'order' => 69,
            'parent_id' => 62
        ]);





        $category = factory(Category::class)->create([
            'name' => 'Cremas',
            'slug' => 'cremas-mascotas',
            'order' => 70,
            'parent_id' => 345
        ]);





        $category = factory(Category::class)->create([
            'name' => 'Shampoo',
            'slug' => 'shampoo-mascotas',
            'order' => 71,
            'parent_id' => 345
        ]);



        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-hygiene.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Recogedoras',
            'slug' => 'recogedoras-mascotas',
            'order' => 72,
            'parent_id' => 344
        ]);





        $category = factory(Category::class)->create([
            'name' => 'Cepillos',
            'slug' => 'cepillos-mascotas',
            'order' => 73,
            'parent_id' => 345
        ]);





        $category = factory(Category::class)->create([
            'name' => 'Colchas',
            'slug' => 'colchas',
            'link' => 'https://tallas.armariomovil.com/hogar/camas/',
            'order' => 74,
            'parent_id' => 340
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-bed.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Cobijas',
            'slug' => 'cobijas',
            'link' => 'https://tallas.armariomovil.com/hogar/camas/',
            'order' => 75,
            'parent_id' => 340
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-bed.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Sábanas',
            'slug' => 'sabanas',
            'link' => 'https://tallas.armariomovil.com/hogar/camas/',
            'order' => 76,
            'parent_id' => 340
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-bed.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



            $category = factory(Category::class)->create([
                'name' => 'Mantel cuadrado',
                'slug' => 'mantel-cuadrado',
                'link' => 'https://tallas.armariomovil.com/hogar/mesas/',
                'order' => 77,
                'parent_id' => 341
            ]);

            $category->addMedia(public_path('images/icons/categories/subcategories/home/home-tablecloth.svg'))
                ->withCustomProperties(['isMain' => true])
                ->preservingOriginal()
                ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Mantel rectangular',
            'slug' => 'mantel-rectangular',
            'link' => 'https://tallas.armariomovil.com/hogar/mesas/',
            'order' => 78,
            'parent_id' => 341
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-tablecloth.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');



        $category = factory(Category::class)->create([
            'name' => 'Mantel circular',
            'slug' => 'mantel-circular',
            'link' => 'https://tallas.armariomovil.com/hogar/mesas/',
            'order' => 79,
            'parent_id' => 341
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-tablecloth.svg'))
            ->withCustomProperties(['isMain' => true])
            ->preservingOriginal()
            ->toMediaCollection('categories');


//TERCER NIVEL

        $category = factory(Category::class)->create([
            'name' => 'Buzos',
            'slug' => 'buzos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/camisetas/',
            'order' => 81,
            'parent_id' => 8
        ]);



        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-m-2',
            'link' => 'https://tallas.armariomovil.com/mujer/camisetas/',
            'order' => 82,
            'parent_id' => 8
        ]);



        $category = factory(Category::class)->create([
            'name' => 'Polos',
            'slug' => 'polos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/camisetas/',
            'order' => 83,
            'parent_id' => 8
        ]);



        $category = factory(Category::class)->create([
            'name' => 'Tops',
            'slug' => 'tops-m',
            'link' => 'https://tallas.armariomovil.com/mujer/camisetas/',
            'order' => 84,
            'parent_id' => 8
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Manga larga',
            'slug' => 'manga-larga-m',
            'link' => 'https://tallas.armariomovil.com/mujer/blusas/',
            'order' => 85,
            'parent_id' => 9
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Manga corta',
            'slug' => 'manga-corta-m',
            'link' => 'https://tallas.armariomovil.com/mujer/blusas/',
            'order' => 86,
            'parent_id' => 9
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sin mangas',
            'slug' => 'sin-manga-m',
            'link' => 'https://tallas.armariomovil.com/mujer/blusas/',
            'order' => 87,
            'parent_id' => 9
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sacos',
            'slug' => 'sacos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 88,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Abrigos',
            'slug' => 'abrigos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 89,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 90,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chalecos',
            'slug' => 'chalecos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 91,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Blazers',
            'slug' => 'blazers-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 92,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Monos',
            'slug' => 'monos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 93,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sudaderas',
            'slug' => 'sudaderas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/chaquetas/',
            'order' => 94,
            'parent_id' => 10
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Jeans',
            'slug' => 'jeans-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 95,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 96,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 97,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Leggins',
            'slug' => 'leggins-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 98,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Capris',
            'slug' => 'capris-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 99,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Shorts',
            'slug' => 'shorts-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 100,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Licras',
            'slug' => 'licras-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pantalones/',
            'order' => 101,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calentador',
            'slug' => 'calentador-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pijamas/',
            'order' => 102,
            'parent_id' => 11
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Largos',
            'slug' => 'largos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 103,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medios',
            'slug' => 'medios-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 104,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cortos',
            'slug' => 'cortos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 105,
            'parent_id' => 12
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Faldas',
            'slug' => 'faldas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/faldas/',
            'order' => 106,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Enterizos',
            'slug' => 'enterizos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 107,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'De novias',
            'slug' => 'de-novias-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 108,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes',
            'slug' => 'trajes-m',
            'link' => 'https://tallas.armariomovil.com/mujer/vestidos/',
            'order' => 109,
            'parent_id' => 12
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Tacos',
            'slug' => 'tacos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 110,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 111,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 112,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Deportivos',
            'slug' => 'deportivos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 113,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botas',
            'slug' => 'botas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 114,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botines',
            'slug' => 'botines-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 115,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Balerinas',
            'slug' => 'balerinas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 116,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sandalias',
            'slug' => 'sandalias-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 117,
            'parent_id' => 13
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brasieres',
            'slug' => 'brasieres-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 118,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brasieres maternales',
            'slug' => 'brasieres-maternales-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 119,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Clásicos',
            'slug' => 'clasicos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 120,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Tangas',
            'slug' => 'tangas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 121,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Hilos',
            'slug' => 'hilos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 122,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cachetero',
            'slug' => 'cachetero-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 123,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Boxer',
            'slug' => 'boxer-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 124,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes de baño (Bikini)',
            'slug' => 'trajes-de-bano-bikini-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 125,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes de Baño (Enterizos)',
            'slug' => 'trajes-de-bano-enterizo-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 126,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Fajas',
            'slug' => 'fajas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/ropa-interior/',
            'order' => 127,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medias',
            'slug' => 'medias-m',
            'link' => 'https://tallas.armariomovil.com/mujer/calzado/',
            'order' => 128,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pijamas',
            'slug' => 'pijamas-m',
            'link' => 'https://tallas.armariomovil.com/mujer/pijamas/',
            'order' => 129,
            'parent_id' => 14
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gafas',
            'slug' => 'gafas-m',
            'order' => 130,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sombreros',
            'slug' => 'sombreros-m',
            'link' => 'https://tallas.armariomovil.com/mujer/accesorios/',
            'order' => 131,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gorras',
            'slug' => 'gorras-m',
            'link' => 'https://tallas.armariomovil.com/mujer/accesorios/',
            'order' => 132,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cinturones',
            'slug' => 'cinturones-m',
            'link' => 'https://tallas.armariomovil.com/mujer/accesorios/',
            'order' => 133,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Carteras',
            'slug' => 'carteras-m',
            'order' => 134,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bolsos',
            'slug' => 'bolsos-m',
            'order' => 135,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Billeteras',
            'slug' => 'billeteras-m',
            'order' => 136,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bufandas',
            'slug' => 'bufandas-m',
            'order' => 137,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Relojes',
            'slug' => 'relojes-m',
            'order' => 138,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Mochilas',
            'slug' => 'mochilas-m',
            'order' => 139,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Portafolios',
            'slug' => 'portafolios-m',
            'order' => 140,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Collares',
            'slug' => 'collares-m',
            'order' => 141,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brazaletes',
            'slug' => 'brazaletes-m',
            'order' => 142,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Anillos',
            'slug' => 'anillos-m',
            'link' => 'https://tallas.armariomovil.com/mujer/accesorios/',
            'order' => 143,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Aretes',
            'slug' => 'aretes-m',
            'order' => 144,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Guantes',
            'slug' => 'guantes-m',
            'link' => 'https://tallas.armariomovil.com/mujer/accesorios/',
            'order' => 145,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pañuelos',
            'slug' => 'panuelos-m',
            'order' => 146,
            'parent_id' => 15
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Perfumes',
            'slug' => 'perfumes-m',
            'order' => 148,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Body Splash',
            'slug' => 'body-splash-m',
            'order' => 149,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Crema',
            'slug' => 'crema-m',
            'order' => 150,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Esmaltes',
            'slug' => 'esmaltes-m',
            'order' => 151,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Labiales',
            'slug' => 'labiales-m',
            'order' => 152,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Brillos',
            'slug' => 'brillos-m',
            'order' => 153,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Sombras',
            'slug' => 'sombras-m',
            'order' => 154,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Bases',
            'slug' => 'bases-m',
            'order' => 155,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Polvos',
            'slug' => 'polvos-m',
            'order' => 156,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Correctores',
            'slug' => 'correctos-m',
            'order' => 157,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Delineador',
            'slug' => 'delineador-m',
            'order' => 158,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Máscaras',
            'slug' => 'mascaras-m',
            'order' => 159,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Cejas',
            'slug' => 'cejas-m',
            'order' => 160,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Pestañas',
            'slug' => 'pestañas-m',
            'order' => 161,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Paletas',
            'slug' => 'paletas-m',
            'order' => 162,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Brochas',
            'slug' => 'brochas-m',
            'order' => 163,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Desmaquilladores',
            'slug' => 'desmaquilladores-m',
            'order' => 164,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Hidratantes',
            'slug' => 'hidratantes-m',
            'order' => 165,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Estuches',
            'slug' => 'estuches-m',
            'order' => 166,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Capilar',
            'slug' => 'capilar-m',
            'order' => 167,
            'parent_id' => 16
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Buzos',
            'slug' => 'buzos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/camisetas/',
            'order' => 168,
            'parent_id' => 17
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-h-2',
            'link' => 'https://tallas.armariomovil.com/hombre/camisetas/',
            'order' => 169,
            'parent_id' => 17
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Polos',
            'slug' => 'polos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/camisetas/',
            'order' => 170,
            'parent_id' => 17
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Classic Fit',
            'slug' => 'classic-fit-h',
            'link' => 'https://tallas.armariomovil.com/hombre/camisas/',
            'order' => 171,
            'parent_id' => 18
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Slim Fit',
            'slug' => 'slim-fit-h',
            'link' => 'https://tallas.armariomovil.com/hombre/camisetas/',
            'order' => 172,
            'parent_id' => 18
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sacos',
            'slug' => 'sacos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 173,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Abrigos',
            'slug' => 'abrigos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 174,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chaquetas',
            'slug' => 'chaquetas-h-2',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 175,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chalecos',
            'slug' => 'chalecos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 176,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Blazers',
            'slug' => 'blazers-h',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 177,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sudaderas',
            'slug' => 'sudaderas-h',
            'link' => 'https://tallas.armariomovil.com/hombre/chaquetas/',
            'order' => 179,
            'parent_id' => 19
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Jeans',
            'slug' => 'jeans-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 180,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 181,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 182,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Capris',
            'slug' => 'capris-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 183,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Shorts',
            'slug' => 'shorts-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 184,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Licras',
            'slug' => 'licras-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pantalones/',
            'order' => 185,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calentador',
            'slug' => 'calentador-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calentador/',
            'order' => 186,
            'parent_id' => 20
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Modern Fit',
            'slug' => 'modern-fit-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ternos/',
            'order' => 187,
            'parent_id' => 21
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Slim Fit',
            'slug' => 'slim-fit-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ternos/',
            'order' => 188,
            'parent_id' => 21
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 189,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 190,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Deportivos',
            'slug' => 'deportivos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 191,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botas',
            'slug' => 'botas-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 192,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botines',
            'slug' => 'botines-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 193,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sandalias',
            'slug' => 'sandalias-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 194,
            'parent_id' => 22
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calzoncillo',
            'slug' => 'calzoncillo-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ropa-interior/',
            'order' => 195,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Hilos',
            'slug' => 'hilos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ropa-interior/',
            'order' => 196,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Boxer',
            'slug' => 'boxer-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ropa-interior/',
            'order' => 197,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes de baño',
            'slug' => 'trajes-de-bano-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ropa-interior/',
            'order' => 198,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Fajas',
            'slug' => 'fajas-h',
            'link' => 'https://tallas.armariomovil.com/hombre/ropa-interior/',
            'order' => 199,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medias',
            'slug' => 'medias-h',
            'link' => 'https://tallas.armariomovil.com/hombre/calzado/',
            'order' => 200,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pijamas',
            'slug' => 'pijamas-h',
            'link' => 'https://tallas.armariomovil.com/hombre/pijamas/',
            'order' => 201,
            'parent_id' => 23
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gafas',
            'slug' => 'gafas-h',
            'order' => 202,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sombreros',
            'slug' => 'sombreros-h',
            'link' => 'https://tallas.armariomovil.com/hombre/accesorios/',
            'order' => 203,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gorras',
            'slug' => 'gorras-h',
            'link' => 'https://tallas.armariomovil.com/hombre/accesorios/',
            'order' => 204,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Corbatas',
            'slug' => 'corbatas-h',
            'order' => 205,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cinturones',
            'slug' => 'cinturones-h',
            'link' => 'https://tallas.armariomovil.com/hombre/accesorios/',
            'order' => 206,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Billeteras',
            'slug' => 'billeteras-h',
            'order' => 207,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bufandas',
            'slug' => 'bufandas-h',
            'order' => 208,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Relojes',
            'slug' => 'relojes-h',
            'order' => 209,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Mochilas',
            'slug' => 'mochilas-h',
            'order' => 210,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Portafolios',
            'slug' => 'portafolios-h',
            'order' => 211,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Collares',
            'slug' => 'collares-h',
            'order' => 212,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brazaletes',
            'slug' => 'brazaletes-h',
            'order' => 213,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Anillos',
            'slug' => 'anillos-h',
            'link' => 'https://tallas.armariomovil.com/hombre/accesorios/',
            'order' => 214,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Guantes',
            'slug' => 'guantes-h',
            'link' => 'https://tallas.armariomovil.com/hombre/accesorios/',
            'order' => 215,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pañuelos',
            'slug' => 'panuelos-h',
            'order' => 216,
            'parent_id' => 24
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cremas',
            'slug' => 'cremas-h',
            'order' => 217,
            'parent_id' => 25
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Perfumes',
            'slug' => 'perfumes-h',
            'order' => 218,
            'parent_id' => 25
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Capilar',
            'slug' => 'capilar-h',
            'order' => 219,
            'parent_id' => 25
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Buzos',
            'slug' => 'buzos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/camisetas/',
            'order' => 220,
            'parent_id' => 26
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-ninas-2',
            'link' => 'https://tallas.armariomovil.com/ninas/camisetas/',
            'order' => 221,
            'parent_id' => 26
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Polos',
            'slug' => 'polos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/camisetas/',
            'order' => 222,
            'parent_id' => 26
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Tops',
            'slug' => 'tops-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/camisetas/',
            'order' => 223,
            'parent_id' => 26
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Manga larga',
            'slug' => 'manga-larga-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/blusas/',
            'order' => 224,
            'parent_id' => 27
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Manga corta',
            'slug' => 'manga-corta-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/blusas/',
            'order' => 225,
            'parent_id' => 27
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sin mangas',
            'slug' => 'sin-manga-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/blusas/',
            'order' => 226,
            'parent_id' => 27
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sacos',
            'slug' => 'sacos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 227,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Abrigos',
            'slug' => 'abrigos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 228,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chaquetas y chompas',
            'slug' => 'chaquetas-y-chompas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 229,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chalecos',
            'slug' => 'chalecos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 230,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Blazers',
            'slug' => 'blazers-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 231,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Monos',
            'slug' => 'monos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 232,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sudaderas',
            'slug' => 'sudaderas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/chaquetas/',
            'order' => 233,
            'parent_id' => 28
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Jeans',
            'slug' => 'jeans-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 234,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 235,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 236,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Leggins',
            'slug' => 'leggins-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 237,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Capris',
            'slug' => 'capris-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 238,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Shorts',
            'slug' => 'shorts-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 239,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Licras',
            'slug' => 'licras-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pantalones/',
            'order' => 240,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calentador',
            'slug' => 'calentador-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pijamas/',
            'order' => 241,
            'parent_id' => 29
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Largos',
            'slug' => 'largos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/vestidos/',
            'order' => 242,
            'parent_id' => 30
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medios',
            'slug' => 'medios-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/vestidos/',
            'order' => 243,
            'parent_id' => 30
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cortos',
            'slug' => 'cortos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/vestidos/',
            'order' => 244,
            'parent_id' => 30
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Faldas',
            'slug' => 'faldas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/faldas/',
            'order' => 245,
            'parent_id' => 30
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes de baño (2 piezas)',
            'slug' => 'trajes-de-bano-2-piezas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/ropa-interior/',
            'order' => 246,
            'parent_id' => 32
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes',
            'slug' => 'trajes-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/vestidos/',
            'order' => 247,
            'parent_id' => 30
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Tacos',
            'slug' => 'tacos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 248,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 249,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 250,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Deportivos',
            'slug' => 'deportivos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 251,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botas',
            'slug' => 'botas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 252,
            'parent_id' => 31
        ]);



        $category = factory(Category::class)->create([
            'name' => 'Botines',
            'slug' => 'botines-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 253,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Balerinas',
            'slug' => 'balerinas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 254,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sandalias',
            'slug' => 'sandalias-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 255,
            'parent_id' => 31
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Clásicos',
            'slug' => 'clasicos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/ropa-interior/',
            'order' => 256,
            'parent_id' => 32
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Boxer',
            'slug' => 'boxer-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/ropa-interior/',
            'order' => 257,
            'parent_id' => 32
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Trajes de baño (Enterizos)',
            'slug' => 'trajes-de-bano-enterizos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/ropa-interior/',
            'order' => 258,
            'parent_id' => 32
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medias',
            'slug' => 'medias-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/calzado/',
            'order' => 259,
            'parent_id' => 32
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pijamas',
            'slug' => 'pijamas-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/pijamas/',
            'order' => 260,
            'parent_id' => 32
        ]);



            $category = factory(Category::class)->create([
                'name' => 'Formadores',
                'slug' => 'formadores-ninas',
                'link' => 'https://tallas.armariomovil.com/ninas/ropa-interior/',
                'order' => 261,
                'parent_id' => 32
            ]);




        $category = factory(Category::class)->create([
            'name' => 'Gafas',
            'slug' => 'gafas-ninas',
            'order' => 262,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sombreros, gorras y gorros',
            'slug' => 'sombreros-gorras-y-gorros-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/accesorios/',
            'order' => 263,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Diademas, vinchas y moños',
            'slug' => 'diademas-vinchas-y-monos-ninas',
            'order' => 264,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cinturones',
            'slug' => 'cinturones-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/accesorios/',
            'order' => 265,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Carteras',
            'slug' => 'carteras-ninas',
            'order' => 266,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bolsos',
            'slug' => 'bolsos-ninas',
            'order' => 267,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Billeteras',
            'slug' => 'billeteras-ninas',
            'order' => 268,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bufandas',
            'slug' => 'bufandas-ninas',
            'order' => 269,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Relojes',
            'slug' => 'relojes-ninas',
            'order' => 270,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Mochilas',
            'slug' => 'mochilas-ninas',
            'order' => 271,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Collares',
            'slug' => 'collares-ninas',
            'order' => 272,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brazaletes',
            'slug' => 'brazaletes-ninas',
            'order' => 273,
            'parent_id' => 33
        ]);



        $category = factory(Category::class)->create([
            'name' => 'Anillos',
            'slug' => 'anillos-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/accesorios/',
            'order' => 274,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Aretes',
            'slug' => 'aretes-ninas',
            'order' => 275,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Guantes',
            'slug' => 'guantes-ninas',
            'link' => 'https://tallas.armariomovil.com/ninas/accesorios/',
            'order' => 276,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pañuelos',
            'slug' => 'panuelos-ninas',
            'order' => 277,
            'parent_id' => 33
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Perfumes',
            'slug' => 'perfumes-ninas',
            'order' => 278,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Body Splash',
            'slug' => 'body-splash-ninas',
            'order' => 279,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Crema',
            'slug' => 'crema-ninas',
            'order' => 280,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Esmaltes',
            'slug' => 'esmaltes-ninas',
            'order' => 281,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Labiales',
            'slug' => 'labiales-ninas',
            'order' => 282,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Brillos',
            'slug' => 'brillos-ninas',
            'order' => 283,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Sombras',
            'slug' => 'sombras-ninas',
            'order' => 284,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Bases',
            'slug' => 'bases-ninas',
            'order' => 285,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Polvos',
            'slug' => 'polvos-ninas',
            'order' => 286,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Brochas',
            'slug' => 'brochas-ninas',
            'order' => 287,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Desmaquilladores',
            'slug' => 'desmaquilladores-ninas',
            'order' => 288,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Estuches',
            'slug' => 'estuches-ninas',
            'order' => 289,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Capilar',
            'slug' => 'capilar-ninas',
            'order' => 290,
            'parent_id' => 34
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Buzos',
            'slug' => 'buzos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/camisetas/',
            'order' => 291,
            'parent_id' => 35
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Camisetas',
            'slug' => 'camisetas-ninos-2',
            'link' => 'https://tallas.armariomovil.com/ninos/camisetas/',
            'order' => 292,
            'parent_id' => 35
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Polos',
            'slug' => 'polos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/camisetas/',
            'order' => 293,
            'parent_id' => 35
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Classic Fit',
            'slug' => 'classic-fit-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/camisas/',
            'order' => 294,
            'parent_id' => 36
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Slim Fit',
            'slug' => 'slim-fit-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/camisas/',
            'order' => 295,
            'parent_id' => 36
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sacos',
            'slug' => 'sacos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 296,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Abrigos',
            'slug' => 'abrigos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 297,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chaquetas y chompas',
            'slug' => 'chaquetas-y-chompas-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 298,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Chalecos',
            'slug' => 'chalecos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 299,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Blazers',
            'slug' => 'blazers-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 300,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Enterizos',
            'slug' => 'enterizos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 301,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sudaderas',
            'slug' => 'sudaderas-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/chaquetas/',
            'order' => 302,
            'parent_id' => 37
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Jeans',
            'slug' => 'jeans-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 303,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 304,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 305,
            'parent_id' => 38
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Capris',
            'slug' => 'capris-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 306,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Shorts',
            'slug' => 'shorts-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 307,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Licras',
            'slug' => 'licras-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 308,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calentador',
            'slug' => 'calentador-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pantalones/',
            'order' => 309,
            'parent_id' => 38
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Modern Fit',
            'slug' => 'modern-fit-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/ternos/',
            'order' => 310,
            'parent_id' => 39
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Slim Fit',
            'slug' => 'slim-fit-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/ternos/',
            'order' => 311,
            'parent_id' => 39
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Casuales',
            'slug' => 'casuales-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 312,
            'parent_id' => 40
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Formales',
            'slug' => 'formales-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 313,
            'parent_id' => 40
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Deportivos',
            'slug' => 'deportivos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 314,
            'parent_id' => 40
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botas',
            'slug' => 'botas-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 315,
            'parent_id' => 40
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Botines',
            'slug' => 'botines-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 316,
            'parent_id' => 40
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sandalias',
            'slug' => 'sandalias-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 317,
            'parent_id' => 40
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Calzoncillo',
            'slug' => 'calzoncillo-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/ropa-interior/',
            'order' => 318,
            'parent_id' => 41
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Boxer',
            'slug' => 'boxer-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/ropa-interior/',
            'order' => 319,
            'parent_id' => 41
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Traje de baño',
            'slug' => 'traje-de-bano-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/ropa-interior/',
            'order' => 320,
            'parent_id' => 41
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Medias',
            'slug' => 'medias-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/calzado/',
            'order' => 321,
            'parent_id' => 41
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pijamas',
            'slug' => 'pijamas-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/pijamas/',
            'order' => 322,
            'parent_id' => 41
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gafas',
            'slug' => 'gafas-ninos',
            'order' => 323,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Sombreros',
            'slug' => 'sombreros-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/accesorios/',
            'order' => 324,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Gorras',
            'slug' => 'gorras-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/accesorios/',
            'order' => 325,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Corbatas',
            'slug' => 'corbatas-ninos',
            'order' => 326,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cinturones',
            'slug' => 'cinturones-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/accesorios/',
            'order' => 327,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Billeteras',
            'slug' => 'billeteras-ninos',
            'order' => 328,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Bufandas',
            'slug' => 'bufandas-ninos',
            'order' => 329,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Relojes',
            'slug' => 'relojes-ninos',
            'order' => 330,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Mochilas',
            'slug' => 'mochilas-ninos',
            'order' => 331,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Portafolios',
            'slug' => 'portafolios-ninos',
            'order' => 332,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Collares',
            'slug' => 'collares-ninos',
            'order' => 333,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Brazaletes',
            'slug' => 'brazaletes-ninos',
            'order' => 334,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Anillos',
            'slug' => 'anillos-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/accesorios/',
            'order' => 335,
            'parent_id' => 42
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Guantes',
            'slug' => 'guantes-ninos',
            'link' => 'https://tallas.armariomovil.com/ninos/accesorios/',
            'order' => 336,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Pañuelos',
            'slug' => 'panuelos-ninos',
            'order' => 337,
            'parent_id' => 42
        ]);




        $category = factory(Category::class)->create([
            'name' => 'Cremas',
            'slug' => 'cremas-ninos',
            'order' => 338,
            'parent_id' => 43
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Perfumes',
            'slug' => 'perfumes-ninos',
            'order' => 339,
            'parent_id' => 43
        ]);

        $category = factory(Category::class)->create([
            'name' => 'Capilar',
            'slug' => 'capilar-ninos',
            'order' => 340,
            'parent_id' => 43
        ]);


        $category = factory(Category::class)->create([
            'name' => 'Accesorios',
            'slug' => 'accesorios-bebe',
            'order' => 341,
            'parent_id' => 5
        ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/men/men-accesories.svg'))
        ->withCustomProperties(['isMain' => true])
        ->preservingOriginal()
        ->toMediaCollection('categories');




        $category = factory(Category::class)->create([
            'name' => 'Vestidos',
            'slug' => 'vestidos-bebe',
            'order' => 342,
            'parent_id' => 347
        ]);



//NUEVAS CATEGORÍAS DE HOGAR, BEBÉS Y MASCOTAS

        $category = factory(Category::class)->create([
                'name' => 'Camas',
                'slug' => 'camas',
                'order' => 343,
                'parent_id' => 7
            ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-bed.svg'))
                ->withCustomProperties(['isMain' => true])
                ->preservingOriginal()
                ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
                    'name' => 'Mesas',
                    'slug' => 'mesas',
                    'order' => 344,
                    'parent_id' => 7
                ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/home/home-tablecloth.svg'))
                    ->withCustomProperties(['isMain' => true])
                    ->preservingOriginal()
                    ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
                    'name' => 'Camisetas',
                    'slug' => 'camisetas-mascotas',
                    'order' => 345,
                    'parent_id' => 62
                ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.png'))
                    ->withCustomProperties(['isMain' => true])
                    ->preservingOriginal()
                    ->toMediaCollection('categories');



         $category = factory(Category::class)->create([
                    'name' => 'Zapatos',
                    'slug' => 'zapatos-mascotas',
                    'order' => 346,
                    'parent_id' => 63
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Accesorios',
                    'slug' => 'accesorios-mascotas',
                    'order' => 347,
                    'parent_id' => 6
                    ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-dish.svg'))
                    ->withCustomProperties(['isMain' => true])
                    ->preservingOriginal()
                    ->toMediaCollection('categories');

        $category = factory(Category::class)->create([
                    'name' => 'Belleza',
                    'slug' => 'belleza-mascotas',
                    'order' => 348,
                    'parent_id' => 6
                    ]);


        $category->addMedia(public_path('images/icons/categories/subcategories/pet/pet-hygiene.svg'))
                    ->withCustomProperties(['isMain' => true])
                    ->preservingOriginal()
                    ->toMediaCollection('categories');


        $category = factory(Category::class)->create([
                    'name' => 'Vestimenta',
                    'slug' => 'vestimenta-bebe',
                    'order' => 349,
                    'parent_id' => 5
                    ]);

        $category->addMedia(public_path('images/icons/categories/subcategories/unisex-shirt.svg'))
                    ->withCustomProperties(['isMain' => true])
                    ->preservingOriginal()
                    ->toMediaCollection('categories');

        $category = factory(Category::class)->create([
                    'name' => 'Casuales',
                    'slug' => 'casuales-b',
                    'order' => 350,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Formales',
                    'slug' => 'formales-b',
                    'order' => 351,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Balerinas',
                    'slug' => 'balerinas-b',
                    'order' => 352,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Sandalias',
                    'slug' => 'sandalias-b',
                    'order' => 353,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Deportivos',
                    'slug' => 'deportivos-b',
                    'order' => 354,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Botas',
                    'slug' => 'botas-b',
                    'order' => 355,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Botines',
                    'slug' => 'botines-b',
                    'order' => 356,
                    'link' => 'https://tallas.armariomovil.com/bebes/calzado/',
                    'parent_id' => 47
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Sombreros, Gorras y Gorros ',
                    'slug' => 'sombreros-gorras-y-gorros-b',
                    'order' => 357,
                    'parent_id' => 338
                    ]);

        $category = factory(Category::class)->create([
                    'name' => 'Diademas, vinchas y moños',
                    'slug' => 'diademas-vinchas-y-monos-b',
                    'order' => 358,
                    'parent_id' => 338
                    ]);

    }
}
