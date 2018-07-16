<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/16
 * Time: 8:33
 */

    $con = mysql_connect("localhost","root","wslzd9877");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    $user = $_GET["username"];
    $pass = $_GET["password"];
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);

    if ($pass == $row['password']){
        echo "<script>alert('login successful!');</script>";
        $type = $row["type"];
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        if($type != '2') {
            header("location:userview.php");
        }
        else {
            header("location:businessView.php");
        }
    }