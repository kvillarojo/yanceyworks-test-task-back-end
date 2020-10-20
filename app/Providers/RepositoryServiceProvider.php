<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\CompanyEmployees\CompanyEmployeeRepository;
use App\Repositories\CompanyEmployees\CompanyEmployeeRepositoryInterface;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $repositories = [
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
        CompanyRepositoryInterface::class => CompanyRepository::class,
        CompanyEmployeeRepositoryInterface::class => CompanyEmployeeRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
