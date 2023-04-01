<html>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script>
<?php
include 'lab_functions.php';
?>

<?php 
ini_set("display_errors", "On");//打开错误提示
ini_set("error_reporting",E_ALL);//显示所有错误

//echo "Here is lab :  ".$_GET['lab_id']." study  ".$_GET['subject'];
$mylab_id= $_GET['lab_id'] ;

if(empty($mylab_id))
                {
                	echo "No lab _id is assigned <br>";
			echo '<br /><a href="./f01.php?  ">点击返回主页</a>' ;
                	return -1 ;
                }
		else 
		{
                	//echo "<br>"."lab_id is from _GET : ".$mylab_id."<br>" ;
		}

 //session_id("123456");
 session_id();
 session_start();
 //session_id(SID);
//echo "lab_id before assign to session is : ".$mylab_id."<br>" ;
if($_SESSION['lab_id'] != $mylab_id and $_SESSION['lab_id'] > 0)
{
	echo "您有正在进行的实验 ， 请先退出进行的实验 <br>";
 	echo '<br /><a href="./f01.php?  ">点击返回主页</a>' ;
	return -1 ; 
}
	
 $_SESSION['lab_id']=$mylab_id ;

//echo "lab_id after assign to session is : ".$_SESSION['lab_id']."<br>" ;

//echo "Here is the lab_id in session : ".$_SESSION['lab_id']."<br>";
//exec('/usr/bin/date > /app/v02/date.out   ' );
//system('/usr/bin/date  ' );
//$mylab_id= $_GET['lab-id'] ;
//$s_out=passthru("/app/v02/lab-start.sh   $mylab_id  ",$retval );

?>
<!--
<frameset rows="25%,50%,25%">
        <frame src="http://39.99.153.25/doc/lab_01.php">
</frameset>
-->

<body>
<br>
<br>
<br>
<p style="text-align:center;" >Linux 是云的基石。 Linux 中的软件部署是Linux 最基本的技能 ， 也是Linux使用的一个门槛 。</p>
<p style="text-align:center;" >这个实验通过简洁的步骤， 帮助实验者了解Yum 源的使用 ， 了解 JAVA 运行环境、编译环境的安装 。 </p>
<p style="text-align:center;" >实验者可用通过这样一个简单的实验 ， 了解Linux 软件安装、部署的基本技能， 打开云中Linux 使用之门 ， 登上云体验的第一个台阶 。  </p>
<br>
<br>
<p style="text-align:center; color:yellow ; font-size: 25px;" ><a id="a0"  href="http://39.99.153.25/v02/index.php" name="2" id="2">点击开始  Linux JAVA 编译环境建立</a></p>
<br>

<p style="text-align:center;" >点击开始实验环境启动， 进入实验环境</p>
<br>
<br>


 <p style="text-align:center;">
                <span style="font-weight:normal;"><a  href="http://39.99.153.25/v02/f01.php">点击返回主页</a><br />
</span>

<script type="text/javascript">
     $(function(){
          document.getElementById("a0").click();
     });
</script>
</body>
</html>
