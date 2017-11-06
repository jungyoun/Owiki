<div class="top_color">
<span class="title_color">문서비교</span><br>
수정한 부분을 알려줍니다(읽는법 : <span class="diff_del">삭제</span><span class="diff_insert">추가</span><span class="diff_no">생략</span>)<br>
<a href="javascript:history.go(-1);">뒤로</a> | <a href="javascript:ask_delre('<?php echo $skin['d_no']?>');">복구</a></div>
<DIV class="contents_color">
<br><b>이전 문서</b><hr>
<?php 
if ($skin['data'][0]<>'')
{
	echo $skin['data'][0];
}else{
	echo '수정된 내용이 없습니다.';
}
?><br><b>최신 문서</b><hr><?php
if ($skin['data'][1]<>'')
{
	echo $skin['data'][1];
}else{
	echo '수정된 내용이 없습니다.';
}
?>
</DIV>