<?php
include_once "header.php";
if(!empty($_GET['twh'])){
  $talk_width=$_GET['twh']-30;
}elseif(!empty($_SESSION['talk_width'])){
	$talk_width=$_SESSION['talk_width']-30;
}else{
	$talk_width=160;
}

$talk_width2=$talk_width-8;
$path=XOOPS_URL."/modules/tad_cbox/";
?>

#cbox_container {
	width: <?php echo $talk_width;?>px;
}
#cbox_container div:after {
	content: ".";
	display: block;
	height: 11px;
	clear: both;
	visibility: hidden;
}
#cbox_container div {
	width: <?php echo $talk_width;?>px;
	height: auto;
	font-size: 11px;
}
b.tl {
	display: block;
	width: <?php echo $talk_width;?>px;
	height: 8px;
	font-size: 1px;
}
b.tr {
	display: block;
	width: <?php echo $talk_width2;?>px;
	height: 8px;
	font-size: 1px;
	float: right;
}
b.br {
	display: block;
	width: <?php echo $talk_width2;?>px;
	height: 8px;
	font-size: 1px;
	float: right;
	position: relative;
}
b.bl {
	display: block;
	width: 8px;
	height: 8px;
	font-size: 1px;
	float: left;
}
b.point {
	display: block;
	font-size: 1px;
	width: 25px;
	height: 14px;
}
#cbox_container div p {
	padding: 8px;
	margin: 0;
	border: 3px solid #fff;
	border-width: 0 3px;
	text-align: justify;
}
div.one b.tl {
	background: url(<?php echo $path;?>images/top_left1.gif) top left no-repeat;
}
div.one b.tr {
	background: url(<?php echo $path;?>images/top_right1.gif) top right no-repeat;
}
div.one p {
	background: #ecc7c7;
}
div.one b.bl {
	background: url(<?php echo $path;?>images/bottom_left1.gif) top left no-repeat;
}
div.one b.br {
	background: url(<?php echo $path;?>images/bottom_right1.gif) top right no-repeat;
}
div.one b.point {
	background: url(<?php echo $path;?>images/point1.gif) top left no-repeat;
	margin: 5px 0 0 25px;
}
div.two b.tl {
	background: url(<?php echo $path;?>images/top_left2.gif) top left no-repeat;
}
div.two b.tr {
	background: url(<?php echo $path;?>images/top_right2.gif) top right no-repeat;
}
div.two p {
	background: #e5ecc9;
}
div.two b.bl {
	background: url(<?php echo $path;?>images/bottom_left2.gif) top left no-repeat;
}
div.two b.br {
	background: url(<?php echo $path;?>images/bottom_right2.gif) top right no-repeat;
}
div.two b.point {
	background: url(<?php echo $path;?>images/point2.gif) top left no-repeat;
	margin: 5px 0 0 25px;
}
div.three b.tl {
	background: url(<?php echo $path;?>images/top_left3.gif) top left no-repeat;
}
div.three b.tr {
	background: url(<?php echo $path;?>images/top_right3.gif) top right no-repeat;
}
div.three p {
	background: #c9d7ec;
}
div.three b.bl {
	background: url(<?php echo $path;?>images/bottom_left3.gif) top left no-repeat;
}
div.three b.br {
	background: url(<?php echo $path;?>images/bottom_right3.gif) top right no-repeat;
}
div.three b.point {
	background: url(<?php echo $path;?>images/point3.gif) top left no-repeat;
	margin: 5px 0 0 25px;
}
div.four b.tl {
	background: url(<?php echo $path;?>images/top_left4.gif) top left no-repeat;
}
div.four b.tr {
	background: url(<?php echo $path;?>images/top_right4.gif) top right no-repeat;
}
div.four p {
	background: #e5c9ec;
}
div.four b.bl {
	background: url(<?php echo $path;?>images/bottom_left4.gif) top left no-repeat;
}
div.four b.br {
	background: url(<?php echo $path;?>images/bottom_right4.gif) top right no-repeat;
}
div.four b.point {
	background: url(<?php echo $path;?>images/point4.gif) top left no-repeat;
	margin: 5px 0 0 25px;
}
