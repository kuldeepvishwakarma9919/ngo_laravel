<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\About;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer(
            ['home.*', 'layouts.*'],
            function ($view) {
                $view->with('aboutData', Cache::rememberForever('about_data', fn() => About::first()));
            }
        );
    }
}
