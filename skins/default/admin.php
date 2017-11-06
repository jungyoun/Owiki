<div class="top_color">
	<span class="title_color">위키관리 페이지</span>
</div>
<?php if($_GET['type']=='setting') {?>
	<script language="javascript" type="text/javascript">
	<!--
	function ask_wikidel(){
		ans=confirm("폐쇄 후 자료는 복구되지 않습니다.\n정말로 위키를 폐쇄 하시겠습니까?");
		if (ans==true)
		location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?mode=wikidel&url=<?php echo $_GET['url']?>";
	}
	-->
	</SCRIPT>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=setting">위키 설정</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="no_select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=member">회원 관리</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:200px;">&nbsp;</DIV>
	<div style="clear:left;">
	</div>
<div style="height:10px;">&nbsp;</div>
<form method="post" action="<?php echo $config['url']['exec'].$config['file']['def']?>" name="admin">
<table border="0" width="450"><tr>
	<td width="100" height="45" valign="top"><p align="right"><span style="font-size:10pt;"><b>위키 이름</b></span></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;">
		<input type="text" name="wiki_title" value="<?php echo $wiki['title']?>" style="width:200px;" maxlength="50"> ( 최대 : 50자 )</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">위키 소개</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;"><input type="text" name="wiki_pr" value="<?php echo $wiki['pr']?>"  style="width:200px;" maxlength="100"> ( 최대 : 100자 )</span></td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">스킨</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<select name="wiki_skin" size="1" style="width:150px;font-size:9pt;">
		<?php
		for ($i=0;$i<sizeof($skin['skin_list']);$i++){	
				?><option <?if ($skin['skin_list'][$i]==$wiki['skin']) echo 'selected';?> value="<?php echo $skin['skin_list'][$i]?>"><?php echo $skin['skin_list'][$i]?></option><?php
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">대문에 보여줄 문서</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;"><input type="text" name="wiki_start_page" value="<?php echo $wiki['start_page']?>"  style="width:200px;" maxlength="50"> ( 최대 : 50자 )<br></span></td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">바로가기 목록</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_menu" rows="4" style="width:300px;"><?php echo $skin['wiki_menu']?></textarea>
			(';'로 구분,최대 : <?php echo $config['max']['admin_menu_list']?>개)<br>
		</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">분류 목록</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_category" rows="4" style="width:300px;"><?php echo $skin['wiki_category']?></textarea>
			(';'로 구분,총 <?php echo $config['max']['admin_category_list']?>개 가능)
		</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">인터위키 설정</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_interwiki" rows="4" style="width:300px;"><?php echo $skin['wiki_interwiki']?></textarea>
			형식 : 제목 주소; (예 : Owiki http://story4u.net/wiki; )
			(';'로 구분,총 <?php echo $config['max']['admin_interwiki_list']?>개 가능)
		</span>
	</td>
</tr>
<?php if($config['use']['rss']){ //rss 설정은 서버측 설정이 우선권이 있다.?>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">RSS</span></b></p></td>
	<td width="8" height="45" valign="top"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<?php
			if ($wiki['use_rss']){
				$tmp_rss_checked[0]='checked';
			}else{
				$tmp_rss_checked[1]='checked';
			}
		?>
		<p><span style="font-size:10pt;">
		<input  class="checkbox" type="radio" name="wiki_rss" <?php echo $tmp_rss_checked[0]?> value="true">사용<br>
		<input  class="checkbox" type="radio" name="wiki_rss" <?php echo $tmp_rss_checked[1]?> value="false">사용하지 않음<br>
	</td>
</tr>
<?}?>
<?php if ($config['use']['counter']){ ?>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">카운터</span></b></p></td>
	<td width="8" height="45" valign="top"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<?php
			if ( $wiki['use_counter'] ) {
				$tmp_counter_checked[0]='checked';
			}else{
				$tmp_counter_checked[1]='checked';
			}
		?>
		<p><span style="font-size:10pt;">
		<input class="checkbox" type="radio" name="wiki_counter" <?php echo $tmp_counter_checked[0]?> value="true">사용<br>
		<input class="checkbox" type="radio" name="wiki_counter" <?php echo $tmp_counter_checked[1]?> value="false">사용하지 않음<br>
	</td>
</tr>
<?}?>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">공개여부</span></b></p></td>
	<td width="8" height="45" valign="top"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<?php $tmp_checked[$wiki['type']]='checked'; ?>
		<p><span style="font-size:10pt;">
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[0]?> value="0">공개 (글쓰기/삭제 제한없음)<br>
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[1]?> value="1">회원제 (정회원이상 글쓰기/삭제 가능)<br>
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[2]?> value="2">비공개 (정회원이상 이용 가능)</span></p>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">위키폐쇄</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;"><a href="javascript:ask_wikidel();">폐쇄하기</a></span>
	</td>
</tr>
<tr>
	<td colspan="3">
		<input type="hidden" name="mode" value="admin_reg">
		<input type="hidden" name="url" value="<?php echo $wiki['url']?>">
		<input type="submit" value="저장하기">
	</td>
</tr>
</table>
</form>
<?php }else{?>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="no_select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=setting">위키 설정</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=member">회원 관리</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:200px;">&nbsp;</DIV>
	<div style="clear:left;">
	</div>
	<div style="height:10px;">&nbsp;</div>
	<div style="padding-left:10px;">
	<?php
		if (count($skin['data'])>0){
			for ($i=0;$i<count($skin['data']);$i++){
				if ($skin['data'][$i][1] == "0"){
					$tmp_str_0.=
						'<input class="checkbox" type="checkbox" name="id_0[]"  value="'.$skin['data'][$i][0].'"><a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$skin['data'][$i][0].'" target="_blank">'.$skin['data'][$i][0].'</a><br>'."\n";
				}elseif ($skin['data'][$i][1] == "1"){
					$tmp_str_1.=
						'<input class="checkbox" type="checkbox" name="id_1[]"  value="'.$skin['data'][$i][0].'"><a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$skin['data'][$i][0].'" target="_blank">'.$skin['data'][$i][0].'</a><br>'."\n";
				}
			}
?>
<script language="javascript" type="text/javascript">
<!--
function ask_join_del(){
	ans=confirm("정말로 탈퇴 시키겠습니까?");
    if (ans==true){
		document.admin.type.value='del';
		document.admin.submit();
	}
}
-->
</script>
<form method="post" action="<?php echo $config['url']['exec'].$config['file']['def']?>" name="admin">
<input type="hidden" name="mode" value="member_reg">
<input type="hidden" name="type" value="">
<input type="hidden" name="url" value="<?php echo $_GET['url']?>">
<?php
	//타입 
	//del일땐 탈퇴시키는것
	//0일땐 준회원 만드는것
	//1일땐 정회원 만드는것
	//2는 여기서 쓰이지 않지만 운영자 권한을 넘겨줄때
	?>

<table style="width:80%;font-size:10pt;"><tr><td valign="top">
<h4><?php echo $config['title']['join_level'][2]?> 목록</h4>
<?php 
	if ($tmp_str_1<>'')
	{
		echo $tmp_str_1; 
	}else{
		echo '목록이 없습니다.';
	}
?>
</td><td>
<a href="#" OnClick="document.admin.type.value='0';document.admin.submit();">▷</a><br>
<a href="#" OnClick="document.admin.type.value='1';document.admin.submit();">◁</a><br>
<a href="#" OnClick="ask_join_del();">탈퇴</a>
</td><td valign="top">
<h4><?php echo $config['title']['join_level'][1]?> 목록</h4>
<?php 
	if ($tmp_str_0<>'')
	{
		echo $tmp_str_0; 
	}else{
		echo '목록이 없습니다.';
	}
?>
</td></tr></table>
</form>
<?php
		}else{
		echo '아직 가입한 회원이 없습니다.';
		}
	?>
	</div>
	<?}?>