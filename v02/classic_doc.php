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

<body>

<div class="header">
  <h2>云端动手实验室  ---  从实践中快速掌握云技能</h2>
  <p>经典文档 ：读经典文档 ， 掌握原理与架构 </p>
</div>

<div class="topnav">
  <a href="../doc/test_iframe03.php">项目介绍</a>
  <a href="#">栏目介绍</a>
  <a href="#">经典文档</a>
  <a href="#">企业用户</a>
  <a href="#">关于我们</a>
</div>

<div class="row">
  <div class="column">
    <h2>操作系统</h2>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Operation%20System/%E6%B7%B1%E5%85%A5%E7%90%86%E8%A7%A3%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F/Computer%20Systems%20-%20A%20Programmers%20Perspective%203E.pdf"   target="view_window" >深入理解计算机系统</a>
<br>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Linux%20Kernel/Linux%20kernel%20development%20by%20robert%20love.pdf"  target="view_window" >Linux Kernel (By Robert Love)</a>
<br>
  </div>

  <div class="column">
    <h2>虚拟化</h2>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Virtualization/Mastering.KVM.Virtualization/Packt.Mastering.KVM.Virtualization.1784399051.pdf"  target="view_window" > KVM 原理 </a>
<br>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Virtualization/Docker%20in%20Practice%2C%202nd%20Edition.pdf"  target="view_window" > Docker 原理 </a>
<br>
  </div>
  
  <div class="column">
    <h2>SDN</h2>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/network/Building%20Data%20Centers%20with%20VXLAN%20BGP%20EVPN.pdf"  target="view_window" > Building Data Centers with VXLAN BGP EVPN </a>
<br>
  </div>
  
  <div class="column">
    <h2>应用开发</h2>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Development/Learning.PHP.MySQL.JavaScript.and.CSS%282nd%2C2012.8%29.Robin.Nixon.pdf" target="view_window" >Learning PHP, MySQL, JavaScript, and CSS </a>
<br>
<a href="https://wxm-web-ssh-01.oss-cn-beijing.aliyuncs.com/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/%E7%BB%8F%E5%85%B8%E6%96%87%E6%A1%A3/Development/Mastering.Spring.Cloud.pdf" target="view_window" >Mastering Spring Cloud </a>
<br>
  </div>
</div>
  <p  style="text-align:center; color:red;" >这些文档仅用于内部学习 ， 严禁用于商业目的 ！</p>
<p style="text-align:center;">
                <span style="font-weight:normal;"><a href="http://39.99.153.25/v02/f01.php">点击返回主页</a><br />
</span>
 </p>

<!---
<marquee scrollamount=20 scrolldelay=3 valign=middle behavior="scroll">
<img src="../img/13-2.jpg" alt="" />
<img src="../img/13-1.jpg" alt="" />
</marquee>
--->
</body>
</html>

