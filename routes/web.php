<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */






/**
 * E-Commerce Front Routes
 */
Auth::routes();
// Social
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');
/** SEO routes */
Route::get('categorias/{categorySlug}', 'CategoryController@show');
Route::get('productos/{storeSlug?}/{categorySlug?}/{subcategorySlug?}/{productSlug}', 'ProductController@show')->name('products.show');
Route::get('outfits/{storeSlug?}/{outfitSlug}', 'OutfitController@show')->name('outfits.show');
Route::get('tiendas/{storeSlug}', 'UserStoreController@show');

Route::get('buscar', 'SearchController@index')->name('buscar');

Route::get('preguntas-frecuentes', 'FaqsController@index')->name('faqs');
Route::get('preguntas-frecuentes/categorias/{categorySlug}', 'FaqsController@category')->name('faq_categories.show');
Route::get('preguntas-frecuentes/{faqSlug}', 'FaqsController@show')->name('faqs.show');

Route::get('contacto', 'StaticPageController@contactForm')->name('contacto');
Route::get('contacto-exito', 'StaticPageController@contactSuccess')->name('contacto-exito');
Route::get('promociones', 'StaticPageController@promociones')->name('promociones');
Route::get('gracias', 'StaticPageController@gracias');

// Blog
Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog/categorias/{categorySlug}', 'BlogController@category');
Route::get('blog/{postSlug}', 'BlogController@show');

Route::get('checkout', 'OrderController@checkout');

/** CONTACT FORM && EMAIL SUBSCRIPTION FOOTER */
Route::post('form_request', 'FormRequestController@store');
Route::post('form_requests_email', 'FormRequestController@storeEmail');





Route::group(['middleware' => ['auth']], function () {

	/**
	 * E-Commerce Routes that need login
	 */

	// Follow store
	Route::get('stores/{storeId}/follow', 'UserStoreController@toggleFollow')->name('stores.follow');


	Route::group(['middleware' => ['has_complete_profile']], function () {

		Route::get('pay/{orderId}', 'OrderController@cards');
		Route::get('bill/{orderId}', 'OrderController@bill');
		// Route::post('pay/{orderId}', 'OrderController@pay');  // ! Moved to API
		Route::post('bill/{orderId}', 'OrderController@generateBill'); // Bills
		Route::get('ship/{orderId}', 'OrderController@ship'); // Ships

		Route::get('pay/callback/', 'OrderController@callback');
	});



	/**
	 * Account Section
	 */
	Route::prefix('account')->group(function () {

		// Account sections that doesnt require a complete Store profile
		Route::get('profile', 'Account\UserController@profile');
		Route::post('profile', 'Account\UserController@update')->name('users.updateProfile'); // FIXME: Update where its called
		Route::post('store', 'Account\UserStoreController@update')->name('store.update');
		Route::delete('store/{storeId}', 'Account\UserStoreController@destroy', ['as' => 'account'])->name('account.stores.destroy');
		Route::get('store/activate', 'Account\UserStoreController@activate')->name('store.activate');

		Route::post('collecting_method', 'Account\UserController@updateCollectingMethod')->name('collectingMethod.update');

		Route::get('password', 'Account\UserController@passwordEdit');
		Route::post('password', 'Account\UserController@passwordUpdate');

		Route::get('notifications', 'Account\NotificationSettingController@index')->name('account.notificationSettings');
		Route::post('notifications', 'Account\NotificationSettingController@update')->name('account.updateNotificationSettings');

		Route::get('followed_categories', 'Account\FollowedCategoriesController@index')->name('account.followedCategories');
		Route::post('followed_categories', 'Account\FollowedCategoriesController@update')->name('account.updateFollowedCategories');


		Route::resource('answers', 'Account\AnswerController', ['as' => 'account']);

		// NEEDS FULL USER PROFILE
		Route::group(['middleware' => ['has_complete_profile']], function () {
			Route::get('tracking/{orderItemId}', 'Account\OrderItemController@show');

			Route::resource('questions', 'Account\QuestionController', ['as' => 'account']);
			// Route::resource('reviews', 'Account\ReviewController', ['as' => 'account']);
			Route::resource('orders', 'Account\OrderController', ['as' => 'account']);
			Route::post('orders/refund/{orderId}', 'Account\OrderController@refund', ['as' => 'account']);
			Route::post('orders/{orderId}/add_bill', 'Account\OrderController@addBill', ['as' => 'account']);
			Route::get('transactions', 'Account\UserController@transactions', ['as' => 'account']);

			Route::get('wishlist', 'Account\WishlistController@index', ['as' => 'account']);

			Route::resource('addresses', 'Account\AddressController');

			Route::get('payment', 'Account\UserController@payment', ['as' => 'account'])->name('account.payment');

			Route::resource('billing', 'Account\BillingController');
		});



		// NEEDS STORE FULL PROFILE
		Route::group(['middleware' => ['has_store']], function () {

			Route::get('store/orders', 'Account\UserStoreController@orders', ['as' => 'account']);
			Route::get('sells', 'Account\OrderController@sells', ['as' => 'account']);

			// Store Image Gallery
			Route::get('store/gallery', 'Account\UserStoreController@gallery', ['as' => 'account']);
			Route::post('store/gallery', 'Account\UserStoreController@updateGallery', ['as' => 'account'])->name('account.store.updateGallery');


			// * Cobrar ahora desde Dashboards
			Route::get('stores/request_payment', 'Account\UserStoreController@request_payment', ['as' => 'account']);

			Route::prefix('dashboards')->group(function () {
				/**
				 * Dashboards
				 */
				Route::get('sell_records', 'Account\DashboardController@sell_records');
				Route::get('business_profile', 'Account\DashboardController@business_profile');
				Route::get('interactions', 'Account\DashboardController@interactions');
				Route::get('products', 'Account\DashboardController@products');
				Route::get('cities', 'Account\DashboardController@cities');
				Route::get('devices', 'Account\DashboardController@devices');
				Route::get('funnel', 'Account\DashboardController@funnel');
			});

			// Exports from Account section
			Route::get('export/excel/sold_products_dashboard', 'Account\ExportExcelController@sold_products_dashboard');
			Route::get('export/pdf/sold_products_dashboard', 'Account\ExportPdfController@sold_products_dashboard');

			Route::get('export/excel/products_dashboard', 'Account\ExportExcelController@products_dashboard');
			Route::get('export/pdf/products_dashboard', 'Account\ExportPdfController@products_dashboard');

			Route::get('export/excel/business_profile_dashboard', 'Account\ExportExcelController@business_profile_dashboard');
			Route::get('export/pdf/business_profile_dashboard', 'Account\ExportPdfController@business_profile_dashboard');

			Route::get('export/excel/cities_dashboard', 'Account\ExportExcelController@cities_dashboard');
			Route::get('export/pdf/cities_dashboard', 'Account\ExportPdfController@cities_dashboard');

			Route::get('export/excel/interactions_dashboard', 'Account\ExportExcelController@interactions_dashboard');
			Route::get('export/pdf/interactions_dashboard', 'Account\ExportPdfController@interactions_dashboard');

			Route::get('export/excel/funnel_dashboard', 'Account\ExportExcelController@funnel_dashboard');
			Route::get('export/pdf/funnel_dashboard', 'Account\ExportPdfController@funnel_dashboard');
			// End exports

			Route::get('passport', 'Account\UserController@passport');
			Route::get('passport', 'Account\UserController@passport');

			Route::resource('products', 'Account\ProductController', ['as' => 'account']);
			Route::get('products/{productId}/pay/{planId}', 'Account\ProductController@planCheckout', ['as' => 'account']);
			// Route::post('products/pay/', 'Account\ProductController@payPlan', ['as' => 'account']); // ! Moved to API
			Route::get('products/{productId}/bill', 'Account\ProductController@billPlan', ['as' => 'account']);
			Route::post('products/bill/', 'Account\ProductController@generatePlanBill', ['as' => 'account']);
			Route::get('products/{productId}/plan/success', 'Account\ProductController@planSuccess', ['as' => 'account']);

			Route::resource('outfits', 'Account\OutfitController', ['as' => 'account']);
			Route::resource('stories', 'Account\StoryController', ['as' => 'account']);

			Route::resource('storeReviews', 'Account\StoreReviewController', ['as' => 'account']);
			Route::post('reviewAnswers', 'Account\ReviewAnswerController@store', ['as' => 'account']);
			Route::resource('plans', 'Account\PlanController', ['as' => 'account']);

			Route::get('plans/{planSlug}/pay', 'Account\PlanController@checkout');
			Route::post('subscription/pay', 'Account\PlanController@pay');
			Route::get('subscription/bill', 'Account\PlanController@bill');
			Route::post('subscription/bill', 'Account\PlanController@generateBill');
			Route::post('plans/cancel', 'Account\PlanController@cancel');

			Route::get('articles/category/{categoryId}', 'Account\ArticleController@index', ['as' => 'account']);
			Route::get('articles/{articleId}', 'Account\ArticleController@show', ['as' => 'account']);
		});
	});



	/**
	 * ADMIN SECTION
	 */
	Route::prefix('admin')->middleware('role:super-user')->group(function () {
		/** APP GENERAL SETTINGS */
		Route::get('settings', 'Admin\SettingsController@index');
		Route::post('settings', 'Admin\SettingsController@update')->name('admin.settings.update');

		/** ORDERS */
		Route::resource('', 'Admin\OrderController', ['as' => 'admin']);
		Route::resource('orders', 'Admin\OrderController', ['as' => 'admin']);
    Route::post('orders/refund/{orderId}', 'Admin\OrderController@refund', ['as' => 'admin']);
    Route::post('orders/{orderId}/status', 'Account\OrderController@status', ['as' => 'account']);


		/** USERS & STORES */
		Route::resource('users', 'Admin\UserController');
		Route::resource('stores', 'Admin\UserStoreController', ['as' => 'admin']);
		Route::resource('stories', 'Admin\StoryController', ['as' => 'admin']);

		/** TRANSACTIONS */
		Route::resource('transactions', 'Admin\TransactionController', ['as' => 'admin']);
		Route::post('transactions/refund/{transactionId}', 'Admin\TransactionController@refund', ['as' => 'admin']);

		/** PRODUCTS */
		Route::resource('products', 'Admin\ProductController', ['as' => 'admin']);
		// Route::resource('outfits', 'Admin\OutfitController', ['as' => 'admin']);
		Route::resource('categories', 'Admin\CategoryController', ['as' => 'admin']);
		Route::post('categories/reorder', 'Admin\CategoryController@reorder')->name('categories.reorder');

		Route::resource('coupons', 'Admin\CouponController', ['as' => 'admin']);

		Route::resource('questions', 'Admin\QuestionController', ['as' => 'admin']);

		Route::resource('faqs', 'Admin\FaqController', ['as' => 'admin']);
		Route::resource('faqCategories', 'Admin\FaqCategoryController', ['as' => 'admin']);
		Route::post('faqCategories/reorder', 'Admin\FaqCategoryController@reorder')
			->name('admin.faqCategories.reorder');

		Route::resource('articles', 'Admin\ArticleController', ['as' => 'admin']);
		Route::resource('articleCategories', 'Admin\ArticleCategoryController', ['as' => 'admin']);
		Route::post('articleCategories/reorder', 'Admin\ArticleCategoryController@reorder')
			->name('admin.articleCategories.reorder');

		Route::resource('posts', 'Admin\PostController', ['as' => 'admin']);
		Route::resource('postCategories', 'Admin\PostCategoryController', ['as' => 'admin']);
		Route::post('postCategories/reorder', 'Admin\PostCategoryController@reorder')
			->name('admin.postCategories.reorder');

		Route::resource('testimonials', 'Admin\TestimonialController', ['as' => 'admin']);
		Route::resource('sliders', 'Admin\SliderController', ['as' => 'admin']);
		Route::resource('slides', 'Admin\SlideController', ['as' => 'admin']);

		Route::resource('push_notifications', 'Admin\PushNotificationController', ['as' => 'admin']);


		/** LOGS */
		Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

		/** EMAIL PREVIEWS */
		Route::get('mail', 'Admin\MailPreviewController@mail');

		/** Form Requests DB */
		Route::get('form_requests', 'Admin\FormRequestController@index');


		// Guias electronicas generacion MANUAL
		Route::get('shipping_orders/{shippingOrderId}', 'Admin\ShippingOrderController@show');
		Route::get('export/pdf/shipping_orders/{shippingOrderId}', 'Account\ExportPdfController@shipping_order');
	});
});
