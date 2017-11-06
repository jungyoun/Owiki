<?php
	$tmp_idx_str.='<select name="key" style="font-size:9pt;" OnChange="location.href= \'index.php?url='.$_GET['url'].'&mode=dlist&key=\'+this.value;">';
	$tmp_key[$_GET['key']]='selected';
	$tmp_count=count($skin['index_data']);
	for ($i=0;$i<$tmp_count;$i++){
		$tmp_idx_str.='<option '.$tmp_key[$i].' value="'.$i.'" >'.$skin['index_data'][$i][0].'</option>';
	}
	$tmp_idx_str.='</select>';
?>
<script language="javascript" type="text/javascript">
<!--
function ask_dlist_del(no){
	ans=confirm("정말로 삭제 하시겠습니까?");
    if (ans==true)
     location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&mode=dlistdel&no="+no;
}
-->
</script>
<div class="top_color">
<span class="title_color">휴지통</span> - <a href='javascript:ask_dlist_del("");'>비우기</a> | 색인별 <?php echo $tmp_idx_str?><br>
삭제한 문서를 보관하는곳
</div>
<DIV class="contents_color">
<?php
$plist_count = count($skin['data']);
if ($plist_count>0){
	for($i=0;$i<$plist_count;$i++){
		$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=history&amp;no='.
					$skin['data'][$i]['no'].'">'.$skin['data'][$i]['title'].'('.$skin['data'][$i]['count'].')</a> <a href=\'javascript:ask_dlist_del('.$skin['data'][$i]['no'].');\'>지움</a><br>'."\n";
	}
}else{
	$tmp_str.='문서없음<br>';
}
echo $tmp_str;
if ((int)$_GET['page']>0) {
	$tmp_idx.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=dlist&amp;key='.$_GET['key'].'&amp;page='.((int)$_GET['page']-1).'">< 이전</a> | ';
}else{
	$tmp_idx.='< 이전 | ';
}
if ($skin['data_next']) {
	$tmp_idx.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=dlist&amp;key='.$_GET['key'].'&amp;page='.((int)$_GET['page']+1).'">다음 ></a>';
}else{
	$tmp_idx.='다음 >';
}
?>
<hr size='1' color='silver'>
<div style="text-align:center;color:silver;"><?php echo $tmp_idx?></div>
</DIV>