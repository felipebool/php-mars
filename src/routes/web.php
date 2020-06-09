<?php

$router->group(['prefix' => 'api/v1/mars'], function () use ($router) {
    $router->post('convert', ['uses' => 'ConvertController@convert']);
});


