<?php

use Random\Engine\Secure;

require_once($_SERVER['DOCUMENT_ROOT'] . "/service.php");

class Page404_controller
{

    function start()
    {
        Service::sendAnswer("Method not found", true);
    }
}
