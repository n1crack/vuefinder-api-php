<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Ozdemir\VueFinder\VueFinderBuilder;
use Ozdemir\VueFinder\Actions\VueFinderActionFactory;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\ReadOnly\ReadOnlyFilesystemAdapter;

class VueFinderServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        // Register VueFinder Core as singleton
        $this->app->singleton('vuefinder.core', function ($app) {

            $storages = [
                'local' => $this->getStorage(storage_path('app/private')),
                'public' => $this->getStorage(storage_path('app/public')),
                'media' => $this->getStorage(storage_path('app/public/media')),
            ];

            return VueFinderBuilder::create($storages);
        });

        // Register Action Factory
        $this->app->singleton(VueFinderActionFactory::class, function ($app) {
            return new VueFinderActionFactory($app->make('vuefinder.core'));
        });
    }

    private function getStorage($storage) {
        $readOnly = config('vuefinder.read_only_storages');

        if ($readOnly) {
            return new ReadOnlyFilesystemAdapter(new LocalFilesystemAdapter($storage));
        }

        return new LocalFilesystemAdapter($storage);
    }
}

