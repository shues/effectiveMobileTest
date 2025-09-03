<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/service.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/tasks_model.php");

class Tasks_controller
{
    private $model;
    private $data;
    private $reqMethod;
    private $noTaskErr;
    private $taskErr;
    private $taskOk;

    function __construct($reqMethod)
    {
        $this->model = new Task_model();
        // $this->service = new Service;

        $this->data = json_decode(file_get_contents('php://input'));

        $this->reqMethod = $reqMethod;

        $this->noTaskErr = "Task not found";

        $this->taskErr = "Error task processing";

        $this->taskOk = "Task processing ok";
    }

    function start($path)
    {
        $mass = explode("/", $path);
        $taskId = $mass[2];

        switch ($this->reqMethod) {
            case "post":
                $title = Service::checkPar($this->data, "title");
                $description = Service::checkPar($this->data, "description");
                $status = Service::checkPar($this->data, "status");

                if ($this->model->create($title, $description, $status)) {
                    Service::sendAnswer($this->taskOk);
                }
                Service::sendAnswer($this->taskErr, true);

                break;
            case "get":
                if (empty($mass[2])) {
                    Service::sendAnswer($this->model->readList());
                } else {
                    $task = $this->model->read($mass[2]);
                    if (count($task) == 0) {
                        Service::sendAnswer($this->noTaskErr, true);
                    }
                    Service::sendAnswer($task);
                }
                break;
            case "put":
                if (!empty($mass[2])) {
                    $title = Service::checkPar($this->data, "title");
                    $description = Service::checkPar($this->data, "description");
                    $status = Service::checkPar($this->data, "status");

                    if ($this->model->read($mass[2])) {
                        if ($this->model->update($mass[2], $title, $description, $status)) {
                            Service::sendAnswer($this->taskOk);
                        }
                        Service::sendAnswer($this->taskErr, true);
                    }
                    Service::sendAnswer($this->noTaskErr, true);
                }
                break;
            case "delete":
                if (!empty($mass[2])) {
                    if ($this->model->read($mass[2])) {
                        if ($this->model->delete($mass[2])) {
                            Service::sendAnswer($this->taskOk);
                        }
                        Service::sendAnswer($this->taskErr, true);
                    }
                    Service::sendAnswer($this->noTaskErr, true);
                }
                break;
        }
    }
}
