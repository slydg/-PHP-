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
    header('location:../login.html');
    exit;
}

//HTTP上传文件的开关，默认为ON即是开  
ini_set('file_uploads', 'ON');
//通过POST、GET以及PUT方式接收数据时间进行限制为90秒 默认值：60  
ini_set('max_input_time', '90');
//脚本执行时间就由默认的30秒变为180秒  
ini_set('max_execution_time', '180');
//Post变量由2M修改为8M，此值改为比upload_max_filesize要大  
ini_set('post_max_size', '120M');
//上传文件修改也为8M，和上面这个有点关系，大小不等的关系。 
ini_set('upload_max_filesize', '100M');
//正在运行的脚本大量使用系统可用内存,上传图片给多点，最好比post_max_size大1.5倍  
ini_set('memory_limit', '200M');


if (isset($_POST['obname'])) {
    $obname = $_POST['obname'];
}
if (isset($_POST['class'])) {
    $class = $_POST['class'];
}
if (isset($_POST['descrip'])) {
    $descrip = $_POST['descrip'];
}
if (isset($_POST['money'])) {
    $money = $_POST['money'];
} else {
    $money = 'NULL';
}
if (isset($_POST['new'])) {
    $new = $_POST['new'];
}
if (isset($_POST['tothings'])) {
    $tothings = $_POST['tothings'];
} else {
    $tothings = 'NULL';
}
if (isset($_POST['toservices'])) {
    $toservices = $_POST['toservices'];    //(uid,obname,class,descrip,new,time,money,tothings,toservices) VALUES('$user', '$obname','$class','$descrip','$new','$time','$money','$tothings','$toservices')
} else {
    $toservices = 'NULL';
}
date_default_timezone_set('Asia/Shanghai');
$time = date("Y-m-d");
$pid = $_POST['pid'];
$result = $connection->query("UPDATE things SET uid='$user',obname='$obname',class='$class',descrip='$descrip',new='$new',time='$time',money='$money',tothings='$tothings',toservices='$toservices'"
        . "WHERE pid='$pid'");
if (!$result) {
    die($connection->error);
    header('location:../reupload.html');
}
$result1 = $connection->query("SELECT * FROM things
            WHERE pid='$pid'");

if ($result1->num_rows == 0) {
    $error = "上传失败";
    header('location:../reupload.html');
} else {
    $row = $result1->fetch_array(MYSQLI_NUM);
}
if (file_exists("../things/" . $pid . "-3.jpg")) {
    $obpic3 = $pid . "-3.jpg";
} elseif (file_exists("../things/" . $pid . "-3.png")) {
    $obpic3 = $pid . "-3.png";
} elseif (file_exists("../things/" . $pid . "-3.gif")) {
    $obpic3 = $pid . "-3.gif";
} elseif (file_exists("../things/" . $pid . "-3.jpeg")) {
    $obpic3 = $pid . "-3.jpeg";
}

if (file_exists("../things/" . $pid . "-2.jpg")) {
    $obpic2 = $pid . "-2.jpg";
} elseif (file_exists("../things/" . $pid . "-2.png")) {
    $obpic2 = $pid . "-2.png";
} elseif (file_exists("../things/" . $pid . "-2.gif")) {
    $obpic2 = $pid . "-2.gif";
} elseif (file_exists("../things/" . $pid . "-2.jpeg")) {
    $obpic2 = $pid . "-2.jpeg";
}


if (file_exists("../things/" . $pid . "-1.jpg")) {
    $obpic1 = $pid . "-1.jpg";
} elseif (file_exists("../things/" . $pid . "-1.png")) {
    $obpic1 = $pid . "-1.png";
} elseif (file_exists("../things/" . $pid . "-1.gif")) {
    $obpic1 = $pid . "-1.gif";
} elseif (file_exists("../things/" . $pid . "-1.jpeg")) {
    $obpic1 = $pid . "-1.jpeg";
}


$result2 = $connection->query("SELECT * FROM users WHERE uid='$user'");
if ($result2->num_rows) {
    $row = $result2->fetch_array(MYSQLI_ASSOC);
    $uname = stripslashes($row['username']);
}
$result3 = $connection->query("SELECT * FROM userinformation WHERE uid='$user'");
if ($result3->num_rows) {
    $row = $result3->fetch_array(MYSQLI_ASSOC);

    if ($row['school'] == "") {
        $school = '尚未填写所在学校';
    } else {
        $school = stripslashes($row['school']);
    }
    if ($row['need'] == "") {
        $need = '还没有填写过近期需求~';
    } else {
        $need = stripslashes($row['need']);
    }
}




if (isset($_FILES['obpic1']['name'])) {
    switch ($_FILES['obpic1']['type']) {
        case "image/gif": $type1 = 'gif';
            break;
        case "image/jpeg": $type1 = 'jpeg';
        case "image/pjpeg": $type1 = 'jpeg';
            break;
        case "image/png": $type1 = 'png';
            break;
        default: $type1 = 'wrong';
            break;
    }
    if ($type1 == 'wrong') {
        
    } else {
        $saveto1 = "../things/$pid" . "-1." . $type1;
        $obpic1 = $pid . "-1." . $type1;
        move_uploaded_file($_FILES['obpic1']['tmp_name'], $saveto1);
    }
}
if (isset($_FILES['obpic2']['name'])) {
    switch ($_FILES['obpic2']['type']) {
        case "image/gif": $type2 = 'gif';
            break;
        case "image/jpeg": $type2 = 'jpeg';
        case "image/pjpeg": $type2 = 'jpeg';
            break;
        case "image/png": $type2 = 'png';
            break;
        default: $type2 = 'wrong';
            break;
    }
    if ($type2 == 'wrong') {
        
    } else {
        $saveto2 = "../things/$pid" . "-2." . $type2;
        $obpic2 = $pid . "-2." . $type1;
        move_uploaded_file($_FILES['obpic2']['tmp_name'], $saveto2);
    }
}
if (isset($_FILES['obpic3']['name'])) {
    switch ($_FILES['obpic3']['type']) {
        case "image/gif": $type3 = 'gif';
            break;
        case "image/jpeg": $type3 = 'jpeg';
        case "image/pjpeg": $type3 = 'jpeg';
            break;
        case "image/png": $type3 = 'png';
            break;
        default: $type3 = 'wrong';
            break;
    }
    if ($type3 == 'wrong') {
        
    } else {
        $saveto3 = "../things/$pid" . "-3." . $type3;
        $obpic3 = $pid . "-1." . $type3;
        move_uploaded_file($_FILES['obpic3']['tmp_name'], $saveto3);
    }
}














if (file_exists("../faces/$user.jpg")) {
    $face = $user . ".jpg";
} else {
    $face = "0.jpg";
}
$tomoney = $money;
unlink('../obpage/' . $pid . '.php');
$tpl = '../obpage/obmodel.tpl';
$content = file_get_contents($tpl);
$content1 = str_replace('{name}', $obname, $content);
$content2 = str_replace('{time}', $time, $content1);
$content3 = str_replace('{class}', $class, $content2);
$content4 = str_replace('{new}', $new, $content3);
$content5 = str_replace('{money}', $tomoney, $content4);
$content6 = str_replace('{owner}', $uname, $content5);
$content7 = str_replace('{school}', $school, $content6);
$content8 = str_replace('{need}', $need, $content7);
$content9 = str_replace('{pid}', $pid, $content8);
$content10 = str_replace('{obpic1}', $obpic1, $content9);
$content11 = str_replace('{obpic2}', $obpic2, $content10);
$content12 = str_replace('{obpic3}', $obpic3, $content11);
$content13 = str_replace('{face}', $face, $content12);
$content14 = str_replace('{descrip}', $descrip, $content13);
$content15 = str_replace('{services}', $toservices, $content14);
$content16 = str_replace('{things}', $tothings, $content15);


file_put_contents('../obpage/' . $pid . '.php', $content16);

header('location:../obpage/' . $pid . '.php');
