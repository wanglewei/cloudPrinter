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
    $province = $_GET["province"];
    $Area = $_GET["Area"];
    $City = $_GET["City"];
    $lo = $_GET["lo"];
    $la = $_GET["la"];
    $Other = $_GET["Other"];
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);
    if($row == null)
    {
        mysql_query("INSERT INTO users (username, password,type,la,lo,province,City,Area,Other) VALUES (\"$user\", \"$pass\",\"$type\",\"$la\",\"$lo\",\"$province\",\"$City\",\"$Area\",\"$Other\")");
        $encode = mb_detect_encoding("INSERT INTO users (username, password,type,la,lo,province,City,Area,Other) VALUES (\"$user\", \"$pass\",\"$type\",\"$la\",\"$lo\",\"$province\",\"$City\",\"$Area\",\"$Other\")", array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
        echo $encode;
        mysql_close($con);
        echo "success";
    }
    else
    {
        echo "failure";
    }

}