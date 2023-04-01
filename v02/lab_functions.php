<?php
ini_set("display_errors", "On");//打开错误提示
ini_set("error_reporting",E_ALL);//显示所有错误

//header( "Content-type:text/html;charset=utf-8" );
define( 'DEBUG' , true );
if( DEBUG )
{
error_reporting( E_ALL ^ E_NOTICE );
ini_set( 'display_errors' , 'On' );
}
else
{
error_reporting( 0 );
ini_set( 'display_errors' , 'Off' );
}

function get_lab_conf($lab_id_i)
{
$file_path = "./lab.conf";
if(file_exists($file_path))
{
	printf("This is the inputed lab_id : %d <br> ", $lab_id_i);
	$file_arr = file($file_path);
	(int)$searched=0 ; 
	for($i=0;$i<count($file_arr);$i++)
	{
		//逐行读取文件内容
	//echo "file line :".$file_arr[$i]."<br />";
	//echo "file line :".$file_arr[$i]."<br />";
		list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit, $type) = explode(":", $file_arr[$i] );
		//echo "<br />" ;
		//echo "lab_id : ".$lab_id; 
		if  ($lab_id == $lab_id_i ) 
			{
			//echo  "<br />" ;
			//printf("Here is the returned values : %d  <br> " ,  $lab_id );
		 	$searched=1 ;
			return($file_arr[$i]) ;
			}
	}

	if( $searched == 0 ) 
	{
			printf("The required lab configuration not found : %d <br> ", $lab_id_i );
			return   -1 ;              
	}


}
}
 
function show_lab_conf($lab) 
{ list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit, $type) = explode(":", $lab );
        echo "<br />" ;
        echo "lab_id : ".$lab_id;
        echo "<br />" ;
        echo "image:".$image;
        echo "<br />" ;
        echo "tag:".$tag;
        echo "<br />" ;
        echo "netowrk:".$network;
        echo "<br />" ;
        echo "start_ip:".$start_ip;
        echo "<br />" ;
        echo "session_limit:".$session_limit;
        echo "<br />" ;
        echo "time_limit:".$time_limit   ;
        echo "<br />" ;
        echo "Type :".$type   ;
        echo "<br />" ;
}

function get_current_session_id($lab_id_i) 
{
	$file_path="./s_counter.txt" ;
 	if(is_file( $file_path ))
	{
            	//取文件里面的值
		$file_arr = file($file_path);
		$searched = 0   ;
		for($i=0;$i<count($file_arr);$i++)
		{
			//逐行读取文件内容
			//echo "file line :".$file_arr[$i]."<br />";
			//echo "file line :".$file_arr[$i]."<br />";
			list($lab_id, $session_counter ) = explode(":", $file_arr[$i] );
			if($lab_id == $lab_id_i ) 
			{
				$searched = 1   ;
				return $session_counter ;
			}
		}

		if( $searched == 0   )
			{
				printf("<br> The required lab session not found , lab_id is %d <br> " , $lab_id_i  );
				return -1 ; 
			}
    	} 
	else 
	{

        	printf( "<br> File %s doest not  exist ! <br> ", $file_path );
    	}
}

function increase_session_counter($lab_id_i , $num )
{
	$file_path="./s_counter.txt" ;
 	if(is_file( $file_path ))
	{
            	//取文件里面的值
		$file_arr = file($file_path);
		$fp=fopen($file_path , 'w+' ) ;
		$searched = 0   ;
		for($i=0;$i<count($file_arr);$i++)
		{
			//逐行读取文件内容
			//echo "file line :".$file_arr[$i]."<br />";
			list($lab_id, $session_counter ) = explode(":", $file_arr[$i] );
			if($lab_id == $lab_id_i ) 
			{
				//printf("<br> This the searched  string : %s ; lab_id : %d ; session_counter : %d <br> " , $file_arr[$i] , $lab_id, $session_counter);
				$searched = 1  ;
				$session_counter=(int)$session_counter  ;
				$num=(int)$num  ;
				$session_counter +=  $num    ;

				$file_arr[$i]=$lab_id.":".$session_counter.PHP_EOL ;
				break ;
			}
		}
		
		if( $searched == 0   )
			{
				printf("<br> The required lab not found , lab_id is %d <br> " , $lab_id_i  );
				$file_arr[count($file_arr)]=$lab_id_i.":"."1".PHP_EOL ;
				//return ; 
			}
		rewind($fp);
		for($i=0;$i<count($file_arr);$i++)
		{
			//printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
			fwrite($fp,$file_arr[$i]);
		}
			//fwrite($fp,$file_arr[$i]);
    	} 
	else 
	{

        	printf( "<br> File %s doest not  exist ! <br> ", $file_path );
    	}

	fclose($fp ) ;
}


function decrease_session_counter( $lab_id_i ,  $num )
{
	$file_path="./s_counter.txt" ;
 	if(is_file( $file_path ))
	{
            	//取文件里面的值
		$file_arr = file($file_path);
		$fp=fopen($file_path , 'w+' ) ;
		$searched = 0   ;
		for($i=0;$i<count($file_arr);$i++)
		{
			//逐行读取文件内容
			//echo "file line :".$file_arr[$i]."<br />";
			list($lab_id, $session_counter ) = explode(":", $file_arr[$i] );
			if($lab_id == $lab_id_i ) 
			{
				printf("<br> This the searched  string : %s ; lab_id : %d ; session_counter : %d <br> " , $file_arr[$i] , $lab_id, $session_counter);
				$searched = 1  ;
				$session_counter=(int)$session_counter  ;
				$num=(int)$num  ;
				if( $session_counter > 0 ) 
					$session_counter -=  $num    ;
				else
				{
					printf("<br> Nobody start this lab : %s <br> " ,  $lab_id_i);
				}

				$file_arr[$i]=$lab_id.":".$session_counter.PHP_EOL ;
				break ;
			}
		}
		
		if( $searched == 0   )
			{
				printf("<br> The required lab not found , lab_id is %d <br> " , $lab_id_i  );
				//$file_arr[count($file_arr)]=$lab_id_i.":"."1".PHP_EOL ;
				//return ; 
			}
		rewind($fp);
		for($i=0;$i<count($file_arr);$i++)
		{
			//printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
			fwrite($fp,$file_arr[$i]);
		}
			//fwrite($fp,$file_arr[$i]);
    	} 
	else 
	{

        	printf( "<br> File %s doest not  exist ! <br> ", $file_path );
    	}

	fclose($fp ) ;
}


function form_command($lab_id_i , $operation_type  ) 
	// With IP increase 
{
	$lab_conf=get_lab_conf($lab_id_i) ; 
	show_lab_conf($lab_conf) ;
	$current_session_id=get_current_session_id($lab_id_i); 
	list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit , $type) = explode(":", $lab_conf);
	list($a_s , $b_s , $c_s , $d_s) = explode(".",  $start_ip) ; 
	$d_s=(int)$d_s;
	$current_session_id=(int)$current_session_id ;
	$session_limit=(int)$session_limit;
	if($current_session_id >= $session_limit ) 
		{
		printf("<br> Reach the session limit , waiting someone to eixt . <br> Lab_id : %d    <br>Session_counter: %d  <br>",$lab_id , $current_session_id) ;
		return("-1") ; 
		}
	else 
		{
		$d_s += $current_session_id  ; 
		//$d_s -= 1  ; 
		$ip_add="$a_s"."."."$b_s"."."."$c_s"."."."$d_s" ; 
		$part2 = "/root/app/controller/docker-lab-start.sh  "." $operation_type "."  "."$image"."  "."$tag"."  "."$network"."  "."$ip_add"  ;
		$part1 = " ssh root@172.20.0.1  "."\" ".$part2."\"" ;
		echo "<br>This is the formed command: <br> " ; 
		echo "<br> $part1 <br> " ; 
		return($part1) ; 
		}
}

function  form_ssh_command($lab_conf , $ip_addr ,  $operation_type  ) 
//function form_ssh_command((string)$lab_conf , (string)$ip_addr ,  (string)$operation_type  ) 
	// Without  IP increase  , simply form with lab_conf and IP_addr
{
	list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit , $type) = explode(":", $lab_conf);
	$type = str_replace(PHP_EOL, '', $type);
	$type=str_replace(' ', '', $type);
        echo "String length is : ".strlen($type)."<br>" ;
        if (strcmp($type, "docker") == 0) 
	{
		$part2 = "/root/app/controller/docker-lab-start.sh  "." $operation_type "."  "."$image"."  "."$tag"."  "."$network"."  "."$ip_addr"  ;
		$part1 = " ssh root@172.20.0.1  "."\" ".$part2."\"" ;
		//echo "<br>This is the formed command: <br> " ; 
		//echo "<br> $part1 <br> " ; 
		return($part1) ; 
        }
	else
	{
		$part2 = "/root/aliyun/vm_lab_ctl.sh  "." $operation_type "."  "."$image"."  "."$tag"."  "."$network"."  "."$ip_addr"."  ".$time_limit  ;
		$part1 = " ssh root@172.20.0.1  "."\" ".$part2."\"" ;
		//echo "<br>This is the formed command: <br> " ; 
		//echo "<br> $part1 <br> " ; 
		return($part1) ; 

	}

}

function get_session_ip($lab_id_i , $session_id_i  ) 
//This function get the IP assigned for the session id : Session_ip = lab_start_ip + session_id 
//And set  $_SESSION['lab_session_ip'] = $ip_add 
{
	$lab_conf=get_lab_conf($lab_id_i) ; 
	if($lab_conf == -1 )
		{
			printf("<br> Failed to get lab configuration : <br> Lab_id : %d    <br>", $lab_id_i ) ;
			return -1 ;
		}
	show_lab_conf($lab_conf) ;
	list($lab_id, $image, $tag, $network, $start_ip, $session_limit, $time_limit , $type) = explode(":", $lab_conf);
	list($a_s , $b_s , $c_s , $d_s) = explode(".",  $start_ip) ; 
	$d_s=(int)$d_s;
	$session_id_i=(int)$session_id_i ;
	$session_limit=(int)$session_limit;
	if($session_id_i > $session_limit ) 
		{
		printf("<br> Reach the session limit , waiting someone to eixt . <br> Lab_id : %d    <br>Session_counter: %d  <br>",$lab_id , $current_session_id) ;
		return("-1") ; 
		}
	else 
		{
		$d_s += $session_id_i  ; 
		$d_s -= 1  ; 
		$ip_add="$a_s"."."."$b_s"."."."$c_s"."."."$d_s" ; 
		$_SESSION['lab_session_ip'] = $ip_add ;
		echo "<br>This is the session  IP :  ".$ip_add."<br>" ; 
		return($ip_add) ; 
		}
}


function get_current_session_ip_addr(int $lab_id_i  ,  int $session_id_i )
//This function get the IP assigned for the session id from lab_session_ip.txt                    
{
        $file_path="./lab_session_ip.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
                $searched = 0   ;
                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr ) = explode(":", $file_arr[$i] );
                        if((int)$lab_id == $lab_id_i and (int)$session_id_i ==  $session_id )
                        {
                                $searched = 1   ;
                                return $ip_addr ;
                        }
                }

                if( $searched == 0   )
                        {
                                printf("<br> The required lab session not found , lab_id is %d <br> Session_id is %d <br> " , $lab_id_i, $session_id_i  );
                                return -1 ;
                        }
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
		return -1 ;
        }
}

function add_session_ip(int $lab_id_i , int $session_id_i , $ip_i ) 
{

        $file_path="./lab_session_ip.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
		$fp=fopen($file_path , 'a+' ) ;
                $searched = 0   ;
                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr ) = explode(":", $file_arr[$i] );
                        if($lab_id == $lab_id_i and $session_id_i ==  $session_id )
                        {
                                $searched = 1   ;
                		/*
				for($i=0;$i<count($file_arr);$i++)
                		{
                        		printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
                        		fwrite($fp,$file_arr[$i]);
                		}
				*/
				fclose($fp ) ;
                                return -1       ;
                        }
                }

                if( $searched == 0   )
                        {
                                printf("<br> The required lab session added  , lab_id is %d <br> Session_id is %d <br> " , $lab_id_i, $session_id_i  );
				$file_arr[$i]="$lab_id_i".":"."$session_id_i".":"."$ip_i".PHP_EOL;
				//rewind($fp);

                		/*for($i=0;$i<count($file_arr);$i++)
                		{
				*/
                        		printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
                        		fwrite($fp,$file_arr[$i]);
                		/*
				}
				*/
				fclose($fp ) ;

                                return 0  ;
                        }
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
		return -1 ;
        }
}


function del_session_ip(int $lab_id_i , int $session_id_i , $ip_i ) 
{
        //返回值： 1 ： 删除成功  0：未找到记录  -1： 文件不存在  
        $file_path="./lab_session_ip.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
		$fp=fopen($file_path , 'w+' ) ;
                $searched = 0   ;
                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
			//var_dump($file_arr[$i]);
                        list($lab_id, $session_id,$ip_addr ) = explode(":", $file_arr[$i] );
                        //printf("<br>  lab_id is:  %d  Session_id is: %d  ip is :%s  <br> " , $lab_id_i, $session_id_i, $ip_i  );
                        //printf(" file :lab_id is:  %d  Session_id is: %d  ip is :%s  <br> " , $lab_id, $session_id, $ip_addr);
			$lab_id = (int) $lab_id ;
			$session_id = (int) $session_id ;
			$ip_addr = str_replace("\n","",$ip_addr);
			//$ip_addr = str_replace("r\n","",$ip_addr);
                        if( $lab_id == $lab_id_i and $session_id_i ==   $session_id and $ip_addr ==  $ip_i )
                        //if($lab_id == $lab_id_i and $session_id_i ==  $session_id and strcmp($ip_addr ,  $ip_i) )
                        {
                                $searched = 1   ;
                        	//printf("<br> This is the deleting  string : %s <br> " ,  $file_arr[$i] );
				$file_arr[$i] = PHP_EOL ;
                        }
                }

                if( $searched == 0   )
                        {
                                printf("<br> The required lab session not found   , lab_id is %d <br> Session_id is %d <br> " , $lab_id_i, $session_id_i  );
                                printf("<br> The required lab session not found   , IP is %s  <br> " , $ip_i  );
                        }
		rewind($fp);
                for($i=0; $i<count($file_arr); $i++)
                	{
                       		//printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
				if( $file_arr[$i] != PHP_EOL )
                       			fwrite($fp,$file_arr[$i]);
			}

		fclose($fp ) ;
                return $searched  ;
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
		return -1 ;
        }
	 fclose($fp ) ;

}


function lab_start($mylab_id,$lab_session_id) //通过lab_id 和 lab_session_id 确定需要的 IP 和 资源类型 ， 形成资源启动脚本 ， 启动实验环境  V01
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
			$lab_session_id=get_current_session_id( (int)$mylab_id);    // 第一个session 返回值为 -1 
			if((int )$lab_session_id == -1) 
				{
				 $lab_session_id=0 ;     // 对于第一个session ， lab_session_id 置为 0 
				}
			$lab_session_id += 1 ;   	//assign a new ID for this session 
        		echo "Here is the lab session id assigned  :". $lab_session_id."<br>" ;
			$_SESSION['lab_session_id']=$lab_session_id ;
        		$_SESSION['lab_start_time']=time();

			$lab_session_ip=get_session_ip($mylab_id , $lab_session_id  )  ; // form a new IP for this session 
			echo "<br>"."this is the IP formed   for the lab & session :".$lab_session_ip."<br>" ;
			increase_session_counter($mylab_id, 1);     // add the session counter 
			add_session_ip( $mylab_id, $lab_session_id , $lab_session_ip ); // add the record to lab session ip table 
			$operation_type="new";	
			printf("<br> lab_conf :%s <br>", $lab_conf );
			printf("<br>  lab_session_ip :%s <br>", $lab_session_ip);
			printf("<br> operation_type :%s <br>", $operation_type );
			$ssh_cmd=form_ssh_command($lab_conf , $lab_session_ip ,  $operation_type  ) ;
			printf("<br> This is the formed command  :%s <br>", $ssh_cmd );
			$s_out=passthru("$ssh_cmd"  ,$retval );
			echo "<br>" ;
			echo "system return:".$retval ;
			echo "<br>" ;
			echo "system out :".$s_out ;
			echo "<br>This is a PHP test <br>" ;   
			echo  "<br>".get_lab_conf($mylab_id)."<br>";
			//echo get_current_session_ip_addr($mylab_id, $lab_session_id);

			return $lab_session_ip ;
        	}
		else
		{
			echo "Here is the lab session id in else  :".$_SESSION['lab_session_id']."<br>" ;
			$lab_session_id=$_SESSION['lab_session_id'] ;
			printf("This is the inputed lab_id : %d <br> ", $mylab_id);
			//printf("This is the session id : %d <br> ", $lab_session_id);

			$current_session_ip_addr=get_current_session_ip_addr($mylab_id , $lab_session_id  ) ;
			if($current_session_ip_addr == -1 )
			{
				printf("The IP for the lab & session not found : %d  , %d <br> ",  $mylab_id, $lab_session_id);
				printf("This is a fatal Error , Check with system admin  <br> ");
				return -1 ; 
			}
			else
			{
				printf("This is the IP got for the lab & session :%s<br> ", $current_session_ip_addr  ) ;
				$lab_session_ip=$current_session_ip_addr ;
				return $lab_session_ip ;
			}

		}
}

function lab_stop($mylab_id,$lab_session_ip)
{
        $lab_conf=get_lab_conf($mylab_id);
        if( $lab_conf == -1 )
        {
                 printf("The required lab configuration not found : %d <br> ", $mylab_id );
                 return -1 ;
        }
        //echo  "<br>".get_lab_conf($mylab_id)."<br>";
	$operation_type = "del";
 	$ssh_cmd=form_ssh_command($lab_conf , $lab_session_ip ,  $operation_type  ) ;
	f_log($ssh_cmd." :command in lab_stop");
        printf("<br> This is the formed command  :%s <br>", $ssh_cmd );
        $s_out=passthru("$ssh_cmd"  ,$retval );
        //echo "<br>" ;
        //echo "system return:".$retval ;
        //echo "<br>" ;
        //echo "system out :".$s_out ;
	f_log( $s_out." : s_out in lab_stop");
	f_log( $retval." : retval in lab_stop");
        return $s_out ;            
}



function f_log($msg)
{
$file_path = "./log";
if(file_exists($file_path))
        {
        //printf("This is the inputed msg  : %s <br> ", $msg);
        $fp=fopen($file_path , 'a+' ) ;
        //echo date("Y-m-d H:i",time());
        $log_msg =  date("Y-m-d H:i",time())." : ".$msg.PHP_EOL ;
        fwrite($fp,$log_msg );
        fclose($fp);

        }
}

function add_lab_session_ip_status(int $lab_id_i , int $session_id_i , $ip_i , $status_i )
{
        //返回值： 0 ： add successfully    -1：add failed  
        $file_path="./lab_session_ip_status.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
                $fp=fopen($file_path , 'w' ) ;
                $searched = 0   ;
		$line_cout = count($file_arr) ;

                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr , $status  ) = explode(":", $file_arr[$i] );
                        if($lab_id == $lab_id_i and $session_id_i ==  $session_id and $ip_addr == $ip_i )
                        //if($lab_id == $lab_id_i and $session_id_i ==  $session_id and strcmp($ip_addr ,  $ip_i) )
                        {
                                $searched = 1   ;
                                printf("<br> Duplicated record  : %s <br> " ,  $file_arr[$i] );
                		//return  -1  ;
                        }
                }
		
		if( $searched == 0 )
		{
			$file_arr[ $line_cout ] = $lab_id_i.":".$session_id_i.":".$ip_i.":".$status_i.PHP_EOL ;
			echo $file_arr[ $line_cout ] ;
			echo "<br> line_count is :".$line_cout."<br>";
		}
                rewind($fp);

		for($i=0; $i< count($file_arr); $i++)
			{
				//printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
				if( $file_arr[$i] != PHP_EOL )
					fwrite($fp,$file_arr[$i]);
			}

                fclose($fp ) ;
                return  0  ;
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
                return -1 ;
        }

}

function update_lab_session_ip_status(int $lab_id_i , int $session_id_i , $ip_i , $status_i )
{
        //返回值： 1 ： 删除成功  0：未找到记录  -1： 文件不存在
        $file_path="./lab_session_ip_status.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
                $fp=fopen($file_path , 'w' ) ;
                $searched = 0   ;
		$line_cout = count($file_arr) ;

                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr , $status  ) = explode(":", $file_arr[$i] );
                        if($lab_id == $lab_id_i and $session_id_i ==  $session_id and $ip_addr == $ip_i )
                        //if($lab_id == $lab_id_i and $session_id_i ==  $session_id and strcmp($ip_addr ,  $ip_i) )
                        {
                                $searched = 1   ;
				$file_arr[ $i ] = $lab_id_i.":".$session_id_i.":".$ip_i.":".$status_i.PHP_EOL ;
                                printf("<br> found and updated   : %s <br> " ,  $file_arr[$i] );
                        }
                }
		
		if( $searched == 0 )
		{
			printf("<br> Failed to find the required record  : %s , %s , %s <br> " ,  $lab_id_i ,  $session_id_i , $ip_i  );
                	//return  -1  ;

		}
 		for($i=0; $i<count($file_arr); $i++)
                        {
                                //printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
                                if( $file_arr[$i] != PHP_EOL )
                                        fwrite($fp,$file_arr[$i]);
                        }


                fclose($fp ) ;
                return  0  ;
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
                return -1 ;
        }

}

function del_lab_session_ip_status(int $lab_id_i , int $session_id_i , $ip_i  )
{
        //返回值： 1 ： 删除成功  0：未找到记录  -1： 文件不存在
        $file_path="./lab_session_ip_status.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
                $fp=fopen($file_path , 'w' ) ;
                $searched = 0   ;
		$line_cout = count($file_arr) ;

                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr , $status  ) = explode(":", $file_arr[$i] );
                        if($lab_id == $lab_id_i and $session_id_i ==  $session_id and $ip_addr == $ip_i )
                        //if($lab_id == $lab_id_i and $session_id_i ==  $session_id and strcmp($ip_addr ,  $ip_i) )
                        {
                                $searched = 1   ;
				$file_arr[ $i ] = PHP_EOL ;
				f_log("del_lab_session_ip_status:  Found and deleted  record  : %s , %s , %s  ".$lab_id_i .  $session_id_i . $ip_i  );
				//printf("<br> Found and deleted  record  : %s , %s , %s <br> " ,  $lab_id_i ,  $session_id_i , $ip_i  );
                        }
                }
		
		if( $searched == 0 )
		{
			printf("<br> Failed to find the required record  : %s , %s , %s <br> " ,  $lab_id_i ,  $session_id_i , $ip_i  );
                	//return  -1  ;

		}
 		for($i=0; $i<count($file_arr); $i++)
                        {
                                //printf("<br> This the writing string : %s <br> " ,  $file_arr[$i] );
                                if( $file_arr[$i] != PHP_EOL )
                                        fwrite($fp,$file_arr[$i]);
                        }


                fclose($fp ) ;
                return  0  ;
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
                return -1 ;
        }

}
function query_lab_session_ip_status(int $lab_id_i , int $session_id_i , $ip_i  )
{
        //返回值：  ： String : returned status ;  -1：未找到记录  -2： 文件不存在
	if($lab_id_i == NULL or $session_id_i == NULL or  $ip_i == NULL )
		{
		return NULL ;
		}

        $file_path="./lab_session_ip_status.txt" ;
        if(is_file( $file_path ))
        {
                //取文件里面的值
                $file_arr = file($file_path);
                $fp=fopen($file_path , 'r' ) ;
                $searched = 0   ;
		$line_cout = count($file_arr) ;

                for($i=0;$i<count($file_arr);$i++)
                {
                        //逐行读取文件内容
                        //echo "file line :".$file_arr[$i]."<br />";
                        //echo "file line :".$file_arr[$i]."<br />";
                        list($lab_id, $session_id,$ip_addr , $status  ) = explode(":", $file_arr[$i] );
                        if($lab_id == $lab_id_i and $session_id_i ==  $session_id and $ip_addr == $ip_i )
                        //if($lab_id == $lab_id_i and $session_id_i ==  $session_id and strcmp($ip_addr ,  $ip_i) )
                        {
                                $searched = 1   ;
				//printf("<br> Found and rerurned  record  : %s , %s , %s <br> " ,  $lab_id_i ,  $session_id_i , $ip_i  );
				//echo "<br>";
                		fclose($fp ) ;
				return $file_arr[$i] ;
				//return $status ;
                        }
                }
		
		if( $searched == 0 )
		{
			printf("<br> Failed to find the required record  : %s , %s , %s <br> " ,  $lab_id_i ,  $session_id_i , $ip_i  );
                	fclose($fp ) ;
                	return  -1  ;

		}
        }
        else
        {

                printf( "<br> File %s doest not  exist ! <br> ", $file_path );
                return -2 ;
        }

}

function get_message_id() 
{
$queue_s = msg_get_queue(100378);
return $queue_s ;

}

function send_msg($msg_id , $lab_id , $lab_session_id , $ip , $cmd, $status  )
{
$serialize_needed=false;  // Must the transfer data be serialized ?
$block_send=false;        // Block if Message could not be send (Queue full...) (true/false)
$msgtype_send=100*((int) $lab_id) + ((int) $lab_session_id) ;
$msgtype_receive=0;       // Whiche type of Message we want to receive ? (Here, the type is the same as the type we send,
                          // but if you set this to 0 you receive the next Message in the Queue with any type.
$maxsize=400;             // How long is the maximal data you like to receive.
$option_receive=MSG_IPC_NOWAIT; // If there are no messages of the wanted type in the Queue continue without wating.
                          // If is set to NULL wait for a Message.
$message=$lab_id.":".$lab_session_id.":".$ip.":".$cmd.":".$status  ;
if(msg_send($msg_id,$msgtype_send, $message,$serialize_needed, $block_send,$err)===true) 
	{
              	//echo "Message sendet.n";
		return 0 ;
        } 
	else 
	{
              	var_dump($err);
		return -1 ;
       }
}


function get_msg($msg_id) // Get msg from $msg_id sequentially 
{
$serialize_needed=false;  // Must the transfer data be serialized ?
$block_send=false;        // Block if Message could not be send (Queue full...) (true/false)
//$msgtype_send=100*((int) $lab_id) + ((int) $lab_session_id) ;
$msgtype_receive=0;       // Whiche type of Message we want to receive ? (Here, the type is the same as the type we send,
                          // but if you set this to 0 you receive the next Message in the Queue with any type.
$maxsize=400;             // How long is the maximal data you like to receive.
$option_receive=MSG_IPC_NOWAIT; // If there are no messages of the wanted type in the Queue continue without wating.
                          // If is set to NULL wait for a Message.
//$message=$lab_id.":".$lab_session_id.":".$ip.":".$cmd.":".$status  ;
$queue_status=msg_stat_queue($msg_id);
	if ($queue_status['msg_qnum']>0)
	{
		if (msg_receive($msg_id,$msgtype_receive  ,$msgtype_erhalten,$maxsize,$daten,$serialize_needed, $option_receive, $err)===true)
		{
			return  $daten ;
			/*
			echo "Received data".$daten."n";
			$data = json_decode($json_string, true);
			list($lab_id, $lab_session_id, $cmd, $status) = explode(":", $daten );
			echo "  <br>Lab id :".$lab_id ;
			echo "  <br>Lab session  id :".$lab_session_id ;
			echo "  <br>cmd :".$cmd ;
			echo "<br>Status :".$status;
			$message=$lab_id.":".$lab_session_id.":".$cmd.":"."Running" ;
			$msgtype_send=100*((int)$lab_id) + (int)$lab_session_id ;
			echo "Start to send message <br>";
			if(msg_send($queue,$msgtype_send, $message,$serialize_needed, $block_send,$err)==true)
			{
				echo "Message sendet.n";
				echo "sent  message <br>";
				} else {
				echo "sent  message error <br>";
				var_dump($err);
			}
			*/
		}
	}
	else
	{
		 return -1  ;
	}

}


function get_lab_session_id($lab_id_i)    // Get the session id assigned for this session ; get_current_session_id() get the current session id recoreded .
{
	/*
	$lab_conf=get_lab_conf($lab_id_i);
	echo  $lab_conf ;
	if(empty( $lab_conf))
		{
			echo "Faild to get lab configuration , exit <br>";
			return -1 ;
		}
        if( $lab_conf == -1 )
        {
                 printf("The required lab configuration not found : %d <br> ", $lab_id_i );
                 return -1 ;
        }
	*/
        if((int)$_SESSION['lab_session_id']<1 or empty($_SESSION['lab_session_id']) )
                {
                        $lab_session_id=get_current_session_id( (int)$lab_id_i);    // 第一个session 返回值为 -1
                        if((int )$lab_session_id == -1)
                                {
                                 $lab_session_id=0 ;     // 对于第一个session ， lab_session_id 置为 0
                                }
                        $lab_session_id += 1 ;  
			$_SESSION['lab_session_id'] =  $lab_session_id ;
		}
		else 
		{
			$lab_session_id = $_SESSION['lab_session_id'] ;
		}
		return $lab_session_id ;
}

function lab_id_init()    //Get lab_id by _GET() and set  _Session['lab_id']  if _Session['lab_id'] failed , else get lab_id  by  _Session['lab_id']  
{
	session_id();
	session_start();
	$mylab_id= $_SESSION['lab_id'] ;
	if(empty($mylab_id))
			{
				echo "New  lab started  <br>";
				 $mylab_id = $_GET['lab_id'] ;
				if(empty($mylab_id))
					{
						echo "No GET value for lab_id <br>";
						return -1 ; 
					}
					else
					{
						echo "<br>"."lab_id is from _GET   : ".$mylab_id."<br>" ;
						$_SESSION['lab_id']=$mylab_id ;
						return  $mylab_id ;
					}
			}
			else
			{
				echo "<br>"."lab_id is from _Session : ".$mylab_id."<br>" ;
				return  $mylab_id ;
 			}
}
?>
