<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$error = $dltel = $dlpass = "";
include('conn.php');
if (isset($_POST['dltel'])) {
    $dltel = $_POST['dltel'];
    $dlpass = $_POST['dlpass'];

    if ($dltel == "" || $dlpass == "") {
        $error = "请输入您的账号和密码";
        header('location:relogin.html');
        exit;
    } else {

        $result = $connection->query("SELECT * FROM users
            WHERE tel='$dltel' AND password='$dlpass'");

        if ($result->num_rows == 0) {
            $error = "用户名或密码错误";
            header('location:relogin.html');
            exit;
        } else {
            $row = $result->fetch_array(MYSQLI_NUM);

            $_SESSION['uid'] = $row[0];
            $_SESSION['password'] = $token;

            header('location:index.php');
            exit;
        }
    }
}else{
            header('location:relogin.html');
            exit;
}

