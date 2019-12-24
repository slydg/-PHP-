<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$link = mysqli_connect(
        'localhost', /* The host to connect to 连接MySQL地址 */ 'rongyi', /* The user to connect as 连接MySQL用户名 */ 'rongyipass', /* The password to use 连接MySQL密码 */ 'rongyi');    /* The default database to query 连接数据库名称 */

if (!$link) {
    printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
    exit;
}
session_start();
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:../login.html');
}
if (isset($_POST['things'])) {
    $things = $_POST['things'];
}else{
    $things = NULL;
}
if (isset($_POST['money'])) {
    $money = $_POST['money'];
}else{
    $money = NULL;
}
if (isset($_POST['service'])) {
    $service = $_POST['service'];
}else{
    $service = NULL;
}
if (isset($_POST['tel'])) {
    $tel = $_POST['tel'];
}else{
    $tel = NULL;
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}else{
    $email = NULL;
}
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
}
if (isset($_POST['owner'])) {
    $owner = $_POST['owner'];
}
$result = $link->query("INSERT INTO apply(things,money,service,tel,email,uid,pid,owner,status) VALUES('{$things}','{$money}','{$service}','{$tel}','{$email}','{$user}','{$pid}','{$owner}','1')");
if (!$result) {
    die($link->error);
    header('location:reask.php?pid='.$pid);
}
header('location:../myapply.php');

