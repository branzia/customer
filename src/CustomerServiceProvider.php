<?php

namespace Branzia\Customer;
use Illuminate\Support\Facades\File;
use Branzia\Blueprint\BranziaServiceProvider;
use Branzia\Blueprint\Contracts\ProvidesFilamentDiscovery;
class CustomerServiceProvider extends BranziaServiceProvider implements ProvidesFilamentDiscovery
{
    public function moduleName(): string
    {
        return 'Customer';
    }
    public function moduleRootPath():string{
        return dirname(__DIR__);
    }
    
    public function boot():void
    {
        parent::boot();

    }

    public function register(): void
    {
        parent::register();
    }
}

