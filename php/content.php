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
$result = $connection->query("SELECT * FROM users WHERE uid = '$user'");
if (isset($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $email = preg_replace('/\s\s+/', ' ', $email);
    $connection->query("UPDATE users SET email = '$email' where uid = '$user'");
}
if (isset($_POST['tel'])) {
    $tel = addslashes($_POST['tel']);
    $tel = preg_replace('/\s\s+/', ' ', $tel);
    $connection->query("UPDATE users SET tel = '$tel' where uid = '$user'");
}
if (isset($_POST['name'])) {
    $name = addslashes($_POST['name']);
    $name = preg_replace('/\s\s+/', ' ', $name);
    $connection->query("UPDATE users SET username = '$name' where uid = '$user'");
}
header('location:../indiv.php');
