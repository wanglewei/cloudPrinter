<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/12
 * Time: 10:55
 */

// 允许上传的图片后缀




    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        $hashname = hash_file('sha256',$_FILES["file"]["tmp_name"],false);
        if (file_exists("upload/" . "$hashname.".substr($_FILES["file"]["name"],strrpos($_FILES["file"]["name"],'.')+1)))
        {
            echo  "SUCCESS";
        }
        else
        {
            
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . "$hashname.".substr($_FILES["file"]["name"],strrpos($_FILES["file"]["name"],'.')+1));
            $username = $_POST["username"];
            $printname = $_POST["printname"];

            $con = mysql_connect("localhost","root","wslzd9877");
            if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("user", $con);

            mysql_query("INSERT INTO file (username, printname, filename)VALUES (\"$username\", \"$printname\",\"upload/"."$hashname.".substr($_FILES["file"]["name"],strrpos($_FILES["file"]["name"],'.')+1)."\")");
            mysql_close($con);
            echo  "SUCCESS";
        }
    }

?>