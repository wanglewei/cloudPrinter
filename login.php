<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/16
 * Time: 8:33
 */
    header("Content-Type: text/html;charset=utf-8");
    $con = mysql_connect("localhost","root","wslzd9877");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);

    if ($pass == $row['password']){
        echo "<script>alert('login successful!');</script>";
        $type = $row["type"];
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['type'] = $row['type'];
        if($type != '2') {
            header("location:userView.php");
        }
        else {
            header("location:businessView.php");
        }
    }
    else {
        echo "<script type='text/javascript'>alert(\"用户名或密码错误\");</script>";
        echo "<script>window.location.href='loginView.php';</script> ";
    }