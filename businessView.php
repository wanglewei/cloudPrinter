<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/16
 * Time: 8:26
 */
session_start();
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$user = $_SESSION["user"];
$pass = $_SESSION["pass"];
session_destroy();
$result = mysql_query("SELECT * FROM file WHERE printname= \"$user\"");
while($row = mysql_fetch_array($result)) {
    ?>
    <a href="<?php echo $row['filename'] ?>"><?php echo $row['filename'] ?></a><br \>
    <?php
}
