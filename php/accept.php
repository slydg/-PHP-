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
$cid = $_GET['cid'];
$connection->query("UPDATE apply SET status = '2' where cid = '$cid'");
// status 2 表示接受 3 表示拒绝
header('location:../getapply.php');
exit();