<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Ozdemir\VueFinder\VueFinderBuilder;
use Ozdemir\VueFinder\Actions\VueFinderActionFactory;
use League\Flysystem\Local\LocalFilesystemAdapter;

class VueFinderServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        // Register VueFinder Core as singleton
        $this->app->singleton('vuefinder.core', function ($app) {

            return VueFinderBuilder::create(
                [
                    'local' => new LocalFilesystemAdapter(storage_path('app/private')),
                    'public' => new LocalFilesystemAdapter(storage_path('app/public')),
                    'media' => new LocalFilesystemAdapter(storage_path('app/public/media')),
                ],
                [
                    'publicLinks' => [
                        'media://' => url('/storage/media'),
                    ],
                ]
            );
        });

        // Register Action Factory
        $this->app->singleton(VueFinderActionFactory::class, function ($app) {
            return new VueFinderActionFactory($app->make('vuefinder.core'));
        });
    }
}

