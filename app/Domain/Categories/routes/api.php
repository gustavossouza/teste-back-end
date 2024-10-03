<?php

$app->get('/', ['uses' => 'CategoriesController@index']);
$app->post('/', ['uses' => 'CategoriesController@store']);
$app->put('/{categoryId}', ['uses' => 'CategoriesController@update']);
$app->delete('/{categoryId}', ['uses' => 'CategoriesController@destroy']);
