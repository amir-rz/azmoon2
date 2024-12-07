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
        $router->get('/','API\V1\CategoriesController@index');
    });

    $router->group(['prefix' => 'quizzes'], function () use ($router){
        $router->post('/','API\V1\QuizzesController@store');
        $router->delete('/','API\V1\QuizzesController@delete');
        $router->get('/','API\V1\QuizzesController@index');
        $router->put('/','API\V1\QuizzesController@update');
    });
    $router->group(['prefix' => 'questions'], function () use ($router){
        $router->post('/','API\V1\QuestionController@store');
        $router->delete('/','API\V1\QuestionController@delete');
        $router->get('/','API\V1\QuestionController@index');
        $router->put('/','API\V1\QuestionController@update');
    });


    $router->group(['prefix' => 'answers'], function () use ($router){
        $router->post('/','API\V1\AnswerSheetController@store');
        $router->delete('/','API\V1\AnswerSheetController@delete');
        $router->get('/','API\V1\AnswerSheetController@index');
        $router->put('/','API\V1\AnswerSheetController@update');
    });
});