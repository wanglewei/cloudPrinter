

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label for="file">文件名：</label>
        <input type="file" name="file" id="file"><br \>
        <input type="text" name="username"  readonly="true"  value="<?php session_start(); echo $_SESSION['user'];?>">
        <input type="text" name="printname">
        <input type="submit" name="submit" value="提交">
    </form>


