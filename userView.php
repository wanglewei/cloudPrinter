

<?php
error_reporting(E_ALL^E_NOTICE);


function unescape($str)
{
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        if ($str [$i] == '%' && $str [$i + 1] == 'u') {
            $val = hexdec(substr($str, $i + 2, 4));
            if ($val < 0x7f)
                $ret .= chr($val);
            else if ($val < 0x800)
                $ret .= chr(0xc0 | ($val >> 6)) . chr(0x80 | ($val & 0x3f));
            else
                $ret .= chr(0xe0 | ($val >> 12)) . chr(0x80 | (($val >> 6) & 0x3f)) . chr(0x80 | ($val & 0x3f));
            $i += 5;
        } else if ($str [$i] == '%') {
            $ret .= urldecode(substr($str, $i, 3));
            $i += 2;
        } else
            $ret .= $str [$i];
    }
    return $ret;
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <head>
        <style type="text/css">
            html{height:100%}
            body{height:100%;margin:0px;padding:0px}
            #container{height:90%}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js" charset="UTF-8"></script>
        <script type="text/javascript">
            function str2utf8(str) {
                encoder = new TextEncoder('utf8');
                return encoder.encode(str);
            }
                function $_cookie(name,value) {
                    var date = new Date();

                    $livetime = 5 * 24 * 3600 * 1000;// cookie生命周期
                    date.setTime(date.getTime() + $livetime);
                    document.cookie = name + "=" + value + ";expires=" + date.toGMTString();
                }
            function createTag(marker,m){

                //标注
                var text = m;
                var infoWindow = new BMap.InfoWindow(text);
                marker.addEventListener("click", function () { this.openInfoWindow(infoWindow);document.getElementById('printname').value=infoWindow.getContent(); });
            }

        </script>
    </head>
    <body>
        <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                <label for="file">文件名：</label>
                <input type="file" name="file" id="file"><br \>
                <input type="text" name="username"  readonly="true"  value="<?php session_start(); echo $_SESSION['user'];?>">
                <input type="text" name="printname" id="printname">
                <input type="submit" name="submit" value="提交">
        </form>
        <div id="container"></div>
        <?php
        $con = mysql_connect("localhost","root","wslzd9877");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("user", $con);
        ?>
        <script type="text/javascript" charset="UTF-8">
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
                    var myGeo = new BMap.Geocoder();
                    //map.addOverlay(mk);
                    map.panTo(r.point);
                    center = map.getCenter()
                    myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
                        if (result){
                            var addComp = result.addressComponents;
                            var pt = null;
                            var i = 0;
                            var mark;
                            $_cookie("province",addComp.province);
                            <?php
                            if(isset($_COOKIE["province"])) {
                                $province = $_COOKIE["province"];
                            }
                            else {
                                echo "location.href='userView.php';";
                            }
                            $province = unescape($province);
                            $order = "SELECT * FROM users WHERE province = \"$province\" and type = \"2\"";

                            //echo "alert('$order');";
                            $result = mysql_query($order);
                            while($row = mysql_fetch_array($result)) {
                                $lo = $row['lo'];
                                $la = $row['la'];
                                $printname = $row['username'];
                                echo "pt = new BMap.Point($lo,$la);";
                                echo "mark=new BMap.Marker(pt);";
                                echo "map.addOverlay(mark);";
                                echo "createTag(mark,\"$printname\");";
                            }
                            ?>
                        }
                    });
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
            })
        </script>
    </body>
</html>
