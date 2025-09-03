<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/service.php");

function conn()
{
    $link = mysqli_connect("db", "user", "test", "todo");
    if (!$link) {
        Service::sendAnswer("database filed", true);
    }
    mysqli_set_charset($link, "utf8");
    return $link;
}

function makeQuery($query, $needAns = false)
{
    $link = conn();
    $res = mysqli_query($link, $query);
    mysqli_close($link);

    if ($needAns) {
        if (mysqli_num_rows($res) == 0) {
            return [];
        }
        $ans = [];
        while($row = mysqli_fetch_assoc($res)){
            $ans[] = $row;
        }
        return $ans;
    } else {
        return $res;
    }
}
