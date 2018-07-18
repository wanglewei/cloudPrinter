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
    <script type="text/javascript">
        function check_code() {
            console.log(1);
            //获取账号
            var code =
                document.getElementById("username").value;
            var reg = /^\w{6,12}$/;
            if(reg.test(code)) {
                return true;
            } else {
                alert("用户名错误,必须为6-12位字母或数字或下划线");
                return false;
            }
        }
        function check_pwd(){
            console.log(2);
            var code2 =document.getElementById("password").value;
            var reg2 = /^\w{6,16}$/;
            if(reg2.test(code2)) {
                return true;
            } else {
                alert("密码错误,必须为6-16位字母或数字或下划线");
                return false;
            }

        }
        function check() {
            return check_code() && check_pwd();
        }
    </script>
</head>

<h1 id="top">云打印网站</h1>
<hr \>
<body>
<div style="text-align: center">
    <p>登录</p>
    <form action="login.php" method="POST"onsubmit="return check()">
        <p>
            username: <input type="text" name="username" id="username"/>
        </p>

        <p>
            password: <input type="password" name="password" id="password"/>
        <input type="submit" >
    </form>
</div>
</body>
</html>