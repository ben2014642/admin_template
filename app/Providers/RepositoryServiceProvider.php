<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Repositories\Setting\SettingRepositoryInterface' => 'App\Repositories\Setting\SettingRepository',
        'App\Repositories\Blog\BaiVietRepositoryInterface' => 'App\Repositories\Blog\BaiVietRepository',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->repositories as $interface => $implement){
            $this->app->singleton($interface, $implement);
        }
    }
     /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){

    }
}
