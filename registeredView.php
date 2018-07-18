<!DOCTYPE html>
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
            if(document.getElementById("la").value == ""){
                alert("请选择位置");
                return false;
            }
            return check_code() && check_pwd();
        }
    </script>
    <style type="text/css">
        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{
            height:50%;
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
</head>

<h1 id="top">云打印网站</h1>
<hr \>

<div style="text-align: center">
    <p>注册</p>
    <form action="registered.php" method="get" onsubmit="return check()">
        <p>username: <input type="text" name="username" id="username"></p>
        <p>password: <input type="password" name="password" id="password"></p>
        <p>   <input type="radio" name="type" value="1" />用户
            <input type="radio" name="type" value="2" />商家
        </p>
        <input type="text" name="province"  readonly="true" id="province" />
        <input type="text" name="City"  readonly="true" id="City"/>
        <input type="text" name="Area"  readonly="true" id="Area"/>
        <input type="text" name="lo"  readonly="true" id="lo"/>
        <input type="text" name="la"  readonly="true" id="la"/>
        <p>详细地址: <input type="text" name="Other" /></p>

        <input type="submit">
    </form>
    <p>选择您（商家/用户）的的位置</p>
</div>
<div id="container"></div>
    <script type="text/javascript">
        var map = new BMap.Map("container");
        var point = new BMap.Point(116.404, 39.915);
        var x,y;
        map.centerAndZoom(point, 10);
        map.addControl(new BMap.GeolocationControl());
        map.addControl(new BMap.NavigationControl());
        map.addControl(new BMap.MapTypeControl());
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                var center;
                //map.addOverlay(mk);
                map.panTo(r.point);
            }
            else {
                alert('无法获取位置信息 错误码:'+this.getStatus());
            }
        });
        map.addEventListener("click", function(e){   //点击事件
            //alert(e.point.lng + ", " + e.point.lat);
            //if(!e.overlay){
            //  alert("aaaaaaaa");
            //}
            var myGeo = new BMap.Geocoder();
            center = map.getCenter()
            myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
                if (result){
                    var addComp = result.addressComponents;
                    var pt = null;
                    var i = 0;
                    var mark;
                    document.getElementById("province").value=addComp.province;
                    document.getElementById("City").value=addComp.city;
                    document.getElementById("Area").value=addComp.district;
                    document.getElementById("la").value=e.point.lat;
                    document.getElementById("lo").value=e.point.lng;
                    map.clearOverlays();
                    pt = new BMap.Point(e.point.lng,e.point.lat);
                    mark=new BMap.Marker(pt);
                    map.addOverlay(mark);
                }
            });
        })

    </script>


</body>
</html>