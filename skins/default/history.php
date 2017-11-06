<div class="top_color">
<span class="title_color"><a href="<?php echo $config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$_GET['no']?>"><?php echo $skin['title']?></a></span>의 과거&nbsp;-&nbsp;<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=dlistdel&amp;no='.$_GET['no']?>"?>모두삭제</a>
</div>
<DIV class="contents_color">
<?php
if (count($skin['data'])>0){
	for($i=0;$i<count($skin['data']);$i++){
		if ($skin['data'][$i]['own']==''){
			$tmp_own=$skin['data'][$i]['ip'];
		}else{
			$tmp_own='<a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$skin['data'][$i]['own'].'" target="_blank">'.$skin['data'][$i]['own'].'</a>';
		}
		$tmp_str.= 
			'<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&mode=delview&no='.$skin['data'][$i]['d_no'].'">'.
			date("Y-m-d H:i:s",$skin['data'][$i]['d_date']).'</a>&nbsp;-&nbsp;<a href="javascript:ask_delre(\''.$skin['data'][$i]['d_no'].'\');">복구</a> | <a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&mode=diff&no='.$_GET['no'].'&diff_no='.$skin['data'][$i]['d_no'].'&next_no='.$skin['data'][$i+1]['d_no'].'&title='.urlencode($skin['title']).'">비교</a> '.$tmp_own.'<br>';
	}
echo $tmp_str;
}else{
echo '과거 내역이 없습니다';
}
?>
</DIV>