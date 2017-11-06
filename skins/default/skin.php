<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
  <title><?php echo $config['site']['name']?> - <?php echo $skin['main']['title']?></title>
	<?php if ($config['use']['rss'] and $skin['main']['use_rss']){ ?>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo $config['url']['rss'].$_GET['url']?>.xml">
	<?}?>
  <style type="text/css">
<!--
A:link {TEXT-DECORATION: none;color:#946d00;}
A:visited {TEXT-DECORATION: none;color:#946d00;}
div.contents_color A:link {TEXT-DECORATION: none;color:#FF7800;}
div.contents_color A:visited {TEXT-DECORATION: none;color:#FF7800;}
div.main_menu_title A:link {TEXT-DECORATION: none;color:black;}
div.main_menu_title A:visited {TEXT-DECORATION: none;color:black;}
div.main_top A:link {TEXT-DECORATION: none;color:black;}
div.main_top A:visited {TEXT-DECORATION: none;color:black;}
div.main_top A:hover {BORDER-BOTTOM: 1px; TEXT-DECORATION: underline}
div.top_color A:link {TEXT-DECORATION: none;color:black;}
div.top_color A:visited {TEXT-DECORATION: none;color:black;}
div.top_color A:hover {BORDER-BOTTOM: 1px; TEXT-DECORATION: underline}
div.main_top_menu A:link {TEXT-DECORATION: none;color:black;}
div.main_top_menu A:visited {TEXT-DECORATION: none;color:black;}
body {
	margin:0pt 0pt;
	}
DIV {line-height: 1.4;}
FORM { 
	display:inline;
}
ul{
	margin-top:0px;
	margin-bottom:0px;
	margin-left:20px;
}
H1, H2, H3, H4, H5 { 
	font-variant: small-caps;
	color: black; 
	margin-top:5px; 
	margin-bottom:5px;
}
h1 {font-size: 18pt;}
h2 {font-size: 16pt;}
h3 {font-size: 13pt;}
h4 {font-size: 11pt;}
h5 {font-size: 9pt;}
.diff_del {
	background-color: yellow;
	color:black;
}
.diff_insert {
	background-color: lime;
	color:black;
}
.my_wiki_combobox{
	width:120px;
	font-size:9pt;
}
.diff_no {
	background-color: #E5E5E5;
	color:black;
}
hr {
height:1px;
}
div.select_page A:link ,div.no_select_page A:link {TEXT-DECORATION: none;color:black;}
div.select_page A:visited ,div.no_select_page A:visited {TEXT-DECORATION: none;color:black;}
.no_select_space {
	text-align:left;
    line-height:1.4;
	padding:2px; 
	height:17px;
	font-size: 9pt;
	border-bottom-color:  silver;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-top-color:  white;
	border-top-width: 1px;
	border-top-style: solid;
	background-color: white;
}
.select_page {
	padding:2px; 
	padding-left:10px;
	width:115px;
	height:17px;
	text-align:left;
    line-height:1.4;
	font-size: 9pt;
	border-top-color: silver;
	border-right-color:  silver;
	border-bottom-color:  white;
	border-left-color: silver;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	background-color: white;
}
.no_select_page {
	font-size: 9pt;
	padding:2px;
	padding-left:10px;
	text-align:left;
	height:17px;
	width: 115px;
    line-height:1.4;
	border-top-color: silver;
	border-right-color:  silver;
	border-bottom-color:  silver;
	border-left-color: silver;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	background-color: #EAEAEA;
}
.select_cm_line {
	font-size:9pt;
    text-align:left;
	color:black;
	line-height: 1.4;
}
.cm_line {
	font-size:9pt;
    text-align:left;
	color:silver;
	line-height: 1.4;
}
.highlight_color {
	background-color: yellow;
}
.ref {
	background-color: white;
	margin-left:5px;
	padding:8px;
	border:1px dotted silver;
}
.checkbox{
	border:0px;
}
.top_color {
	font-size:10pt;
    text-align:left;
	margin-bottom:10px;
	padding:5px; 
    line-height:1.4;
	color: #999999;
	border:1px none white;
}
.title_color {
	font-size:12pt;
	font-weight: bold;
	color: black;
    text-align:left;
}
.contents_color {
	font-size:9pt;
	padding:5px; 
	color: black;
	line-height:1.6;
    text-align:left;
}
.foot_color {
	font-size:10pt;
    text-align:left;
	margin-top:10px;
	padding:5px; 
    line-height:1.4;
	background-color: #EAEAEA;
	border:0px none white;
}
.main_top {
    text-align:left;
	padding-left:10px; 
}
.main_left {
	float:left;
	font-size:10pt;
    text-align:left;
	padding:5px; 
}
.main_center {
	float:left;
	font-size:10pt;
    text-align:left;
	padding:5px; 
}
.main_right {
	float:left;
	font-size:10pt;
    text-align:left;
	padding:5px; 
}
.main_menu_title {
	font-size:9pt;
	text-align:left;
	padding-left:10px;
	font-weight:bold;
	background-color: white;
	color: black;
	padding:2px; 
}
.main_menu_contents {
	font-size:9pt;
	padding:5px; 
}
.main_top_menu {
	padding:0px;
	height:15px;
	font-size:0px;
	background-image:url('<?php echo $config['url']['skin'].$wiki['skin']?>/images/back_menu_2.jpg');
}
.main_contents {
	font-size:9pt;
    text-align:left;
	padding:10px; 
	table-layout:fixed;
	border:1px solid silver;
}
.main_foot {
	font-size:9pt;
    text-align:left;
	padding:5px;
}

INPUT, TEXTAREA {
	font-size: 9pt;
	border-top-color: #808080;
	border-right-color:  #EBEBEB;
	border-bottom-color:  #EBEBEB;
	border-left-color: #808080;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
.main_info {
	font-size:9pt;
    text-align:left;
	padding:3px; 
	margin:3pt;
}
-->
  </style>
</head>
<body>
<script language="javascript" type="text/javascript">
<!--
function ask(question){
	ans=confirm(question);
	if (ans==true)
    location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?mode=join&url=<?php echo $_GET['url']?>";
}
function ask_delre(no){
	ans=confirm("문서를 복구하시겠습니까?");
    if (ans==true)
    location.href = "<?php echo $config['url']['exec'].$config['file']['def']?>?mode=delre&no="+no+"&url=<?php echo $_GET['url']?>";
}
try {
	top.document.title='<?php echo $config['site']['name']?> - <?php echo $skin['main']['title']?>'
} catch (Exception) {
}
//-->
</script>
<div style="margin: 0 auto;padding:0px;text-align:center;">
<div style="margin: 0 auto;width:820px;padding:0px;text-align:left;">
<div class='main_top_menu'>&nbsp;</div>
<div class="main_top">
<div style="float:left;text-align:left;width:140px;">
	<a href="<?php echo $config['url']['main'].$config['file']['main_def']?>" target="_blank"><img src="<?php echo $config['url']['main']?>/images/owiki_cut.png" width="106" height="27" border="0" alt="logo" align="top"></a>
</div>
<div style="float:left;">
	<span style="font-size:18pt;"><a href="<?php echo $config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']?>"><?php echo $skin['main']['title']?></a></span><?//=$skin['main']['pr']?>
</div>
<div style="clear:left;"></div>
</div>
	<div class="main_left" style="width:130px;">
		<?php
		if ($config['use']['counter'] and $skin['main']['use_counter']){
			?><div style="text-align:center;font-size:8pt;background-color:black;color:#9BD1FA;padding:3px;">오늘 <?php echo $skin['main']['count_today']?>&nbsp;/전체 <?php echo $skin['main']['count_total']?></div><?php
		}
			//$skin['main']['count_yesterday']는 어제 접속자수
			//$skin['main']['count_max']는 최고 접속자수
		?>
			<div class="main_info">
			<span style="font-family:굴림;font-size:9pt;">
			공개여부 : <?php echo $skin['main']['type_title']?><br>
			개설 : <?php echo date('Y/m/d',$skin['main']['date'])?><br>
			운영자 : <a href="<?php echo $config['url']['main'].$config['file']['main_def']?>?page=profile&amp;id=<?php echo $skin['main']['admin']?>" target="_blank"><?php echo $skin['main']['admin']?></a><br>
			문서수 : <?php echo $skin['main']['total_page']?><?php if ($config['max']['make_wiki_page']>0) echo '/'.$config['max']['make_wiki_page'];?><br>
		<?php
		if ($skin['main']['total_user']>10) echo '총 회원수 : '.$skin['main']['total_user'].'<br>';
		?>
			</span>
			</div>
			<div class="main_info">
			<?view_login()?>
			</div>
			<div class="main_menu_title">
				<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?url='.$_GET['url']?>">처음으로</a><br>
				바로가기
			</div>
			<div class="main_menu_contents" style="padding-left:10px;">
			<?php
			$tmp_menu_count=count($wiki['menu']);
			if ($tmp_menu_count>0){
				for($i=0;$i<$tmp_menu_count;$i++)
				{
					$tmp_1.= '<a href="'.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;title='.urlencode($wiki['menu'][$i]).'">'.add_space($wiki['menu'][$i]).'</a><br>'."\n";
				}
			echo $tmp_1;
			}else{
			echo '없음';
			}
			?>
			</div>
			<div class="main_menu_title">
				<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?mode=list&amp;url='.$_GET['url']?>">문서목록</a><br>
				<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?mode=edit&amp;url='.$_GET['url']?>">새글쓰기</a><br>
				<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?mode=update&amp;url='.$_GET['url']?>">바뀐글</a><br>
				<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?mode=dlist&amp;url='.$_GET['url']?>">휴지통</a>
				<?php
				if ($config['use']['rss'] and $skin['main']['use_rss']){ 
					?><br><a href="<?php echo $config['url']['rss'].$_GET['url']?>.xml">RSS</a><?php
				}
				if ($_SESSION['login_id']<>''){
					if ($join_level==0){
						?><br><a href='javascript:ask("<?php echo $config['msg']['join'][11]?>");'>위키가입</a><?php
					}elseif ($join_level==1){
						?><br><a href='javascript:ask("<?php echo $config['msg']['join'][12]?>");'>위키탈퇴</a><?php
					}elseif ($join_level==2){
						?><br><a href='javascript:ask("<?php echo $config['msg']['join'][13]?>");'>위키탈퇴</a><?php
					}elseif ($join_level==3){
						?><br><a href='<?php echo $config['url']['exec'].$config['file']['def'].'?mode=admin&amp;type=setting&amp;url='.$_GET['url']?>'>위키관리</a><?php
					}
					?><br><br><?php echo stripslashes($_COOKIE['my_wiki'])?><?php
				}
				?>
			</div>
			</div>
			<div class="main_center" style="width:520px;">
			<div class="main_contents">
				<!-- 본문에 스크롤바가 생기게 하려면 <div class="main_contents" style="overflow:auto;height:500px;"> -->
				<!-- 여기부터 본문 -->
				<?view_contents()?>
				<!-- 여기까지 본문 -->
			</div>
		<div class="main_foot">
		<br>Copyright 2000-2005 Story4u.net ALL RIGHTS RESERVED.<br>
		Powered by <a href="http://story4u.net/">owiki</a> <?php echo $skin['main']['ver']?>
		</div>
	</div>
	<div class="main_right" style="width:130px;">
		<form action="index.php" name="search" method="GET"><div class="main_menu_contents" style="margin:0px;padding:0px;text-align:left;">
			<input name="keyword" type="text" size="14" style="width:110px;"  onKeyDown="if(event.keyCode==13){document.search.submit();}" > 
			<a href="javascript:document.search.submit();"><img src="<?php echo $config['url']['skin'].$wiki['skin']?>/images/search.gif" border="0"></a>
			<input type="hidden" name="mode" value="result">
			<input type="hidden" name="url" value="<?php echo $_GET['url']?>">
		</div></form>
		<div class="main_menu_title" style="text-align:left;">
			수정된 글 ...<a href="<?php echo $config['url']['exec'].$config['file']['def'].'?mode=update&amp;url='.$_GET['url']?>">more</a>
		</div>
		<div class="main_menu_contents" style="text-align:left;">
			<?view_new_list(35,12)?>
		</div>
	</div>
	<div style="clear:left;"></div>
</div>
</div>
<?//color:#946d00;?>
</body>
</html>
