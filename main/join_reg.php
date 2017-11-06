<?php
include "../_config.php";
include "../_func.php";
ob_start();
$_POST['join_id'] = strtolower(str_chk($_POST['join_id']));
if ($_POST['p_type']<>'0') {
	session_start();
	if ($_SESSION['login_id']==''){
		go_back('로그인 후 이용해 주세요.',true);
	}
	if ($_SESSION['login_id']<>$config['admin']['id'] && $_SESSION['login_id']<>$_POST['join_id']){
		go_back('자신의 개인정보만 수정할 수 있습니다.',true);
	}
}
if ($_POST['p_type']=='0'){
if (strpos(','.$config['filter']['id'].',',','.$_POST['join_id'].',')!==false){go_back($config['msg']['join'][7],true);exit;}
if(!ereg("(^[0-9a-zA-Z]{4,12}$)",$_POST['join_id'])){
go_back($config['msg']['join'][9],true);
}elseif(!ereg("(^[0-9a-zA-Z]{4,12}$)",$_POST['join_pw'])){
go_back($config['msg']['join'][10],true);
}

$result = DB_query('SELECT id FROM '.$config['db_table']['user'].' where id=\''.trim($_POST['join_id']).'\' ');
$result2 = DB_query('SELECT id FROM '.$config['db_table']['user'].' where email=\''.trim($_POST['join_email']).'\' ');
$err_id = mysql_num_rows($result);
$err_email = mysql_num_rows($result2);
if ($err_id>0){
$tmp=$config['msg']['join'][6];//아이디가 있다
}elseif($err_email>0){
$tmp=$config['msg']['join'][8];//이메일이 있다
}

if ($err_id=='0'){
if ($err_email=='0'){
	$wdate = time();
	$tt2=DB_query('insert into '.$config['db_table']['user'].'(id,passwd,name,email,homepage,memo,wdate,ldate,view,accept) values("'.$_POST['join_id'].'","'.md5($_POST['join_pw']).'","'.$_POST['join_name'].'","'.$_POST['join_email'].'","'.$_POST['join_homepage'].'","'.$_POST['join_pr'].'","'.date("y-m-d h:i:s",$wdate).'","'.$wdate.'","'.$_POST['join_view'].'","1")');
	if ($tt2<>'') go_page($config['msg']['join'][0],$config['url']['main'].$config['file']['main_def']);
}else{
	go_back($tmp,true);
}
}else{
	go_back($tmp,true);
}

}elseif ($_POST['p_type']=="1"){
if ($_SESSION['login_id']==$config['admin']['id']){
	DB_query('update '.$config['db_table']['user'].' set passwd=\''.md5($_POST['join_pw']).'\' where id=\''.$_POST['join_id'].'\' ');
	go_back($config['msg']['join'][3],true);
}else{
	$result = DB_query('SELECT passwd FROM '.$config['db_table']['user'].' where id=\''.$_POST['join_id'].'\' ');
	if ($result<>''){
	$row=mysql_fetch_array($result);
	$p_get_pw = $row['passwd'];
	}
	if (md5($_POST['join_pw_2'])==$p_get_pw){

	go_back($config['msg']['join'][3],true) ;
	}else{
	go_back($config['msg']['join'][4],true);
	}
}
}elseif ($_POST['p_type']=="2"){
//그외 개인정보
$tt2='SELECT email FROM '.$config['db_table']['user'].' where id=\''.$_POST['join_id'].'\' ';
$tt3='SELECT id FROM '.$config['db_table']['user'].' where email=\''.trim($_POST['join_email']).'\' ';
$result = DB_query($tt2);
if ($result<>''){
$row=mysql_fetch_array($result);
$p_get_email = $row['email'];
}
if ($p_get_email<>$_POST['join_email'])
	{
		$result2 = DB_query($tt3);
		$err_email = mysql_num_rows($result2);
		if ($err_email=="0"){
		$wdate = time();
		$tt='update '.$config['db_table']['user'].' set name=\''.$_POST['join_name'].'\',ldate=\''.$wdate.'\',email=\''.$_POST['join_email'].'\',homepage=\''.$_POST['join_homepage'].'\',memo=\''.$_POST['join_pr'].'\',view=\''.$_POST['join_view'].'\',accept=\'0\' where id=\''.$_POST['join_id'].'\' ';
		}else{
		go_back($config['msg']['join'][8],true);
		}

	}else{
		$tt='update '.$config['db_table']['user'].' set name=\''.$_POST['join_name'].'\',email=\''.$_POST['join_email'].'\',homepage=\''.$_POST['join_homepage'].'\',memo=\''.$_POST['join_pr'].'\',view=\''.$_POST['join_view'].'\' where id=\''.$_POST['join_id'].'\' ';
	}


DB_query($tt);
go_back($config['msg']['join'][5],true);

}elseif ($_POST['p_type']=='3'){
	session_start();
	if ($_SESSION['login_id']<>$config['admin']['id'] && $_SESSION['login_id']<>$_POST['join_id']){
		go_back('자신의 개인정보만 수정할 수 있습니다.',true);
	}
	$get_data_count=count($_POST['category']);
	DB_Query('DELETE FROM '.$config['db_table']['category'].' WHERE id = \''.$_POST['join_id'].'\' and url = \''.$_POST['url'].'\';');
	if($_POST['join_id']<>'') {
		for($i=0;$i<$get_data_count;$i++){
			$query_tmp[]="\n".'(\''.$_POST['join_id'].'\',\''.$_POST['url'].'\',\''.$_POST['category'][$i].'\')';
		}
		if ($i>0) DB_Query('insert into '.$config['db_table']['category'].'(id,url,category) values '.implode(',',$query_tmp));
	}
go_page('저장하였습니다.\n다음 접속때 적용됩니다.',$config['url']['exec'].$config['file']['def'].'?url='.$_POST['url'].'&mode=update');
}
?>