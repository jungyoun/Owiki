<div class="top_color">
<span class="title_color"><b>�˻����</b></span><br>
<?php if ($_GET['keyword']<>'') { ?>
<?php
	echo '�˻��� : '.$_GET['keyword'];
	//$tmp_str.='<ul>';
	if ($skin['no']==''){
		$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].
			'?title='.urlencode($_GET['keyword']).'&amp;mode=edit&amp;url='.$_GET['url'].'">"<b>'.add_space($_GET['keyword']).'</b>" ���� �ۼ��ϱ�</a><br>';
	}else{
		$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].
			'?no='.$skin['no'].'&amp;url='.$_GET['url'].'">"<b>'.add_space($_GET['keyword']).'</b>" �ٷΰ���</a><br>';
	}
	$tmp_str.='<br>';
		$tmp_cnt = count($skin['data']);
		if ($tmp_cnt>0){
			for($i=0;$i<$tmp_cnt;$i++){
				$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;highlight='.urlencode($_GET['keyword']).'&amp;title='.urlencode($skin['data'][$i]['title']).'">'.add_space($skin['data'][$i]['title']).'</a><br>';
			}
			$tmp_str.='<div style="text-align:center;"><hr size=1>';
			if ((int)$_GET['page']>0) {
				$tmp_str.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=result&amp;keyword='.urlencode($_GET['keyword']).'&amp;page='.((int)$_GET['page']-1).'">< ����</a> | ';
			}else{
				$tmp_str.='< ���� | ';
			}
			if ($skin['data_next']) {
				$tmp_str.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=result&amp;keyword='.urlencode($_GET['keyword']).'&amp;page='.((int)$_GET['page']+1).'">���� ></a>';
			}else{
				$tmp_str.='���� >';
			}
			$tmp_str.='</div>';
		} else {
			$tmp_str.= '�˻������ �����ϴ�.';
		}
} else {
	$tmp_str = '�˻��� �ܾ �Է��� �ּ���.';
}
?>
</div>
<DIV class="contents_color">
<?php echo $tmp_str?>
</DIV>