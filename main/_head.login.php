<?php
if ($_SESSION['login_id']==''){
?>
<form method="post" action="<?php echo $config['url']['exec'].$config['file']['login']?>" name="login">
		<b>아이디</b>
		<input type="text" name="login_id" style="width:100px" value="<?php echo $_COOKIE['save_id']?>">
		<b>암호</b>
		<input type="password" onKeyDown="if(event.keyCode==13){document.login.submit();}" name="login_pw" style="width:100px">
		<input type="checkbox" style="border:0px none white;" name="save_id" <?php if($_COOKIE['save_id']<>''){echo 'checked';} ?>>아이디 저장
		<a href="javascript:document.login.submit()"><img src="images/login.gif" border='0'>
		</a>
		<a href="<?php echo $config['url']['main'].$config['file']['main_def'].'?page=join';?>"><img src="images/join.gif" border='0'>
		</a>
</form>
<?php }else{ ?>
	<b><?php echo $_SESSION['login_id']?></b>(<?php echo $_SESSION['login_name']?>)님 환영합니다.
	<a href="<?php echo $config['url']['main'].$config['file']['main_def']?>?page=profile&amp;id=<?php echo $_SESSION['login_id']?>"><img src="images/mypage.gif" border='0'></a> <a href="<?php echo $config['url']['exec'].$config['file']['login']?>?mode=logout"><img src="images/logout.gif" border='0'></a> &nbsp;&nbsp;<?php echo stripslashes($_COOKIE['my_wiki'])?>
<?php }?>