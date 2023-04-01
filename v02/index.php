<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="renderer" content="webkit">
<?php
$ip_addr="169.10.0.6";
session_id();
session_start();
//echo "Test for session ID :  ".session_id()."<br>"; 
        $mylab_id= $_SESSION['lab_id'] ;
                //printf( "This is the lab_id in session in index.php : %s <br> ", $_SESSION['lab_id'] ) ;
        if(empty($mylab_id))
                {
                //echo "No lab _id is assigned <br>".$mylab_id;
                //printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
                return -1 ;
                }
        //echo "<br>Here is the lab_id <br>". $mylab_id."<br>" ;
?>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script>
    <style type="text/css">
	/***        *{padding:0px;margin:0px;border: } ***/
        html,body{width:100%;height:100%;}
    </style>
    <title>动手实验室精简版</title>
    <script type="text/javascript">
        /***
         *
         * iframe横向分隔条拖拽伸缩实例 陈建宇 2016-6-14
         *
         ***/
        function init(){

            var li = $("#li");//left iframe
            var ri = $("#ri");//right iframe
            var s = $("#s");//中间分割条
            var img = s.children("img").eq(0);
            var drag = $("#drag");//分隔条中的拖拽层.

            var clientWidth = $(window).width();
            var li_init_width=270;//上边iframe要显示的宽度,若需要调整默认宽度,请改此值即可.
            var s_init_width=10;//分隔条宽度默认值
            var ri_width=clientWidth-li_init_width-s_init_width;//底部iframe要显示的宽度

            //初始化
            li.css("width",li_init_width+"px");
            ri.css("width",ri_width+"px");
            s.css("left",li_init_width+"px").css("width",s_init_width+"px");
            img.css("width",s_init_width+"px").css("box-shadow","0 0 6px #666");

            var is_drag = false;//是否点住并进行了拖拽


            /***
             * 分隔条事件处理,如果用户执行了mousedown,mousemove,mouseup说明是拖拽,
             * 如果只执行了mousedown,mouseup说明是点击.
             */


            drag.unbind("mousedown").mousedown(function () {
                //获得分隔条内拖拽层离顶边的距离
                var li_width = parseInt(li.css("width"));
                var ri_width = parseInt(ri.css("width"));

                //分隔条div宽度设为100%,撑满屏,只有这样才能在拖拽分隔条时,有效的控制mouseup事件.
                s.css("width","100%").css("left","0px");
                img.css("left",li_width);

                var start_x = event.clientX;

                drag.unbind("mousemove").mousemove(function (event) {
                    is_drag = true;
                    var current_x = event.clientX;
                    var cha = current_x - start_x;//算偏移差量

                    li.css("width",(li_width+cha)+"px");
                    ri.css("width",(ri_width-cha)+"px");
                    img.css("left",(li_width+cha)+"px");



                });

                drag.unbind("mouseup").mouseup(function (event) {
                    var left = parseInt(img.css("left"));
                    s.css("width",s_init_width+"px").css("left",left+"px");
                    img.css("left","0px");

                    //处理非拖拽的click情况
                    if(!is_drag){

                        //直接设定固定值
                        var src=img.attr("src");
                        if(src.indexOf("toleft")!=-1){
                            li.css("width","0px");
                            s.css("left","0px");
                            clientWidth = $(window).width();
                            ri.css("width",(clientWidth-s_init_width)+"px");
                            img.attr("src",src.replace("toleft","toright"));
                        }else{
                            li.css("width",li_init_width+"px");
                            s.css("left",li_init_width+"px");
                            clientWidth = $(window).width();
                            ri.css("width",(clientWidth-li_init_width-s_init_width)+"px");
                            img.attr("src",src.replace("toright","toleft"));
                        }

                    }

                    drag.unbind("mousemove");
                    is_drag = false;



                });



            });


            //当窗口大小发生改变时,重新渲染页面,以使各组件自适应高宽度.
            $(window).resize(function() {
                //顶部iframe保持高度不变,改变底部iframe高度
                var clientWidth = $(window).width();
                var li_width = parseInt(li.css("width"));
                var new_ri_width = clientWidth - li_width - s_init_width;
                ri.css("width",new_ri_width+"px");

            });

        }


        /***
         * 加载左边页面方法 陈建宇 2016-6-21
         * 当右边页面先加载完后再加载左边页面,因为左边页面需要控制右边页面里的iframe
         * 如果右边页面还没加载完,则会出错,左边页面也会加载失败.
         */
       /* 
	   function loadLeft(){
            $("#li").attr("src","left.html");
        }
		*/


        $(document).ready(function(){

            init();

        });

    </script>


</head>
<body scroll="no">
<!--	
	<p><b>Open Lab : Open the secret of Cloud   </b> </p>
<p id="msg2" style="font-size:5px"> 公网地址： </p>
-->
<form action="lab_exit.php"  style="display: inline">
<input id="msg1" style="background-color: white;color:black;text-align:center;font-size: 60%;margin-left: 50px;"  type="text" value="公网地址：">
 &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; 
<input style="background-color: linen;color:red;text-align:center;font-size: 60%"  type="submit" value="退出实验">
</form>

<?php
session_id();
session_start();
//echo "Test for session ID :  ".session_id()."<br>"; 
        $mylab_id= $_SESSION['lab_id'] ;
                //printf( "This is the lab_id in session in index.php : %s <br> ", $_SESSION['lab_id'] ) ;
        if(empty($mylab_id))
                {
                //echo "No lab _id is assigned <br>".$mylab_id;
                //printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
                return -1 ;
                }
        //echo "<br>Here is the lab_id <br>". $mylab_id."<br>" ;
	echo "<iframe id=\"li\" name=\"left\" src=\"left_".$mylab_id.".html\" frameborder=\"1\" style=\"height:100%;border:thick;position:absolute;left:0px;top:50px;z-index:1;border: 1px solid;\"></iframe>" ;
	//<iframe id="li" name="left" src="left.php" frameborder="1" style="height:100%;border:thick;position:absolute;left:0px;top:50px;z-index:1;border: 1px solid;"></iframe>
?>
<div id="s" style="height:100%;position:absolute;z-index:3;cursor:move;margin-top:35px;">
    <img style="height:100%;position:absolute;z-index:1;" src="https://images2017.cnblogs.com/blog/391710/201708/391710-20170806153534897-940657970.png"/>
    <div style="height:100%;width:100%;position:absolute;z-index:2;margin-left:0px;margin-top:50px;padding:0px;filter:alpha(opacity=0);opacity:0;background-color:#fee;" id="drag"></div>
</div>

<!-- 2022/01/31 update for progress showing 
<iframe id="ri" name="right" src="right01.php" frameborder="1" style="height:100%;border:thick;position:absolute;top:50px;right:0px;z-index:1;border: 1px solid;"></iframe>
-->
<iframe id="ri" name="right"  frameborder="1" style="height:100%;border:thick;position:absolute;top:50px;right:0px;z-index:1;border: 1px solid;"></iframe>

<?php $lab_id = $_GET['lab_id'] ; ?>

<script language="javascript">
var flag = 0 ;
var redo_count = 2 ;
var vm_ip = "172.30.2.180" ;
var lab_id = '<?php echo $lab_id ;  ?>';
var url_str ;
var url_ok = 0 ;
function StartConnect(){
                document.getElementById("ri").src="http://39.99.153.25:8033/?hostname=172.30.2.180&username=root&password=V2FCQzI0ODA="
}
function setflag(){
               flag = 1 ;
}
function resetflag(){
                flag = 0 ;
                startCount();
}

function startCount(){
        if(flag == 1 )
                {
                        //document.getElementById("flag").innerHTML = "End the qurying ";
                        return ;
                }

    // 创建 XMLHttpRequest 对象
        var request = new XMLHttpRequest();
        // 实例化请求对象
        request.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
                document.getElementById("ri").src= "http://39.99.153.25/v02/update_redo.php?redo="+redo_count  ;
                var needle ='Running';
                var str_op = this.responseText.search("Running");
                 if(str_op > 1)
                {
                        flag=1;
                        //document.getElementById("msg0").innerHTML =  "Here is ok to connect to web ssh "+str_op;
                        //document.getElementById("external").src= "http://39.99.153.25/test/msg/update_redo.php?redo="+redo_count  ;
                        var strs= new Array(); //定义一数组
                        //var url_str ;
                        strs=this.responseText.split(":"); //字符分割
                        url_str = "http://39.99.153.25:8033/?hostname="+strs[2] +"&username=root&password=V2FCQzI0ODA=";
                        document.getElementById("msg1").value = "URL:" +  url_str ;
                        //document.getElementById("msg1").innerHTML = "URL:" +  url_str ;
                        document.getElementById("ri").src=  url_str ;
			//url_check(url_str) ;
			//call to display public IP 
			get_public_ip() ;
                }
                else
                {
                        //document.getElementById("msg0").innerHTML =  "waiting for status to become running   "+str_op;
                }

                var str_op = this.responseText.search("Abnormal");
                 if(str_op > 1)
                {
                        flag=1;
                        var strs= new Array(); //定义一数组
                        var url_str ;
                        strs=this.responseText.split(":"); //字符分割
                        url_str = "http://39.99.153.25/v02/return_home.php" ;                                           
                        //document.getElementById("msg1").value =  url_str ;
                        document.getElementById("ri").src=  url_str ;
                }
                else
                {
                        //document.getElementById("msg0").innerHTML =  "waiting for status to become running   "+str_op;
                }

                }
        };
        request.open("GET", "http://39.99.153.25/v02/update_progress.php");
        request.setRequestHeader("If-Modified-Since","0");
        request.setRequestHeader("Cache-Control","no-cache");
        request.send();
        redo_count++ ;
         setTimeout(startCount,1000);
}

function request_send(lab_id_i){

    // 创建 XMLHttpRequest 对象
        var request = new XMLHttpRequest();
        // 实例化请求对象
        request.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
                //document.getElementById("msg1").innerHTML =   this.responseText ;
                }
        };
        //document.getElementById("msg1").innerHTML =   "msg1 : lab_id in JS : "+lab_id_i ;
        //document.getElementById("msg2").innerHTML =   "http://39.99.153.25/test/msg/get_lab_session_id_ip.php?redo=1&lab_id="+lab_id_i ;
        request.open("GET", "http://39.99.153.25/v02/get_lab_session_id_ip.php?redo=1&lab_id="+lab_id_i);
        request.setRequestHeader("If-Modified-Since","0");
        request.setRequestHeader("Cache-Control","no-cache");
        request.send();
        redo_count++ ;
         //setTimeout(startCount,1000);
}

function get_public_ip(){

    // 创建 XMLHttpRequest 对象
        var request = new XMLHttpRequest();
        // 实例化请求对象
        request.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
                document.getElementById("msg1").value =   "公网地址："+this.responseText ;
                //document.getElementById("msg1").innerHTML =   "公网地址："+this.responseText ;
                }
        };
        //document.getElementById("msg1").innerHTML =   "msg1 : lab_id in JS : "+lab_id_i ;
        //document.getElementById("msg2").innerHTML =   "http://39.99.153.25/test/msg/get_lab_session_id_ip.php?redo=1&lab_id="+lab_id_i ;
        request.open("GET", "http://39.99.153.25/v02/get_public_ip.php");
        request.setRequestHeader("If-Modified-Since","0");
        request.setRequestHeader("Cache-Control","no-cache");
        request.send();
         //setTimeout(startCount,1000);
}

function release_lab(){

    // 创建 XMLHttpRequest 对象
        var request = new XMLHttpRequest();
        // 实例化请求对象
        request.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
                //document.getElementById("msg1").innerHTML =   this.responseText ;
                }
        };
        request.open("GET", "http://39.99.153.25/v02/release_lab.php");
        request.setRequestHeader("If-Modified-Since","0");
        request.setRequestHeader("Cache-Control","no-cache");
        request.send();
}

function url_check(url){
        if(url_ok  == 1 )
                {
                        //document.getElementById("flag").innerHTML = "End the qurying ";
                        //document.getElementById("ri").src=  url_str ;
                        return ;
                }

    // 创建 XMLHttpRequest 对象
        var request = new XMLHttpRequest();
        // 实例化请求对象
        request.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
                var str_op = this.responseText.search("Hostname");
                 if(str_op > 1)
                {
			// Continue for checking if return page include Hostname 
                }
                else
                {
                        url_ok = 1;
			document.getElementById("ri").src=  url ;
                        //document.getElementById("msg0").innerHTML =  "waiting for status to become running   "+str_op;
                }


                }
        };
        request.open("GET", "url" );
        request.setRequestHeader("If-Modified-Since","0");
        request.setRequestHeader("Cache-Control","no-cache");
        request.send();
        setTimeout(url_check ,1000);
}

request_send(lab_id) ;
setTimeout(startCount,1000);
//var pub_ip=<?php
//session_id();
//session_start();
//$_SESSION['lab_session_ip'] = "172.30.2.172";
//$ip=$_SESSION['lab_session_ip'];
//system(" ssh root@172.20.0.1   /root/aliyun/get_pip_by_ip.sh $ip " );
//?>
//document.getElementById("msg1").innerHTML =   "公网地址: "+ip ;


</script>

</body>

</html>
