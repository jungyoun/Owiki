<div class="top_color">
	<span class="title_color">��Ű���� ������</span>
</div>
<?php if($_GET['type']=='setting') {?>
	<script language="javascript" type="text/javascript">
	<!--
	function ask_wikidel(){
		ans=confirm("��� �� �ڷ�� �������� �ʽ��ϴ�.\n������ ��Ű�� ��� �Ͻðڽ��ϱ�?");
		if (ans==true)
		location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?mode=wikidel&url=<?php echo $_GET['url']?>";
	}
	-->
	</SCRIPT>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=setting">��Ű ����</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="no_select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=member">ȸ�� ����</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:200px;">&nbsp;</DIV>
	<div style="clear:left;">
	</div>
<div style="height:10px;">&nbsp;</div>
<form method="post" action="<?php echo $config['url']['exec'].$config['file']['def']?>" name="admin">
<table border="0" width="450"><tr>
	<td width="100" height="45" valign="top"><p align="right"><span style="font-size:10pt;"><b>��Ű �̸�</b></span></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;">
		<input type="text" name="wiki_title" value="<?php echo $wiki['title']?>" style="width:200px;" maxlength="50"> ( �ִ� : 50�� )</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">��Ű �Ұ�</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;"><input type="text" name="wiki_pr" value="<?php echo $wiki['pr']?>"  style="width:200px;" maxlength="100"> ( �ִ� : 100�� )</span></td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">��Ų</span></b></p></td>
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
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">�빮�� ������ ����</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top"><span style="font-size:10pt;"><input type="text" name="wiki_start_page" value="<?php echo $wiki['start_page']?>"  style="width:200px;" maxlength="50"> ( �ִ� : 50�� )<br></span></td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">�ٷΰ��� ���</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_menu" rows="4" style="width:300px;"><?php echo $skin['wiki_menu']?></textarea>
			(';'�� ����,�ִ� : <?php echo $config['max']['admin_menu_list']?>��)<br>
		</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">�з� ���</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_category" rows="4" style="width:300px;"><?php echo $skin['wiki_category']?></textarea>
			(';'�� ����,�� <?php echo $config['max']['admin_category_list']?>�� ����)
		</span>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">������Ű ����</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;">
			<textarea name="wiki_interwiki" rows="4" style="width:300px;"><?php echo $skin['wiki_interwiki']?></textarea>
			���� : ���� �ּ�; (�� : Owiki http://story4u.net/wiki; )
			(';'�� ����,�� <?php echo $config['max']['admin_interwiki_list']?>�� ����)
		</span>
	</td>
</tr>
<?php if($config['use']['rss']){ //rss ������ ������ ������ �켱���� �ִ�.?>
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
		<input  class="checkbox" type="radio" name="wiki_rss" <?php echo $tmp_rss_checked[0]?> value="true">���<br>
		<input  class="checkbox" type="radio" name="wiki_rss" <?php echo $tmp_rss_checked[1]?> value="false">������� ����<br>
	</td>
</tr>
<?}?>
<?php if ($config['use']['counter']){ ?>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">ī����</span></b></p></td>
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
		<input class="checkbox" type="radio" name="wiki_counter" <?php echo $tmp_counter_checked[0]?> value="true">���<br>
		<input class="checkbox" type="radio" name="wiki_counter" <?php echo $tmp_counter_checked[1]?> value="false">������� ����<br>
	</td>
</tr>
<?}?>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">��������</span></b></p></td>
	<td width="8" height="45" valign="top"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<?php $tmp_checked[$wiki['type']]='checked'; ?>
		<p><span style="font-size:10pt;">
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[0]?> value="0">���� (�۾���/���� ���Ѿ���)<br>
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[1]?> value="1">ȸ���� (��ȸ���̻� �۾���/���� ����)<br>
		<input class="checkbox" type="radio" name="wiki_type" <?php echo $tmp_checked[2]?> value="2">����� (��ȸ���̻� �̿� ����)</span></p>
	</td>
</tr>
<tr>
	<td width="100" height="45" valign="top"><p align="right"><b><span style="font-size:10pt;">��Ű���</span></b></p></td>
	<td width="8" valign="top" height="45"><span style="font-size:10pt;">&nbsp;</span></td>
	<td width="310" height="45" valign="top">
		<span style="font-size:10pt;"><a href="javascript:ask_wikidel();">����ϱ�</a></span>
	</td>
</tr>
<tr>
	<td colspan="3">
		<input type="hidden" name="mode" value="admin_reg">
		<input type="hidden" name="url" value="<?php echo $wiki['url']?>">
		<input type="submit" value="�����ϱ�">
	</td>
</tr>
</table>
</form>
<?php }else{?>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="no_select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=setting">��Ű ����</a>
	</DIV>
	<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
	<DIV class="select_page" style="float:left;">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=admin&amp;type=member">ȸ�� ����</a>
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
	ans=confirm("������ Ż�� ��Ű�ڽ��ϱ�?");
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
	//Ÿ�� 
	//del�϶� Ż���Ű�°�
	//0�϶� ��ȸ�� ����°�
	//1�϶� ��ȸ�� ����°�
	//2�� ���⼭ ������ ������ ��� ������ �Ѱ��ٶ�
	?>

<table style="width:80%;font-size:10pt;"><tr><td valign="top">
<h4><?php echo $config['title']['join_level'][2]?> ���</h4>
<?php 
	if ($tmp_str_1<>'')
	{
		echo $tmp_str_1; 
	}else{
		echo '����� �����ϴ�.';
	}
?>
</td><td>
<a href="#" OnClick="document.admin.type.value='0';document.admin.submit();">��</a><br>
<a href="#" OnClick="document.admin.type.value='1';document.admin.submit();">��</a><br>
<a href="#" OnClick="ask_join_del();">Ż��</a>
</td><td valign="top">
<h4><?php echo $config['title']['join_level'][1]?> ���</h4>
<?php 
	if ($tmp_str_0<>'')
	{
		echo $tmp_str_0; 
	}else{
		echo '����� �����ϴ�.';
	}
?>
</td></tr></table>
</form>
<?php
		}else{
		echo '���� ������ ȸ���� �����ϴ�.';
		}
	?>
	</div>
	<?}?>