<div class="top_color">
<span class="title_color">������</span><br>
������ �κ��� �˷��ݴϴ�(�д¹� : <span class="diff_del">����</span><span class="diff_insert">�߰�</span><span class="diff_no">����</span>)<br>
<a href="javascript:history.go(-1);">�ڷ�</a> | <a href="javascript:ask_delre('<?php echo $skin['d_no']?>');">����</a></div>
<DIV class="contents_color">
<br><b>���� ����</b><hr>
<?php 
if ($skin['data'][0]<>'')
{
	echo $skin['data'][0];
}else{
	echo '������ ������ �����ϴ�.';
}
?><br><b>�ֽ� ����</b><hr><?php
if ($skin['data'][1]<>'')
{
	echo $skin['data'][1];
}else{
	echo '������ ������ �����ϴ�.';
}
?>
</DIV>