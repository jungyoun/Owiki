<?php
ob_start();
if ($_GET['page']=='join' or $_GET['page']=='makewiki') {
	session_cache_limiter('nocache, must-revalidate');
}
session_start();
global $config;
include "../_config.php";
include "../_func.common.php";
$inc_list['main']		= array('����ȭ��','_main.php');
$inc_list['join']		= array('�����ϱ�','_join.php');
$inc_list['profile']	= array('��������','_profile.php');
$inc_list['makewiki']	= array('��Ű����','_make.php');
$inc_list['list']	= array('��������Ű','_make.list.php');
if ($_GET['page']=='') $_GET['page']='main';
include '_head.php'; //��ܿ� ���ױ�
if ($inc_list[$_GET['page']][1]<>'')
	include $inc_list[$_GET['page']][1]; //������ ���ͺ�
include '_foot.php'; //�ϴܿ� �� html�±�
?>