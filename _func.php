<?php
include_once '_func.common.php';
function title_sp($title){
$tmp_0=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$tmp_1=array('A ','B ','C ','D ','E ','F ','G ','H ','I ','J ','K ','L ','M ','N ','O ','P ','Q ','R ','S ','T ','U ','V ','W ','X ','Y ','Z ');
$tmp_2=array(' A',' B',' C',' D',' E',' F',' G',' H',' I',' J',' K',' L',' M',' N',' O',' P',' Q',' R',' S',' T',' U',' V',' W',' X',' Y',' Z');
return trim(str_replace($tmp_1,$tmp_0,str_replace($tmp_0,$tmp_2,$title)));
}
function page_list_save()//���� �ö�� �� ����� ���Ϸ� ����
{
$plist=get_modify_list();
$icr=count($plist);//update `owiki_page_name` set n_date_start=n_date WHERE 1
for($ic=0;$ic<$icr;$ic++){
if ($plist[$ic][0]<>''){
$update_list.='$nc_data[]=array(\''.$plist[$ic][0].'\',\''.$plist[$ic][1].'\',\''.$plist[$ic][2].'\',\''.$plist[$ic][3].'\',\''.$plist[$ic][4].'\',\''.$_GET['url'].'\',\''.$plist[$ic][5].'\','.$plist[$ic][6].','.$plist[$ic][7].');'."\n";
}
}
$newcon="<?\n".$update_list.'?>';
save_file($_GET['url'],'update',$newcon);
}
function page_info_save(){ //�̰͵� ���� ������ ���Ϸ� ����
	global $wiki,$config;
	$result = DB_query('select count(no) from '.$config['db_table']['space'].' where accept=\'1\' and url=\''.$_GET['url'].'\' ');
	$result2 = DB_query('select count(*) from '.$config['db_table']['page_name'].' where n_del=\'0\' and n_url=\''.$_GET['url'].'\' ');
	DB_query('update '.$config['db_table']['space'].' set u_date=\''.time().'\' where accept=\'2\' and url=\''.$_GET['url'].'\' ');
	if ($result<>'') $row=mysql_fetch_row($result);
	if ($result2<>'') $row2=mysql_fetch_row($result2);
	$total_user=(int)$row[0];
	$total_data=(int)$row2[0];
	$tmp='<?php'."\n".
	'$wiki[\'url\'] = \''.$wiki['url'].'\';'."\n".
	'$wiki[\'title\'] = \''.$wiki['title'].'\';'."\n".
	'$wiki[\'pr\'] = \''.$wiki['pr'].'\';'."\n".
	'$wiki[\'admin\'] = \''.$wiki['admin'].'\';'."\n".
	'$wiki[\'type\'] = '.$wiki['type'].';'."\n".
	'$wiki[\'date\'] = \''.$wiki['date'].'\';'."\n".
	'$wiki[\'skin\'] = \''.$wiki['skin'].'\';'."\n".
	'$wiki[\'start_page\'] = \''.$wiki['start_page'].'\';'."\n".
	'$wiki[\'total_user\'] = '.$total_user.';'."\n".
	'$wiki[\'total_page\'] = '.$total_data.';'."\n";
	if ( $wiki['use_rss'] ) 
		$tmp.='$wiki[\'use_rss\'] = true;'."\n";
	else 
		$tmp.='$wiki[\'use_rss\'] = false;'."\n";
	if ( $wiki['use_counter'] ) 
		$tmp.='$wiki[\'use_counter\'] = true;'."\n";
	else 
		$tmp.='$wiki[\'use_counter\'] = false;'."\n";
	$tmp.='?>';
	save_file($_GET['url'],'page',$tmp,true);
}
function page_wiki_join($url,$id,$name)
{
	global $config,$wiki;
	$result = DB_query('select count(no) from '.$config['db_table']['space'].' where id=\''.$id.'\' and url=\''.$url.'\' ');
	$row=mysql_fetch_row($result);
	$tcl=$row[0];
	if($tcl>0){
		DB_query('delete from '.$config['db_table']['space'].' where id=\''.$id.'\' and url=\''.$url.'\' ');
		page_info_save();
		return 2;
	}else{
		$tmp_time=time();
	if ($wiki['type']==0)
		{
			DB_query('insert into '.$config['db_table']['space'].'(id,accept,url,m_date,u_date) values(\''.$id.'\',\'1\',\''.$url.'\',\''.$tmp_time.'\',\''.$tmp_time.'\') ');
		}else{
			DB_query('insert into '.$config['db_table']['space'].'(id,accept,url,m_date,u_date) values(\''.$id.'\',\'0\',\''.$url.'\',\''.$tmp_time.'\',\''.$tmp_time.'\') ');
		}
		page_info_save();
		return $wiki['type'];
//�̰����� ����,���������,Ż�� �ð� �ִ� *
//�켱 $id�� $url�� ���Ե��� Ȯ���Ѵ� *
//���������� owiki_user_2���� ���� �ϰ� type=2�� ������ *
//�������� �ʾ����� owiki_page ���� Ÿ���� ã�Ƽ�
//Ÿ���� 0�̸� owiki_user_2�� �߰���Ű�� accept=1���� ����
//Ÿ���� 1�̸� owiki_user_2�� �߰���Ű�� accept=0���� ���д�.
	}
}

function page_load($pagename,$url,$del='0') // �������� ������ ã�� �Լ�
{
	global $config;
if ($del==''){
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where a.n_title=\''.addslashes($pagename).'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}else{
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where b.d_del=\''.$del.'\' and a.n_title=\''.addslashes($pagename).'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}
$result = DB_query($tmp);
if ($result<>''){
$row=mysql_fetch_array($result);
$row['n_title'] = stripslashes($row['n_title']);
$row['d_content'] = stripslashes($row['d_content']);
return $row;
}
}
function page_load_d_no($pageno,$url,$del='0') // db_page�� d_no��ȣ�� ã��
{
global $config;
if ($del==''){
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_category,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where b.d_no=\''.$pageno.'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}else{
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_category,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where b.d_del=\''.$del.'\' and b.d_no=\''.$pageno.'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}
//echo $tmp.'<br>';
$result = DB_query($tmp);
if ($result<>''){
$row=mysql_fetch_array($result);
$row['n_title'] = stripslashes($row['n_title']);
$row['d_content'] = stripslashes($row['d_content']);
return $row;
}
}
function page_load_no($pageno,$url,$del='0') // db_page�� d_no��ȣ�� ã��
{
global $config;
if ($del==''){
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_category,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where a.n_no=\''.$pageno.'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}else{
$tmp='select a.n_no,a.n_title,a.n_date,a.n_del,a.n_url,b.d_no,b.d_own,b.d_content,b.d_date,b.d_view_level,b.d_write_level,b.d_ip,b.d_target,b.d_category,b.d_use_html from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where b.d_del=\''.$del.'\' and a.n_no=\''.$pageno.'\' and a.n_url=\''.$url.'\' and b.d_target=a.n_no order by b.d_idx asc';
}
//echo $tmp.'<br>';
$result = DB_query($tmp);
if ($result<>''){
$row=mysql_fetch_array($result);
$row['n_title'] = stripslashes($row['n_title']);
$row['d_content'] = stripslashes($row['d_content']);
return $row;
}
}

function page_del_re($no,$url,$id) //��������
{
	global $config;
	$get_page=page_load_d_no($no,$url,1);
	$get_page_2=page_load_no($get_page['n_no'],$url,0);
	if ( page_level_check($get_page_2['d_write_level']) && page_level_check($get_page['d_write_level']) ) {
	page_write(
		$get_page['n_title'],
		$get_page['d_content'],
		$url,$id,$get_page['d_view_level'],
		$get_page['d_write_level'],
		$get_page['d_category'],
		$get_page['d_use_html']
	);
	} else {
	go_back($config['msg']['common'][0],true);
	}
}
function plus_day($day){
return mktime(0,0,0,date('m'),date('d')+$day+1,date('Y'));
}
function get_modify_list() // �ֱٿ� ������ ����� �̾��ش�.
{
	global $config;
	$dbtemp='select a.n_no,a.n_title,a.n_date,b.d_own,b.d_ip,b.d_category,a.n_del,a.n_date_start from '.$config['db_table']['page_name'].' a, '.$config['db_table']['page_data'].' b where b.d_date=a.n_date and a.n_url=\''.$_GET['url'].'\' and b.d_date>\''.plus_day(-$config['max']['modify_list_day']).'\' order by b.d_date desc';
	$result = DB_query($dbtemp);
	if ($result<>'') $t2 = mysql_num_rows($result);
	for($i=0;$i<$t2;$i++)
	{
		$row=mysql_fetch_array($result);
		if ($tmp_title<>$row['n_title'])
		{
			$gettitle[$i][0] = $row['n_title'];
			$gettitle[$i][1] = $row['n_date'];
			$gettitle[$i][2] = $row['d_ip'];
			$gettitle[$i][3] = $row['d_own'];
			$gettitle[$i][4] = $row['n_no'];
			$gettitle[$i][5] = $row['d_category'];
			$gettitle[$i][6] = $row['n_del'];
			$gettitle[$i][7] = $row['n_date_start'];
		}
		$tmp_title= $row['n_title'];
	}
return $gettitle;
}
function page_search($word,$url,$page=0) // ����� ã�´�.
{
	global $config,$join_level;
	$dbtemp='select a.n_title as title,b.d_content as contents from '.$config['db_table']['page_name'].' a,'.$config['db_table']['page_data'].' b where b.d_del=\'0\' and a.n_del=\'0\' and a.n_url=\''.$url.'\' and a.n_no=b.d_target and ( ( b.d_content like \'%'.$word.'%\' and b.d_view_level<=\''.$join_level.'\') or a.n_title like \'%'.$word.'%\') order by a.n_title asc limit '.($page*$config['max']['result_list']).','.($config['max']['result_list']+1);
	$result = DB_query($dbtemp);
	if ($result<>'') $t2 = mysql_num_rows($result);
	for($i=0;$i<$t2;$i++){
		$row=mysql_fetch_array($result);
		$gettitle[]= $row;
	}
	return $gettitle;
}
function page_write($title,$content,$url,$own,$vtype,$wtype,$category='',$use_html='') // ��������.
{
	global $config,$wiki;
	$now_time=time();
	$title=trim(str_chk(stripslashes($title)));
	$content=stripslashes($content);
	$category=urldecode($category);
	//$content = str_replace("\r",'',$content); //owiki_user_2
	$tmp_asc=addslashes($title['0'].$title['1']);
	//$title = str_replace('"','&quot;',$title);
	$no=titleto($title,$url);
	$_GET['no']=&$no;
	if ($no<>'')
	{
		$result99=DB_query('SELECT n_del FROM '.$config['db_table']['page_name'].' where n_url=\''.$url.'\' and n_no=\''.$no.'\' ;');
		if ($result99<>'') $row99=mysql_fetch_array($result99);
		if ($row99['n_del']=='1'){
		//����� �츮�� �κ��� ��ü���� ���ѿ� ���� ���Ѱɷ��� �Ѵ�.
			if ($config['max']['make_wiki_page']>0 && $wiki['total_page']>=$config['max']['make_wiki_page']){
				go_back($config['msg']['write'][0],true);
			}
		}
		DB_query('update '.$config['db_table']['page_name'].' set n_date=\''.$now_time.'\', n_del=\'0\' where n_url=\''.$url.'\' and n_no=\''.$no.'\' ');
	}else{
		if ($config['max']['make_wiki_page']>0 && $wiki['total_page']>=$config['max']['make_wiki_page']){
			go_back($config['msg']['write'][0],true);
		}
		DB_query('insert into '.$config['db_table']['page_name'].'(n_title,n_title_idx,n_date,n_date_start,n_del,n_url) values(\''.addslashes($title).'\',\''.strtolower($tmp_asc).'\',\''.$now_time.'\',\''.$now_time.'\',\'0\',\''.$url.'\') ');
		$no=titleto($title,$url);
	}
	$result3=DB_query('SELECT MIN(d_idx)-1 FROM '.$config['db_table']['page_data'].';');
	if ($result3<>'') $row3=mysql_fetch_row($result3);
	$p_idx_min=$row3[0];
	DB_query('update '.$config['db_table']['page_data'].' set d_date=\''.($now_time-1).'\',d_del=\'1\',d_category=\''.$category.'\',d_use_html=\''.$use_html.'\' where d_url=\''.$url.'\' and d_del=\'0\' and d_target=\''.$no.'\'');
	DB_query('insert into '.$config['db_table']['page_data'].'(d_idx,d_content,d_own,d_date,d_view_level,d_write_level,d_ip,d_target,d_del,d_url,d_category,d_use_html) values(\''.$p_idx_min.'\',\''.addslashes($content).'\',\''.$own.'\',\''.$now_time.'\',\''.$vtype.'\',\''.$wtype.'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.$no.'\',\'0\',\''.$url.'\',\''.$category.'\',\''.$use_html.'\') ');
	page_write_htm($title,page_conv($content,$url,$use_html),$url,$own,$vtype,$wtype,$category);
}
function page_write_htm($title,$content,$url,$own,$vtype=0,$wtype=0,$category) // ���Ϸ� ����.
{
	global $config;
	if($title<>''){
		$no=titleto($title,$url);
		$_GET['no']=&$no;
	}
	$from_page_dir=idx($config['dir']['data'].$url,$no).'/'.$no.'.php';
	$page_dir_2=$config['dir']['data'].$url;
	if( !is_dir( $page_dir_2 ))
	{
	mkdir ($page_dir_2, 0707);
	}
	$tmp_save_text= "<?\n".
		'$skin["view_level"] = '.(int)$vtype.';'."\n".
		'$skin["write_level"] = '.(int)$wtype.';'."\n".
		'$skin["title"] = "'.$title.'";'."\n".
		'$skin["category"] = "'.$category.'";'."\n".
		'$skin["own"] = "'.$own.'";'."\n".
		'$skin["ip"] = "'.$_SERVER['REMOTE_ADDR'].'";'."\n".
		'$skin["date"] = "'.time().'";'."\n";
	for ($i=0;$i<count($content);$i++){
		if (trim($content[$i])<>''){
			$tmp_save_text.=
				'$skin["contents"][] = \''.str_replace(array('\\',"'"),array('\\\\',"\'"),$content[$i]).'\';'."\n";
		}
	}
	$tmp_save_text.= 		
		"\n?>";
	$fp = fopen ($from_page_dir, 'w');
	fwrite ( $fp , $tmp_save_text );
	fclose ( $fp );
	@chmod($from_page_dir,0707);
	return $title_form_tmp;
}
function page_del($no,$url,$id) { //���� �����
	global $config;
	$now_time=time();
	//$no=titleto($title,$url);
	$page_dir=idx($config['dir']['data'].$url,$no).'/'.$no.'.php';
	@unlink($page_dir);
	DB_query('update '.$config['db_table']['page_name'].' set n_del=\'1\', n_date=\''.$now_time.'\' where n_url=\''.$url.'\' and n_no=\''.$no.'\' ');
	DB_query('update '.$config['db_table']['page_data'].' set d_date=\''.$now_time.'\',d_del=\'1\',d_own=\''.$_SESSION['login_id'].'\',d_ip=\''.$_SERVER['REMOTE_ADDR'].'\' where d_del=\'0\' and d_target=\''.$no.'\' ');
}
function exec_member_reg() {
	global $wiki,$config;
	if ($_SESSION['login_id']<>''){
		if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin']){
			switch($_POST['type']){
				case ('0') : 
					//	
					if (count($_POST['id_1'])>0)
					{
						$tmp='id = "'.implode('" or id = "',$_POST['id_1']).'"';
						DB_query('update '.$config['db_table']['space'].' set accept=\'0\' where ('.$tmp.') and url=\''.$_GET['url'].'\' and accept=\'1\' ');
						go_back('',true);
					}else{
						go_back('���̵� ������ �ּ���.',true);
					}
					break;
				case ('1') : 
					if (count($_POST['id_0'])>0)
					{
						$tmp='id = "'.implode('" or id = "',$_POST['id_0']).'"';
						DB_query('update '.$config['db_table']['space'].' set accept=\'1\' where ('.$tmp.') and url=\''.$_GET['url'].'\' and accept=\'0\' ');
						go_back('',true);
					}else{
						go_back('���̵� ������ �ּ���.',true);
					}
					break;
				case ('2') : 
					//���� ���۵��� ����
					break;
				case ('del') : 
					if (count($_POST['id_0'])>0 or count($_POST['id_1'])>0)
					{
						if (count($_POST['id_0'])>0){
						$tmp='id = "'.implode('" or id = "',$_POST['id_0']).'"';
						}
						if (count($_POST['id_1'])>0){
							if ($tmp<>'') $tmp.=' or ';
						$tmp.='id = "'.implode('" or id = "',$_POST['id_1']).'"';
						}
						DB_query('delete from '.$config['db_table']['space'].' where ('.$tmp.') and url=\''.$_GET['url'].'\'');
						go_back('',true);
					}else{
						go_back('���̵� ������ �ּ���.',true);
					}
					break;
			}
			go_back('',true);
		}
	}
}
function exec_admin_reg() {//��������
	global $wiki,$config;
	$_POST['wiki_title']=str_chk($_POST['wiki_title']);
	$_POST['wiki_pr']=str_chk($_POST['wiki_pr']);
	$_POST['wiki_skin']=str_chk($_POST['wiki_skin']);//��Ų�� ���� �����ϴ��� �˻��ؾ��Ѵ�.
	if ($_POST['wiki_title']=='')
	{
		go_back($config['msg']['admin'][2],true);
	}
	if ($_POST['wiki_pr']=='')
	{
		go_back($config['msg']['admin'][3],true);
	}
	if ($_POST['wiki_skin']=='')
	{
		go_back($config['msg']['admin'][4],true);
	}else{
		if ( !file_exists($config['dir']['skin'].$_POST['wiki_skin'].'/skin.php') )
		{
			go_back($config['msg']['admin'][5],true);
		}
	}
	if ($_SESSION['login_id']<>''){
	if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin']){
	if ( str_chk($_POST['wiki_rss'])<>'true' ) $_POST['wiki_rss'] = 'false'; //�Ѿ�� ���� �ٸ����� ����ִ°��� ����
	if ( str_chk($_POST['wiki_counter'])<>'true' ) $_POST['wiki_counter'] = 'false';
	if ($_POST['wiki_start_page']=='') $_POST['wiki_start_page']='ó��ȭ��';
	$tmp='<?php'."\n".
	'$wiki[\'url\']=\''.$_GET['url'].'\';'."\n".
	'$wiki[\'title\']=\''.$_POST['wiki_title'].'\';'."\n".
	'$wiki[\'pr\']=\''.$_POST['wiki_pr'].'\';'."\n".
	'$wiki[\'admin\']=\''.$wiki['admin'].'\';'."\n".
	'$wiki[\'type\']='.(int)$_POST['wiki_type'].';'."\n".
	'$wiki[\'date\']=\''.$wiki['date'].'\';'."\n".
	'$wiki[\'skin\']=\''.str_chk($_POST['wiki_skin']).'\';'."\n".
	'$wiki[\'total_user\']='.$wiki['total_user'].';'."\n".
	'$wiki[\'total_page\']='.$wiki['total_page'].';'."\n".
	'$wiki[\'start_page\']="'.str_chk($_POST['wiki_start_page']).'";'."\n".
	'$wiki[\'use_rss\']= '.$_POST['wiki_rss'].';'."\n".	
	'$wiki[\'use_counter\']= '.$_POST['wiki_counter'].';'."\n";
	$tmp.='?>';
	save_file($_GET['url'],'page',$tmp,true);
	//���� ���� ��
	//ī�װ� �������
	if (strlen($_POST['wiki_category'])<(($config['max']['admin_category_title']+1)*$config['max']['admin_category_list'])){
		$tmp_array=explode(';',$_POST['wiki_category']);
	}

	$tmp_count=count($tmp_array);
	if ($config['max']['admin_category_list']<$tmp_count) $tmp_count=$config['max']['admin_category_list'];
	$tmp_category.='<?'."\n";
	for ($i=0;$i<$tmp_count;$i++)
		{
		$tmp_str=trim(str_chk($tmp_array[$i]));
		if ($tmp_str<>'' && $tmp_str<>'��з�' && strlen($tmp_str)<$config['max']['admin_category_title']) $tmp_category.='$wiki[\'category\'][]="'.$tmp_str.'";'."\n";
		}
	$tmp_category.='?>';
	save_file($_GET['url'],'category',$tmp_category);
	clear_category(); //ī�װ� ��������� �����Ѵ�. ī�װ��� �����Ǹ� ���ù����� ī�װ� ������ �����. �׸��� ������ ī�װ� ��Ͽ����� ���ش�.
	//������Ű ����
	if (strlen($_POST['wiki_interwiki'])<(($config['max']['admin_interwiki_title']+200)*$config['max']['admin_interwiki_list'])){
		$tmp_array=explode(';',$_POST['wiki_interwiki']);
	}
	$tmp_count=count($tmp_array);
	if ($config['max']['admin_interwiki_list']<$tmp_count) $tmp_count=$config['max']['admin_interwiki_list'];
	$tmp_interwiki.='<?'."\n";
	for ($i=0;$i<$tmp_count;$i++)
		{
		$tmp_str=trim($tmp_array[$i]);
		$tmp_pos=strpos($tmp_str,' ');
		$tmp_str_name=str_chk(substr($tmp_str,0,$tmp_pos));
		$tmp_str_url=substr($tmp_str,$tmp_pos+1);
		if ($tmp_str<>'' && strlen($tmp_str_name)<$config['max']['admin_interwiki_title']) 
			$tmp_interwiki.='$iw_list[\''.strtolower($tmp_str_name).'\']=array(\'title\'=>\''.$tmp_str_name.'\',\'url\'=>\''.str_replace('&','&amp;',$tmp_str_url).'\');'."\n";
		}
	$tmp_interwiki.='?>';
	save_file($_GET['url'],'interwiki',$tmp_interwiki);
	//
	//�޴� ����
	if (strlen($_POST['wiki_menu'])<(($config['max']['admin_menu_title']+1)*$config['max']['admin_menu_list'])){
		$tmp_array=explode(';',$_POST['wiki_menu']);
	}
	$tmp_count=count($tmp_array);
	if ($config['max']['admin_menu_list']<$tmp_count) $tmp_count=$config['max']['admin_menu_list'];
	
	$tmp_menu.='<?'."\n";
	for ($i=0;$i<$tmp_count;$i++)
		{
		$tmp_str=trim(str_chk($tmp_array[$i]));
		if (strlen($tmp_str)<$config['max']['admin_menu_title'] && $tmp_str<>'') $tmp_menu.='$wiki[\'menu\'][]="'.$tmp_str.'";'."\n";
		}
	$tmp_menu.='?>';
	save_file($_GET['url'],'menu',$tmp_menu);
	//�޴����� ��
	go_back($config['msg']['admin'][0],true);
	}else{
	go_back($config['msg']['admin'][1],true);
	}
	}else{
	go_back($config['msg']['common'][1],true);
	}
}
function clear_category()
{
	global $config;
	$tmp_array=explode(';',$_POST['wiki_category']);
	if (count($tmp_array)>0)
	{
		$tmp='category <> "'.implode('" and category <> "',$tmp_array).'" and category <> ""';
		$tmp_3='d_category <> "'.implode('" and d_category <> "',$tmp_array).'" and d_category <> ""';
	}else{
		$tmp='category <> ""';
		$tmp_3='category <> ""';
	}
	DB_query('delete from '.$config['db_table']['category'].' where '.$tmp.' and url=\''.$_GET['url'].'\'');
	$tmp_q='select d_target as no,d_no from '.$config['db_table']['page_data'].' where '.$tmp_3.' and d_url=\''.$_GET['url'].'\' ';
	$result = DB_query($tmp_q);
	if ($result<>'') $t2 = mysql_num_rows($result);
	for($i=0;$i<$t2;$i++){
		$row=mysql_fetch_array($result);
		$get_no[]=$row['no'];
		$get_d_no[]=$row['d_no'];
	}
	$get_no=array_unique($get_no); //�ߺ����ֱ�
	if (count($get_d_no)>0)
	{
		$tmp2='';
		DB_query('update '.$config['db_table']['page_data'].' set d_category="" where (d_no = "'.implode('" or d_no = "',$get_d_no).'") and d_url=\''.$_GET['url'].'\' ');
		//$get_d_no �� �̿��Ͽ� �ѹ��� update���� ����ؼ� ī�װ� ���� ''�� �ٲپ� ���.
	}
	if (count($get_no)>0)
	{
		$tmp_q_2 ='select a.n_title,b.d_own,b.d_content,b.d_view_level,b.d_write_level,b.d_category,b.d_use_html from '.$config['db_table']['page_name'].
			' a,'.$config['db_table']['page_data'].' b where (a.n_no = "'.implode('" or a.n_no = "',$get_no).'") and a.n_url=\''.$_GET['url'].'\' and a.n_del=\'0\' and a.n_no=b.d_target and a.n_date=b.d_date';
		$result2 = DB_query($tmp_q_2);
		if ($result2<>'')$t3 = mysql_num_rows($result2);
		for($i3=0;$i3<$t3;$i3++)
		{
			$row2=mysql_fetch_array($result2);	page_write_htm($row2['n_title'],page_conv($row2['d_content'],$_GET['url'],$row2['d_use_html']),$_GET['url'],$row2['d_own'],$row2['d_view_level'],$row2['d_write_level'],$row2['d_category'],$row2['d_use_html']);
		}
		//$get_no �� �̿��Ͽ� �ѹ��� �ڷḦ �ҷ����� ������ ���� �� �ڷḦ �̿��� ����ĳ�ø� �����ϴ� �κ�
		page_list_save();
		//�������� ����Ʈĳ�ø� ���Ž����ش�.
	}
}
function deldir($dir)
{
$handle = opendir($dir);
while (false!==($FolderOrFile = readdir($handle)))
{
if($FolderOrFile != "." && $FolderOrFile != "..") 
{ 
if(is_dir("$dir/$FolderOrFile")) 
{ deldir("$dir/$FolderOrFile"); } // recursive
else
{ unlink("$dir/$FolderOrFile"); }
} 
}
closedir($handle);
if(rmdir($dir))
{ $success = true; }
return $success; 
} 
function exec_wiki_pass() {//��Ű�ѱ��
	global $wiki,$config;
	$_GET['pass_id']=str_chk($_GET['pass_id']);
	if ($_SESSION['login_id']<>''){
	if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin']){
		//@unlink($config['dir']['data'].$_GET['url'].'/page.php');//�켱 page.php�� �����ϰ�
		//�̰������ ���� ��ڸ� ����� ����Ʈ�� �Ѿ�� pass_id �� ����ִ´�.pass_id�� �ش��ϴ� ����� ������ ���������� ������ ������ ������ �װ� �� �����Ѵ�.
		DB_query('delete from '.$config['db_table']['space'].' where accept=\'2\' and url=\''.$_GET['url'].'\' ');//join ���� ����
		DB_query('delete from '.$config['db_table']['space'].' where id=\''.$_GET['pass_id'].'\' and url=\''.$_GET['url'].'\' ');//join ���� ����
		$tmp_time=time();
		DB_query('insert into '.$config['db_table']['space'].'(id,accept,url,m_date,u_date) values(\''.$_GET['pass_id'].'\',\'2\',\''.$_GET['url'].'\',\''.$tmp_time.'\',\''.$tmp_time.'\') ');
		$tmp='<?php'."\n".
		'$wiki[\'url\'] = \''.$wiki['url'].'\';'."\n".
		'$wiki[\'title\'] = \''.$wiki['title'].'\';'."\n".
		'$wiki[\'pr\'] = \''.$wiki['pr'].'\';'."\n".
		'$wiki[\'admin\'] = \''.$_GET['pass_id'].'\';'."\n".
		'$wiki[\'type\'] = '.$wiki['type'].';'."\n".
		'$wiki[\'date\'] = \''.$wiki['date'].'\';'."\n".
		'$wiki[\'skin\'] = \''.$wiki['skin'].'\';'."\n".
		'$wiki[\'start_page\'] = \''.$wiki['start_page'].'\';'."\n".
		'$wiki[\'total_user\'] = '.$wiki['total_user'].';'."\n".
		'$wiki[\'total_page\'] = '.$wiki['total_page'].';'."\n";
		if ( $wiki['use_rss'] ) 
			$tmp.='$wiki[\'use_rss\'] = true;'."\n";
		else 
			$tmp.='$wiki[\'use_rss\'] = false;'."\n";
		if ( $wiki['use_counter'] ) 
			$tmp.='$wiki[\'use_counter\'] = true;'."\n";
		else 
			$tmp.='$wiki[\'use_counter\'] = false;'."\n";
		$tmp.='?>';
		save_file($_GET['url'],'page',$tmp,true);
		go_page('��ڱ����� �Ѱ�����ϴ�.',$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']);
	}else{
		go_back('��ڰ� �ƴմϴ�.',true);
	}
	}else{
		go_back($config['msg']['common'][1],true);
	}
}
function exec_wiki_del() {//��������
	global $wiki,$config;
	if ($_SESSION['login_id']<>''){
	if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin']){
		@unlink($config['dir']['data'].$_GET['url'].'/page.php');//�켱 page.php�� �����ϰ� 
		DB_query('delete from '.$config['db_table']['page_name'].' where n_url=\''.$_GET['url'].'\' ');//page_name���� �ּҷ� �˻��ؼ� �ڷ� �����ϰ�
		DB_query('delete from '.$config['db_table']['page_data'].' where d_url=\''.$_GET['url'].'\' ');//page_data���� ���������� ����
		DB_query('delete from '.$config['db_table']['space'].' where url=\''.$_GET['url'].'\' ');//join ���� ����
		DB_query('delete from '.$config['db_table']['category'].' where url=\''.$_GET['url'].'\' ');//ī�װ����� ����
		deldir($config['dir']['data'].$_GET['url']);//���丮 ��°�� ����
		go_page('���Ǿ����ϴ�.',$config['url']['main'].$config['file']['main_def']);
	}else{
		go_back('��ڰ� �ƴմϴ�.',true);
	}
	}else{
		go_back($config['msg']['common'][1],true);
	}
}
function view_delview()
{
	global $config,$wiki;
			$viewtmp2 = page_load_d_no($_GET['no'],$_GET['url'],1);
			if ($viewtmp2['n_title']<>''){
				$skin['view']=page_level_check($viewtmp2['d_view_level']);
				if ($skin['view']){
					$skin['own']=&$viewtmp2['d_own'];
					$skin['date']=&$viewtmp2['d_date'];
					$skin['title']=&$viewtmp2['n_title'];
					$skin['view_level']=&$viewtmp2['d_view_level'];
					$skin['write_level']=&$viewtmp2['d_write_level'];
					$skin['view_level_title']=$config['title']['join_level'][$skin['view_level']];
					$skin['write_level_title']=$config['title']['join_level'][$skin['write_level']];
					$skin['d_no']=&$viewtmp2['d_no'];
					$skin['contents']=page_conv($viewtmp2['d_content'],$_GET['url'],$viewtmp2['d_use_html']);
					include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['dview'];
				}else go_back('������ �����ϴ�.',true);
			}else go_back('������ ã�� �� �����ϴ�.',true);
}
function page_list_idx($url,$idx_key=0,$page=0){
	global $config;
	$result = DB_query('SELECT a.n_title as title FROM '.$config['db_table']['page_name'].' a WHERE a.n_url=\''.$url.'\' and a.n_del=\'0\' and a.n_title<>\'\' '.$config['idx'][$idx_key][1].' order by a.n_title_idx asc limit '.($page*$config['max']['all_list']).','.($config['max']['all_list']+1)); 
	if ($result<>''){
		$t2 = mysql_num_rows($result);
		for($i=0;$i<$t2;$i++){
		$row = mysql_fetch_array($result);
		$gettitle3[]=$row;
		}
		return $gettitle3;
	}else{
		return array();
	}
}
function page_dlist_idx($url,$idx_key=0,$page=0){ 
	global $config;
	$result = DB_query('SELECT a.n_no as no,a.n_title as title,count(*) as count FROM '.$config['db_table']['page_name'].' a, '.$config['db_table']['page_data'].' b WHERE a.n_no=b.d_target and a.n_url=\''.$url.'\' '.$config['idx'][$idx_key][1].' and b.d_del=\'1\' group by a.n_title limit '.($page*$config['max']['delete_list']).','.($config['max']['delete_list']+1)); 
	if ($result<>''){
		$t2 = mysql_num_rows($result);
		for($i=0;$i<$t2;$i++){
		$row=mysql_fetch_array($result);
		$gettitle3[]=$row;
		}
		return $gettitle3;
	}else{
		return array();
	}
}
function page_history($url,$no) // ������ ����Ʈ�� �̾��ش�.
{
	global $config;
$dbtemp='select a.n_title,b.d_date,b.d_own as own,b.d_ip as ip,b.d_no from '.$config['db_table']['page_name'].' a, '.$config['db_table']['page_data'].' b where a.n_no=b.d_target and a.n_url=\''.$url.'\' and b.d_del=\'1\' and a.n_no=\''.$no.'\' order by b.d_date desc';
$result = DB_query($dbtemp);
if ($result<>'') $t2 = mysql_num_rows($result);
for($i=0;$i<$t2;$i++)
	{
		$gettitle[] = mysql_fetch_array($result);
	}
return $gettitle;
}
function page_dlist_del($url,$no='') //idx
{
	global $config,$wiki;
	if ($no==''){
		$dbtemp_2='delete from '.$config['db_table']['page_data'].' where d_url=\''.$url.'\'  and d_del=\'1\'';
	}else{
		$dbtemp_2='delete from '.$config['db_table']['page_data'].' where d_url=\''.$url.'\'  and d_del=\'1\' and d_target=\''.$no.'\' ';
	}
		if ($_SESSION['login_id']==$config['admin']['id'] || $wiki['admin']==$_SESSION['login_id'])
		{
			$result = DB_query($dbtemp_2,true);
			return true;
		}
}
function cho($title){
$hcode = array('b0a1','b3aa','b4d9','b6f3','b8b6','b9d9','bbe7','bec6','c0da','c2f7','c4ab','c5b8','c6c4','c7cf','c8ff');
$hcode_2 = array('��','��','��','��',	'��','��','��','��','��',	'��','��','��','��','��');
$tmp= bin2hex(substr($title,0,2));
$tmp_2=substr($title,0,1);
if (ord($tmp_2)<128){return strtoupper($tmp_2);}
$j=13;
for($i=0;$i<=$j;$i++){
if ($hcode[$i] <= $tmp & $tmp < $hcode[$i+1]){return $hcode_2[$i];}
}
}
function view_dlist() //������
{
	global $config,$wiki;
	$idx_num=count($config['idx']);
	if ($_GET['key']=='' or $idx_num<=$_GET['key']) $_GET['key']=0;
	$skin['index_data']=$config['idx'];
	$skin['data']=page_dlist_idx($_GET['url'],$_GET['key'],$_GET['page']);
	if (count($skin['data'])>$config['max']['delete_list'])
	{
		array_pop($skin['data']);
		$skin['data_next']=true;
	}
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['dlist'];
}	
function exec_dlist_del()
{
	global $config;
	if ($_SESSION['login_id']==''){go_back($config['msg']['common'][1],true);}
	$dd=page_dlist_del($_GET['url'],$_GET['no']);
	if ($_GET['no']==''){
	if($dd!==true){go_back($config['msg']['admin'][1],true);}
	else{go_back($config['msg']['common'][2],true);}
	}else{
	if($dd!==true){go_back($config['msg']['admin'][1],true);}
	else{go_back($config['msg']['common'][2],true);}
	}
}
function exec_delre()
{
		//if ($_SESSION['login_id']<>""){
		global $config,$wiki;
		if (page_join()){
		$del_temp = page_del_re($_GET['no'],$_GET['url'],$_SESSION['login_id']);
		page_all_save();
		go_back('',true);
		}else{
		go_back('������ �����ϴ�.',true);
		}
}
function page_all_save()
{
	page_list_save();
	page_rss_save();
	page_info_save();
}
function exec_join()
{
	if ($_SESSION['login_id']<>''){
		$join_type = page_wiki_join($_GET['url'],$_SESSION['login_id'],$_SESSION['login_name']);
		if ($join_type==0){
			go_back($config['msg']['join'][0],true);
		}elseif ($join_type==1){
			go_back($config['msg']['join'][1],true);
		}elseif ($join_type==2){
			go_back($config['msg']['join'][2],true);
		}
		}else{
		go_back($config['msg']['common'][1],true);
		}
}
function exec_page_del()
{
		$tmp_level = get_write_level($_GET['no'],$_GET['url']);
		if (page_join() and page_level_check($tmp_level)){
		$del_temp = page_del($_GET['no'],$_GET['url'],$_SESSION['login_id']);
		page_all_save();
		go_back('',true);
		}else{
		go_back('������ �����ϴ�.',true);
		}
}

function view_config()
{
	global $config,$wiki;
	if ($_SESSION['login_id']==''){
	go_page($config['msg']['common'][1],$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&mode=update');
	}
	if ($_GET['type']=='category'){
		include $config['dir']['data'].$_GET['url'].'/category.php'; //�ڷ�ҷ�����
		$skin['all_category_data']=&$wiki['category'];
		$skin['my_category_data']=';'.implode(';',cut_my_category()).';';
	}
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['config'];
}
function view_update()
{
	global $config,$wiki;
		include $config['dir']['data'].$_GET['url'].'/update.php'; //�ڷ�ҷ�����
		$plist=$nc_data; //�ڷ����
		$skin['data']=&$plist;
		$array_category = cut_my_category(); //�ڽ��� ������ ī�װ� �ҷ�����
		if (count($array_category)>0){
		$skin['get_my_category']=';'.implode(';',$array_category).';';
		}else{
		$skin['get_my_category']='';
		}
		if ($_GET['type']=='') //Ÿ���� ������
			{
			if ($_SESSION['login_id']==''){ //���̵� ������
				$_GET['type']='all_category'; //��ü �����ְ�
			}else{
				if (count($array_category)>0){
					$_GET['type']='set_category';
				}else{
					$_GET['type']='all_category';
				}//ī���� ���� 0���� ũ�� �з������������ �з������� �����ְ� �ƴϸ� ��ü������
			}
		}//����ó�� �Ǿ� �Ұ�
		include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['update'];
}
function join_list($url)
	{
	global $config;
	$result = DB_query('select id,accept from '.$config['db_table']['space'].' where url=\''.$url.'\' and accept<2 order by m_date asc');
	if ($result<>'') $t2 = mysql_num_rows($result);
	for($i=0;$i<$t2;$i++){
	$row=mysql_fetch_array($result);
	$gettitle3[]=$row;
	}
	return $gettitle3;
}
function exec_insert()
{
		global $config,$wiki,$join_level;
		include $config['dir']['data'].$_GET['url'].'/category.php'; //ī�װ� ������ ���� �ҷ��´�
		//editâ���� �������� $_GET['date']�� �Ѿ�´�
		//�̰� �̿��ؼ� ������ �ֽŹ��� n_date�� �´��� Ȯ���� ���� ������ ���ü��� ������ �߻��� ���̴�.
		//�׷� ���� ������ �˸��� editâ�� �ٽ� �����ְ� �ճ����� �ٽ� ������.
		//go_back('�Է°�'.(int)$_POST['use_html']);
		$_GET['title']=trim(str_chk($_GET['title']));
		$_POST['category']=trim($_POST['category']);
		$get_n_date=titleto($_GET['title'],$_GET['url'],'n_date',0);

		if ($get_n_date<>'' && $_POST['date']<>'' && $_POST['date']<>$get_n_date){
			SetCookie('insert_title',$_POST['title']);
			SetCookie('insert_content',$_POST['contents']);
			SetCookie('insert_category',$_POST['category']);
			//SetCookie('insert_type',$_POST['type']);
			SetCookie('insert_view_level',$_POST['view_level']);
			SetCookie('insert_write_level',$_POST['write_level']);
			SetCookie('insert_date',$get_n_date);
			SetCookie('insert_use_html',(int)$_POST['use_html']);
			go_page($config['msg']['write'][2],
				$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&mode=edit');
			}
		$_GET['title'] = stripcode($_GET['title']);
		if ($_GET['title']<>''){
			$_GET['title']=trim($_GET['title']);
		}
		if (strlen(trim($_GET['title']))==0){
			go_back($config['msg']['write'][1],true);
		}
		if ( count($wiki['category'])>0 && 
			$_POST['category']<>'' && 
			strpos( ';'.implode(';',$wiki['category']).';' , ';'.$_POST['category'].';')===false )
		{ //�������� �ʴ� ī�װ��� ���� ������ �Ҷ�(�ҹ�����) ī�װ� ����
			$_POST['category']='';
			//go_back('�������� �ʴ� ī�װ� �Դϴ�.',true);
		}
		if (strlen($_GET['title'])<=100){
			if ($join_level<$_POST['view_level']){
				$_POST['view_level']=$join_level; //�ڽź��� ���� ������� ����Ÿ���� ���������� ���� ����(�ҹ��õ�)
			}
			if ($_POST['write_level']<$_POST['view_level']){
				$_POST['write_level']=$_POST['view_level']; 
				//���� �ִµ� ���� ������ �־
				//���� �ִµ� ���� ������ ������ �����Ѵ�
			}
			if ($_GET['no']==''){ 
				$_GET['no']=titleto($_GET['title'],$_GET['url']);
			}
			$tmp_level = get_write_level($_GET['no'],$_GET['url']);
			if (page_join() and page_level_check($tmp_level)){
				page_write(
					$_GET['title'],
					$_POST['contents'],
					$_GET['url'],
					$_SESSION['login_id'],
					$_POST['view_level'],
					$_POST['write_level'],
					$_POST['category'],
					(int)$_POST['use_html']);
				page_all_save();
				$_GET['no']=titleto($_GET['title'],$_GET['url']);
				go_page('',$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&no='.$_GET['no']);
			}else{
			go_page($config['msg']['common'][0],
				$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&no='.$_GET['no']);
			}
		}else{
		go_back('������ �ʹ� ��ϴ�.'.strlen($_GET['title'])."/100",true);
		}
}
function view_result()
{
	global $config,$wiki;
	$_GET['keyword'] = trim(str_chk($_GET['keyword']));
	if ($_GET['keyword']<>''){
		$skin['no']=titleto($_GET['keyword'],$_GET['url']);
		$skin['data']=page_search($_GET['keyword'],$_GET['url'],$_GET['page']);
	}
	if (count($skin['data'])>$config['max']['result_list']){
		array_pop($skin['data']);
		$skin['data_next']=true;
	}
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['result'];
}
function view_list_category()
{
	global $config;
	echo '['.urldecode($_GET['category']).']�з��� ��� ����(��� ������)';
}
function view_list()
{
	global $config,$wiki;
		$skin['index_data']=&$config['idx'];
		if ($_GET['key']=='' or count($config['idx'])<=$_GET['key']) $_GET['key']=0;
		$skin['data']=page_list_idx($_GET['url'],$_GET['key'],$_GET['page']);
		if (count($skin['data'])>$config['max']['all_list']){
			array_pop($skin['data']);
			$skin['data_next']=true;
		}
		include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['list'];
}	
function view_history()
{
	global $config,$wiki;
			$skin['data']=page_history($_GET['url'],$_GET['no']);
			if (count($skin['data'])>0){
				$skin['title']=$skin['data'][0]['n_title'];
			}else{
				$skin['title']=no_to($_GET['no'],$_GET['url'],'n_title');
			}
			include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['history'];
}

function view_diff() //Ʋ���κ��� ã���ִ� diff
{
	/*
	�� �κп��� ���� diff�Լ��� ���� ������� ������ �ణ �����ϴ�.
	�ܺ�diff ��ƿ�� ����Ϸ��� ������ ��ġ�ؾ� �ϴ� ���ŷο��� �ֱ⶧���� ���� ���������� ���ߴ�.
	*/
	global $config,$wiki;
	if($_GET['no']=='') {$_GET['no']=titleto($_GET['title'],$_GET['url']);}
	if($_GET['diff_no']=='') {$_GET['diff_no']=no_to_target($_GET['no']);}
	if($_GET['next_no']=='') {$_GET['next_no']=next_d_no($_GET['no'],$_GET['diff_no'],$_GET['url']);}
	$skin['data']=page_diff($_GET['url'],$_GET['no'],$_GET['diff_no'],$_GET['next_no']);
	$skin['d_no']=$_GET['next_no'];
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['diff'];
}
function view_preview()
{
	global $config,$wiki;
	if ( !page_join() ){
		go_back('������ �����ϴ�.',true);
	}
	$skin['title'] = &$_POST['title'];
	$skin['contents'] = $_POST['contents'];
	$skin['category'] = &$_POST['category'];
	$skin['date'] = &$_POST['date'];
	$skin['no'] = &$_POST['no'];
	$skin['view_level'] = &$_POST['view_level'];
	$skin['write_level'] = &$_POST['write_level'];
	$skin['use_html'] = (int)$_POST['use_html'];
	$skin['view_level_title']=$config['title']['join_level'][$skin['view_level']];
	$skin['write_level_title']=$config['title']['join_level'][$skin['write_level']];
	$tmp_cont = page_conv($skin['contents'],$_GET['url'],$skin['use_html']);
	$skin['contents'] = str_replace(array('<','>','"',"'"),array('&lt;','&gt;','&quot;','&#039;'),$skin['contents']);
	for ($i=0;$i<count($tmp_cont);$i++){
	$tmp_cont_str.=$tmp_cont[$i];
	if ($i<(count($tmp_cont)-1)) $tmp_cont_str.="\n<hr>";
	}
	$skin['contents_conv'] = $tmp_cont_str;
	include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['preview'];
}
function view_edit()
{
	global $config,$wiki,$join_level;
	if ( !page_join() ){
		go_page('������ �����ϴ�.',$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']);
	}
	include $config['dir']['data'].$_GET['url'].'/category.php'; //ī�װ� ������ ���� �ҷ��´�
	if ($_COOKIE['insert_title']<>''){
			$skin['title']=stripcode(stripslashes($_COOKIE['insert_title']));
			$tmp_contents=$_COOKIE['insert_content']; //������ ȥ������ ���� �ӽú����� ��Ƶд�
			$skin['view_level']=$_COOKIE['insert_view_level'];
			$skin['write_level']=$_COOKIE['insert_write_level'];
			$skin['date']=$_COOKIE['insert_date'];
			$edit_temp['d_category']=stripslashes($_COOKIE['insert_category']);
			$skin['use_html_value']=$_COOKIE['insert_use_html'];
			if($_GET['no']=='') {$_GET['no']=titleto($skin['title'],$_GET['url']);}
			if($_GET['diff_no']=='') {$_GET['diff_no']=no_to_target($_GET['no']);}
			if($_GET['next_no']=='') {$_GET['next_no']=next_d_no($_GET['no'],$_GET['diff_no'],$_GET['url']);}
			$skin['contents']=page_diff($_GET['url'],$_GET['no'],$_GET['diff_no'],$_GET['next_no']);
			$skin['d_no']=$_GET['diff_no'];
			include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['diff'];
			$skin['contents']=stripslashes(stripslashes($tmp_contents)); //���⼱ edit��带 ���� contents�� ��´�
	}else{
		if($_GET['no']<>''){
			$edit_temp = page_load_no($_GET['no'],$_GET['url']);
		//}elseif ($_GET['title']<>''){
		//	$edit_temp = page_load($_GET['title'],$_GET['url']);
		}else{
			if ($config['max']['make_wiki_page']>0 && $wiki['total_page']>=$config['max']['make_wiki_page']){
				go_back($config['msg']['write'][0],true);
			}
		}
		if ($edit_temp['n_title']==''){
			$skin['title']=$_GET['title'];
		}else{
			$skin['title']=$edit_temp['n_title'];
		}
		$skin['contents']=$edit_temp['d_content'];
		$skin['view_level']=$edit_temp['d_view_level'];
		$skin['write_level']=$edit_temp['d_write_level'];
		$skin['use_html_value']=$edit_temp['d_use_html'];
		$skin['date']=$edit_temp['d_date'];
		$skin['no']=$_GET['no'];
	}
	//��Ű���� �����
	SetCookie('insert_title','',0);
	SetCookie('insert_content','',0);
	SetCookie('insert_view_level','',0);
	SetCookie('insert_write_level','',0);
	//SetCookie('insert_type');
	SetCookie('insert_date','',0);
	SetCookie('insert_use_html','',0);
	//��⳻�� ����� ��
	if (page_level_check($skin['write_level'])){
		$array_category = &$wiki['category'];
		$category_length = count($array_category);
		$tmp_1.= '<select name="category"><option value="">��з�</option>';
		for($i=0;$i<$category_length;$i++) {
			if($array_category[$i]==$edit_temp['d_category'])    //ó���� ������ �з����� �⺻ �������� �ǵ��� �ϱ� ���� ����
				$tmp_1.='<option selected value="'.$array_category[$i].'">'.$array_category[$i].'</option>';
			else
				$tmp_1.='<option value="'.$array_category[$i].'">'.$array_category[$i].'</option>';
		}
		$tmp_1.='</select>';
		if ($skin['write_level']=='') $skin['write_level']=$join_level;
		$tmp_3[$skin['view_level']]='selected';
		$tmp_4[$skin['write_level']]='selected';

		$skin['type_view']='<select name="view_level">';
		$skin['type_write']='<select name="write_level">';
		for ($i=0;$i<$join_level+1;$i++){
			$skin['type_view'].='<option '.$tmp_3[$i].' value="'.$i.'">'.$config['title']['join_level'][$i].'</option>';
			$skin['type_write'].='<option '.$tmp_4[$i].' value="'.$i.'">'.$config['title']['join_level'][$i].'</option>';
		}
		$skin['type_view'].='</select>';
		$skin['type_write'].='</select>';

		$skin['category']=$tmp_1;
	if ($skin['use_html_value']>0) $skin['use_html']='checked';
		include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['edit'];
	}else{
		go_back('������ �����ϴ�.',true);
	}
}
function text_conv($text,$url){
global $iw_list;
global $config;
	$text=trim($text);
	$tmp_start=strpos($text,'(');
	$tmp_end=strpos($text,')',$tmp_start);
	$f_sp =strpos($text,' ');
	if ($f_sp===false){
	$f_sp=strlen($text);
	}
	if ($tmp_start!==false and $tmp_end!==false and $tmp_start < $f_sp) //���麸�� �տ� �־�� �Ѵ�
		{
			$tmp_txt_function=substr($text,0,$tmp_start);
			//$tmp_txt = substr($text,$tmp_start+4,$tmp_end-$tmp_start-4);
			$tmp_txt = substr($text,$tmp_start+1,strlen($text)-$tmp_start-2);
			switch(strtolower($tmp_txt_function)){
				case ('id') :
					return '<a href="'.$config['url']['main'].$config['file']['main_def'].
					'?page=profile&amp;id='.$tmp_txt.'">'.$tmp_txt.'</a>';
				break;
				//���⿡ �߰��ϸ� ��ɾ� Ȯ�尡��
			}
		}else{
			$find_sp=strpos($text,' ');
			if ($find_sp!==false){
			$tmp_a_1=substr($text,0,$find_sp);
			$tmp_a_2=substr($text,$find_sp+1,strlen($text)-$find_sp-1);
			}else{
			$tmp_a_1=$text;
			$tmp_a_2='';
			}
			$tmp_url=$tmp_a_1;
			$tmp_pos=strpos($tmp_url,':');
			if ($tmp_pos!==false) $tmp_function=strtolower(substr($tmp_url,0,$tmp_pos));
			switch ($tmp_function){
				case 'http' :
				case 'https':
					if ($tmp_a_2==''){
						$tmp_ext=strtolower(substr($tmp_url,-4));
						if ($tmp_ext == '.jpg' || $tmp_ext == '.gif' ||	$tmp_ext == '.png' || $tmp_ext == '.bmp'){
							return '<img src="'.$tmp_url.'" alt="�׸�">';
						}else{
							return '<a href="'.$tmp_url.'" target="_blank">'.add_space($tmp_url).'</a>';
						}
					}else{
						return '<a href="'.$tmp_url.'" target="_blank">'.add_space($tmp_a_2).'</a>';
					}
					break;
				case '':
					return '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$url.'&amp;title='.urlencode($text).'">'.add_space($text).'</a>';
				break;
				default:
				$tmp_txt=substr($text,$tmp_pos+1);
				if (strtolower($iw_list[$tmp_function]['title'])<>''){
					return '<a href="'.$iw_list[$tmp_function]['url'].urlencode($tmp_txt).'" title="'.$iw_list[$tmp_function]['title'].'" target="_blank">'.add_space($tmp_txt).'</a>';
				}else{
					return '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.urlencode($tmp_function).'&amp;title='.urlencode($tmp_txt).'" title="'.$tmp_txt.'">'.add_space($tmp_txt).'</a>';
				}
				break;
		}
	}
return $text;
}
function blit_end_num(&$b_type,$num,&$b_space){
$i_max=count($b_type)-1;
for($i=$i_max;$i>$i_max+$num;$i--){
	$a++;
	if ($b_type[$i]=='*' or $b_type[$i]==''){
		$tmp_return.='</ul>';
	}else{
		$tmp_return.='</ol>';
	}
	array_pop($b_type);
}
$b_space=$b_space+$num+1;
return $tmp_return;
}
function blit_space(&$b_type,$b_space){
for ($i=0;$i<($b_space-1);$i++){
	$b_type[] = '';
	$tmp_return.= '<ul>';
}
return $tmp_return;
}
function blit_end(&$b_type,&$b_start,&$b_space){
$i_max=count($b_type)-1;
for($i=$i_max;$i>=0;$i--){
	$a++;
	if ($b_type[$i]=='*' or $b_type[$i]==''){
		$tmp_return.='</ul>';
	}else{
		$tmp_return.='</ol>';
	}
	array_pop($b_type);
}
$b_start=false;
$b_space=0;
return $tmp_return;
}
function page_conv($content,$url,$use_html){
global $iw_list,$config;
$strip_tag_events = 	'javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup|onchange|onblur|onfocus';
$strip_tag = '<center><h1><b><br><i><a><ul><ol><li><hr><img><font><embed><span><div><table><tr><td><p>';
include $config['dir']['data'].$url.'/interwiki.php';

$content=stripslashes($content);
if ($use_html>0){
	$conv_name=array("\r");
	$conv_value=array('');
	$content = strip_tags($content, $strip_tag);
	$content = preg_replace("/<(.*)(".$strip_tag_events.")+([^>]*)>/i", "<\\1x-\\2\\3>", $content);
}else{
	$conv_name=array("\r",'"','<','>');
	$conv_value=array('','&quot;','&lt;','&gt;');

}
$content = str_replace($conv_name,$conv_value,$content);
$conv_name_2=array('{{{','}}}','{{|','|}}');
$conv_value_2=array('{{|','|}}',"<div class='ref'>",'</div>');
$content = str_replace($conv_name_2,$conv_value_2,$content);

if(strpos($content,"''") !== false)
	{
$tmp_tag[5]=array('<STRIKE>','</STRIKE>');
$tmp_tag[4]=array('<FONT SIZE=4>','</FONT>');
$tmp_tag[3]=array('<B>','</B>');
$tmp_tag[2]=array('<I>','</I>');
$find_key="'''''";
for($q_len=5;$q_len>1;$q_len--){
	$tmp_find_key=substr($find_key,0,$q_len);
	//echo '['.$tmp_find_key.']<br>';
	$tmp_on = false;
	$tmp_len = strlen($content);
	for($i=0;$i<$tmp_len;$i++){
		$tmp_pos = strpos($content,$tmp_find_key,$i);
		if($tmp_pos !== false)
			{
			$tmp_start =  substr($content,0,$tmp_pos);
			$tmp_end = substr($content,$tmp_pos+$q_len);
			if ( $tmp_on === false ) {
				$content = $tmp_start.$tmp_tag[$q_len]['0'].$tmp_end;
				$tmp_on = true;
			}else{
				$content = $tmp_start.$tmp_tag[$q_len]['1'].$tmp_end;
				$tmp_on = false;
			}
			$i = $tmp_pos+$q_len;
		}else{
			break;
		}

	}
}
}
$tmp_len = strlen($content);
for ($i=0;$i<$tmp_len;$i++){
	$tmp_start=strpos($content,'[[',$i);
	if($tmp_start !== false)
	{
		if($content[$tmp_start+2]<>'['){
			$tmp_end = strpos($content,']]',$tmp_start);
			$f_text = substr($content,$tmp_start+2,$tmp_end-$tmp_start-2);
			$tmp_conv=text_conv($f_text,$url);
			$tmp_len_a=strlen($f_text)+2;
			$tmp_len_b=strlen($tmp_conv);
			$tmp_len_c=$tmp_len_a-$tmp_len_b;
			$content = str_replace('[['.$f_text.']]',$tmp_conv,$content);
		$tmp_len = strlen($content);
		$i = $tmp_end-$tmp_len_c;
		}
	} else break;
}
$con_a=explode("\n",$content);
$return_array=0;
$con_c=array();
$i_max=count($con_a);
for($i=0;$i<$i_max;$i++){
	$tmp_con_a=ltrim($con_a[$i]);
	$tmp_con_b=rtrim($tmp_con_a);
	$tmp_3='';
	$tmp_2=strlen($con_a[$i])-strlen($tmp_con_a);
	//echo '['.$i.'���� : '.$con_a[$i].',sp:'.$tmp_2.',ra:'.$return_array.']<br>';
	if (($tmp_con_a[0].$tmp_con_a[1]=='* ' or 
		$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='A. ' or 
		$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='a. ' or 
		$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='I. ' or 
		$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='i. ' or 
		$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='1. ') and $tmp_2>0)
	{
	if ($blit_start==false) //���ν���
	{
		$blit_start=true;
		$blit_sp=$tmp_2;
		$get_line=substr($tmp_con_b,2);
		if (substr($con_c[$return_array],-1)=="\n")
		{
			$con_c[$return_array]=substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
		}
		if ($tmp_con_a[0]=='*'){
		$con_c[$return_array].='<ul>';
		$blit_type[]=$tmp_con_a[0];
		}else{
		$con_c[$return_array].='<ol type="'.$tmp_con_a[0].'">';
		$blit_type[]=$tmp_con_a[0];
		}

		$con_c[$return_array].='<li>'.$get_line.'</li>';
	}else{
	//���� ���۵�
		if ($blit_sp==$tmp_2){
			//�������� ����
			$get_line=substr($tmp_con_b,2);
			$con_c[$return_array].='<li>'.$get_line.'</li>';
		}else{
			$tmp_sp=$tmp_2-$blit_sp;//�ٷ��� �ٰ� ��������
			$blit_sp=$tmp_2;
			$get_line=substr($tmp_con_b,2);
			if ($tmp_sp>0){ //������ �þ
			if (($tmp_con_a[0].$tmp_con_a[1]=='* ' or 
				$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='A. ' or 
				$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='a. ' or 
				$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='I. ' or 
				$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='i. ' or 
				$tmp_con_a[0].$tmp_con_a[1].$tmp_con_a[2]=='1. ') and $tmp_2>0)
			{
				$blit_start=true;
				$con_c[$return_array].=blit_space($blit_type,$tmp_sp);
				if ($tmp_con_a[0]=='*'){
					$con_c[$return_array].='<ul>';
					$blit_type[]=$tmp_con_a[0];
				}else{
					$con_c[$return_array].='<ol type="'.$tmp_con_a[0].'">';
					$blit_type[]=$tmp_con_a[0];
				}
				$con_c[$return_array].='<li>'.$get_line.'</li>';
			}
			}else{
				//������ �پ��
				$con_c[$return_array].=blit_end_num($blit_type,$tmp_sp,$blit_sp);
				$con_c[$return_array].='<li>'.$get_line.'</li>';
				
			}
		}
		if ($i==($i_max-1)){
			if ( substr($con_c[$return_array],-1) =="\n" ){
				$con_c[$return_array] = substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
			}
		$con_c[$return_array].=blit_end($blit_type,$blit_start,$blit_sp);
		}
	}
	}elseif ($tmp_con_a[0]=='='){
		if ($blit_start==true){
			if ( substr($con_c[$return_array],-1) =="\n" ){
				$con_c[$return_array] = substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
			}
			$con_c[$return_array].=blit_end($blit_type,$blit_start,$blit_sp);
		}
		for($i2=0;$i2<strlen($tmp_con_b);$i2++){
			if ($tmp_con_b[$i2]<>'=') break;
		}
		$tmp_3=substr($tmp_con_b,0,$i2);
		if (substr($tmp_con_b,-$i2)==$tmp_3){
		$get_title=substr($tmp_con_b,$i2,strlen($tmp_con_b)-($i2*2));
		}else{
		$get_title=substr($tmp_con_b,$i2);
		}
		$tmp_title_idx[]=$get_title;
		$con_c[$return_array].= '<H'.($i2).'><a name="title'.(int)($title_idx++).'">'.$get_title.'</a></H'.($i2).'>';
	}elseif ($tmp_con_a[0]=='-' && $tmp_2==0){
		for($i2=0;$i2<strlen($tmp_con_b);$i2++){
			if ($tmp_con_b[$i2]<>'-') break;
		}
		if ($i2>2){
			$tmp_3=substr($tmp_con_b,0,$i2);
			if ($i2==3) $i2++;
			$tmp_size=$i2-2;
			if ($i2>3) $tmp_size--;
			//$con_c[$return_array]=substr($con_c[$return_array],0,strlen($con_c[$return_array])-2);
			//if ($con_c[$return_array][strlen($con_c[$return_array])]=="\n") echo '�������� ����';
			if ($blit_sp<>$tmp_2){
				$tmp_sp=$tmp_2-$blit_sp;//�ٷ��� �ٰ� ��������
				$blit_sp=$tmp_2;
				if ($tmp_sp<0){
					//������ �پ��
					if ( substr($con_c[$return_array],-1) =="\n" ){
						$con_c[$return_array] = substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
					}
					$con_c[$return_array].=blit_end($blit_type,$blit_start,$blit_sp);
				}
			}
			if ($config['max']['page_index']>($return_array+1)) 
			{
				$return_array++;
			}else{
				$con_c[$return_array].= '<hr>';
			}
			if ($i2<strlen($tmp_con_b)){
				//echo '����';
				$con_c[$return_array].= substr($tmp_con_b,$i2)."\n";
			}
		}else{
			$blit_start=true;
			//�����ִ� ���ڿ� �ش�
			if ($blit_sp==$tmp_2){
				//go_back('a:'.$tmp_con_b);
				//�������� ����
				$con_c[$return_array].=$tmp_con_b."\n";
			}else{ //�������� ����
				//go_back('b:'.$tmp_con_b);
				$tmp_sp=$tmp_2-$blit_sp;//�ٷ��� �ٰ� ��������
				$blit_sp=$tmp_2;
				if ($tmp_sp<0){
					//������ �پ��
					$con_c[$return_array].=blit_end_num($blit_type,$tmp_sp,$blit_sp).$tmp_con_b."\n";		
				}
			}
		}
	}elseif ($tmp_2>0){ // ������ ����
			$blit_start=true;
			//�����ִ� ���ڿ� �ش�
			if ($blit_sp==$tmp_2){
				//go_back('a:'.$tmp_con_b);
				//�������� ����
				$con_c[$return_array].=$tmp_con_b."\n";
			}else{ //�������� ����
				//go_back('b:'.$tmp_con_b);
				$tmp_sp=$tmp_2-$blit_sp;//�ٷ��� �ٰ� ��������
				$blit_sp=$tmp_2;
				if ($tmp_sp>0){ //������ �þ
					$blit_start=true;
					$blit_type[]='';
					$con_c[$return_array].=blit_space($blit_type,$tmp_sp).'<ul>'.$tmp_con_b."\n";
				}else{
					//������ �پ��
					$con_c[$return_array].=blit_end_num($blit_type,$tmp_sp,$blit_sp).$tmp_con_b."\n";		
				}
			}
	}else{ //�������
		if ($blit_start) {
			if ( substr($con_c[$return_array],-1) =="\n" ){
				$con_c[$return_array] = substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
			}
			$con_c[$return_array].=blit_end($blit_type,$blit_start,$blit_sp);
			$blit_sp=0;
		}
		$con_c[$return_array].=$tmp_con_b."\n";
	}
}
if ( substr($con_c[$return_array],-1) =="\n" ){
	$con_c[$return_array] = substr($con_c[$return_array],0,strlen($con_c[$return_array])-1);
}
$con_c[$return_array].=blit_end($blit_type,$blit_start,$blit_sp);
if ($use_html<>1){
	for($i77=0;$i77<=$return_array;$i77++){
	$con_c[$i77] = str_replace("\n","<br>\n",$con_c[$i77]);
	}
}
return $con_c;
}
function page_rss_save_bak(){ //���뵵 �ۼ�
global $config,$wiki;
if (!$wiki['use_rss']) return void;
$conv_name=array('&',"'",'"','<','>');
$conv_value=array('&amp;','&#039;','&quot;','&lt;','&gt;');
$tmp_rss=
'<?xml version="1.0" encoding="euc-kr" ?>'."\n".
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">'."\n".
'<channel>'."\n".
'<title>'.str_replace($conv_name,$conv_value,$config['site']['name'].' - '.$wiki['title']).'</title>'."\n".
'<link>'.str_replace($conv_name,$conv_value,$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']).'</link>'."\n".
'<dc:language>ko</dc:language>';
include $config['dir']['data'].$_GET['url'].'/update.php';
$tmp_rss_count=count($nc_data);
if ($tmp_rss_count>0){
for ($i=0;$i<$tmp_rss_count;$i++){
	if ($nc_data[$i][7]==0){
		$page_dir=idx($config['dir']['data'].$_GET['url'],$nc_data[$i][4]).'/'.$nc_data[$i][4].'.php';
		$fe=file_exists( $page_dir );
		if( $fe ) include $page_dir;
		$tmp_rss.= 
		'<item>'."\n".
		'<title>'.str_replace($conv_name,$conv_value,$nc_data[$i][0]).'</title>'."\n".
		'<link>'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$nc_data[$i][4].'</link>'."\n".
		'<dc:date>'.date("Y.m.d H:i:s",$nc_data[$i][1]).'</dc:date>'."\n".
		'<dc:subject>'.$nc_data[$i][6].'</dc:subject>';
		if ($skin['type']>0){
			$tmp_rss.='<description>������ �����ϴ�.</description>';
		}else{
			$tmp_rss.='<description>'.str_replace($conv_name,$conv_value,$skin["contents"]).'</description>';
		}
		$tmp_rss.='</item>';
	}
	}
}
$tmp_rss.='
</channel>
</rss>';
$frss=fopen($config['dir']['rss'].$_GET['url'].'.xml','w');
fwrite($frss,$tmp_rss);
fclose($frss);
}
function page_rss_save(){ //���뻩��
global $config,$wiki;
//rss�� ����� �¿��� ���� Ȯ���Ҷ�
if (!($config['use']['rss'] and $wiki['use_rss'])) return void;
$conv_name=array('&',"'",'"','<','>');
$conv_value=array('&amp;','&#039;','&quot;','&lt;','&gt;');
$tmp_rss=
'<?xml version="1.0" encoding="euc-kr" ?>'."\n".
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">'."\n".
'<channel>'."\n".
'<title>'.str_replace($conv_name,$conv_value,$config['site']['name'].' - '.$wiki['title']).'</title>'."\n".
'<link>'.str_replace($conv_name,$conv_value,$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']).'</link>'."\n".
'<dc:language>ko</dc:language>';
include $config['dir']['data'].$_GET['url'].'/update.php';
$tmp_rss_count=count($nc_data);
if ($tmp_rss_count>0){
for ($i=0;$i<$tmp_rss_count;$i++){
	if ($nc_data[$i][7]==0){
		$tmp_rss.= 
		'<item>'."\n".
		'<title>'.str_replace($conv_name,$conv_value,$nc_data[$i][0]).'</title>'."\n".
		'<link>'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$nc_data[$i][4].'</link>'."\n".
		'<dc:date>'.date("Y.m.d H:i:s",$nc_data[$i][1]).'</dc:date>'."\n".
		'<dc:subject>'.$nc_data[$i][6].'</dc:subject>'."\n".
		'<description />'."\n".
		'</item>';
	}
}
}
$tmp_rss.='
</channel>
</rss>';
$frss=fopen($config['dir']['rss'].$_GET['url'].'.xml','w');
fwrite($frss,$tmp_rss);
fclose($frss);
}
function view_admin()
{
global $wiki,$config;
if ($_SESSION['login_id']==$config['admin']['id'] || $_SESSION['login_id']==$wiki['admin']){
	if ($_GET['type']=='setting'){
		include $config['dir']['data'].$_GET['url'].'/category.php'; //�ڷ�ҷ�����
		include $config['dir']['data'].$_GET['url'].'/interwiki.php';
		//$skin=&$wiki;
		if (count($wiki['category'])>0) $skin['wiki_category']=implode(';',$wiki['category']); //ī�װ� ��� �̾ƿ���
		if (count($wiki['menu'])>0) $skin['wiki_menu']=implode(';',$wiki['menu']); //�޴���� �̾ƿ���
		if ($handle = opendir($config['dir']['skin'])) { //��Ų��� �̾ƿ���
		   while (false !== ($file = readdir($handle))) { 
			   if ($file != "." && $file != "..") { 
				   $skin['skin_list'][]= $file; 
			   } 
		   }
		   closedir($handle); 
		}
		if (count($iw_list) > 0){
			while (list ($key, $val) = each ($iw_list)) {
				$skin['wiki_interwiki'].=$val['title'].' '.$val['url'].';'."\n";
			}
		}
	}else{
		$skin['data']=join_list($_GET['url']);
	}
		
include $config['dir']['skin'].$wiki['skin'].'/'.$config['form']['admin'];
}else{
go_page('��ڰ� �ƴմϴ�.',$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']);
}
}
function page_diff($url,$no,$diff_no,$next_no) // ������ Ʋ������ ã�� �Լ� 
{
	$row=page_load_d_no($diff_no,$url,'');
	$row2=page_load_d_no($next_no,$url,'');
	if (page_level_check($row['d_view_level']) and page_level_check($row2['d_view_level'])){
		return diff($row2['d_content'],$row['d_content']);
	}else{
		$tmp[] = '������ �����ϴ�.';
		return $tmp;
	}
}
function adiff($array1,$array2) //�迭�� ���� 
{
$ary_count_1=count($array1);
$ary_count_2=count($array2);
for ($i=0;$i<$ary_count_1;$i++)
	{
		for ($i2=0;$i2<$ary_count_2;$i2++)
			{
				if ($array1[$i]==$array2[$i2])
				{
					$array1[$i]='';
					$array2[$i2]='';
					$i2=$ary_count_2;
				}
			}
	}
	return $array1;
}
function diff($text1,$text2){
	global $config;
$conv_name=array("\r","'",'"','<','>');
$conv_value=array('','&#039;','&quot;','&lt;','&gt;');
$text1=str_replace($conv_name,$conv_value,$text1);
$text2=str_replace($conv_name,$conv_value,$text2);
$text1_array=explode("\n", stripslashes($text1));
$text2_array=explode("\n", stripslashes($text2));
$text3_a=adiff($text1_array, $text2_array);
$text3_b=adiff($text2_array, $text1_array);
$tmp_array=0;
if (count($text1_array) >= count($text2_array))
	{
	$text_count = count($text1_array);
	}else{
	$text_count = count($text2_array);
	}
for ($i=0;$i<$text_count;$i++)
	{
		if ($text3_a[$i]<>''){
			$tmp_0[]= array('1',$i,$text3_a[$i]);
		}else{
			if ($text1_array[$i]<>''){
			$tmp_0[]= array('0',$i,$text1_array[$i]);
			}
		}
	}
for ($i=0;$i<$text_count;$i++)
	{
		if ($text3_b[$i]<>''){
			$tmp_1[]= array('1',$i,$text3_b[$i]);
		}else{
			if ($text2_array[$i]<>''){
			$tmp_1[]= array('0',$i,$text2_array[$i]);
			}
		}
	}
for ($i=0;$i<count($tmp_0);$i++)
	{
		if ($tmp_0[$i]['0'] == '1'){
			$tmp_return[$tmp_array].= '<DIV class="diff_del">'.$tmp_0[$i]['1'].' : '.$tmp_0[$i]['2'].'</DIV>';
			$tmp_r=true;
			//�̺κп� ó����ƾ
		}else{
			if ($tmp_0[$i-1]['0']=='1' or $tmp_0[$i+1]['0']=='1')
				{
				$tmp_return[$tmp_array].= $tmp_0[$i]['1'].' : '.$tmp_0[$i]['2'].'<br>';
				$tmp_r=true;
				}else{
				if (($tmp_0[$i-1]['0']=='0' and $tmp_0[$i-2]['0']=='1') or ($i==0 and $tmp_0[$i]['0']=='0'))
					{
						$tmp_return[$tmp_array].= '<DIV class="diff_no">���� ����</DIV>';
						$tmp_r=true;
					}
				}
		}
	}
if ($tmp_r!==true){$tmp_return[$tmp_array].= $config['msg']['diff'][2];}
$tmp_array=1;
for ($i=0;$i<count($tmp_1);$i++)
	{
		if ($tmp_1[$i]['0'] == '1'){
			$tmp_return[$tmp_array].= '<DIV class="diff_insert">'.$tmp_1[$i]['1'].' : '.$tmp_1[$i]['2'].'</DIV>';
			$tmp_r2=true;
			//�̺κп� ó����ƾ
		}else{
			if ($tmp_1[$i-1]['0']=='1' or $tmp_1[$i+1]['0']=='1')
				{
				$tmp_return[$tmp_array].= $tmp_1[$i]['1'].' : '.$tmp_1[$i]['2'].'<br>';
				$tmp_r2=true;
				}else{
				if (($tmp_1[$i-1]['0']=='0' and $tmp_1[$i-2]['0']=='1') or ($i==0 and $tmp_1[$i]['0']=='0'))
					{
						$tmp_return[$tmp_array].= '<DIV class="diff_no"">���� ����</DIV>';
						$tmp_r2=true;
					}
				}
		}
	}
if ($tmp_r2!==true){$tmp_return[$tmp_array].= $config['msg']['diff'][3];}
return $tmp_return;
}
?>