<?php if (($_GET['id']=='' and $_SESSION['login_id']<>'') or $_GET['id']==$_SESSION['login_id']){ ?>
<div class="title_color">관심분류 설정</div>
<form method="post" action="<?php echo $config['url']['main'].$config['file']['join_reg']?>" name="join3">
<div class="contents_color">
<br>
<table border="0" width="90%" align="top" style="font-size:10pt;"><tr>
<?php
$line=4;
$i2=0;
$tmp_count=count($skin['all_category_data']);
if ($tmp_count>0){
for($i=0;$i<$tmp_count;$i++){
	$i2++;
	$tmp_str.='<td>';
	if (strpos($skin['my_category_data'],';'.$skin['all_category_data'][$i].';')!==false){
		$tmp_str.='<input class="checkbox" type="checkbox" name="category[]"  value="'.$skin['all_category_data'][$i].'" checked>'.$skin['all_category_data'][$i];
	}else{
		$tmp_str.='<input class="checkbox" type="checkbox" name="category[]"  value="'.$skin['all_category_data'][$i].'" >'.$skin['all_category_data'][$i];	
	}
	$tmp_str.='</td>'."\n";
	if($i2>=$line)	
	{
		$i2=0;
		$tmp_str.='</tr><tr>';
	}
	
}
echo $tmp_str;
}else{
?><tr><td><div style="font-size:12px;padding-top:10px;padding-buttom:10px;color:red;text-align:center;">선택할 수 있는 분류가 없습니다.</div></td></tr><?php
}
?>
</tr></table>
<input type="hidden" name="p_type" value="3">
<input type="hidden" name="url" value="<?php echo $_GET['url']?>">
<input type="hidden" name="join_id" value="<?php echo $_SESSION['login_id']?>">
</div>
</form>
<br>
<input type="submit" value="저장하기" OnClick="document.join3.submit();">
<?php } ?>