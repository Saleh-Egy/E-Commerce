<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Exception;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ExceptionsObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\SellerObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);
        Seller::observe(SellerObserver::class);
        Product::observe(ProductObserver::class);
        Exception::observe(ExceptionsObserver::class);
    }
}
