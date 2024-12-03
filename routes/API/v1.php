<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\User;

$router->get('api', function (){
    dd(User::create(['full_name' => 'amir',]));
});
 
$router->group(['prefix' => 'api/v1'], function () use ($router){
    $router->group(['prefix' => 'users'], function () use ($router){
        $router->post('/','API\V1\UserController@store');
        $router->put('/','API\V1\UserController@updateInfo');
        $router->put('change-password','API\V1\UserController@updatePassword');
        $router->delete('/','API\V1\UserController@delete');
        $router->get('/','API\V1\UserController@index');
    });
    $router->group(['prefix' => 'categories'], function () use ($router){
        $router->post('/','API\V1\CategoriesController@store');
        $router->delete('/','API\V1\CategoriesController@delete');
        $router->put('/','API\V1\CategoriesController@update');


    });
    
});