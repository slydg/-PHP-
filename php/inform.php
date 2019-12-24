<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('../conn.php');
session_start();
if (isset($_SESSION['uid'])) {
    $login = TRUE;
    $user = $_SESSION['uid'];
} else {
    $login = FALSE;
}
if (!$login) {
    echo '<a href="login.html" style="color:black">您还没有登录</a>';
    exit;
}
$getrecord1 = $connection->query("SELECT * FROM chatown WHERE owner = '$user'");
if ($getrecord1->num_rows) {
    $recordnum = $getrecord1->num_rows;
    for ($j = 0; $j < $recordnum; ++$j) {
        $getrecord1->data_seek($j);
        $chat = $getrecord1->fetch_array(MYSQLI_NUM);
        
        $getrecord2 = $connection->query("SELECT * FROM message WHERE reciver_uid = '$user' AND sender_uid = '$chat[3]' AND status = '1'");
        if ($getrecord2->num_rows) {
            $result1 = $connection->query("SELECT obname FROM things WHERE pid = '$chat[1]'");
            $obname = $result1->fetch_array(MYSQLI_NUM);
            echo '<a href="message/client.php?from=' . $chat[2] . '&to=' . $chat[3] . '&pid=' . $chat[1] . '">//收到关于"' . $obname[0] . '"的私信！</a><br>';
        }
    }
}
$getrecord3 = $connection->query("SELECT * FROM apply WHERE owner = '$user' AND status = '1'");
if ($getrecord3->num_rows) {
    echo '<a href="getapply.php">//有新的交换请求！</a><br>';
}
$getrecord4 = $connection->query("SELECT * FROM apply WHERE uid = '$user' AND status = '2'");
if ($getrecord4->num_rows) {
    echo '<a href="myapply.php">//您的请求被接受！</a><br>';
}
$getrecord5 = $connection->query("SELECT * FROM apply WHERE uid = '$user' AND status = '3'");
if ($getrecord5->num_rows) {
    echo '<a href="myapply.php">//您的请求被拒绝！</a><br>';
}