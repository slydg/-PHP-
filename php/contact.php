<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('../conn.php');
if (isset($_POST['cName'])) {
    $cname = addslashes($_POST['cName']);
    $cname = preg_replace('/\s\s+/', ' ', $cname);
}
if (isset($_POST['cEmail'])) {
    $cemail = addslashes($_POST['cEmail']);
    $cemail = preg_replace('/\s\s+/', ' ', $cemail);
}
if (isset($_POST['cMessage'])) {
    $cmessage = addslashes($_POST['cMessage']);
    $cmessage = preg_replace('/\s\s+/', ' ', $cmessage);
}
$result = $connection->query("INSERT INTO feedback(name,email,message) VALUES('$cname','$cemail','$cmessage')");
if (!$result) {
    die($connection->error);
}
header("location:../getcontact.html");
exit;