<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:../login.html');
    exit;
}
include ('../conn.php');
$result = $connection->query("SELECT * FROM guanzhu WHERE uid = '$user'");
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $rowsize = count($row);
        $isset = FALSE;
        for ($j = 0; $j < $rowsize; $j++) {
            if ($row[$j] == $pid) {
                $isset = TRUE;
                $connection->query("UPDATE guanzhu SET pid" . strval($j) . " = NULL where uid = '$user'");
            }
        }
    }
}
header("location:../mygz.php");
exit;
