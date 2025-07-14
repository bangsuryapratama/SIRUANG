<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\bookings;
use Carbon\Carbon;

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
    Carbon::setLocale('id');

    View::composer('*', function ($view) {
        if (Auth::check()) {
            $notifications = bookings::where('user_id', Auth::id())
                ->whereIn('status', ['Diterima', 'Ditolak'])
                ->where('is_read', false)
                ->latest()
                ->take(5)
                ->get();

            $view->with('userNotifications', $notifications);
        }
     });
  }

}
