<?php if ($_SESSION['login_id']==''){ ?>
<form method="post" action="<?php echo $config['url']['exec'].$config['file']['login']?>" name="login">
	<div>
		<b>아이디</b><br>
		<input type="text" name="login_id" tabindex='1' style="width:110px" value="<?php echo $_COOKIE['save_id']?>"><br>
		<b>암호</b><br>
		<input type="password"  tabindex='2' onKeyDown="if(event.keyCode==13){document.login.submit();}" name="login_pw" style="width:110px"><br>
		<input  tabindex='4' type="checkbox" style="border:0px none white;" name="save_id" <?php if($_COOKIE['save_id']<>''){echo 'checked';} ?>>아이디 저장
		<a tabindex='3' href="javascript:document.login.submit()"><img src="<?php echo $config['url']['skin'].$wiki['skin']?>/images/login.gif" border="0"></a> 
		<a tabindex='5' href="<?php echo $config['url']['main'].$config['file']['main_def'].'?page=join';?>" target="_blank"><img src="<?php echo $config['url']['skin'].$wiki['skin']?>/images/join.gif" border="0"></a>
	</div>
</form>
<script language="javascript" type="text/javascript">
<!--
	if (document.login.login_id.value=="")
	{
		document.login.login_id.focus();
	}else{
		document.login.login_pw.focus();
	}
-->
</script>
<?php }else{ ?>
<span style='text-align:center'>
<b><?php echo $_SESSION['login_id']?></b> (<?php echo $config['title']['join_level'][$join_level]?>)님<br>환영합니다.<br><br>
<a href='<?php echo $config['url']['main'].$config['file']['main_def']?>?page=profile&amp;id=<?php echo $_SESSION['login_id']?>' target="_blank"><img src="<?php echo $config['url']['skin'].$wiki['skin']?>/images/mypage.gif" border="0"></a> 
<a href="<?php echo $config['url']['exec'].$config['file']['login']?>?mode=logout"><img src="<?php echo $config['url']['skin'].$wiki['skin']?>/images/logout.gif" border="0"></a>
</span>
<?php } ?>