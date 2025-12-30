<?php

namespace App\Providers;

use App\Modules\Category\Services\CategoryService;
use App\Modules\Category\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            CategoryServiceInterface::class,
            CategoryService::class
        );
    }

}
