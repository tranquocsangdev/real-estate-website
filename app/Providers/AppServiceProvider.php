<?php

namespace App\Providers;

use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $admin = Auth::guard('admin')->user();
            $view->with('adminLogin', $admin);
        });

        $khachHangComposer = function ($view) {
            $khach_hang = null;
            $user = Auth::guard('khach_hangs')->user();
            if ($user) {
                $khach_hang = KhachHang::where('id', $user->id)
                                        ->where('is_active', 1)
                                        ->first();
            }
            $view->with('khach_hangLogin', $khach_hang);
        };
        View::composer(['Client.Layout.top', 'Client.Layout.menu'], $khachHangComposer);

    }

}
