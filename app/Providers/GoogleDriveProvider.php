<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleDriveProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend('google', function($app, $config) {
            $client = new \Google_Client();
            $client->setClientId(getenv('GOOGLE_DRIVE_CLIENT_ID'));
            $client->setClientSecret(getenv('GOOGLE_DRIVE_CLIENT_SECRET'));
            $client->refreshToken(getenv('GOOGLE_DRIVE_REFRESH_TOKEN'));
            $service = new \Google_Service_Drive($client);
            $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, getenv('GOOGLE_DRIVE_FOLDER_ID'));

            return new \League\Flysystem\Filesystem($adapter);
        });
    }
}
