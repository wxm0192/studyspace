<html>
<body>
<?php
include '../v02/lab_functions.php';
?>

<?php 
ini_set("display_errors", "On");//打开错误提示
ini_set("error_reporting",E_ALL);//显示所有错误

function write_feedback($feedback_i)
{
$file_path = "./feedback.txt";
//if(file_exists($file_path))
//	{
        //printf("This is the inputed feedback : %s <br> ", $feedback_i);
	$fp=fopen($file_path , 'a' ) ;
	fwrite($fp,date("Y-m-d:H-i-s",time()).":".$feedback_i.PHP_EOL);
			echo "非常感谢您的反馈 ， 您的反馈将帮助更多朋友有更好的实践体验 !  " ; 
			echo '<br /><a href="../v02/f01.php?  ">点击返回主页</a>' ;
	fclose($fp ) ;
//	}
}

$my_feedback= $_GET['feedback'] ;

if(empty($my_feedback))
                {
                	echo "No feedback <br>";
			echo '<br /><a href="../v02/f01.php?  ">点击返回主页</a>' ;
                	return -1 ;
                }
		else 
		{
                	//echo "<br>"."The feedback is  : ".$my_feedback."<br>" ;
			write_feedback( $my_feedback );
		}


?>
</body>
</html>
