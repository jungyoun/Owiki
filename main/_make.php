<?php 
	if ($_SESSION['login_id']<>'') { 
		$result=DB_query('select count(no) from '.$config['db_table']['space'].' where accept=\'2\' and id=\''.$_SESSION['login_id'].'\' ');
		if ( $result<>'' ) $row=mysql_fetch_row($result);
		$row[0]=(int)$row[0];
		if ($_SESSION['login_id']==$config['admin']['id'] || $config['max']['make_wiki_space']>$row[0] ){
?>
<script language="javascript" type="text/javascript">
<!--
function CheckURL() {
  var frm = document.make;

  if (frm.make_url.value == "") {
    alert("��� URL�� ���� �Է��ϼ���");
    frm.make_url.focus();
    return;
  }
  url = './make_checkurl.php';
  url = url + '?url=' + frm.make_url.value;
  window.open(url, 'checkurl', 'top=20, left=120, width=420, height=240, toolbar=no, status=no, menubar=no, scrollbars=no, resizable=no, directories=no');
}

function CheckChar(str)
{
  var alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  var numeric = '1234567890';
  var chars = alpha+numeric; 
  
  var i; 
  for (i = 0; i < str.length; i++) {
    if (chars.indexOf(str.substring(i, i+1)) < 0) {
      break;
    }
  }
  if (i != str.length) {
    return false ; 
  } else {
    return true ;
  } 
  return true;
}

function gogo() {
  var frm = document.make;

  if (frm.make_url.value.length == 0) {
    alert("�ּҸ� �Է��� �ּ���.");
    frm.make_url.focus();
    return;
  }
  if ((frm.make_url.value.length < 4) || (frm.make_url.value.length > 30)) {
    alert("�ּҴ� 4 ~ 30�ڸ��� �����մϴ�.");
    frm.make_url.focus();
    return;
  }
  if (!CheckChar(frm.make_url.value)) {
    alert("�ּҴ� ������/������ ���ո� �����մϴ�.");
    frm.make_url.focus();
    return;
  }
  if (frm.make_title.value.length == 0) {
    alert("������ �Է��� �ּ���.");
    frm.make_title.focus();
    return;
  }
  if (frm.make_pr.value.length == 0) {
    alert("������ �Է��� �ּ���.");
    frm.make_pr.focus();
    return;
  }
  if (frm.make_title.value.length > 100) {
    alert("������ 100�� ���Ϸ� �Է��� �ּ���.");
    frm.make_title.focus();
    return;
  }
  frm.submit();
}
-->
</script>
<form method='post' action='<?php echo $config['url']['main'].$config['file']['make_reg']?>' name='make'>
<p><img src="images/skin_menu_makewiki.jpg"></p>
<ul><table border="0" width="400">
<tr>
	<td width="150" valign="top">�ּ�</td>
	<td width="250">                
		<input type="text" name="make_url" size="14">
			<a href="javascript:CheckURL();"><img src="images/check_url.gif" border='0'></a><br>�� ��ҹ��� ���о��� ���ĺ�/���� 30�� ����.
	</td>
</tr>
<tr>
	<td width="150" valign="top">����</td>
	<td width="250">                
		<input type="text" name="make_title" style="width:200px;" size="14"><br>
		�� 50�� ����.(�±׻��Ұ�)
	</td>
</tr>
<tr>
	<td width="150" valign="top">����</td>
	<td width="250">                
		<input type="text" name="make_pr" style="width:200px;" size="14"><br>�� 50�� ����.(�±׻��Ұ�)
	</td>
</tr>
</table>
<p><span style="color:red">�� ���<br>
1. ��ġ,����,�ҹ��ڷ� ���� ��Ű�� �����ϽǼ� �����ϴ�.<br>
2. ��ġ,����,�ҹ��ڷ� ���� �۵� �ø��� �� �����ϴ�.<br>
3. ��Ű�� ���� �� ����� ������ ���� å���� �ش� ��Ű�� ������ �������� ������ �˸��ϴ�.<br>
4. �� 1,2���� �����ϴ� ��Ű����Ʈ�� ���߽� �����˴ϴ�.<br>
5. ���� ����� �����Ͻô� �и� ��Ű�� ������ �� �ֽ��ϴ�.</span></p>
<p><a href="javascript:gogo();"><img src="images/make.gif" border='0' align='absmiddle'></a> <a href="javascript:history.go(-1);"><img src="images/cancel.gif" border='0' align='absmiddle'></a></p>
</form>
</ul>
<?php
} else {
	go_back('���̻� ��Ű�� ������ �� �����ϴ�.',true);
}
/*
$row=mysql_fetch_array($result);
$row['n_title'] = stripslashes($row['n_title']);
$row['d_content'] = stripslashes($row['d_content']);	
*/
?>
<?php 
	} else {
		go_back('�α��� �� �̿��� �ּ���.',true);
	} 
?>