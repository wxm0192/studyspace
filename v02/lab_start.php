
<?php
include 'lab_functions.php';

function lab_controll($mylab_id,$lab_session_id)
{

        $lab_conf=get_lab_conf($mylab_id);
        if( $lab_conf == -1 )
        {
                 printf("The required lab configuration not found : %d <br> ", $mylab_id );
                 return -1 ;
        }

        //$session_id_i=$_GET['session-id'] ;
        if((int)$_SESSION['lab_session_id']<1 or empty($_SESSION['lab_session_id']) )
                {
                        //$_SESSION['lab_session_id']=get_current_session_id( (int)$mylab_id);
                        //$_SESSION['lab_session_id']=get_current_session_id( (int)$mylab_id);
                        $lab_session_id=get_current_session_id( (int)$mylab_id);
                        if((int )$lab_session_id == -1)
                                {
                                 $lab_session_id=0 ;
                                }
                        $lab_session_id += 1 ;   //assign a new ID for this session
                        echo "Here is the lab session id assigned  :". $lab_session_id."<br>" ;
                        $_SESSION['lab_session_id']=$lab_session_id ;
                        $_SESSION['lab_start_time']=time();

                        $lab_session_ip=get_session_ip($mylab_id , $lab_session_id  )  ; // form a new IP for this session


During Coding !
