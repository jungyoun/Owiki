<?php
ob_start();
if ($_GET['page']=='join' or $_GET['page']=='makewiki') {
	session_cache_limiter('nocache, must-revalidate');
}
session_start();
global $config;
include "../_config.php";
include "../_func.common.php";
$inc_list['main']		= array('메인화면','_main.php');
$inc_list['join']		= array('가입하기','_join.php');
$inc_list['profile']	= array('개인정보','_profile.php');
$inc_list['makewiki']	= array('위키개설','_make.php');
$inc_list['list']	= array('개설된위키','_make.list.php');
if ($_GET['page']=='') $_GET['page']='main';
include '_head.php'; //상단에 들어갈테그
if ($inc_list[$_GET['page']][1]<>'')
	include $inc_list[$_GET['page']][1]; //명훈이 나와봐
include '_foot.php'; //하단에 들어갈 html태그
?>