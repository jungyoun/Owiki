<?php
	include "../_config.php";
	include "../_func.php";
	ob_start();
	session_start();
	if ($_SESSION['login_id']==''){
		go_back('�α��� �� �̿��� �ּ���.',true);
	}
	$_POST['make_url'] = strtolower(str_chk(trim($_POST['make_url'])));
	$_POST['make_title'] = str_chk(trim($_POST['make_title']));
	$_POST['make_pr'] = str_chk(trim($_POST['make_pr']));
	if (strpos(','.$config['filter']['url'].',',','.$_POST['make_url'].',')!==false){
		go_back('����Ҽ� ���� URL�Դϴ�.',true);
	}
	if( $_POST['make_title'] == '' ){
		go_back('������ �Է��� �ּ���.',true);
	}elseif( $_POST['make_pr'] == '' ){
		go_back('������ �Է��� �ּ���.',true);
	}
	if(!ereg("(^[0-9a-zA-Z]{4,30}$)",$_POST['make_url'])){
		go_back('URL�� �ּ� 4�ڿ��� 30�ڱ����� ������ �Ǵ� ���ڿ��� �մϴ�.',true);
	}elseif( strlen( $_POST['make_title'] ) > 100 ){
		go_back('������ ���̰� �ʹ� ��ϴ�.',true);
	}elseif( strlen( $_POST['make_pr'] ) > 100 ){
		go_back('������ ���̰� �ʹ� ��ϴ�.',true);
	}
$result = DB_query('select * from '.$config['db_table']['space'].' where url=\''.$_POST['make_url'].'\' and accept=\'2\' '); //�ߺ�Ȯ��
$result2 = DB_query('select * from '.$config['db_table']['space'].' where id=\''.$_SESSION['login_id'].'\' and accept=\'2\' '); //������Ű Ȯ��
$chk_url = mysql_num_rows($result);
$chk_my = mysql_num_rows($result2);
if ($chk_url>0){
	go_back('�̹� �����ϴ� URL�Դϴ�.',true);
}elseif($_SESSION['login_id']<>$config['admin']['id'] && $config['max']['make_wiki_space']<=$chk_my){
	go_page('���̻� ��Ű�� ������ �� �����ϴ�.:',$config['url']['main'].$config['file']['main_def']);
}
$create_date=time();
DB_query('insert into '.$config['db_table']['space'].'(id,accept,m_date,url) values(\''.$_SESSION['login_id'].'\',\'2\',\''.$create_date.'\',\''.$_POST['make_url'].'\') ');//��� ����Ʈ ���
mkdir ($config['dir']['data'].$_POST['make_url'], 0707);
//����־ �Ǵ°� ����
save_file($_POST['make_url'],'category','');
save_file($_POST['make_url'],'count','');
save_file($_POST['make_url'],'interwiki','');
save_file($_POST['make_url'],'update','');
save_file($_POST['make_url'],'menu','');
//��

//�����ʿ� ����
	$tmp_page='<?php'."\n".
	'$wiki[\'url\'] = \''.$_POST['make_url'].'\';'."\n".
	'$wiki[\'title\'] = \''.$_POST['make_title'].'\';'."\n".
	'$wiki[\'pr\'] = \''.$_POST['make_pr'].'\';'."\n".
	'$wiki[\'admin\'] = \''.$_SESSION['login_id'].'\';'."\n".
	'$wiki[\'type\'] = 0;'."\n".
	'$wiki[\'date\'] = \''.$create_date.'\';'."\n".
	'$wiki[\'skin\'] = \'default\';'."\n".
	'$wiki[\'start_page\'] = \'ó��ȭ��\';'."\n".
	'$wiki[\'start_page_max\'] = 1;'."\n".
	'$wiki[\'total_user\'] = 1;'."\n".
	'$wiki[\'total_page\'] = 0;'."\n".
	'$wiki[\'use_counter\'] = false;'."\n".
	'$wiki[\'use_rss\'] = false;'."\n".
	'?>';
save_file($_POST['make_url'],'page',$tmp_page);
//��

go_page('��Ÿ��� ��Ű�� �����Ǿ����ϴ�.',$config['url']['exec'].$config['file']['def'].'?url='.$_POST['make_url'].'&mode=admin&type=setting');
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