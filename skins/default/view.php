<script language="javascript" type="text/javascript">
<!--
function ask_del(no){
	ans=confirm("������ �����Ͻðڽ��ϱ�?");
    if (ans==true)
     location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?mode=del&url=<?php echo $_GET['url']?>&no="+no;
}
-->
</script>
<?php if ($skin['view']){ ?>
<?php
	if ($_GET['type']=='all')
	{
//���� �����ֱ�(������ ���м����� ���������� ���⼭ �߶� �����ش�.)
		$tmp_1 = 0;
		$tmp_2 = count($skin['contents']);
	}else{
		$tmp_1 = $_GET['page']*$config['max']['contents_view'];
		if (count($skin['contents'])-$tmp_1>$config['max']['contents_view']){
			$tmp_2 = $config['max']['contents_view'];
		}else{
			$tmp_2 = count($skin['contents'])-$tmp_1;
		}
	}

		$tmp_3 = $tmp_1 + $tmp_2;
		for($i=$tmp_1;$i<$tmp_3;$i++)
		{
			$tmp_str.= $skin['contents'][$i];
			if ($i<($tmp_3-1)) $tmp_str.="\n<hr size='1'>";
		}
?>
<div class="top_color">
	<?if($skin['category']<>''){?>
		<span style="font-size:9pt;">
		[<?php echo $skin['category']?>]
		</span>
	<?}?>
	<span class="title_color">
		<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;no=<?php echo $skin['no']?>"><?php echo add_space($skin['title']);?></a> 
	</span><br>
</div>
<DIV class="contents_color" style="padding:10px;word-break:break-all;">
<table class="contents_color" style="width:470px;table-Layout:fixed;margin:0px;padding:0px;"><tr><td>
	<?php echo $tmp_str;?>
</td><tr></table>
</DIV>
<?php //�ε��� ���
	if ($_GET['highlight']<>'') $tmp_hl='&amp;highlight='.urlencode($_GET['highlight']);
	if ($_GET['type']<>'all'){
		$tmp_4 = count($skin['contents'])/$config['max']['contents_view'];
		if ($tmp_4>1){
			for ($i2=0;$i2<$tmp_4;$i2++){
				if ((int)$_GET['page']==$i2){
					$tmp_idx.='['.($i2+1).']';
				}else{
					$tmp_idx.='<a href="'.
					$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$skin['no'].$tmp_hl.'&amp;page='.$i2.'">['.($i2+1).']</a>';
				}
			}
			echo "<DIV style='text-align:right;padding:10px;font-size:9pt;'>".$tmp_idx.' <a href="'.
					$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$skin['no'].$tmp_hl.'&amp;type=all">...��κ���</a></DIV>';
		}
	}else{
		echo '<DIV style=:text-align:right;padding:10px;font-size:9pt;"><a href="'.
			$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$skin['no'].$tmp_hl.'">...�������</a></DIV>';
	}
?>
<DIV style="text-align:right;padding:5px;">
<span style="font-size:9pt;"><?php echo date("Y-m-d H:i",$skin['date']);?> | 
	<?php
	if($skin['own']<>''){
	?><a href="<?php echo $config['url']['main'].$config['file']['main_def']?>?page=profile&amp;id=<?php echo $skin['own']?>" target="_blank"><?php echo $skin['own']?></a> �� | <?	
	}else{
	?>ip : <?php echo $skin['ip']?> | <?	
	}
	?>
	<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?no='.$skin['no'].'&amp;mode=edit&amp;url='.$_GET['url']?>">����</a> | 
	<a href='javascript:ask_del("<?php echo $skin['no']?>");'>����</a> | 
	<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?no='.$skin['no'].'&amp;mode=diff&amp;url='.$_GET['url'].'&amp;title='.urlencode($skin['title'])?>">��</a> | 
	<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?no='.$skin['no'].'&amp;mode=history&amp;url='.$_GET['url'];?>">����</a> | 
	<?php echo $skin['write_level_title']?> ���� ����</span>
</DIV>
<?php
	}else{
		if ($skin['title']==''){
			if ($_GET['no']<>'') $_GET['title']=no_to($_GET['no'],$_GET['url'],'n_title');
			?>
			������ ã���� �����ϴ�.<br><a href="<?php echo $config['url']['exec'].$config['file']['def']?>?mode=edit&amp;url=<?php echo $_GET['url']?>&amp;title=<?php echo urlencode($_GET['title'])?>">�� �۾���</a>
			<?php
		}else{
			?>
				<div class="top_color">
				<?if($skin['category']<>''){?>
				<span style="font-size:9pt;">
					[<?php echo $skin['category']?>]
				</span>
				<?}?>
					<span class="title_color">
						<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?title=<?php echo urlencode($skin['title'])?>&amp;url=<?php echo $_GET['url']?>&amp;no=<?php echo $skin['no']?>"><?php echo add_space($skin['title']);?></a>
					</span>
					<br>
				</div>
				<DIV class="contents_color" style="padding:10px;text-align:center;color:red;">
					������ �����ϴ�.<br>
					<span style="color:black;"><?php echo $skin['view_level_title']?> �̻� �б� ����</span>
				</DIV>
				<DIV style="text-align:right;padding:5px;">
					<span style="font-size:9pt;"><?php echo date("Y-m-d H:i",$skin['date']);?> | 
						<?php
						if($skin['own']<>''){
						?><a href="<?php echo $config['url']['main'].$config['file']['main_def']?>?page=profile&amp;id=<?php echo $skin['own']?>" target="_blank"><?php echo $skin['own']?></a> ��<?	
						}else{
						?>ip : <?php echo $skin['ip']?>
						<?	
						}
						?>
				</span>
				</DIV>
			<?php
		}
}
?>
