<?php 
?>
<p><img src="images/skin_menu_wikilist.jpg"><br>
<span style="color:silver;">&nbsp;&nbsp;����� ��Ű�� ��Ÿ���� �ʽ��ϴ�.</span> </p>
<?php
	//$tmp_1 = (int)$_GET['page_num']*$config['max']['make_wiki_list'];
	//$result = DB_query('select * from '.$config['db_table']['space'].' where accept=\'2\' limit '.$tmp_1.','.$config['max']['make_wiki_list'].' ');
	//�߰��߰� ����� ��϶����� �̷������� �����̾ƿ��� �����ٶ� ������ ���� �ʴ´�.
	//�׷��� ����
	$result = DB_query('select url from '.$config['db_table']['space'].' where accept=\'2\' order by m_date desc');
	if ($result<>'') $t2 = mysql_num_rows($result);
	for($i=0;$i<$t2;$i++)
		{
		$row=mysql_fetch_array($result);
			unset($wiki);
			include $config['dir']['data'].$row['url'].'/page.php';
			if ($_SESSION['login_id']==$config['admin']['id']){
				$tmp_str.= '<p><ul><a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$row['url'].'" target="_blank">'.
				'<u>'.$wiki['title'].'</u></a> - <a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$wiki['admin'].'" target="_blank">'.$wiki['admin'].'</a><br>'.
				$wiki['pr'].'<br><a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$row['url'].'" target="_blank">http://'.$row['url'].'.'.$_SERVER['HTTP_HOST'].'</a></ul></p>';
			}elseif ($wiki['type']<2){
				$tmp_str.= '<p><ul><a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$row['url'].'" target="_blank">'.
				'<u>'.$wiki['title'].'</u></a> - <a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$wiki['admin'].'" target="_blank">'.$wiki['admin'].'</a><br>'.
				$wiki['pr'].'<br><a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$row['url'].'" target="_blank">http://'.$row['url'].'.'.$_SERVER['HTTP_HOST'].'</a></ul></p>';
			}
		}
		echo $tmp_str;
?>