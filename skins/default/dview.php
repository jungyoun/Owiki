<div class="top_color">
(과거문서)<span class="title_color"><?php echo $skin['title']?></span><br>
<span style="font-size:9pt;">마지막 수정일자 : <?php echo date("Y.m.d H:i:s",$skin['date']);?>, 작성자 : <?php echo $skin['own'];?></span> | 
<?php echo $skin['view_level_title']?> 이상 열람 가능
</div>
<DIV class="contents_color">
<table style="width:470px;table-Layout:fixed;margin:0px;padding:0px;font-size:12px;"><tr><td>
<?php
$tmp_count = count($skin['contents']);
for ($i=0;$i<$tmp_count;$i++){
$tmp_str.=$skin['contents'][$i];
if ($i<($tmp_count-1)) $tmp_str.="\n<hr size='1'>";
}
echo $tmp_str;
?>
</td><tr></table>
</DIV>
<DIV class="foot_color">
<a href="javascript:ask_delre('<?php echo $skin['d_no']?>');">되돌리기</a>
</div>