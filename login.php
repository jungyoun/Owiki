<?php
session_start();
if ($_GET['mode']=='logout'){
	session_unregister('login_id');
	session_unregister('login_name');
	setcookie('my_wiki','',time()-3600);
	setcookie('user_category','',time()-3600);
	echo '
	<script language="javascript" type="text/javascript">
	<!--
		location.replace("'.$_SERVER['HTTP_REFERER'].'");
	-->
	</script>';
	exit;
}
include '_config.php';
include '_func.common.php';
$_POST['login_id'] = str_chk(strtolower($_POST['login_id']));
$p_login_pw = md5($_POST['login_pw']);

$wdate = date("y-m-d h:i:s",time());
$tmp ='SELECT passwd,name from '.$config['db_table']['user'].' where accept=\'1\' and id=\''.$_POST['login_id'].'\' ';
$result=DB_query($tmp);
if ($result<>'') $row=mysql_fetch_array($result);
$passwd = $row['passwd'];
$p_login_name = $row['name'];
if ($_POST['save_id']=='on') {
	SetCookie('save_id',$_POST['login_id'],time() + 3600 * 24 * 30 );
}else{
	SetCookie('save_id','',time()-3600);
}
if ($passwd<>'' && $passwd==$p_login_pw){
		//이부분에서 자신이 가입되어 있는 위키를 불러온다.
	//한번 불러오면 쿠키로 굽고 쿠키가 있으면 db에 접속하지 않는다
	$result = DB_query('select url from '.$config['db_table']['space'].' where id=\''.$_POST['login_id'].'\' ');
	if ($result<>'') $t2 = mysql_num_rows($result);
	$tmp_combobox.='<select class="my_wiki_combobox" name="mywiki" OnChange=\'if(this.value!=""){location.href="'.$config['url']['exec'].$config['file']['def'].'?url="+this.value;}\'>';
	$tmp_combobox.="\n".'<option value="">내가 가입한 위키</option>'."\n".'<option value="">--------------</option>'."\n";
	if ($t2>0)
	{
		
		for($i=0;$i<$t2;$i++)
		{
			$row=mysql_fetch_array($result);
			unset($wiki);
			$tmp_file = $config['dir']['data'].$row['url'].'/page.php';
			if (file_exists($tmp_file))
			{
					include $tmp_file;
					$tmp_combobox.='<option value="'.$row['url'].'" >'.$wiki['title'].'</option>'."\n";
			}
		}
	}else{
		$tmp_combobox.='<option value="">없음</option>'."\n";
	}
	$tmp_combobox.='</select>';
	$my_wiki=&$tmp_combobox;

	$_SESSION['login_id']=$_POST['login_id'];
	$_SESSION['login_name']=$p_login_name;
	session_register("login_id");
	session_register("login_name");
	SetCookie('my_wiki',$my_wiki);
	DB_query('UPDATE '.$config['db_table']['user'].' SET ldate=\''.time().'\',login_ok=login_ok+1,login_ip=\''.$_SERVER['REMOTE_ADDR'].'\' where id=\''.$_POST['login_id'].'\' ');
	echo '
	<script language="javascript" type="text/javascript">
	<!--
	location.replace("'.$_SERVER['HTTP_REFERER'].'");
	-->
	</script>';
}else{
	DB_query('UPDATE '.$config['db_table']['user'].' SET login_err=login_err+1,login_ip=\''.$_SERVER['REMOTE_ADDR'].'\' where id=\''.$_POST['login_id'].'\' ');
	echo "
	<script language='javascript' type='text/javascript'>
	<!--
	alert('아이디가 없거나 비밀번호가 잘못되었습니다.');
	history.go(-1);
	-->
	</script>";
}

?>