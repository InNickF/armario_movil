<?php

// Home
Breadcrumbs::for ('home', function ($trail) {
	$trail->push('Inicio', route('home'));
});

// // Home > About
// Breadcrumbs::for('about', function ($trail) {
//     $trail->parent('home');
//     $trail->push('About', route('about'));
// });

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });

Breadcrumbs::for ('category', function ($trail, $category) {
	// $trail->parent('home');
	$trail->push($category->name, $category->url);
});


Breadcrumbs::for ('store', function ($trail, $store) {
	$trail->parent('home');
	$trail->push($store->name, $store->url);
});

// Home  > [Category] > [Product]
Breadcrumbs::for ('product', function ($trail, $product) {
	// $trail->parent('home');
	$trail->parent('store', $product->store);
	$trail->parent('category', $product->category);

	$trail->push($product->name, $product->url);
});


// Home  > [Store] > [Outfit]
Breadcrumbs::for ('outfit', function ($trail, $outfit) {
	// $trail->parent('home');
	$trail->parent('store', $outfit->store);

	$storeSlug = $outfit->store ? $outfit->store->slug : 'tienda';
	$outfitSlug = $outfit->slug;

	$trail->push($outfit->name, route('outfits.show', [$storeSlug, $outfitSlug]));
});

Breadcrumbs::for ('preguntas-frecuentes', function ($trail) {
	// dd($category);
	$trail->parent('home');
	$trail->push('Preguntas frecuentes', url('preguntas-frecuentes'));
});


Breadcrumbs::for ('preguntas-frecuentes/categorias', function ($trail, $category) {
	// dd($category);
	$trail->parent('preguntas-frecuentes');
	$trail->push($category->name, $category->url);
});

Breadcrumbs::for ('pregunta-frecuente', function ($trail, $faq) {
	$trail->parent('preguntas-frecuentes/categorias', $faq->categories[0]);
	$trail->push($faq->title, $faq->url);
});