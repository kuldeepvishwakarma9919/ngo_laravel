<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Lazy load settings only when view is rendered
        View::composer('*', function ($view) {
            // Schema check safe: only if connection exists
            $settings = null;
            try {
                if (Schema::hasTable('settings')) {
                    $settings = Setting::first();
                }
            } catch (\Exception $e) {
                // Ignore exceptions (artisan commands, no db yet)
                $settings = null;
            }

            $view->with('settings', $settings);
        });
    }

    public function register()
    {
        //
    }
}
