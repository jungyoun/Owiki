<?php 
include_once '../_func.common.php';
if ($_GET['id']=='' and $_SESSION['login_id']=='') go_back('�߸��� �����Դϴ�.',true);?>
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
<b>������������</b><span style="color:silver;"> | ��й�ȣ ����</span>
<form method="post" action="<?php echo $config['url']['main'].$config['file']['join_reg']?>" name="join">
<table border="0" width="400">
    <tr>
        <td width="150">���̵�</td>
		<td width="250"><?php echo $_GET['id']?></td>
	</tr>

	<tr>
        <td width="150">���� ��ȣ</td>
		<td width="250"><input type="password" name="join_pw_2" size="14"</td>
	</tr>
<tr>
    <td width="150">�� ��ȣ</td>
	<td width="250"><input type="password" name="join_pw" size="14"></td>
</tr>
<tr>
    <td width="150">�ٽ��Է�</td>
	<td width="250">
		<input type="password" name="join_pw_re" size="14">
		<input type="submit" name="join_submit" value="�����ϱ�">
		<input type="hidden" name="p_type" value="1">
		<input type="hidden" name="join_id" value="<?php echo $_GET['id']?>">
	</td>
</table>
</form>
<hr size="1" color="silver">
<b>�������� ����</b>
<form method="post" action="<?php echo $config['url']['main'].$config['file']['join_reg']?>" name="join2">
<table border="0">
<tr>
    <td width="150">�̸�</td>
	<td width="250"><input type="text" name="join_name" size="14" value="<?php echo $skin['name']?>"></td>
</tr>
<tr>
    <td width="150">�̸���</td>
	<td width="250"><input type="text" name="join_email" size="26" value="<?php echo $skin['email']?>"></td>
</tr>
<tr>
    <td width="150">Ȩ������</td>
	<td width="250"><input type="text" name="join_homepage" size="26" value="<?php echo $skin['homepage']?>"></td>
</tr>
<tr>
    <td width="150">�ڱ�Ұ�</td>
	<td width="250"><textarea name="join_pr" rows="12" style="width:200px;"><?php echo stripslashes($skin['memo'])?></textarea></td>
</tr>
<tr>
    <td width="150">��������</td>
	<td width="250">
	<?if($skin['view']) $tmp_view='checked';?>
		<input type="checkbox" name="join_view" <?php echo $tmp_view?>>������ ���� �մϴ�.
		<input type="hidden" name="p_type" value="2">
		<input type="hidden" name="join_id" value="<?php echo $_GET['id']?>">
	</td>
</table>
<input type="submit" value="�����ϱ�">
</form>
<?}else{?>
<?if($skin['id']<>''){?>
<?if($_SESSION['login_id']==$config['admin']['id'] or $skin['view']){?>
<b><?php echo $skin['id']?>���� ��������</b><span style="color:silver;"> | ��й�ȣ ����</span>
<table border="0">
    <tr>
        <td width="150">���̵�</td>
		<td width="250"><?php echo $skin['id']?></td>
	</tr>
	<tr>
		<td width="150">�̸�</td>
		<td width="250"><?php echo htmlspecialchars($skin['name'])?></td>
	</tr>
	<tr>
		<td width="150">�̸���</td>
		<td width="250"><?php echo htmlspecialchars($skin['email'])?></td>
	</tr>
	<?php if ($skin['homepage']<>'') { ?>
	<tr>
		<td width="150">Ȩ������</td>
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
		<td width="150">�ڱ�Ұ�</td>
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