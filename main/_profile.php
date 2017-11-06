<?php 
include_once '../_func.common.php';
if ($_GET['id']=='' and $_SESSION['login_id']=='') go_back('잘못된 접근입니다.',true);?>
<?php 
	$_GET['id']=str_chk($_GET['id']);
	$result = DB_query('select name,email,homepage,memo,view,no,id from '.$config['db_table']['user'].' where id=\''.strtolower($_GET['id']).'\' ');
	if ($result<>''){
	$row=mysql_fetch_array($result);
	$skin['name'] = $row['name'];
	$skin['email'] = $row['email'];
	$skin['homepage'] = $row['homepage'];
	$skin['memo'] = $row['memo'];
	if ($row['view']=='on')
		$skin['view']=true;

	$skin['no'] = $row['no'];
	$skin['id'] = $row['id'];
	}
?>
<?php if ($_SESSION['login_id']==$config['admin']['id'] or ( $_GET['id']=='' and $_SESSION['login_id']<>'') or $_GET['id']==$_SESSION['login_id'] ){ ?>
<b>개인정보변경</b><span style="color:silver;"> | 비밀번호 변경</span>
<form method="post" action="<?php echo $config['url']['main'].$config['file']['join_reg']?>" name="join">
<table border="0" width="400">
    <tr>
        <td width="150">아이디</td>
		<td width="250"><?php echo $_GET['id']?></td>
	</tr>

	<tr>
        <td width="150">기존 암호</td>
		<td width="250"><input type="password" name="join_pw_2" size="14"</td>
	</tr>
<tr>
    <td width="150">새 암호</td>
	<td width="250"><input type="password" name="join_pw" size="14"></td>
</tr>
<tr>
    <td width="150">다시입력</td>
	<td width="250">
		<input type="password" name="join_pw_re" size="14">
		<input type="submit" name="join_submit" value="변경하기">
		<input type="hidden" name="p_type" value="1">
		<input type="hidden" name="join_id" value="<?php echo $_GET['id']?>">
	</td>
</table>
</form>
<hr size="1" color="silver">
<b>인적사항 변경</b>
<form method="post" action="<?php echo $config['url']['main'].$config['file']['join_reg']?>" name="join2">
<table border="0">
<tr>
    <td width="150">이름</td>
	<td width="250"><input type="text" name="join_name" size="14" value="<?php echo $skin['name']?>"></td>
</tr>
<tr>
    <td width="150">이메일</td>
	<td width="250"><input type="text" name="join_email" size="26" value="<?php echo $skin['email']?>"></td>
</tr>
<tr>
    <td width="150">홈페이지</td>
	<td width="250"><input type="text" name="join_homepage" size="26" value="<?php echo $skin['homepage']?>"></td>
</tr>
<tr>
    <td width="150">자기소개</td>
	<td width="250"><textarea name="join_pr" rows="12" style="width:200px;"><?php echo stripslashes($skin['memo'])?></textarea></td>
</tr>
<tr>
    <td width="150">정보공개</td>
	<td width="250">
	<?if($skin['view']) $tmp_view='checked';?>
		<input type="checkbox" name="join_view" <?php echo $tmp_view?>>정보를 공개 합니다.
		<input type="hidden" name="p_type" value="2">
		<input type="hidden" name="join_id" value="<?php echo $_GET['id']?>">
	</td>
</table>
<input type="submit" value="저장하기">
</form>
<?}else{?>
<?if($skin['id']<>''){?>
<?if($_SESSION['login_id']==$config['admin']['id'] or $skin['view']){?>
<b><?php echo $skin['id']?>님의 개인정보</b><span style="color:silver;"> | 비밀번호 변경</span>
<table border="0">
    <tr>
        <td width="150">아이디</td>
		<td width="250"><?php echo $skin['id']?></td>
	</tr>
	<tr>
		<td width="150">이름</td>
		<td width="250"><?php echo htmlspecialchars($skin['name'])?></td>
	</tr>
	<tr>
		<td width="150">이메일</td>
		<td width="250"><?php echo htmlspecialchars($skin['email'])?></td>
	</tr>
	<?php if ($skin['homepage']<>'') { ?>
	<tr>
		<td width="150">홈페이지</td>
		<?php
			if (strtolower(substr($skin['homepage'],0,7))=='http://') 
			{
				$tmp_hp=$skin['homepage'];
			}else{
				$tmp_hp='http://'.$skin['homepage'];
			}
		?>
		<td width="250"><a href="<?php echo $tmp_hp?>" target="_blank"><?php echo htmlspecialchars($tmp_hp)?></a></td>
	</tr>
	<?php } ?>
	<?php if ($skin['memo']<>'') { ?>
	<tr>
		<td width="150">자기소개</td>
		<td width="250">
		<?php echo htmlspecialchars(stripslashes($skin['memo']))?>
	</td>
	<?php } ?>
</tr>
</table>
<?php
}else go_page($config['msg']['common'][3],$config['url']['main'].$config['file']['main_def']);
}else go_page($config['msg']['common'][4],$config['url']['main'].$config['file']['main_def']);
}?>