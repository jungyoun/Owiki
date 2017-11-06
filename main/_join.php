<script language="javascript" type="text/javascript">
<!--
function CheckID() {
  var frm = document.join;

  if (frm.join_id.value == "") {
    alert("희망 ID를 먼저 입력하세요");
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
    alert("아이디를 입력해 주세요.");
    frm.join_id.focus();
    return;
  }
  if ((frm.join_id.value.length < 4) || (frm.join_id.value.length > 12)) {
    alert("아이디는 4 ~ 12자리만 가능합니다.");
    frm.join_id.focus();
    return;
  }
  if (!CheckChar(frm.join_id.value)) {
    alert("아이디는 영문자/숫자의 조합만 가능합니다.");
    frm.join_id.focus();
    return;
  }
  if (frm.join_pw.value.length == 0) {
    alert("비밀번호를 입력해 주세요.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_pw_re.value.length == 0) {
    alert("비밀번호를 다시한번 입력해 주세요.");
    frm.join_pw.focus();
    return;
  }
    if (frm.join_email.value.length == 0) {
    alert("이메일주소를 입력해 주세요.");
    frm.join_pw.focus();
    return;
  }
  if ((frm.join_pw.value.length < 4) || (frm.join_pw.value.length > 12)) {
    alert("비밀빈호는 4 ~ 12자리만 가능합니다.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_pw.value != frm.join_pw_re.value) {
    alert("비밀번호가 서로 일치하지 않습니다.");
    frm.join_pw.focus();
    return;
  }
  if (!CheckChar(frm.join_pw.value)) {
    alert("비밀번호는 영문자/숫자의 조합만 가능합니다.");
    frm.join_pw.focus();
    return;
  }
  if (frm.join_name.value == "") {
    alert("이름을 입력하세요.");
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
            <td width="150" valign="top"><img src="images/check.gif">아이디</td>
            <td width="250">                

                <input type="text" name="join_id" size="14">
				<a href="javascript:CheckID();"><img src="images/check_id.gif"  border="0" align=absmiddle></a><br>※ 영문자/숫자의 조합만 가능합니다.
</td>
    </tr>
        <tr>
            <td width="150" valign="top"><img src="images/check.gif">비밀번호</td>
            <td width="250"><input type="password" name="join_pw" size="14"></td>
    </tr>
    <tr>
            <td width="150" valign="top">                <img src="images/check.gif">다시입력
</td>
            <td width="250"><input type="password" name="join_pw_re" size="14"></td>
    </tr>
    <tr>
        <td width="150" valign="top"><img src="images/check.gif">이름</td>
            <td width="250"><input type="text" name="join_name" size="14"></td>
    </tr>
    <tr>
        <td width="150" valign="top"><img src="images/check.gif">이메일</td>
            <td width="250"><input type="text" name="join_email" size="14"></td>
    </tr>
    <tr>
            <td width="150" valign="top">홈페이지</td>
            <td width="250">                <input type="text" name="join_homepage" size="14">
</td>
    </tr>
    <tr>
        <td width="150" height="24" valign="top">자기소개</td>
            <td width="250" height="24"><textarea name="join_pr" rows="4" style="width:200px"></textarea></td>
    </tr>
    <tr>
            <td width="150" height="24" valign="top">정보공개</td>
            <td width="250" height="24"><input type="checkbox" name="join_view" checked>정보를 공개 합니다.</td>
    </tr>
</table>
<img src="images/check.gif"> 표시는 필수 입력항목. <br><br> 약관에 <b>동의</b> 하시면 가입버튼을 눌러주세요.<br>
<a href="javascript:gogo();"><img src="images/join.gif" border="0"></a> 
<a href="javascript:history.go(-1);"><img src="images/cancel.gif" border="0"></a>
</form>
</ul>