<?php

namespace App\Providers;

use App\Http\Interface\AdminInterface;
use App\Http\Interface\CurrencyInterface;
use App\Http\Interface\ExpenditureInterface;
use App\Http\Interface\ExportRestProductInterface;
use App\Http\Interface\IncomeInterface;
use App\Http\Interface\ProductInterface;
use App\Http\Interface\ProfitInterface;
use App\Http\Interface\UserInterface;
use App\Http\Repositories\AdminRepository;
use App\Http\Repositories\CurrencyRepository;
use App\Http\Repositories\ExpenditureRepository;
use App\Http\Repositories\ExportRestProductRepository;
use App\Http\Repositories\IncomeRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ProfitRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
     $this->app->singleton(AdminInterface::class,AdminRepository::class);
     $this->app->singleton(UserInterface::class,UserRepository::class);
     $this->app->singleton(ProductInterface::class,ProductRepository::class);
     $this->app->singleton(CurrencyInterface::class,CurrencyRepository::class);
     $this->app->singleton(ExpenditureInterface::class,ExpenditureRepository::class);
     $this->app->singleton(ExportRestProductInterface::class,ExportRestProductRepository::class);
     $this->app->singleton(IncomeInterface::class,IncomeRepository::class);
     $this->app->singleton(ProfitInterface::class,ProfitRepository::class);
    //  $this->app->singleton(ProductInterface::class,ProductRepository::class);
    //  $this->app->singleton(ProductInterface::class,ProductRepository::class);
    //  $this->app->singleton(ProductInterface::class,ProductRepository::class);
    //  $this->app->singleton(ProductInterface::class,ProductRepository::class);
    }
}
