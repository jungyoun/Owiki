<?php
$db_connect = false; //false �̸� ������� ���� ���� //true�̸� ����� ����
$db_close = true; //true �̸� �׻� �۾��� ������� //false �� �۾��� ���� �Ȳ���
function mtime_func(){$time = explode( " ", microtime());$usec = (double)$time[0];$sec = (double)$time[1];    return $sec + $usec;}
function mtime_diff_func($ts,$te){return sprintf("%2.4f" ,$te - $ts);} 
function debug($text)
{
	$fp = fopen ('temp.txt', 'a+');
	fwrite ( $fp , $text );
	fclose ( $fp );
}
function DB_query($text,$debug=false) //��� ������
{
	global $config;
	//$debug=true; //���߸�忡�� �̰� Ȱ��ȭ ��Ű�� �μ��� ���� ������ ������ش�. ������
	$debug=false;// ������ ������ �̰� Ȱ��ȭ ��Ű�� �μ��� ���� debug���� ��� ���õȴ�. �������
	if ($GLOBALS['db_connect']===false){
		$GLOBALS['db_cnt']++;
		$GLOBALS['connection']=@mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) or die("DB������ �����Ͽ����ϴ�.");
		@mysql_select_db($config['db_name'],$GLOBALS['connection']);
		$GLOBALS['db_connect']=true;
	}
	$GLOBALS['db_cnt_2']++;
	$t_start_2 = mtime_func();

	$dbtemp = mysql_query($text,$GLOBALS['connection']);
	if ($debug===true){debug('����:'.$text.' ('.mtime_diff_func($t_start_2, mtime_func()).' sec)'."\n");}
	if ($GLOBALS['db_close']===true & $GLOBALS['db_connect']===true){DB_query_end();}
	return $dbtemp;
}
function DB_query_start()
{
	$GLOBALS['db_connect'] = false;
	$GLOBALS['db_close'] = false;
}
function view_login()
{
	global $config,$wiki,$join_level;
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['login'];
}
function cutstring($str,$len)//���ڿ� �ڸ���
{ 
	if (strlen($str) < $len) return $str;
	$str = substr($str, 0, $len);
	$i = 0;
	while ($len) {
	$j = $str[--$len];
	if (!(chr(0x00) < $j && chr(0x7F) > $j)) $i++;
	}
	if ($i % 2) $str = substr($str, 0, -1); 
	return $str;
}
function view_interwiki_list($list_max=35,$title_max=15)
{
	global $config;
	include $config['dir']['data'].$_GET['url'].'/interwiki.php';
	if (count($iw_list) > 0){
	while (list ($key, $val) = each ($iw_list)) {
		$tmp_iw.='<a href="'.$val['url'].'">'.$val['title']."</a><br>\n";
		//$tmp_iw.=$val['title'].""; //' '.$val['url'].';'."\n";
	}
	}else{
	$tmp_iw= '����';
	}
	echo $tmp_iw;
}
function view_new_list($list_max=35,$title_max=15)
{
	global $config;
	include $config['dir']['data'].$_GET['url'].'/update.php';
	$tmp_cnt_nc=count($nc_data);
	if ($tmp_cnt_nc>$config['max']['modify_list']) $tmp_cnt_nc=$config['max']['modify_list'];
	for ($i=0;$i<$tmp_cnt_nc;$i++)
	{
		if ($nc_data[$i][7]==0){
			$tmp_title=add_space($nc_data[$i][0]);
			if (strlen($tmp_title)>$title_max) $tmp_title=cutstring($tmp_title,$title_max-2).'..';
			if (date("m.d",$nc_data[$i]['1'])==date("m.d")){
			$tmp_time =date("H:i",$nc_data[$i]['1']);
			}else{
			$tmp_time =date("m.d",$nc_data[$i]['1']);
			}
			$get_new_con.=$tmp_time.'&nbsp;&nbsp;<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$nc_data[$i][4].'">'.$tmp_title.'</a><br>'."\n";
		}
		if ($list_max<$i) break;
	}
	if ($get_new_con<>''){
		echo $get_new_con;
	}else{
		echo '����';
	}
}
function DB_query_end()
{
	@mysql_close();
	$GLOBALS['db_connect']=false;
	$GLOBALS['db_close']=true;
}
function page_view()
{
	global $wiki,$join_level,$config;
	$type_name[0]='����';
	$type_name[1]='ȸ����';
	$type_name[2]='�����';

	if ($config['use']['counter'] and $wiki['use_counter']){
		$t_count =page_count($_GET['url'],$_SESSION['login_id']);
		$skin['main']['count_today']=&$t_count[0];
		$skin['main']['count_total']=&$t_count[1];
		$skin['main']['count_yesterday']=&$t_count[2];
		$skin['main']['count_max']=&$t_count[3];
	}
	$skin['main']['ver']=&$config['ver'];
	$skin['main']['title']=&$wiki['title'];
	$skin['main']['pr']=&$wiki['pr'];
	$skin['main']['type']=&$wiki['type'];
	$skin['main']['type_title']=&$type_name[$wiki['type']];
	$skin['main']['date']=&$wiki['date'];
	$skin['main']['admin']=&$wiki['admin'];
	$skin['main']['total_page']=&$wiki['total_page'];
	$skin['main']['total_user']=&$wiki['total_user'];
	$skin['main']['use_rss']=&$wiki['use_rss'];
	$skin['main']['use_counter']=&$wiki['use_counter'];
	if ($_GET['skin']<>'' and file_exists($config['dir']['skin'].$_GET['skin'].'/skin.php')) $wiki['skin']=$_GET['skin'];
	include $config['dir']['data'].$_GET['url'].'/menu.php';
	include $config['dir']['skin'].$wiki['skin'].'/skin.php';
}

function stripcode($text){
$conv_name=array(';',"'",'"','(',')','<','>');
$conv_value=array('&#59;','&#039;','&quot;','&#40;','&#41;','&lt;','&gt;');
return str_replace($conv_name,$conv_value,$text);
}
function titleto($pagename,$url,$get='n_no') // �������� �ʵ带 ������ ����
{
	global $config;
	$pagename = stripcode($pagename);
	if ($get=='n_date'){
	$result = DB_query('select '.$get.' from '.$config['db_table']['page_name'].' where n_del=\'0\' and n_title=\''.$pagename.'\' and n_url=\''.$url.'\' ');
	}else{
	$result = DB_query('select '.$get.' from '.$config['db_table']['page_name'].' where n_title=\''.$pagename.'\' and n_url=\''.$url.'\' ');
	}
if ($result<>''){
$row=mysql_fetch_array($result);
return $row[$get];
}
}
function get_write_level($no,$url) // �������� ������ ����
{
	global $config;
	$page_dir=idx($config['dir']['data'].$url,$no).'/'.$no.'.php';
	if( $no<>'' && file_exists( $page_dir )){
		include $page_dir;
		return $skin['write_level'];
		}
}
function no_to($no,$url,$get)
{
global $config;
$result = DB_query('select '.$get.' from '.$config['db_table']['page_name'].' where n_no=\''.$no.'\' and n_url=\''.$url.'\' ');
if ($result<>''){
$row=mysql_fetch_array($result);
return $row[$get];
}
}
function next_d_no($no,$d_no,$url)
{
global $config;
$result = DB_query('select d_no from '.$config['db_table']['page_data'].' where d_no<\''.$d_no.'\' and d_target=\''.$no.'\' and d_url=\''.$url.'\' order by d_no desc limit 1');
if ($result<>''){
$row=mysql_fetch_array($result);
return $row['d_no'];
//echo $row['d_no'];
}
}

function no_to_target($pageno,$next_no='0')
{
global $config;
$result = DB_query('select d_no from '.$config['db_table']['page_data'].' where d_target=\''.$pageno.'\' order by d_idx asc limit '.$next_no.',1 ');
if ($result<>''){
$row=mysql_fetch_array($result);
return $row['d_no'];
}
}
function idx($full_dir,$no) //���� �ε��� ���丮�� ����� ���� �Լ�
{
		//���߿� ��������� Ȯ���� ���� ���ܵ�
		$return_dir=$full_dir.'/page/'.(string)$no[strlen((string)$no)-1];
		if( is_dir( $return_dir )===false ){mkdir ($return_dir, 0707);}
		return $return_dir;
}
function exec_work()
{
switch($_GET['mode']){
	case ('dlistdel') : 
		exec_dlist_del();
		break;
	case ('join') : 
		exec_join();
		break;
	case ('delre') : 
		exec_delre();
		break;
	case ('del') : 
		exec_page_del();
		break;
	case ('insert') : 
		exec_insert();
		break;
	case ('admin_reg') : 
		exec_admin_reg();
		break;
	case ('member_reg') : 
		exec_member_reg();
		break;
	case ('wikidel') : 
		exec_wiki_del();
		break;
	case ('wikipass') : 
		exec_wiki_pass();
		break;
	default:
		page_view();
		break;
	}
}
function view_contents()
{
switch($_GET['mode']){
	case ('view') :
		view_page();	
		break;
	case ('list') :
		view_list();	
		break;
	case ('dlist') :
		view_dlist();	
		break;
	case ('edit') : 
		view_edit();
		break;
	case ('admin') : 
		view_admin();
		break;
	case ('update') : 
		view_update();
		break;
	case ('preview') : 
		view_preview();
		break;
	case ('history') : 
		view_history();
		break;
	case ('result') : 
		view_result();
		break;
	case ('list_category') : 
		view_list_category();
		break;
	case ('delview') :
		view_delview();
		break;
	case ('diff') : 
		view_diff();
		break;
	case ('admin') : 
		view_admin();
		break;
	case ('config') :
		view_config();
		break;
	}
}
function page_level_check($s_type){
	global $config,$wiki,$join_level;
if ($wiki['type']>1){
		if( ( ($s_type==0 or $s_type==1 or $s_type==2) and $join_level>1) or $join_level>2 ){
			return true;
		}else return false;
}else{
		if(
			($s_type==0) or 
			($s_type==1 and $join_level>0) or 
			($s_type==2 and $join_level>1) or 
			($s_type==3 and $join_level>2)
		){
			return true;
		}else return false;
}
}
function view_page()
{
	global $config,$wiki;
	$_GET['highlight']=str_chk($_GET['highlight']);
	$page_dir=idx($config['dir']['data'].$_GET['url'],$_GET['no']).'/'.$_GET['no'].'.php';
	$fe=file_exists( $page_dir );
	if( $fe and $_GET['no']<>'')
		{
		include $page_dir;
		if ($skin['view_level']<3 and $wiki['type']>1) $skin['view_level']=2;
		$skin['view_level_title']=$config['title']['join_level'][$skin['view_level']];
		$skin['write_level_title']=$config['title']['join_level'][$skin['write_level']];
		$skin['no']=&$_GET['no'];
		$skin['view']=page_level_check($skin['view_level']);
	}
	$skin['contents_count']=count($skin['contents']);
	if ($_GET['highlight']<>'') { //���̶���Ʈ �ܾ �ԷµǸ�
		for ($i2=0;$i2<$skin['contents_count'];$i2++){
			$break_point=0;
			//echo $skin['contents'][$i2];
			for ($i=0;$i<strlen($skin['contents'][$i2]);$i++){  
				//������ ����
				if ($skin['contents'][$i2][$i]=='<'){ //�±׽���
				//�±װ� ���۵Ǹ� �ٷ��� �극��ũ����Ʈ���� ���� i������ �߶� �����Ѵ�
					$tag_start=true;
					$tmp_string = str_replace($_GET['highlight'],'<span class="highlight_color">'.$_GET['highlight'].'</span>',substr($skin['contents'][$i2],$break_point,$i-$break_point));
					//echo '[a:'.$tmp_string.']';
					$tmp_content[$i2].=$tmp_string;//���⼭ ���̶���Ʈ����
					$break_point=$i;
				}elseif ($skin['contents'][$i2][$i]=='>'){ //�±׳�
				//�±װ� ������ �̰�
					$tag_start=false;
					$tmp_string = substr($skin['contents'][$i2],$break_point,$i-$break_point+1);
					//echo '[b:'.$tmp_string.']';
					$tmp_content[$i2].=	$tmp_string;
					$break_point=$i+1;
				}
			}
			if (!$tag_start){
				$tmp_string = str_replace($_GET['highlight'],'<span class="highlight_color">'.$_GET['highlight'].'</span>',substr($skin['contents'][$i2],$break_point,$i-$break_point));
				//echo '[c:'.$tmp_string.']';
				$tmp_content[$i2].=$tmp_string;//���⼭ ���̶���Ʈ����
			}
		}
		$skin['contents']=&$tmp_content;	
	}
include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['view'];
}
function go_back($msg,$back=false)
{
//go_back
	ob_end_clean(); //���ݱ��� ��µǷ������� ����� �Ʒ��� �ִ°͸� ����Ѵ�
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
	if ($msg<>'') go_back($msg);
	echo '
	<script language="javascript" type="text/javascript">
	<!--
	location.href="'.$url.'";
	-->
	</script>';
	exit;
}
function load_file($url,$filename)
{
	global $config;

$file_tmp=$config['dir']['data'].$url.'/'.$filename.'.php';
$fe=file_exists( $file_tmp );
if( $fe===true and filesize( $file_tmp )>0)
	{
		$fp = fopen( $file_tmp ,'r' );
		$get_page = fread( $fp, filesize( $file_tmp ) );
		fclose( $fp );
	}
	return $get_page;
}
function save_file($url,$filename,$text,$backup=false)
{
global $config;
	$tmp_file=$config['dir']['data'].$url.'/'.$filename.'.php';
	if ($backup) @copy($tmp_file, $config['dir']['data'].$url.'/'.$filename.'.backup.php');
	$fp = fopen ($tmp_file, 'w');
	if(flock( $fp,LOCK_EX )) fwrite( $fp , $text );
	flock( $fp, LOCK_UN ); 
	fclose( $fp );
}
function restore_file($url,$filename)
{
	global $config;
	@copy($config['dir']['data'].$url.'/'.$filename.'.backup.php',$config['dir']['data'].$url.'/'.$filename.'.php');
}
function page_count($url,$id) // ī����3
{
	global $config;
	$tmp_date=date("Ymd",time());
	$bip=strpos($_SERVER['REMOTE_ADDR'],'66.249.');//���� �ֵ弾���� ī���� �ø��� ���� �����Ѵ�.
	@include $config['dir']['data'].$_GET['url'].'/count.php';
	if ($total_count=='') {
		restore_file($_GET['url'],'count'); //������ ���� �������� ����
		@include $config['dir']['data'].$_GET['url'].'/count.php';
		$today_count++; //�������� �ö󰡾� �ߴ��� �ȿö����״ϱ�
	}
	if (($last_ip<>$_SERVER['REMOTE_ADDR'] or $last_date<>$tmp_date) and $bip===false){
		if ($last_date<>$tmp_date) 
		{
			//�Ϸ簡 ������ ���� ī���͸� ���� ī���Ϳ� ������ �ʱ�ȭ
			if ($max_count<$today_count)
			{
				$max_count=$today_count;
			}
			$yesterday_count=$today_count;
			$today_count=0;
		}
		if ($total_count==''){$total_count=0;}
		if ($yesterday_count==''){$yesterday_count=0;}
		if ($max_count==''){$max_count=0;}
	$tmp_count='<?$today_count='.++$today_count.';$total_count='.++$total_count.';$yesterday_count='.$yesterday_count.';$max_count='.$max_count.';$last_ip="'.$_SERVER['REMOTE_ADDR'].'";$last_date="'.$tmp_date.'";?>';
	save_file($_GET['url'],'count',$tmp_count,true);
	}
	return array($today_count,$total_count,$yesterday_count,$max_count);
}
function get_join_level() //�ش���Ű���� �׻���� ���� 0 �մ� 1 ��ȸ�� 2 ��ȸ�� 3 ���
{
	global $config,$wiki;
if ($_SESSION['login_id']<>''){
	if ($_SESSION['login_id']==$config['admin']['id'] || $wiki['admin']==$_SESSION['login_id']){
		return 3;
	}else{
		$result2 = DB_query('select accept from '.$config['db_table']['space'].' where id=\''.$_SESSION['login_id'].'\' and url=\''.$_GET['url'].'\' ');
		if ($result2<>''){
			$row2=mysql_fetch_array($result2);
			if ($row2['accept']==''){
				return 0;
			}elseif($row2['accept']=='0'){
				return 1;
			}elseif($row2['accept']=='1'){
				return 2;
			}
		}else return 0;
	}
}else return 0;
}
function page_join()
{
	global $wiki,$config;
	if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin'] and $_SESSION['login_id']<>''){
		return true;
	}else{
		if ($wiki['type']==0){
			return true;
		}elseif ($wiki['type']>0){
			if (get_join_level()>=2) return true;
		}
	}
}
//������� ��Ű����
function add_category($url,$array_category,$run) { //���� ��Ű�� �ش�url�� �з��� ����� �߰����ִ°�
if (!$run) {$tmp_cookie=$_COOKIE['user_category'];}
if (count($array_category)>0){
$tmp_cookie=$tmp_cookie.'&CM_'.$url.'=load;'.implode(';',$array_category);
setcookie('user_category',$tmp_cookie);
}else{
$tmp_cookie=$tmp_cookie.'&CM_'.$url.'=load;';
setcookie('user_category',$tmp_cookie);
}
}
function cut_my_category() //���� Ŭ���� �з��� �ҷ��� �迭�� ��ȯ�Ѵ�.
{
parse_str($_COOKIE['user_category']);
$tmp_url='CM_'.$_GET['url'];
$tmp_str=$$tmp_url;
$tmp_str_2=substr($tmp_str,5,strlen($tmp_str)-5);
if (strlen(trim($tmp_str_2))>0){
return explode(';',$tmp_str_2);
}else{
return array();
}
}
function chk_category($url) //���� ������ Ŭ���� �з��� �ҷ��Դ��� Ȯ���Ѵ�.
{
parse_str($_COOKIE['user_category']);
$tmp_url='CM_'.$url;
$tmp_str=$$tmp_url;
$tmp_str_2=substr($tmp_str,0,4);
if ($tmp_str_2=='load'){
return true;
}else{
return false;
}
}

function get_my_category($login_id,$url,$run=false) {  //���̵�� Ŭ���ּҿ� ���� �з������� ���������� �з�� �̹� �ε�Ȱ��� �ٽ� �ҷ����� �ʴ´�. ��, $run�� ���϶��� ������ ������´�. ������ �����ؾߵɶ� $run���
	global $config;
	if (!chk_category($url) or $run){
	if($login_id<>''){
		$result=DB_query('SELECT category from '.$config['db_table']['category'].' where id=\''.$login_id.'\' and url=\''.$url.'\'');
	}
	if ($result<>'') {
		while( $row=mysql_fetch_array($result)) {
			$array_category[]=$row['category'];
		}
		if(count($array_category)>0) {
		add_category($url,$array_category,$run);
		}else{
		$array_category=array();
		add_category($url,$array_category,$run);
		}
	}
	}
}
function str_chk($text){
$str=array('.','<','>','\'','"','/','\\','?','#','@','%','$','*','-','_','[',']','+');
//; ������
return trim(str_replace($str,'',$text));
}
function add_space($title){
	$tmp_0=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$tmp_1=array('A ','B ','C ','D ','E ','F ','G ','H ','I ','J ','K ','L ','M ','N ','O ','P ','Q ','R ','S ','T ','U ','V ','W ','X ','Y ','Z ');
	$tmp_2=array(' A',' B',' C',' D',' E',' F',' G',' H',' I',' J',' K',' L',' M',' N',' O',' P',' Q',' R',' S',' T',' U',' V',' W',' X',' Y',' Z');
	return trim(str_replace($tmp_1,$tmp_0,str_replace($tmp_0,$tmp_2,' '.$title.' ')));
}
?>