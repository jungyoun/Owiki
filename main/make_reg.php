<?php
	include "../_config.php";
	include "../_func.php";
	ob_start();
	session_start();
	if ($_SESSION['login_id']==''){
		go_back('로그인 후 이용해 주세요.',true);
	}
	$_POST['make_url'] = strtolower(str_chk(trim($_POST['make_url'])));
	$_POST['make_title'] = str_chk(trim($_POST['make_title']));
	$_POST['make_pr'] = str_chk(trim($_POST['make_pr']));
	if (strpos(','.$config['filter']['url'].',',','.$_POST['make_url'].',')!==false){
		go_back('사용할수 없는 URL입니다.',true);
	}
	if( $_POST['make_title'] == '' ){
		go_back('제목을 입력해 주세요.',true);
	}elseif( $_POST['make_pr'] == '' ){
		go_back('설명을 입력해 주세요.',true);
	}
	if(!ereg("(^[0-9a-zA-Z]{4,30}$)",$_POST['make_url'])){
		go_back('URL은 최소 4자에서 30자까지의 영문자 또는 숫자여야 합니다.',true);
	}elseif( strlen( $_POST['make_title'] ) > 100 ){
		go_back('제목의 길이가 너무 깁니다.',true);
	}elseif( strlen( $_POST['make_pr'] ) > 100 ){
		go_back('설명의 길이가 너무 깁니다.',true);
	}
$result = DB_query('select * from '.$config['db_table']['space'].' where url=\''.$_POST['make_url'].'\' and accept=\'2\' '); //중복확인
$result2 = DB_query('select * from '.$config['db_table']['space'].' where id=\''.$_SESSION['login_id'].'\' and accept=\'2\' '); //소유위키 확인
$chk_url = mysql_num_rows($result);
$chk_my = mysql_num_rows($result2);
if ($chk_url>0){
	go_back('이미 존재하는 URL입니다.',true);
}elseif($_SESSION['login_id']<>$config['admin']['id'] && $config['max']['make_wiki_space']<=$chk_my){
	go_page('더이상 위키를 개설할 수 없습니다.:',$config['url']['main'].$config['file']['main_def']);
}
$create_date=time();
DB_query('insert into '.$config['db_table']['space'].'(id,accept,m_date,url) values(\''.$_SESSION['login_id'].'\',\'2\',\''.$create_date.'\',\''.$_POST['make_url'].'\') ');//디비에 사이트 등록
mkdir ($config['dir']['data'].$_POST['make_url'], 0707);
//비어있어도 되는것 시작
save_file($_POST['make_url'],'category','');
save_file($_POST['make_url'],'count','');
save_file($_POST['make_url'],'interwiki','');
save_file($_POST['make_url'],'update','');
save_file($_POST['make_url'],'menu','');
//끝

//내용필요 시작
	$tmp_page='<?php'."\n".
	'$wiki[\'url\'] = \''.$_POST['make_url'].'\';'."\n".
	'$wiki[\'title\'] = \''.$_POST['make_title'].'\';'."\n".
	'$wiki[\'pr\'] = \''.$_POST['make_pr'].'\';'."\n".
	'$wiki[\'admin\'] = \''.$_SESSION['login_id'].'\';'."\n".
	'$wiki[\'type\'] = 0;'."\n".
	'$wiki[\'date\'] = \''.$create_date.'\';'."\n".
	'$wiki[\'skin\'] = \'default\';'."\n".
	'$wiki[\'start_page\'] = \'처음화면\';'."\n".
	'$wiki[\'start_page_max\'] = 1;'."\n".
	'$wiki[\'total_user\'] = 1;'."\n".
	'$wiki[\'total_page\'] = 0;'."\n".
	'$wiki[\'use_counter\'] = false;'."\n".
	'$wiki[\'use_rss\'] = false;'."\n".
	'?>';
save_file($_POST['make_url'],'page',$tmp_page);
//끝

go_page('당신만의 위키가 개설되었습니다.',$config['url']['exec'].$config['file']['def'].'?url='.$_POST['make_url'].'&mode=admin&type=setting');
/*
category<br>
count<br>
info<br>
interwiki<br>
menu<br>
page<br>
update<br>
*/
?>