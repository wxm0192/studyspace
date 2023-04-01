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
$ip_addr=get_current_session_ip_addr($mylab_id,$lab_session_id )  ;
if($ip_addr == -1) 
	{
		echo "Failed to get current IP "."<br>" ;
		return -1 ;
	}
//printf("<br> This the current IP addr : %s <br>",  $ip_addr  ) ;
del_session_ip($mylab_id,$lab_session_id ,$ip_addr);
decrease_session_counter($mylab_id , 1 ) ;
$ip_addr= str_replace(PHP_EOL, '', $ip_addr);
$ip_addr=str_replace(' ', '', $ip_addr);
f_log($mylab_id." : ".$ip_addr." in lab_exit");
lab_stop($mylab_id , $ip_addr );
f_log("Here is after lab stop ");
// add_session_ip($mylab_id,$lab_session_id ,$ip_addr);
// increase_session_counter($mylab_id , 1 ) ;
session_destroy();
//echo '<br /><a href="./f01.php?  ">点击返回主页</a>';
?>


<p style="text-align:center;"><a href="http://39.99.153.25/v02/f01.php" data-ke-src="http://39.99.153.25/v02/f01.php" >实验环境已经还原， 点击返回主页 。&nbsp;</a></p><p style="text-align:center;"><br /></p><p style="text-align:center;"></p>

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
