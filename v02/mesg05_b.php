<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JavaScript</title>
</head>
<body>


<?php error_reporting(E_ALL);
/**
* Example for sending and receiving Messages via the System V Message Queue
*
* To try this script run it synchron/asynchron twice times. One time with ?typ=send and one time with ?typ=receive
*
* @author          Thomas Eimers - Mehrkanal GmbH
*
* This document is distributed in the hope that it will be useful, but without any warranty;
* without even the implied warranty of merchantability or fitness for a particular purpose.
*/
//header('Content-Type: text/plain; charset=ISO-8859-1');
echo "Start...n";

// Create System V Message Queue. Integer value is the number of the Queue
$queue_s = msg_get_queue(100378);
$queue_r = msg_get_queue(100379);

// Sendoptions
$message='nachricht';     // Transfering Data
$serialize_needed=false;  // Must the transfer data be serialized ?
$block_send=false;        // Block if Message could not be send (Queue full...) (true/false)
$msgtype_send=1;          // Any Integer above 0. It signeds every Message. So you could handle multible message
                          // type in one Queue.

// Receiveoptions
$msgtype_receive=1;       // Whiche type of Message we want to receive ? (Here, the type is the same as the type we send,
                          // but if you set this to 0 you receive the next Message in the Queue with any type.
$maxsize=400;             // How long is the maximal data you like to receive.
$option_receive=MSG_IPC_NOWAIT; // If there are no messages of the wanted type in the Queue continue without wating.
                          // If is set to NULL wait for a Message.

// Send or receive 20 Messages
$lab_id=5 ;
$lab_session_id= 3; 
$msgtype_send=100*((int) $lab_id) + ((int) $lab_session_id) ;
$msgtype_receive=0 ;
  // This one sends

while(1)
	{
	    	$queue_status=msg_stat_queue($queue_s);
	    	echo 'Messages in the Send  queue: '.$queue_status['msg_qnum']."\n";

    		if ($queue_status['msg_qnum']>0) 
	      	{
	      		if (msg_receive($queue_s,$msgtype_receive ,$msgtype_erhalten,$maxsize,$daten,$serialize_needed, $option_receive, $err)===true) 
			{
		      		echo "Received data".$daten."\n";
			 	list($lab_id, $lab_session_id, $cmd, $status) = explode(":", $daten );
			 	echo "	<br>Lab id :".$lab_id ;
			 	echo "	<br>Lab session  id :".$lab_session_id ;
			 	echo "	<br>cmd :".$cmd ;
			 	echo "<br>Status :".$status;
				
				 $ssh_cmd  = " ssh root@172.20.0.1  "."\" ".$cmd."\"" ;
				//$s_out=passthru("$ssh_cmd"  ,$retval );
				echo "<br>" ;
				echo "system return:".$retval ;
				echo "<br>" ;
				echo "system out :".$s_out ;
				sleep(1) ;
				$status = "Running" ;
				$message=$lab_id.":".$lab_session_id.":system out is  ".$s_out."     Return Value is ".$retval.":".$status ;
				$msgtype_send=100*((int)$lab_id) + (int)$lab_session_id ;
				echo "Start to send message <br>";
				if(msg_send($queue_r,$msgtype_send, $message,$serialize_needed, $block_send,$err)==true) 
				{
			      		echo "Message sendet.n";
					echo "sent  message <br>";
			    		} else {
					echo "sent  message error <br>";
			      		var_dump($err);
			    	}
	      		} 
	      	} 
		else
		{
			 echo "<br>No message required in send  queue  :" ;
		}
		sleep(1) ;
	}
?>

</body>
</html>

