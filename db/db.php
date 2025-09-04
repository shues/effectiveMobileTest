<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/service.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function conn()
{
    $mysqli = new mysqli("db", "user", "test", "todo");
    if (!$mysqli) {
        Service::sendAnswer("database filed", true);
    }
    mysqli_set_charset($mysqli, "utf8");
    return $mysqli;
}

// function makeQuery($query, $needAns = false)
// {
//     $link = conn();
//     $res = mysqli_query($link, $query);
//     mysqli_close($link);

//     if ($needAns) {
//         if (mysqli_num_rows($res) == 0) {
//             return [];
//         }
//         $ans = [];
//         while($row = mysqli_fetch_assoc($res)){
//             $ans[] = $row;
//         }
//         return $ans;
//     } else {
//         return $res;
//     }
// }
