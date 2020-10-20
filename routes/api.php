<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('\App\Http\Controllers\Api\v1')
    ->prefix('v1')
    ->group(function () {

        Route::namespace('Auth')
            ->group(function () {
                Route::post('/login', 'AuthController@login')->name('login');
            });


        Route::middleware('auth:api')->group(function () {
            Route::namespace('Auth')
                ->group(function () {
                    Route::post('/logout', 'AuthController@logout');
                });

            Route::namespace('Employee')
                ->group(function () {
                    Route::post('/employee/populate', 'EmployeeController@populateEmployees');
                    Route::resource('/employee', 'EmployeeController')->only([
                        'index', 'store', 'show', 'update', 'destroy'
                    ]);
                });

            Route::namespace('Company')
                ->group(function () {

                    Route::prefix('company')
                        ->group(function () {
                            Route::post('{id}', 'CompanyController@addNewEmployee');
                            Route::get('employees', 'CompanyController@getEmployees');

                            Route::post('{id}/logo', 'CompanyController@uploadLogo');

                            Route::get('{id}/employees', 'CompanyController@getEmployeesByCompanyId');

                            Route::resource('/', 'CompanyController')->only([
                                'index', 'store', 'show', 'update', 'destroy'
                            ]);
                        });

                });
        });

    });


