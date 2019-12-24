
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$connection = mysqli_connect(
    'localhost',  /* The host to connect to 连接MySQL地址 */
    'rongyi',      /* The user to connect as 连接MySQL用户名 */
    'rongyipass',         /* The password to use 连接MySQL密码 */
    'rongyi');    /* The default database to query 连接数据库名称*/

if (!$connection) {
    printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
    exit;
}

//处理编码问题
mysqli_set_charset($connection,"utf8");

//只能用函数来判断是否连接成功
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
