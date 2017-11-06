<?php
ob_start();
if ($_GET['mode']=='edit') {
	session_cache_limiter('nocache, must-revalidate');
}
session_start();
$t_start_2 = mtime();
//넘어온 변수를 처리하는 부분
if ($_GET['url']=='') 
{
	if ($_POST['url']=='')
	{
		echo 'url을 입력하세요';
		exit;
	}else{
		$_GET['url'] = $_POST['url'];
	}
}
if ($_GET['title']=='')		$_GET['title']	= $_POST['title'];
if ($_GET['mode']=='')		$_GET['mode']	= $_POST['mode'];
if ($_GET['no']=='')		$_GET['no']		= $_POST['no'];

$t_start_3 = mtime();
include '_config.php'; //$_GET['url']정보를 사용하므로 변수처리 뒤에와야한다.
@include $config['dir']['data'].$_GET['url'].'/page.php';

if ($wiki['url']=='') //page.php가 제대로 불러지면 이곳을 통과
{
	echo '존재하지 않는 주소';
	exit;
}
include '_func.common.php'; //기본적인 함수파일부터 불러온다.
$_GET['title']	= str_chk($_GET['title']);
$_GET['no']		= str_chk($_GET['no']);
$_GET['url']	= str_chk($_GET['url']);
if ($_GET['mode']=='' or $_GET['mode']=='view') //어떤 함수파일을 불러올껀지 확인하는곳
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
DB_query_start(); //이것 다음부터는 한번 디비를 연결하면 end가 나오기 전까지 끊지 않는다.
get_my_category($_SESSION['login_id'],$_GET['url']); 
/* 
 * 현재 접속한 클럽의 카테고리를 불러온다. 페이지를 열때마다 불러오지 않고
 * 쿠키를 이용해서 한번 불러온 정보는 다시 불러오지 않는다. 
 * 다른 위키홈페이지를 접속하면 해당위키의 카테고리는 불러온다
 */

exec_work(); // 작업시작
/*
 * exec_work() 는
 * $_GET['mode']를 이용해서 무슨작업인지 구별해서 작업을 시작한다.
 * exec_work()에서 mode에 맞는 작업을 찾지 못하면 page_view()를 호출해서 skin.php를 출력하면
 * skin.php에서는 필요한 함수를 직접 호출해서 사용하는 방식이다.
 */
?><DIV style="text-align:center;">query : <?php echo (int)$GLOBALS['db_cnt_2']?>, mtime : <?php echo mtime_diff($t_start_2, mtime())?> sec.</DIV><!-- <?php echo $join_level;?> --><?php
DB_query_end();
ob_end_flush();
function mtime(){$time = explode(' ', microtime());$usec = (double)$time[0];$sec = (double)$time[1];    return $sec + $usec;}
function mtime_diff($ts,$te){return sprintf("%2.3f" ,$te - $ts);} 
?>
