<html>
<body>
<style type="text/css">
.divForm{

text-align: center;/*(让div中的内容居中)*/
}
</style>

<?php
include 'lab_functions.php' ;
//include 'lab_msg_functions.php' ;
 session_id();
 session_start();
 $mylab_id = $_SESSION['lab_id'];
 $lab_session_id = $_SESSION['lab_session_id'];
 $lab_session_ip = $_SESSION['lab_session_ip'];


var_dump($mylab_id);
var_dump($lab_session_id);
var_dump($lab_session_ip);
if($mylab_id == NULL or $lab_session_id == NULL or  $lab_session_ip == NULL )
                {
                	echo "NULL for lab_id_i or session_id_i or ip_i ";
                	//return NULL ;
                }
		else
		{
			decrease_session_counter($mylab_id , 1 );
			$ret_no = del_session_ip( $mylab_id ,  $lab_session_id , $lab_session_ip );
			var_dump( $ret_no ) ;
			//var_dump(get_msg($msg_id)) ;
			del_lab_session_ip_status($mylab_id ,  $lab_session_id , $lab_session_ip , $status );
			session_destroy();
		}

?>

<p style="text-align:center;">实验环境创建异常，需要联系维护人员， 点击返回主页 。&nbsp;</a></p><p style="text-align:center;"</p>
<p style="text-align:center;"><a href="http://39.99.153.25/v02/f01.php" target="_parent"    > 点击返回主页 &nbsp;</a></p><p style="text-align:center;"><br /></p><p style="text-align:center;"></p>

</body>
</html>

