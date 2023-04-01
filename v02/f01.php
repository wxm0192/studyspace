<!DOCTYPE html>
<html lang="en">
<head>
<title>OpenLab</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background-color: lightblue;
}

/* 设置页眉的样式 */
.header {
  background-color: #f1f1f1;
  color: white;
  padding: 5px;
  text-align: center;
  background-color: lightblue;
  /*text-indent: 50px; */
}

/* 设置顶部导航栏的样式 */
.topnav {
  overflow: hidden;
  color: white;
  background-color: LightGrey ;
}

/* 设置 topnav 链接的样式 */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  color: black ;
}

/* 改变鼠标悬停时的颜色 */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* 创建并排的三个非等列 */
.column {
  float: left;
  width: 25%;
  padding: 15px;
  color: white;
}

/* 清除列之后的浮动 */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* 响应式布局 - 创建堆叠而非并排的三列 */
@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}
</style>
</head>
<?php

    //首先判断有没有统计的文件
    if(is_file("pv.txt")){
            //取文件里面的值
            $count=file_get_contents("pv.txt");
            //累加
            $count++;
            //累加后的值存进文件
            file_put_contents("pv.txt", $count);
            //输出pv数
            echo"您是第 ".$count."  位访问的客人 ， 欢迎您 ！";
    } else {
            //没有统计的文件,创建文件 同时给文件里一个初始值
        file_put_contents("pv.txt",1);
            //输出一下当前的pv是:1
            echo"当前pv数是:1";
    }
?>

<body>

<div class="header">
  <h2>纸上得来终觉浅，绝知此事要躬行  </h2>
<!---
  <h2>纸上得来终觉浅，绝知此事要躬行  ---  从实践中快速掌握云技能</h2>
--->
  <p>开发阶段，黄色背景标出的实验可用，其他实验在开发中</p>
</div>

<div class="topnav">
  <a href="../doc/test_iframe03.php">项目介绍</a>
  <a href="#">栏目介绍</a>
  <a href="http://39.99.153.25/v02/classic_doc.php">经典文档</a>
  <a href="http://39.99.153.25/test/tongji/test_ajax01.php">热门教程</a>
  <a href="#">企业用户</a>
  <a href="#">关于我们</a>
</div>

<div class="row">
  <div class="column">
    <h2>云基础技能类</h2>
<a href="./test_get01.php?subject=PHP&lab_id=1"  style="background-color:yellow;" >实验1: Linux 环境下软件安装</a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=2"  style="background-color:yellow;" >实验2: Linux基本操作自由实验</a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=101"  style="background-color:yellow;" >实验3: NFS 实现文件共享</a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=102"  style="background-color:yellow;" >实验4: iSCSI 实现外部存储</a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=103"  style="background-color:yellow;" >实验5: 多功能虚机自由实验</a>
  </div>

  <div class="column">
    <h2>私有云技能类</h2>
<a href="./coming_on.php">实验1: KVM 资源管理</a>
<br>
<a href="./coming_on.php">实验2: OVS 集群实现分布式网络</a>
<br>
<a href="./coming_on.php">实验3: OCFS2 实现CAS共享文件系统</a>
<br>
<a href="./coming_on.php">实验4: Ceph 实现分布式存储</a>
<br>
  </div>
  
  <div class="column">
    <h2>PAAS 技能类</h2>
<a href="./test_get01.php?subject=PHP&lab_id=31"  style="background-color:yellow;">实验1: JAVA 调用 Redis  </a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=32" style="background-color:yellow;" >实验2: MySQL 初体验  </a>
<br>
<a href="./coming_on.php">实验3: Kafka 基本操作  </a>
<br>
<a href="./coming_on.php">实验4: Hadoop 基本操作  </a>
<br>
<a href="./test_get01.php?subject=PHP&lab_id=35"  style="background-color:yellow;" >实验5: 搭建自己的第一个个人网站  </a>
<br>
  </div>
  
  <div class="column">
    <h2>云软件展示</h2>
<a href="./coming_on.php">实验1: 绿洲平台 演示  </a>
<br>
<a href="./coming_on.php">实验2: 紫光云芯片设计平台 演示  </a>
<br>
<a href="./coming_on.php">实验3: RPA(业务过程机器人） 演示  </a>
<br>
  </div>
</div>

<marquee scrollamount=20 scrolldelay=3 valign=middle behavior="scroll" align="texttop">
<img src="../img/0415/01.jpg" alt="" />
<img src="../img/0415/02.jpg" alt="" />
<img src="../img/0415/05.jpg" alt="" />
<img src="../img/0415/06.jpg" alt="" />
</marquee>

</body>
</html>

