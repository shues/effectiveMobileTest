<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

class Task_model
{
    function create($title, $description, $status)
    {
        $query = "INSERT INTO tasks VALUES (null, '$title', '$description', '$status')";
        return makeQuery($query);
    }

    function readList()
    {
        $query = "SELECT * FROM tasks";
        return makeQuery($query, true);
    }

    function read($id)
    {
        $query = "SELECT * FROM tasks WHERE id=$id";
        return makeQuery($query, true);
    }


    function update($id, $title, $description, $status)
    {
        $query = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id='$id'";
        return makeQuery($query);
    }


    function delete($id)
    {
        $query = "DELETE FROM tasks WHERE id=$id";
        return makeQuery($query);
    }
}
