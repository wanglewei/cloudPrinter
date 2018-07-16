<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/10
 * Time: 23:12
 */
if(isset($_GET["username"])) {
    $con = mysql_connect("localhost", "root", "wslzd9877");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    $user = $_GET["username"];
    $pass = $_GET["password"];
    $type = $_GET["type"];
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);
    if($row == null)
    {
        mysql_query("INSERT INTO users (username, password,type) VALUES (\"$user\", \"$pass\",\"$type\")");
        mysql_close($con);
        echo "success";
    }
    else
    {
        echo "failure";
    }

}