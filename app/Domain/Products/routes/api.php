<?php

$app->get('/', ['uses' => 'ProductsController@index']);
$app->get('/{productId}', ['uses' => 'ProductsController@show']);
$app->post('/', ['uses' => 'ProductsController@store']);
$app->put('/{productId}', ['uses' => 'ProductsController@update']);
$app->delete('/{productId}', ['uses' => 'ProductsController@destroy']);
