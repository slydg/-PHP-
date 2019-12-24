<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include ('../conn.php');
if (isset($_SESSION['uid'])) {
    $user = $_SESSION['uid'];
} else {
    header('location:../login.html');
    exit;
}
$result = $connection->query("SELECT * FROM guanzhu WHERE uid = '$user'");
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $rowsize = count($row);
        $isset = FALSE;
        for ($j = 0; $j < $rowsize; $j++) {
            if ($row[$j] == $pid) {
                $isset = TRUE;
                $connection->query("UPDATE guanzhu SET pid" . strval($j) . " = NULL where uid = '$user'");
                echo '<img src="obpage/images/gz.jpg" alt="">';
            }
        }
        if (!$isset) {
            $isempty = FALSE;
            for ($i = 0; $i < $rowsize; $i++) {
                if ($row[$i] == NULL) {
                    if ($isempty == FALSE) {
                        $t1 = $connection->query("UPDATE guanzhu SET pid" . strval($i) . " = '$pid' where uid = '$user'");
                        $isempty = TRUE;
                        echo '<img src="obpage/images/gzcg.jpg" alt="">';
                    }
                }
            }
            if ($isempty == FALSE) {
                $t2 = $connection->query("ALTER TABLE guanzhu ADD pid" . strval($rowsize) . " SMALLINT UNSIGNED");
                if (!$t2) {
                    echo 'error';
                } else {
                    $connection->query("UPDATE guanzhu SET pid" . strval($rowsize) . " = '$pid' where uid = '$user'");
                    echo '<img src="obpage/images/gzcg.jpg" alt="">';
                }
            }
        }
    } else {
        $connection->query("INSERT INTO guanzhu(uid,pid1) VALUES('$user', '$pid')");
        echo '<img src="obpage/images/gzcg.jpg" alt="">';
    }
}
  
