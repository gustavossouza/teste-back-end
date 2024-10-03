<?php

$app->get('/', ['uses' => 'UsersController@index']);
$app->get('/{userId}', ['uses' => 'UsersController@show']);
$app->post('/', ['uses' => 'UsersController@store']);
$app->put('/{userId}', ['uses' => 'UsersController@update']);
$app->delete('/{userId}', ['uses' => 'UsersController@destroy']);
