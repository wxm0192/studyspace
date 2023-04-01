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
                return NULL ;
                }

echo  query_lab_session_ip_status( $mylab_id , $lab_session_id , $lab_session_ip  ) ;

$msg_id = get_message_id() ;

$lab_conf=get_lab_conf($mylab_id);
if (  $lab_conf < 0 )
        {
                echo "Failed to get lab conf  ";
                return -1 ;
        }


$cmd = form_ssh_command($lab_conf , $lab_session_ip  ,  "del"  ) ;
	echo "<br>".$cmd."<br>" ;
	$status = "Deleting" ;
	if(send_msg($msg_id , $mylab_id , $lab_session_id , $lab_session_ip , $cmd, $status  ) == 0)
		{
			echo "Mesage queue sent <br>";
		}
		else
		{
			echo "failed to send message queue<br>";
		}

	decrease_session_counter($mylab_id , 1 );
	$ret_no = del_session_ip( $mylab_id ,  $lab_session_id , $lab_session_ip );
	var_dump( $ret_no ) ;
	//var_dump(get_msg($msg_id)) ;
	del_lab_session_ip_status($mylab_id ,  $lab_session_id , $lab_session_ip , $status );
	session_destroy();
?>
