<html>
<body>
<style type="text/css">
.divForm{

text-align: center;/*(让div中的内容居中)*/
}
</style>

<?php
include 'lab_functions.php';

session_id();
session_start();
//echo "Test for session ID :  ".session_id()."<br>";
        $mylab_id= $_SESSION['lab_id'] ;
        //printf( "This is the lab_id in session in index.php : %s <br> ", $_SESSION['lab_id'] ) ;
        if(empty($mylab_id))
                {
                echo "No lab _id is assigned <br>".$mylab_id;
                printf( "No lab _id is assigned:%d <br>",$mylab_id) ;
		echo "<p style=\"text-align:center;\"><a href=\"http://39.99.153.25/v02/f01.php\" data-ke-src=\"http://39.99.153.25/v02/f01.php\" target=\"_blank\"> 点击返回主页 。&nbsp;</a></p><p style=\"text-align:center;\"><br /></p><p style=\"text-align:center;\"><hr /></p>" ;
                return -1 ;
                }
        //echo "<br>Here is the lab_id : ".$mylab_id."<br>" ;

	$lab_session_id=$_SESSION['lab_session_id'] ;
        if(empty($lab_session_id))
                {
                echo "No lab_session_id is assigned <br>".$lab_session_id;
                printf( "No lab_session_id is assigned:%d <br>",$lab_session_id) ;
		echo "<p style=\"text-align:center;\"><a href=\"http://39.99.153.25/v02/f01.php\" data-ke-src=\"http://39.99.153.25/v02/f01.php\" target=\"_blank\"> 点击返回主页 。&nbsp;</a></p><p style=\"text-align:center;\"><br /></p><p style=\"text-align:center;\"><hr /></p>" ;
                return -1 ;
		}
        //echo "<br>Here is the session_id : ".$lab_session_id."<br>" ;

//echo "This is a PHP " ;
/*
$ip_addr=get_current_session_ip_addr($mylab_id,$lab_session_id )  ;
if($ip_addr == -1) 
	{
		echo "Failed to get current IP "."<br>" ;
		return -1 ;
	}
*/
 $lab_session_ip = $_SESSION['lab_session_ip'];
if($mylab_id == NULL or $lab_session_id == NULL or  $lab_session_ip == NULL )
                {
                echo "NULL for lab_id_i or session_id_i or ip_i ";
		echo "<p style=\"text-align:center;\"><a href=\"http://39.99.153.25/v02/f01.php\" data-ke-src=\"http://39.99.153.25/v02/f01.php\" target=\"_blank\"> 点击返回主页 。&nbsp;</a></p><p style=\"text-align:center;\"><br /></p><p style=\"text-align:center;\"><hr /></p>" ;
                return NULL ;
                }

$msg_id = get_message_id() ;

$lab_conf=get_lab_conf($mylab_id);
if (  $lab_conf < 0 )
        {
                echo "Failed to get lab conf  ";
                f_log("lab_eixt : Failed to get lab conf  ");
                return -1 ;
        }


$cmd = form_ssh_command($lab_conf , $lab_session_ip  ,  "del"  ) ;
        //echo "<br>".$cmd."<br>" ;
	f_log("Here is  lab stop command :   ".$cmd);
        $status = "Deleting" ;
        if(send_msg($msg_id , $mylab_id , $lab_session_id , $lab_session_ip , $cmd, $status  ) == 0)
                {
                        f_log("Lab exit : Mesage queue sent <br>");
                }
                else
                {
                        echo "failed to send message queue<br>";
                }
decrease_session_counter($mylab_id , 1 );
$ret_no = del_session_ip( $mylab_id ,  $lab_session_id , $lab_session_ip );
//var_dump( $ret_no ) ;
del_lab_session_ip_status($mylab_id ,  $lab_session_id , $lab_session_ip , $status );
session_destroy();

f_log("Here is after lab stop:  del_session_ip return value :  ".$ret_no);
?>


<p style="text-align:center;"><a href="http://39.99.153.25/v02/f01.php"  target="_parent"  >实验环境已经还原， 点击返回主页 。&nbsp;</a></p><p style="text-align:center;"><br /></p><p style="text-align:center;"></p>

<div class="divForm">
<form action="./save_feedback.php">
<p>反馈与建议:</p>
<input type="text" name="feedback" style="width:600px;height:50px"  >
<br>
<br>
<input type="submit" value="提交">
<p>您的建议可以帮助更多的朋友更快的学习和提高 ！</p>
</form>
</div>
<hr/>
</body>
</html>
