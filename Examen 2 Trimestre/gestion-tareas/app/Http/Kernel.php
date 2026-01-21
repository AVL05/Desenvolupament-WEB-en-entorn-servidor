<?php

return [
protected $routeMiddleware = [
    'auth.custom' => \App\Http\Middleware\AuthMiddleware::class,
];