<?php 
function save_file($filename,$text)
{
	$fp = fopen ($filename, 'w');
	fwrite( $fp , $text );
	fclose( $fp );
}
function read_file($filename)
{
	if ( file_exists($filename) )
	{
		@chmod($filename,0707);
		$fp = fopen( $filename ,'r' );
		$get_page = fread( $fp, filesize( $filename ) );
		fclose( $fp );
		return $get_page;
	}
}
function DB_query($text) //��� ������
{
	$connect=@mysql_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pass']) or die ("DB������ �����Ͽ����ϴ�.");
	mysql_select_db($_POST['db_name'],$connect);
	mysql_query($text,$connect);
	//echo mysql_error();
	//echo '<br>';
	//echo nl2br($text);
	mysql_close();
}
function msgbox($msg,$back=false)
{
	if (trim($msg)<>'') $tmp_script='alert(\''.$msg.'\');';
	if ($back) $tmp_script.='history.go(-1);';
	echo '
	<script language="javascript" type="text/javascript">
	<!--
	'.$tmp_script.'
	-->
	</script>';
	if ($back) exit;
}
function go_page($msg,$url)
{
	if ($msg<>'') msgbox($msg);
	echo '
	<script language="javascript" type="text/javascript">
	<!--
	location.href="'.$url.'";
	-->
	</script>';
	exit;
}
/* 
 * ��� ���̵�,db����,��ġ���,Ȩ������ �̸��� �Է¹ް�
 * ��ġ��θ� �̿��� ������ Ǯ�� ��� data������ ������ 707�� ��������
 * config.php���Ͽ� ���̵�,db,��ġ���,Ȩ������ �̸��� �Է��ϰ�
 * db���̺��� �����Ѵ�.Ȩ������ �̵�
 */
if ($_POST['work']==''){
include '_config.php';
?>
<html>
<head>
<title>����Ű ��ġ ���α׷�</title>
 <style type="text/css">
<!--
BODY,TABLE  {
	font-size:9pt;
}
INPUT, TEXTAREA{
	font-size: 9pt;
	border-top-color: #808080;
	border-right-color:  #EBEBEB;
	border-bottom-color:  #EBEBEB;
	border-left-color: #808080;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
-->
</style>
</head>
<body>
<div style="text-align:center;">
<span style="font-size:10pt;"><b>��Ű���� ����Ű(owiki) Ver <?=$config['ver']?> ��ġ</b></span>
<form name="install" method="post" action='install.php'>
<table>
<tr>
<td>�����ͺ��̽� ȣ��Ʈ : </td><td><input type="text" name="db_host" value="localhost"></td>
</tr><tr>
<td>�����ͺ��̽� �̸� : </td><td><input type="text" name="db_name"></td>
</tr><tr>
<td>�����ͺ��̽� ���̵� : </td><td><input type="text" name="db_user"></td>
</tr><tr>
<td>�����ͺ��̽� ��ȣ : </td><td><input type="password" name="db_pass"></td>
</tr><tr>
<td>��� ���̵� : </td><td><input type="text" name="admin_id"></td>
</tr><tr>
<td>Ȩ������ �ּ� : </td><td><input type="text" name="site_url" value="http://<?=$_SERVER["HTTP_HOST"]?>/"></td>
</tr><tr>
<td>Ȩ������ ���� : </td><td><input type="text" name="site_name" value="����Ű"></td>
</tr><tr>
<td>��ġ�� ���丮 : </td><td><input name="install_dir" value="wiki/"></td>
</tr><tr>
<td colspan=2><input type="hidden" name="work" value='1'>
<input type="button" value="��ġ�ϱ�" OnClick="document.install.submit();"></td>
</tr></table>
</form>
</div>
</body>
</html>
<?php 
}else{ 
$get_db_category = "
CREATE TABLE `owiki_category` (
  `no` int(10) unsigned NOT NULL auto_increment,
  `id` varchar(15) NOT NULL default '',
  `url` varchar(30) NOT NULL default '',
  `category` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`no`),
  KEY `id` (`id`)
)";
$get_db_page_data = "
CREATE TABLE `owiki_page_data` (
  `d_no` int(11) NOT NULL auto_increment,
  `d_idx` int(11) NOT NULL default '0',
  `d_own` varchar(10) NOT NULL default '',
  `d_content` text NOT NULL,
  `d_date` int(11) NOT NULL default '0',
  `d_ip` varchar(15) NOT NULL default '',
  `d_target` int(11) NOT NULL default '0',
  `d_use_html` tinyint(4) NOT NULL default '0',
  `d_del` tinyint(4) NOT NULL default '0',
  `d_url` varchar(30) NOT NULL default '',
  `d_category` varchar(25) NOT NULL default '',
  `d_view_level` tinyint(4) NOT NULL default '0',
  `d_write_level` tinyint(4) NOT NULL default '0',
  `d_history_point` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`d_no`),
  KEY `d_target` (`d_target`),
  KEY `d_date` (`d_date`),
  KEY `d_idx` (`d_idx`)
)";
$get_db_page_name = "
CREATE TABLE `owiki_page_name` (
  `n_no` int(11) NOT NULL auto_increment,
  `n_title` char(150) binary NOT NULL default '',
  `n_title_idx` char(2) NOT NULL default '0',
  `n_date` int(11) NOT NULL default '0',
  `n_date_start` int(11) NOT NULL default '0',
  `n_del` tinyint(4) NOT NULL default '0',
  `n_url` char(30) NOT NULL default '',
  PRIMARY KEY  (`n_no`),
  KEY `n_title_idx` (`n_title_idx`)
)";
$get_db_space = "
CREATE TABLE `owiki_space` (
  `no` int(10) unsigned NOT NULL auto_increment,
  `id` varchar(15) NOT NULL default '',
  `accept` tinyint(4) NOT NULL default '0',
  `url` varchar(30) NOT NULL default '',
  `m_date` int(11) NOT NULL default '0',
  `u_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`no`)
)";
$get_db_user = "
CREATE TABLE `owiki_user` (
  `no` int(10) NOT NULL auto_increment,
  `id` varchar(15) NOT NULL default '',
  `passwd` varchar(40) NOT NULL default '',
  `name` varchar(20) NOT NULL default '',
  `email` varchar(30) NOT NULL default '',
  `memo` text NOT NULL,
  `homepage` varchar(50) NOT NULL default '',
  `ldate` int(11) default NULL,
  `wdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `view` char(3) NOT NULL default '',
  `accept` tinyint(4) NOT NULL default '0',
  `login_err` smallint(6) NOT NULL default '0',
  `login_ok` smallint(6) NOT NULL default '0',
  `login_ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`no`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`),
  KEY `accept` (`accept`)
)";
	if ($_POST['db_host'] <> '' && $_POST['db_name'] <> '' && $_POST['db_user'] <> '' && $_POST['db_pass'] <> '' && $_POST['admin_id'] <> '' && $_POST['site_url'] <> '' && $_POST['site_name'] <> '' && $_POST['install_dir'] <> '')
		{
			if ( substr($_POST['site_url'],-1) <> '/' ) $_POST['site_url']=$_POST['site_url'].'/'; 
			if ( substr($_POST['install_dir'],-1) <> '/' ) $_POST['install_dir']=$_POST['install_dir'].'/'; 
			//�������� ����
			@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'],0707);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'data/',0707);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'main/',0707);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'rss/',0707);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'skins/',0707);
			//���� ���� �ҷ�����
			$get_config=read_file($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'_config.php');
			$get_db=read_file($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'db.sql');
			//_config.php���Ͽ� ����

			$tmp_0=array(
				'[%db_host%]',
				'[%db_name%]',
				'[%db_user%]',
				'[%db_pass%]',
				'[%admin_id%]',
				'[%site_url%]',
				'[%site_name%]',
				'[%install_dir%]'
			);	
			$tmp_1=array(
				$_POST['db_host'],
				$_POST['db_name'],
				$_POST['db_user'],
				$_POST['db_pass'],
				$_POST['admin_id'],
				$_POST['site_url'],
				$_POST['site_name'],
				$_POST['install_dir']
			);
			save_file($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'_config.php',str_replace($tmp_0,$tmp_1,$get_config));
			DB_query($get_db_category);
			DB_query($get_db_page_data);
			DB_query($get_db_page_name);
			DB_query($get_db_space);
			DB_query($get_db_user);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['install_dir'].'install.php');
			go_page('��ġ�Ǿ����ϴ�.\n�Է��Ͻ� ��� ���̵�� ������ ���̵�� ������ �ּ���.',$_POST['site_url'].$_POST['install_dir'].'main/index.php?page=join');
			//echo $_POST['site_url'].$_POST['install_dir'].'main/index.php';
		}else{
			msgbox('�Էµ��� ���� �׸��� �ֽ��ϴ�.');
		}
	}
?>