<?php
include "../_config.php";
include "../_func.common.php";
if ($_GET['id']=='') $_GET['id'] = $_POST['id'];
$_GET['id']=str_chk($_GET['id']);
DB_query_start();
function checkid($id)
{
	global $config;
	if (strpos(','.$config['filter']['id'].',',','.$url.',')===false){
	$result = DB_query('select * from '.$config['db_table']['user'].' where id=\''.$id.'\' ');
	if ($result<>'') $tc1 = mysql_num_rows($result);
	if ($tc1<1){
		return true;
	}else{
		return false;
	}
	}else{
		return false;
	}
}
?>
<html>
<head>
<meta name="GENERATOR" content="Namo WebEditor v6.0">
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<script language="javascript" type="text/javascript">
<!--
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
  var frm = document.form1;

  if (frm.id.value.length == 0) {
    alert("���̵� �Է��� �ּ���.");
    frm.id.focus();
    return;
  }
  if ((frm.id.value.length < 4) || (frm.id.value.length > 12)) {
    alert("���̵�� 4 ~ 12�ڸ��� �����մϴ�.");
    frm.id.focus();
    return;
  }
  if (!CheckChar(frm.id.value)) {
    alert("���̵�� ������/������ ���ո� �����մϴ�.");
    frm.id.focus();
    return;
  }
  frm.submit();
}
function SelectID(id) {
  opener.document.join.join_id.value = id;
  opener.document.join.join_pw.focus();

  window.close();
}
-->
</script>
<title>���̵� �ߺ��˻�</title>
</head>
<body>

<p>���̵� �ߺ��˻�</p>
<?php
if (checkid($_GET['id'])){
	echo '"'.$_GET['id'].'"�� ��밡���մϴ�.';
}else{
	echo '"'.$_GET['id'].'"�� �̹� ������Դϴ�.';
}
DB_query_end();
?>

<form name="form1">
    <p><input type="text" name="id"> <a href="javascript:gogo();"><img src="images/check_id.gif" border='0' align='absmiddle'></a></p>
</form>
<script language="javascript" type="text/javascript">
<!--
document.form1.id.focus();
-->
</script>
<p><img src="images/ok.gif" border="0" align='absmiddle' onClick="SelectID('<?echo $_GET['id']; ?>');"> <img src="images/cancel.gif" border="0" align='absmiddle' onClick="window.close();"></p>
</body>
</html> 