<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', [
    'as' => '/', 'uses' => 'IndexController@getEnrolleesList'
]);

$router->get('/{field}/{sort}', [
    'as' => 'sorting', 'uses' => 'IndexController@getEnrolleesSortingList'
]);

$router->get('registration', [
    'as' => 'registration', 'uses' => 'IndexController@registration'
]);

$router->post('registration', [
    'as' => 'registration', 'uses' => 'IndexController@registration'
]);

$router->get('/search', [
    'as' => 'search', 'uses' => 'IndexController@search'
]);
