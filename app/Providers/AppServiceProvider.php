<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        view()->composer('dashboard.layouts.topbar', function ($view) {

            // Default unread = 0
            $unreadCount = 0;

            // Cek user login
            if (Auth::check()) {
                $unreadCount = Message::where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
            }

            // Kirim ke view
            $view->with('unreadCount', $unreadCount);
        });
    }
}
