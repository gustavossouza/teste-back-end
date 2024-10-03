<?php

$app->get('/', ['uses' => 'UsersController@index']);
$app->post('/', ['uses' => 'UsersController@store']);
$app->put('/{userId}', ['uses' => 'UsersController@update']);
$app->delete('/{userId}', ['uses' => 'UsersController@destroy']);
