<script language="javascript" type="text/javascript">
<!--
function use_html_tag(obj){
	if(obj.checked) {
		var get_return = confirm("�ڵ� �ٹٲ��� �Ͻðڽ��ϱ�?");
		if(get_return){
			obj.value=2;
		}else{
			obj.value=1;
		}
		
	}else{
		obj.value=0;
	}
}
function view_setting( div_id )
{
	var tmp_div = document.getElementById( div_id );
	if( tmp_div.style.display == "none" )
		tmp_div.style.display = "block";
	else
		tmp_div.style.display = "none";
}
-->
</script>
<div class="top_color">
<span class="title_color">�۾���</span></div>
<form name="edit" method="post" action='<?php echo $config['url']['exec'].$config['file']['def']?>'>
<DIV class="contents_color">
	���� : <input name="title" maxlength="35" size="35" value="<?php echo cutstring($skin['title'],70)?>"> <a href="javascript:void(0);" OnClick="view_setting('setting_div')">���μ���</a>
	<DIV id="setting_div" STYLE="display:none">
	�з� : <?php echo $skin['category']?>
	���� : �б� <?php echo $skin['type_view']?> / ���� <?php echo $skin['type_write']?>
	<input type="checkbox" style="border:0px none white;" name="use_html" value="<?php echo $skin['use_html_value']?>" OnClick="use_html_tag(this);" <?php echo $skin['use_html']?>>html ���
	</DIV>
	<TEXTAREA name="contents" style="width:480px;height:250px;"><?php echo $skin['contents']?></TEXTAREA><br>
	<input type="hidden" name="mode">
	<input type="hidden" name="date" value="<?php echo $skin['date']?>">
	<input type="hidden" name="no" value="<?php echo $skin['no']?>">
	<input type="hidden" name="url" value='<?php echo $_GET['url']?>'>
	<input type="button" value="�̸�����" OnClick="document.edit.mode.value='preview';document.edit.submit();">
	<input type="button" value="�Ϸ�" OnClick="document.edit.mode.value='insert';document.edit.submit();">
	<input type="button" value="���" OnClick="history.go(-1);">
</DIV>
</form>