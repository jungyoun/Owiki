<?php //�޺��ڽ� ����� �̸� ������ش�.
		$tmp_idx_str.='<select name="key" style="font-size:9pt;" OnChange="location.href= \'index.php?url='.$_GET['url'].'&mode=list&key=\'+this.value;">';
		$tmp_key[$_GET['key']]='selected';
		$tmp_count=count($skin['index_data']);
		for ($i=0;$i<$tmp_count;$i++)
		{
			$tmp_idx_str.='<option '.$tmp_key[$i].' value="'.$i.'" >'.$skin['index_data'][$i][0].'</option>';
		}
		$tmp_idx_str.='</select>';
?>
<div class="top_color">
<span class="title_color">�������</span> - ���κ� <?php echo $tmp_idx_str?>
<br>
��ü��� ���� �ֽ��ϴ�.
</div>
<DIV class="contents_color">
<?php
if (count($skin['data'])>0){
	for($i=0;$i<count($skin['data']);$i++){
		$tmp_str.= ' <a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;title='.urlencode($skin['data'][$i]['title']).'">'.add_space($skin['data'][$i]['title']).'</a><br>';
	}
}else{
	$tmp_str.='��������<br>';
}
echo $tmp_str;
if ((int)$_GET['page']>0) {
	$tmp_idx.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=list&amp;key='.$_GET['key'].'&amp;page='.((int)$_GET['page']-1).'">< ����</a> | ';
}else{
	$tmp_idx.='< ���� | ';
}
if ($skin['data_next']) {
	$tmp_idx.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=list&amp;key='.$_GET['key'].'&amp;page='.((int)$_GET['page']+1).'">���� ></a>';
}else{
	$tmp_idx.='���� >';
}
?>
<hr size='1' color='silver'>
<div style="text-align:center;color:silver;"><?php echo $tmp_idx?></div>
</DIV>