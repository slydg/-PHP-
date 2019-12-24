<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
} else {
    header('location:../myobs.php');
    exit;
}
include('../conn.php');
$ok = 1;

$result1 = $connection->query("SELECT * FROM apply WHERE pid = '$pid' OR things = '$pid'");
if ($result1->num_rows) {
    $ok = 0;
}
if ($ok == 1) {
    $result = $connection->query("DELETE FROM things
            WHERE pid='$pid'");
    $result2 = $connection->query("DELETE FROM chatown
            WHERE pid='$pid'");
    unlink('../obpage/' . $pid . '.php');

    if (file_exists("../things/" . $pid . "-3.jpg")) {
        unlink("../things/" . $pid . "-3.jpg");
    } elseif (file_exists("../things/" . $pid . "-3.png")) {
        unlink("../things/" . $pid . "-3.png");
    } elseif (file_exists("../things/" . $pid . "-3.gif")) {
        unlink("../things/" . $pid . "-3.gif");
    } elseif (file_exists("../things/" . $pid . "-3.jpeg")) {
        unlink("../things/" . $pid . "-3.jpeg");
    }

    if (file_exists("../things/" . $pid . "-2.jpg")) {
        unlink("../things/" . $pid . "-2.jpg");
    } elseif (file_exists("../things/" . $pid . "-2.png")) {
        unlink("../things/" . $pid . "-2.png");
    } elseif (file_exists("../things/" . $pid . "-2.gif")) {
        unlink("../things/" . $pid . "-2.gif");
    } elseif (file_exists("../things/" . $pid . "-2.jpeg")) {
        unlink("../things/" . $pid . "-2.jpeg");
    }


    if (file_exists("../things/" . $pid . "-1.jpg")) {
        unlink("../things/" . $pid . "-1.jpg");
    } elseif (file_exists("../things/" . $pid . "-1.png")) {
        unlink("../things/" . $pid . "-1.png");
    } elseif (file_exists("../things/" . $pid . "-1.gif")) {
        unlink("../things/" . $pid . "-1.gif");
    } elseif (file_exists("../things/" . $pid . "-1.jpeg")) {
        unlink("../things/" . $pid . "-1.jpeg");
    }
}
header('location:../myobs.php');