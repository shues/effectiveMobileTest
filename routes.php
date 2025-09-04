<?php

$routes = [
    "post" => [
        '/^\/tasks$/' => "Tasks_controller"
    ],
    "get" => [
        '/^\/tasks(\/\d+)?$/' => "Tasks_controller"
    ],
    "put" => [
        '/^\/tasks\/\d+$/' => "Tasks_controller"
    ],
    "delete" => [
        '/^\/tasks\/\d+$/' => "Tasks_controller"
    ]
];
