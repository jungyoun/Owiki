<?php
ob_start();
if ($_GET['mode']=='edit') {
	session_cache_limiter('nocache, must-revalidate');
}
session_start();
$t_start_2 = mtime();
//�Ѿ�� ������ ó���ϴ� �κ�
if ($_GET['url']=='') 
{
	if ($_POST['url']=='')
	{
		echo 'url�� �Է��ϼ���';
		exit;
	}else{
		$_GET['url'] = $_POST['url'];
	}
}
if ($_GET['title']=='')		$_GET['title']	= $_POST['title'];
if ($_GET['mode']=='')		$_GET['mode']	= $_POST['mode'];
if ($_GET['no']=='')		$_GET['no']		= $_POST['no'];

$t_start_3 = mtime();
include '_config.php'; //$_GET['url']������ ����ϹǷ� ����ó�� �ڿ��;��Ѵ�.
@include $config['dir']['data'].$_GET['url'].'/page.php';

if ($wiki['url']=='') //page.php�� ����� �ҷ����� �̰��� ���
{
	echo '�������� �ʴ� �ּ�';
	exit;
}
include '_func.common.php'; //�⺻���� �Լ����Ϻ��� �ҷ��´�.
$_GET['title']	= str_chk($_GET['title']);
$_GET['no']		= str_chk($_GET['no']);
$_GET['url']	= str_chk($_GET['url']);
if ($_GET['mode']=='' or $_GET['mode']=='view') //� �Լ������� �ҷ��ò��� Ȯ���ϴ°�
{ 
	if ($_GET['title']<>'')
	{
		if ($_GET['no']=='')
		{
			$_GET['no']=titleto($_GET['title'],$_GET['url']);
			if ($_GET['no']<>'')
			{
				if ($_GET['highlight']<>'') 
				{
					$tmp_hl='&highlight='.urlencode($_GET['highlight']);
				}
					header('location: '.
						$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].$tmp_hl.'&no='.$_GET['no']);
			}
		}
	}elseif($_GET['no']=='' or ($_GET['no']=='' and $_GET['title']=='') )
	{
		$_GET['title']=$wiki['start_page'];
		$_GET['no']=titleto($_GET['title'],$_GET['url']);
	}
}else{
	include '_func.php';
}

if($_GET['mode']=='')
{
	$_GET['mode']='view';
}
$join_level=get_join_level();
DB_query_start(); //�̰� �������ʹ� �ѹ� ��� �����ϸ� end�� ������ ������ ���� �ʴ´�.
get_my_category($_SESSION['login_id'],$_GET['url']); 
/* 
 * ���� ������ Ŭ���� ī�װ��� �ҷ��´�. �������� �������� �ҷ����� �ʰ�
 * ��Ű�� �̿��ؼ� �ѹ� �ҷ��� ������ �ٽ� �ҷ����� �ʴ´�. 
 * �ٸ� ��ŰȨ�������� �����ϸ� �ش���Ű�� ī�װ��� �ҷ��´�
 */

exec_work(); // �۾�����
/*
 * exec_work() ��
 * $_GET['mode']�� �̿��ؼ� �����۾����� �����ؼ� �۾��� �����Ѵ�.
 * exec_work()���� mode�� �´� �۾��� ã�� ���ϸ� page_view()�� ȣ���ؼ� skin.php�� ����ϸ�
 * skin.php������ �ʿ��� �Լ��� ���� ȣ���ؼ� ����ϴ� ����̴�.
 */
?><DIV style="text-align:center;">query : <?php echo (int)$GLOBALS['db_cnt_2']?>, mtime : <?php echo mtime_diff($t_start_2, mtime())?> sec.</DIV><!-- <?php echo $join_level;?> --><?php
DB_query_end();
ob_end_flush();
function mtime(){$time = explode(' ', microtime());$usec = (double)$time[0];$sec = (double)$time[1];    return $sec + $usec;}
function mtime_diff($ts,$te){return sprintf("%2.3f" ,$te - $ts);} 
?>
