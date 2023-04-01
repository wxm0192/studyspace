<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>iframe纵向分隔条拖拽伸缩</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
//include 'lab_functions.php';
session_id(); 
session_start();
        $mylab_id= $_SESSION['lab_id'] ;
                // printf( "This is the lab_id in right01.php :%d <br>",$mylab_id) ;
        if(empty($mylab_id))
                {
                echo "No lab _id is assigned <br>".$mylab_id;
                printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
                return -1 ;
                }
	//echo "<br>Here is the lab_id <br>". $mylab_id."<br>" ;

?>
    <style type="text/css">
        *{padding:0px;margin:0px;}
        html,body{width:100%;height:100%;}
    </style>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">

        /***
         *
         * iframe纵向分隔条拖拽伸缩 陈建宇 2016-6-14
         *
         ***/

        function init(){

            var ti = $("#ti");//top iframe
            var bi = $("#bi");//bottom iframe
            var s = $("#s");//中间分割条
            var img = s.children("img").eq(0);
            var drag = $("#drag");//分隔条中的拖拽层.

            var clientHeight = $(window).height();
            var ti_init_height=10;//上边iframe要显示的高度,若需要调整默认高度,请改此值即可.
            var bi_init_height=60;//上边iframe要显示的高度,若需要调整默认高度,请改此值即可.
            var s_init_height=10;//分隔条高度默认值
            var bi_height=clientHeight-ti_init_height-s_init_height;//底部iframe要显示的高度

            //初始化
            ti.css("height",ti_init_height+"px");
            bi.css("height",bi_height+"px");
            s.css("top",ti_init_height+"px").css("height",s_init_height+"px");
            img.css("height",s_init_height+"px").css("box-shadow","0 0 6px #666");

            var is_drag = false;//是否点住并进行了拖拽


            /***
             * 分隔条事件处理,如果用户执行了mousedown,mousemove,mouseup说明是拖拽,
             * 如果只执行了mousedown,mouseup说明是点击.
             */


            drag.unbind("mousedown").mousedown(function () {
                //获得分隔条内拖拽层离顶边的距离
                var ti_height = parseInt(ti.css("height"));
                var bi_height = parseInt(bi.css("height"));

                //分隔条div高度设为100%,撑满屏,只有这样才能在拖拽分隔条时,有效的控制mouseup事件.
                s.css("height","100%").css("top","0px");
                img.css("top",ti_height);

                var start_y = event.clientY;

                drag.unbind("mousemove").mousemove(function (event) {
                    is_drag = true;

                    var current_y = event.clientY;
                    var cha = current_y - start_y;//算偏移差量

                    ti.css("height",(ti_height+cha)+"px");
                    bi.css("height",(bi_height-cha)+"px");
                    img.css("top",(ti_height+cha)+"px");



                });

                drag.unbind("mouseup").mouseup(function (event) {
                    var top = parseInt(img.css("top"));
                    s.css("height",s_init_height+"px").css("top",top+"px");
                    img.css("top","0px");

                    //处理非拖拽的click情况
                    if(!is_drag){

                        //直接设定固定值
                        var src=img.attr("src");
                        if(src.indexOf("totop")!=-1){
                            ti.css("height","0px");
                            s.css("top","0px");
                            clientHeight = $(window).height();
                            bi.css("height",(clientHeight-s_init_height)+"px");
                            img.attr("src",src.replace("totop","tobottom"));
                        }else{
                            ti.css("height",ti_init_height+"px");
                            s.css("top",ti_init_height+"px");
                            clientHeight = $(window).height();
                            bi.css("height",(clientHeight-ti_init_height-s_init_height)+"px");
                            img.attr("src",src.replace("tobottom","totop"));
                        }

                    }

                    drag.unbind("mousemove");
                    is_drag = false;



                });



            });

            //当窗口大小发生改变时,重新渲染页面,以使各组件自适应高宽度.
            $(window).resize(function() {
                //顶部iframe保持高度不变,改变底部iframe高度
                var clientHeight = $(window).height();
                var ti_height = parseInt(ti.css("height"));
                var new_bi_height = clientHeight - ti_height - s_init_height;
                bi.css("height",new_bi_height+"px");

            });


        }





        $(document).ready(function(){
            init();
            parent.loadLeft();
        });
    </script>
</head>
<body scroll="yes">
<?php
include 'lab_functions.php';
session_id(); 
session_start();
        $mylab_id= $_SESSION['lab_id'] ;
                //printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
        if(empty($mylab_id))
                {
                echo "No lab _id is assigned <br>".$mylab_id;
                printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
                return -1 ;
                }
	//echo "<br>Here is the lab_id <br>". $mylab_id."<br>" ;



        $lab_session_id=$_SESSION['lab_session_id'] ;

//$ip_addr="169.10.0.6";
 $ip_addr=lab_start($mylab_id,$lab_session_id);
 if($ip_addr == "-1" ) 
	{
		printf("<br>Failed to get lab session IP : %s <br>", $ip_addr);
		return -1 ; 
	}
 //printf("<br>this is the lab session IP returned from function : %s<br> " ,  $ip_addr  ) ;
$lab_conf=get_lab_conf($mylab_id) ;
list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit, $type) = explode(":", $lab_conf );
$type= str_replace(PHP_EOL, '', $type);
$type=str_replace(' ', '', $type);
f_log("The lab type is :".$type );
if($type == "docker")
	{
	echo "<iframe id=\"bi\" name=\"bottom\" src=\"http://39.99.153.25:8033/?hostname=".$ip_addr."&username=root&password=cm9vdAo=\" frameborder=\"0\" style=\"width:100%;border:none;position:absolute;bottom:0px;left:0px;z-index:2;\"></iframe>" ;
	}
	else
	{
	echo "<iframe id=\"bi\" name=\"bottom\" src=\"http://39.99.153.25:8033/?hostname=".$ip_addr."&username=root&password=V2FCQzI0ODA=\" frameborder=\"0\" style=\"width:100%;border:none;position:absolute;bottom:0px;left:0px;z-index:2;\"></iframe>" ;
	}
?>
</body>
</html>
