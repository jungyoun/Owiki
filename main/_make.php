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
    alert("희망 URL를 먼저 입력하세요");
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
    alert("주소를 입력해 주세요.");
    frm.make_url.focus();
    return;
  }
  if ((frm.make_url.value.length < 4) || (frm.make_url.value.length > 30)) {
    alert("주소는 4 ~ 30자리만 가능합니다.");
    frm.make_url.focus();
    return;
  }
  if (!CheckChar(frm.make_url.value)) {
    alert("주소는 영문자/숫자의 조합만 가능합니다.");
    frm.make_url.focus();
    return;
  }
  if (frm.make_title.value.length == 0) {
    alert("제목을 입력해 주세요.");
    frm.make_title.focus();
    return;
  }
  if (frm.make_pr.value.length == 0) {
    alert("설명을 입력해 주세요.");
    frm.make_pr.focus();
    return;
  }
  if (frm.make_title.value.length > 100) {
    alert("제목은 100자 이하로 입력해 주세요.");
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
	<td width="150" valign="top">주소</td>
	<td width="250">                
		<input type="text" name="make_url" size="14">
			<a href="javascript:CheckURL();"><img src="images/check_url.gif" border='0'></a><br>※ 대소문자 구분없이 알파벳/숫자 30자 이하.
	</td>
</tr>
<tr>
	<td width="150" valign="top">제목</td>
	<td width="250">                
		<input type="text" name="make_title" style="width:200px;" size="14"><br>
		※ 50자 이하.(태그사용불가)
	</td>
</tr>
<tr>
	<td width="150" valign="top">설명</td>
	<td width="250">                
		<input type="text" name="make_pr" style="width:200px;" size="14"><br>※ 50자 이하.(태그사용불가)
	</td>
</tr>
</table>
<p><span style="color:red">※ 약관<br>
1. 정치,종교,불법자료 관련 위키는 개설하실수 없습니다.<br>
2. 정치,종교,불법자료 관련 글도 올리실 수 없습니다.<br>
3. 위키를 개설 후 생기는 문제에 대한 책임은 해당 위키를 개설한 유저에게 있음을 알립니다.<br>
4. 위 1,2번에 위반하는 위키사이트는 적발시 삭제됩니다.<br>
5. 위의 약관에 동의하시는 분만 위키를 개설할 수 있습니다.</span></p>
<p><a href="javascript:gogo();"><img src="images/make.gif" border='0' align='absmiddle'></a> <a href="javascript:history.go(-1);"><img src="images/cancel.gif" border='0' align='absmiddle'></a></p>
</form>
</ul>
<?php
} else {
	go_back('더이상 위키를 개설할 수 없습니다.',true);
}
/*
$row=mysql_fetch_array($result);
$row['n_title'] = stripslashes($row['n_title']);
$row['d_content'] = stripslashes($row['d_content']);	
*/
?>
<?php 
	} else {
		go_back('로그인 후 이용해 주세요.',true);
	} 
?>