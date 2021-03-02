<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use App\Observers\ProductObserver;
use App\Observers\ReviewObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Observers\TransactionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        Transaction::observe(TransactionObserver::class);
        Product::observe(ProductObserver::class);
        Review::observe(ReviewObserver::class);

        Carbon::setLocale('es');


        if (!Collection::hasMacro('paginate')) {

            Collection::macro(
                'paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage),
                        $this->count(),
                        $perPage,
                        $page,
                        $options
                    ))
                        ->withPath('');
                }
            );
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      // IDE HELPER
      if ($this->app->environment() !== 'production') {
          $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
      }
    }
}
