<script language="javascript" type="text/javascript">
<!--
function CheckID() {
  var frm = document.join;

  if (frm.join_id.value == "") {
    alert("��� ID�� ���� �Է��ϼ���");
    frm.join_id.focus();
    return;
  }
  url = './join_checkid.php';
  url = url + '?id=' + frm.join_id.value;
  window.open(url, 'checkid', 'top=20, left=120, width=420, height=240, toolbar=no, status=no, menubar=no, scrollbars=no, resizable=no, directories=no');
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
  var frm = document.join;

  if (frm.join_id.value.length == 0) {
    alert("���̵� �Է��� �ּ���.");
    frm.join_id.focus();
    return;
  }
  if ((frm.join_id.value.length < 4) || (frm.join_id.value.length > 12)) {
    alert("���̵�� 4 ~ 12�ڸ��� �����մϴ�.");
    frm.join_id.focus();
    return;
  }
  if (!CheckChar(frm.join_id.value)) {
    alert("���̵�� ������/������ ���ո� �����մϴ�.");
    frm.join_id.focus();
    return;
  }
  if (frm.join_pw.value.length == 0) {
    alert("��й�ȣ�� �Է��� �ּ���.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_pw_re.value.length == 0) {
    alert("��й�ȣ�� �ٽ��ѹ� �Է��� �ּ���.");
    frm.join_pw.focus();
    return;
  }
    if (frm.join_email.value.length == 0) {
    alert("�̸����ּҸ� �Է��� �ּ���.");
    frm.join_pw.focus();
    return;
  }
  if ((frm.join_pw.value.length < 4) || (frm.join_pw.value.length > 12)) {
    alert("��к�ȣ�� 4 ~ 12�ڸ��� �����մϴ�.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_pw.value != frm.join_pw_re.value) {
    alert("��й�ȣ�� ���� ��ġ���� �ʽ��ϴ�.");
    frm.join_pw.focus();
    return;
  }
  if (!CheckChar(frm.join_pw.value)) {
    alert("��й�ȣ�� ������/������ ���ո� �����մϴ�.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_name.value == "") {
    alert("�̸��� �Է��ϼ���.");
    frm.name.focus();
    return;
  }
  frm.submit();
}
-->
</script>
<form method='post' action='<?php echo $config['url']['main'].$config['file']['join_reg']?>' name='join'>
<input type="hidden" name="p_type" value="0">
<p><img src="images/skin_menu_join.jpg"></p>
<ul><table border="0" width="400">
    <tr>
            <td width="150" valign="top"><img src="images/check.gif">���̵�</td>
            <td width="250">                

                <input type="text" name="join_id" size="14">
				<a href="javascript:CheckID();"><img src="images/check_id.gif"  border="0" align=absmiddle></a><br>�� ������/������ ���ո� �����մϴ�.
</td>
    </tr>
        <tr>
            <td width="150" valign="top"><img src="images/check.gif">��й�ȣ</td>
            <td width="250"><input type="password" name="join_pw" size="14"></td>
    </tr>
    <tr>
            <td width="150" valign="top">                <img src="images/check.gif">�ٽ��Է�
</td>
            <td width="250"><input type="password" name="join_pw_re" size="14"></td>
    </tr>
    <tr>
        <td width="150" valign="top"><img src="images/check.gif">�̸�</td>
            <td width="250"><input type="text" name="join_name" size="14"></td>
    </tr>
    <tr>
        <td width="150" valign="top"><img src="images/check.gif">�̸���</td>
            <td width="250"><input type="text" name="join_email" size="14"></td>
    </tr>
    <tr>
            <td width="150" valign="top">Ȩ������</td>
            <td width="250">                <input type="text" name="join_homepage" size="14">
</td>
    </tr>
    <tr>
        <td width="150" height="24" valign="top">�ڱ�Ұ�</td>
            <td width="250" height="24"><textarea name="join_pr" rows="4" style="width:200px"></textarea></td>
    </tr>
    <tr>
            <td width="150" height="24" valign="top">��������</td>
            <td width="250" height="24"><input type="checkbox" name="join_view" checked>������ ���� �մϴ�.</td>
    </tr>
</table>
<img src="images/check.gif"> ǥ�ô� �ʼ� �Է��׸�. <br><br> ����� <b>����</b> �Ͻø� ���Թ�ư�� �����ּ���.<br>
<a href="javascript:gogo();"><img src="images/join.gif" border="0"></a> 
<a href="javascript:history.go(-1);"><img src="images/cancel.gif" border="0"></a>
</form>
</ul>