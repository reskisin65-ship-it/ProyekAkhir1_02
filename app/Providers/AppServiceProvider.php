<?php

namespace App\Providers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share jumlah notifikasi belum dibaca ke SEMUA view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('unreadNotifications',
                    Notifikasi::where('user_id', Auth::user()->user_id)
                        ->where('dibaca', false)
                        ->count()
                );
            } else {
                $view->with('unreadNotifications', 0);
            }
        });
    }
}
