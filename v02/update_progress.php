
 <?php
include 'lab_functions.php' ;
//include 'lab_msg_functions.php' ;
 session_id();
 session_start();
 $mylab_id = $_SESSION['lab_id'];
 $lab_session_id = $_SESSION['lab_session_id'];
 $lab_session_ip = $_SESSION['lab_session_ip'];


//var_dump($mylab_id);
//var_dump($lab_session_id);
//var_dump($lab_session_ip);
if($mylab_id == NULL or $lab_session_id == NULL or  $lab_session_ip == NULL )
                {
		echo "NULL for lab_id_i or session_id_i or ip_i ";
                return NULL ;
                }

echo  query_lab_session_ip_status( $mylab_id , $lab_session_id , $lab_session_ip  ) ;
?>
