<?php

$app->get('/', ['uses' => 'LoginController@index']);
$app->post('/', ['uses' => 'LoginController@login']);
