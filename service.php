<?php

class Service
{
    static function getController($routes, $reqMethod, $path)
    {
        $set = $routes[$reqMethod];

        foreach ($set as $route => $controller) {
            if (preg_match($route, $path)) {
                return $controller;
            }
        }

        return "Page404_controller";
    }

    static function checkPar($data, $parName)
    {
        if (isset($data->$parName)) {
            return $data->$parName;
        }
        Service::sendAnswer("need parameter $parName", true);
    }

    static function sendAnswer($answer, $err = false)
    {
        $ans = [];
        $ans['ok'] = !$err;
        if ($err) {
            $ans['error'] = $answer;
        } else {
            $ans['data'] = $answer;
        }

        echo json_encode($ans);
        die;
    }
}
