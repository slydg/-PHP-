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
if (isset($_POST['need'])) {
    $need = addslashes($_POST['need']);
    $need = preg_replace('/\s\s+/', ' ', $need);
    if ($result->num_rows) {
        $connection->query("UPDATE userinformation SET need = '$need' where uid = '$user'");
    } else {
        $connection->query("INSERT INTO userinformation(uid,need) VALUES('$user', '$need')");
    }
}
header('location:../indiv.php');
