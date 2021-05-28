<?php

namespace Rapidez\MirasvitKnowledgeBase;

use Illuminate\Support\ServiceProvider;

class MirasvitKnowledgeBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mirasvitknowledgebase');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez/mirasvit-knowledge-base'),
        ], 'views');
    }
}
