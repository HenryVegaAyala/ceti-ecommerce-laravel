<?php

namespace App\Providers;

use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Modules\Config\Repository\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Modules\Config\Repository\Interfaces\BaseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(
            BaseRepositoryInterface::class,
            BaseRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
    }
}
