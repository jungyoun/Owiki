<?php
include "../_config.php";
include "../_func.common.php";
if ($_GET['url']=='') $_GET['url'] = $_POST['url'];
$_GET['url']=strtolower($_GET['url']);
function checkurl($url)
{
	global $config;
	if (strpos(','.$config['filter']['url'].',',','.$url.',')===false){
		
		$result = DB_query('select * from '.$config['db_table']['space'].' where url=\''.$url.'\' and accept=\'2\' ');
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

  if (frm.url.value.length == 0) {
    alert("주소를 입력해 주세요.");
    frm.url.focus();
    return;
  }
  if ((frm.url.value.length < 4) || (frm.url.value.length > 30)) {
    alert("주소는 4 ~ 30자리만 가능합니다.");
    frm.url.focus();
    return;
  }
  if (!CheckChar(frm.url.value)) {
    alert("주소는 영문자/숫자의 조합만 가능합니다.");
    frm.url.focus();
    return;
  }
  frm.submit();
}
function SelectURL(url) {
  opener.document.make.make_url.value = url;
  opener.document.make.make_url.focus();

  window.close();
}
-->
</script>
<title>주소 중복검사</title>
</head>
<body>

<p>주소 중복검사</p>
<?php
if (checkurl($_GET['url'])){
	echo '"'.$_GET['url'].'"는 사용가능합니다.';
}else{
	echo '"'.$_GET['url'].'"는 이미 사용중입니다.';
}
?>

<form name="form1">
    <p><input type="text" name="url"> <a href="javascript:gogo();"><img src="images/check_url.gif" border='0' align='absmiddle'></a></p>
</form>
<script language="javascript" type="text/javascript">
<!--
document.form1.url.focus();
-->
</script>
<p><img src="images/ok.gif" border="0" align="absmiddle" onClick="SelectURL('<?echo $_GET['url']; ?>');"> <img src="images/cancel.gif" border="0" align="absmiddle" onClick="window.close();"></p>
</body>
</html> 