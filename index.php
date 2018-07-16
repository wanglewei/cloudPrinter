<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <head>
        <title>云打印网站</title>
        <style type="text/css">
        #top {
            color: brown;
            text-align: center;
            background-color: beige;
        }
        body{
            background-color:cadetblue;
        }
        </style>
    </head>

        <h1 id="top">云打印网站</h1>
        <hr \>

        <div style="text-align: center">
            <p>登录</p>
            <form action="login.php" method="get">
            <p>username: ?<input type="text" name="username"></p>
            <p>password: ?<input type="password" name="password"></p>
            <input type="submit">
            </form>
            <p>注册</p>
            <form action="registered.php" method="get">
                <p>username: <input type="text" name="username"></p>
                <p>password: <input type="password" name="password"></p>
                <p>   <input type="radio" name="type" value="1" />用户
                    <input type="radio" name="type" value="2" />商家
                </p>
                <input type="submit">
            </form>
        </div>

    </body>
</html>