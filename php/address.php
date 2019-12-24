<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('../conn.php');
session_start();
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:../login.html');
    exit;
}
$result = $connection->query("SELECT * FROM userinformation WHERE uid = '$user'");
if (isset($_POST['school'])) {
    $school = addslashes($_POST['school']);
    $school = preg_replace('/\s\s+/', ' ', $school);
    if ($result->num_rows) {
        $connection->query("UPDATE userinformation SET school = '$school' where uid = '$user'");
    } else {
        $connection->query("INSERT INTO userinformation(uid,school) VALUES('$user', '$school')");
    }
}
if (isset($_POST['detail'])) {
    $detail = addslashes($_POST['detail']);
    $detail = preg_replace('/\s\s+/', ' ', $detail);
    if ($result->num_rows) {
        $connection->query("UPDATE userinformation SET address = '$detail' where uid = '$user'");
    } else {
        $connection->query("INSERT INTO userinformation(uid,address) VALUES('$user', '$detail')");
    }
}
header('location:../indiv.php');
