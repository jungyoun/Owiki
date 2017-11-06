<div class="top_color">
<span class="title_color"><b>검색결과</b></span><br>
<?php if ($_GET['keyword']<>'') { ?>
<?php
	echo '검색어 : '.$_GET['keyword'];
	//$tmp_str.='<ul>';
	if ($skin['no']==''){
		$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].
			'?title='.urlencode($_GET['keyword']).'&amp;mode=edit&amp;url='.$_GET['url'].'">"<b>'.add_space($_GET['keyword']).'</b>" 문서 작성하기</a><br>';
	}else{
		$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].
			'?no='.$skin['no'].'&amp;url='.$_GET['url'].'">"<b>'.add_space($_GET['keyword']).'</b>" 바로가기</a><br>';
	}
	$tmp_str.='<br>';
		$tmp_cnt = count($skin['data']);
		if ($tmp_cnt>0){
			for($i=0;$i<$tmp_cnt;$i++){
				$tmp_str.= '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;highlight='.urlencode($_GET['keyword']).'&amp;title='.urlencode($skin['data'][$i]['title']).'">'.add_space($skin['data'][$i]['title']).'</a><br>';
			}
			$tmp_str.='<div style="text-align:center;"><hr size=1>';
			if ((int)$_GET['page']>0) {
				$tmp_str.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=result&amp;keyword='.urlencode($_GET['keyword']).'&amp;page='.((int)$_GET['page']-1).'">< 이전</a> | ';
			}else{
				$tmp_str.='< 이전 | ';
			}
			if ($skin['data_next']) {
				$tmp_str.='<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=result&amp;keyword='.urlencode($_GET['keyword']).'&amp;page='.((int)$_GET['page']+1).'">다음 ></a>';
			}else{
				$tmp_str.='다음 >';
			}
			$tmp_str.='</div>';
		} else {
			$tmp_str.= '검색결과가 없습니다.';
		}
} else {
	$tmp_str = '검색할 단어를 입력해 주세요.';
}
?>
</div>
<DIV class="contents_color">
<?php echo $tmp_str?>
</DIV>