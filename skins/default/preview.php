<?php
?>
<div class="top_color">
<span class="title_color">미리보기</span></div>
<form name="preview" method="post" action='<?php echo $config['url']['exec'].$config['file']['def']?>'>
<DIV class="contents_color">
	제목 : <?php echo cutstring($skin['title'],70)?><br>
	분류 : <?php if ($_POST['category']==''){ echo '비분류'; } else { echo $_POST['category']; }?><br>
	읽기권한 : <?php echo $skin['view_level_title']?> / 쓰기권한 : <?php echo $skin['write_level_title']?><br><br>
	<DIV style="border:1px solid silver;padding:10px;">
	<?php echo $skin['contents_conv']?>
	</DIV>
	<br>
	<input type="hidden" name="title" value="<?php echo $skin['title']?>">
	<input type="hidden" name="view_level" value="<?php echo $skin['view_level']?>">
	<input type="hidden" name="use_html" value="<?php echo $skin['use_html']?>">
	<input type="hidden" name="category" value="<?php echo $skin['category']?>">
	<input type="hidden" name="contents" value="<?php echo $skin['contents']?>">
	<input type="hidden" name="mode" value="insert">
	<input type="hidden" name="date" value="<?php echo $skin['date']?>">
	<input type="hidden" name="no" value="<?php echo $_POST['no']?>">
	<input type="hidden" name="url" value='<?php echo $_GET['url']?>'>
	<input type="button" value="뒤로" OnClick="history.go(-1);">
	<input type="button" value="완료" OnClick="document.preview.submit();">
	
</DIV>
</form>