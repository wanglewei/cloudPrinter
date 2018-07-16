
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <head>
        <style type="text/css">
            html{height:100%}
            body{height:100%;margin:0px;padding:0px}
            #container{height:100%}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3"></script>
    </head>
    <body>
        <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                <label for="file">文件名：</label>
                <input type="file" name="file" id="file"><br \>
                <input type="text" name="username"  readonly="true"  value="<?php session_start(); echo $_SESSION['user'];?>">
                <input type="text" name="printname">
                <input type="submit" name="submit" value="提交">
        </form>
        <div id="container"></div>

        <script type="text/javascript">
            var map = new BMap.Map("container");
            var point = new BMap.Point(116.404, 39.915);
            map.centerAndZoom(point, 15);
        </script>
    </body>
</html>
