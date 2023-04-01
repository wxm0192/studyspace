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
<!---	
	<p><b>Open Lab : Open the secret of Cloud   </b> </p>
--->
<form action="lab_exit.php">
<input style="background-color: linen;color:red;text-align:center;font-size: 120%;margin-left: 1000px;"  type="submit" value="退出实验">
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

<iframe id="ri" name="right" src="right01.php" frameborder="1" style="height:100%;border:thick;position:absolute;top:50px;right:0px;z-index:1;border: 1px solid;"></iframe>


</body>

</html>
