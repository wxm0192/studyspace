 <?php
include 'lab_functions.php' ;
//include 'lab_msg_functions.php' ;

 $mylab_id = lab_id_init() ;
	if (  $lab_session_id < 0 )
	{
		echo "Failed to get lab  ID ";
		return -1 ;
	}
        $lab_conf=get_lab_conf($mylab_id);
        //var_dump($lab_conf) ;
        $lab_session_id = get_lab_session_id($mylab_id);
	if (  $lab_session_id < 0 )
	{
		echo "Failed to get lab sesssion ID ";
		return -1 ;
	}
        //echo "after get_lab_session:The session_id is ".$lab_session_id."<br>";
        //$lab_session_ip =  get_current_session_ip_addr($mylab_id , $lab_session_id  ) ;
        $lab_session_ip =  get_session_ip($mylab_id , $lab_session_id  ) ;
	if (  $lab_session_ip < 0 )
	{
		echo "Failed to get lab sesssion IP ";
		return -1 ;
	}
	//echo "after get_lab_session_ip  The session_ip is ".$lab_session_ip."<br>";
	$msg_id = get_message_id() ;

$redo=$_GET['redo'];

if( $redo > 1 )
{
	echo query_lab_session_ip_status( $mylab_id , $lab_session_id , $lab_session_ip  ) ;
}
else
{
	$cmd = form_ssh_command($lab_conf , $lab_session_ip  ,  "new"  ) ;
	//$cmd = "ssh root@172.20.0.1  /bin/ls -l"     ;
	echo "<br>".$cmd."<br>" ;
	$status = "Creating" ;
	if(send_msg($msg_id , $mylab_id , $lab_session_id , $lab_session_ip , $cmd, $status  ) == 0)
		{
			echo "Mesage queue sent <br>";
		}
		else
		{
			echo "failed to send message queue<br>";
		}

	increase_session_counter($mylab_id , 1 );
	add_session_ip( $mylab_id ,  $lab_session_id , $lab_session_ip );
	//var_dump(get_msg($msg_id)) ;
	add_lab_session_ip_status($mylab_id ,  $lab_session_id , $lab_session_ip , $status );
	//session_destroy();
}
?>
