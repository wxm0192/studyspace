<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>我的动手实验室</title>
</head>
<body>
<p><b>动手实验-01</b> </p>
<p><b>Linux 环境下面软件安装与验证(Centos 8 环境） </b> </p>
<p>说明：  </p>
<p style="font-size:10px" >Linux 环境里面软件安装是使用Linux 的最基本的一个常用技能。 </p>
<p style="font-size:10px" >我们常用的Linux 环境往往需要安装一些必要的软件 ， 比如 Nginx ， JAVA ， PHP ， Redis 等。  </p>
<p style="font-size:10px" >Linux 环境里面软件安装也有一些条件和注意事项 ， 比如 能够访问Yum 源 （如果Yum 在公网， 需要能够访问公网 ） 。  </p>
<p style="font-size:10px" >yum （ Yellow dog Updater, Modified ），主要功能是更方便的添加/删除/更新RPM包。 它能自动解决包的倚赖性问题。它能便于管理大量系统的更新问题  </p>

<p>步骤01：  </p>
<p style="font-size:10px" >
本实验使用公网环境 Yum 源 ， 需要能够访问公网， 需要测试能够连通公网 。 <p>
<p style="font-size:10px" >在此通过测试 8.8.8.8 公网地址验证能否连通公网 。 <p>
<p style="font-size:10px" >在命令行输入 ： <p>
 <p style="font-size:10px" >&nbsp;<em> &nbsp;#ping 8.8.8.8</em> 
 <p>
<p style="font-size:10px" >如果看到如下显示， 说明能够连通公网 ： <p>
<p style="font-size:10px">PING 8.8.8.8 (8.8.8.8) 56(84) bytes of data.<p>
<p style="font-size:10px" >64 bytes from 8.8.8.8: icmp_seq=3 ttl=110 time=42.7 ms<p>
<p style="font-size:10px" >64 bytes from 8.8.8.8: icmp_seq=4 ttl=110 time=42.7 ms<p>
<p style="font-size:10px" >64 bytes from 8.8.8.8: icmp_seq=5 ttl=110 time=42.7 ms<p>
<p>
<p>步骤02：  </p>
<p style="font-size:10px" >
本实验以Java 软件包为例 。<p> 
<p style="font-size:10px" >在命令行输入：<p>
<p style="font-size:10px"><em>&nbsp; #javac</em></p>
<p style="font-size:10px" ><p>
<p style="font-size:10px" >会显示 ： -bash: javac: command not found ， 说明没有安装 Java 开发环境 。 <p>
<p style="font-size:10px" >我们先测试yum 源：<p>
<p style="font-size:10px" ><em>#</em><em>yum list </em> 
<p>
<p style="font-size:10px" >显示 ： <p>
 <p style="font-size:10px" >* base: mirrors.aliyun.com<p>
 <p style="font-size:10px" >* extras: mirrors.aliyun.com<p>
 <p style="font-size:10px" >* updates: mirrors.aliyun.com<p>
<p>....<p>
<p style="font-size:10px" >这说明使用了阿里的Yum  源 。<p>
<p style="font-size:10px" >该定义为 /etc/yum.repos.d/CentOS-Base.repo  中的：<p>
<p style="font-size:10px" >		baseurl=http://mirrors.aliyun.com/centos/$releasever/updates/$basearch/<p>
<p style="font-size:10px" >     http://mirrors.aliyuncs.com/centos/$releasever/updates/$basearch/<p>
<p style="font-size:10px" >        http://mirrors.cloud.aliyuncs.com/centos/$releasever/updates/$basearch/<p>


<p style="font-size:10px" ><em># cat /etc/yum.repos.d/CentOS-Base.repo </em> 
<p>
<p style="font-size:10px" >进行确认 。<p>
<p>
<p>步骤03：  </p>
<p>
<p style="font-size:10px" >确认JAVA 的 J<strong>DK 安装包 </strong> 
<p>
<p style="font-size:10px" ><em># yum search JDK</em>
<p>
<p style="font-size:10px" >选择安装包为 ： <p>
<p><p>
	<p style="font-size:10px" >java-1.8.0-openjdk.x86_64 : OpenJDK 8 Runtime Environment<p>
	<p style="font-size:10px" >ava-1.8.0-openjdk-devel.x86_64 : OpenJDK 8 Development Environment <p>
<p><p>
<p style="font-size:10px" ><em>#yum install -y  java-1.8.0-openjdk.x86_64 </em>  
<p style="font-size:10px" ><em>#yum install -y  java-1.8.0-openjdk-devel.x86_64 </em>  
<p>
<p>

<p>步骤04：  </p>
<p>
<p style="font-size:10px" >java -version<p>
 
 <p style="font-size:10px" >显示Java 版本： <p>
 
<p style="font-size:10px" >	openjdk version "1.8.0_292" <p>
<p style="font-size:10px" >	OpenJDK Runtime Environment (build 1.8.0_292-b10)<p>
<p style="font-size:10px" >	OpenJDK 64-Bit Server VM (build 25.292-b10, mixed mode) <p>
<p>
</body>
</html>
