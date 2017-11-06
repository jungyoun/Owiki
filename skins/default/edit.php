<script language="javascript" type="text/javascript">
<!--
function use_html_tag(obj){
	if(obj.checked) {
		var get_return = confirm("자동 줄바꿈을 하시겠습니까?");
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
<span class="title_color">글쓰기</span></div>
<form name="edit" method="post" action='<?php echo $config['url']['exec'].$config['file']['def']?>'>
<DIV class="contents_color">
	제목 : <input name="title" maxlength="35" size="35" value="<?php echo cutstring($skin['title'],70)?>"> <a href="javascript:void(0);" OnClick="view_setting('setting_div')">세부설정</a>
	<DIV id="setting_div" STYLE="display:none">
	분류 : <?php echo $skin['category']?>
	권한 : 읽기 <?php echo $skin['type_view']?> / 쓰기 <?php echo $skin['type_write']?>
	<input type="checkbox" style="border:0px none white;" name="use_html" value="<?php echo $skin['use_html_value']?>" OnClick="use_html_tag(this);" <?php echo $skin['use_html']?>>html 사용
	</DIV>
	<TEXTAREA name="contents" style="width:480px;height:250px;"><?php echo $skin['contents']?></TEXTAREA><br>
	<input type="hidden" name="mode">
	<input type="hidden" name="date" value="<?php echo $skin['date']?>">
	<input type="hidden" name="no" value="<?php echo $skin['no']?>">
	<input type="hidden" name="url" value='<?php echo $_GET['url']?>'>
	<input type="button" value="미리보기" OnClick="document.edit.mode.value='preview';document.edit.submit();">
	<input type="button" value="완료" OnClick="document.edit.mode.value='insert';document.edit.submit();">
	<input type="button" value="취소" OnClick="history.go(-1);">
</DIV>
</form>