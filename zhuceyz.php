
<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$name = $pass = $tel = $email = "";

if (isset($_POST['name'])) {
    $name = fix_string($_POST['name']);
}
if (isset($_POST['pass'])) {
    $pass = fix_string($_POST['pass']);
}
if (isset($_POST['tel'])) {
    $tel = fix_string($_POST['tel']);
}
if (isset($_POST['email'])) {
    $email = fix_string($_POST['email']);
}

$gender = fix_string($_POST['gender']);

$fail = validate_name($name);
$fail .= validate_pass($pass);
$fail .= validate_tel($tel);
$fail .= validate_email($email);

print $fail;

if ($fail == "") {
    // This is where you would enter the posted fields into a database,
    // preferably using hash encryption for the password.
    include('conn.php');
    $query = "INSERT INTO users(username,gender,email,tel,password) VALUES('$name','$gender','$email', '$tel', '$pass')";
    $result = $connection->query($query);
    if (!$result) {
        die($connection->error);
    } else {



        $result = $connection->query("SELECT * FROM users
            WHERE tel='$tel' AND password='$token'");
        $row = $result->fetch_array(MYSQLI_NUM);

        header('location:login.html');
    }


    exit;
}else{
  header('location:resignup.html');
  exit;
}

// The PHP functions



function validate_name($field) {
    if ($field == "") {
        return "No Username was entered<br>";
    } else if (strlen($field) < 2) {
        return "Usernames must be at least 2 characters<br>";
    }
    //   else if (preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u", $field))
    //   {return "Only letters, numbers, - and _ in usernames<br>";}
    else if (strlen($field) > 100) {
        return"昵称不得多于20个字符（20个字母或10个汉字）。";
    }
    return "";
}

function validate_pass($field) {
    if ($field == "") {
        return "No Password was entered<br>";
    } else if (strlen($field) < 6) {
        return "Passwords must be at least 6 characters<br>";
    } else if (!preg_match("/[a-z]/", $field) ||!preg_match("/[0-9]/", $field)) {
        return "Passwords require 1 each of a-z and 0-9<br>";
    }
    return "";
}

function validate_tel($field) {
    if ($field == "") {
        return "No tel was entered<br>";
    } else if (preg_match("/[^0-9]/", $field)) {
        return "The tel number is invalid<br>";
    }
    return "";
}

function validate_email($field) {
    if ($field == "") {
        return "No Email was entered<br>";
    } else if (!((strpos($field, ".") > 0) &&
            (strpos($field, "@") > 0)) ||
            preg_match("/[^a-zA-Z0-9.@_-]/", $field)) {
        return "The Email address is invalid<br>";
    }
    return "";
}

function fix_string($string) {
    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
        return htmlentities($string);
    } else {
        return($string);
    }
}
