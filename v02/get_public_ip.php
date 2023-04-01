<?php
// 输出运行中的 php/httpd 进程的创建者用户名
// （在可以执行 "whoami" 命令的系统上）
$var1="-la";
//$ip = $_GET['ip'];
//echo $ip ;
//$ip = "172.30.2.172";
//echo "Started  " ;

session_id();
session_start();
//$_SESSION['lab_session_ip'] = "172.30.2.172";
$ip=$_SESSION['lab_session_ip']; 
system(" ssh root@172.20.0.1   /root/aliyun/get_pip_by_ip.sh $ip " );
//$result =  system(" ssh root@172.20.0.1   /root/aliyun/get_pip_by_ip.sh $ip " );
//echo "<br>" ;
//echo $result ; 
//echo system(' ssh root@172.20.0.1   /root/aliyun/list_ecs.sh ' );
//echo exec(' ssh root@172.20.0.1   /root/aliyun/list_ecs.sh ' );
//echo "Finished " ;
//echo exec(" ssh root@172.20.0.1   /root/aliyun/list_ecs.sh " );
//echo exec(' ssh root@172.20.0.1  " /root/aliyun/list_ecs.sh " ');
//echo exec(' ssh root@172.20.0.1  " /root/aliyun/vm_lab_ctl.sh   del   m-8vb35k67frag92hcy8pa  2110  biz_net  172.30.2.180  60" ');
?>
