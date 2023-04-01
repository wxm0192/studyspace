
 <?php
include 'lab_functions.php' ;
//include 'lab_msg_functions.php' ;
 $redo = $_GET['redo'];


//var_dump($mylab_id);
//var_dump($lab_session_id);
//var_dump($lab_session_ip);
//echo  query_lab_session_ip_status( $mylab_id , $lab_session_id , $lab_session_ip  ) ;
$lasting =  $_GET['redo']*1  ;
echo "实验环境的准备需要 1~3 分钟的时间 ， 请耐心等待 ， 可以先看看实验说明啊  , <br>用时 ：".$lasting."秒 ，，，，，";
?>
