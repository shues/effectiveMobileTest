<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

class Task_model
{
    function create($title, $description, $status)
    {
        $mysqli = conn();
        $stmt = $mysqli->prepare("INSERT INTO tasks(id, title, description, status) VALUES (null, ?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $status);

        $result = $stmt->execute();
        $mysqli->close();

        return $result;
    }

    function readList()
    {

        $query = "SELECT * FROM tasks";

        $mysqli = conn();
        $result = $mysqli->query($query);
        $mysqli->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function read($id)
    {
        $mysqli = conn();
        $stmt = $mysqli->prepare("SELECT * FROM tasks WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $mysqli->close();

        return $result->fetch_assoc();
    }


    function update($id, $title, $description, $status)
    {
        $mysqli = conn();
        $stmt = $mysqli->prepare("UPDATE tasks SET title=?, description=?, status=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $description, $status, $id);

        $result = $stmt->execute();
        $mysqli->close();

        return $result;
    }


    function delete($id)
    {
        $mysqli = conn();
        $stmt = $mysqli->prepare("DELETE FROM tasks WHERE id=?");
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();
        $mysqli->close();

        return $result;
    }
}
