<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<title><?php echo $config['site']['name'].' > '.$inc_list[$_GET['page']][0]?></title>
<META http-equiv="Expires" content="0">
<META http-equiv="Content-Type" content="text/html; charset=euc-kr">
<STYLE type="text/css">
A:link {TEXT-DECORATION: none;color:#008ED0;}
A:visited {TEXT-DECORATION: none;color:#008ED0;}
body {
	margin:0pt 0pt;
}
.my_wiki_combobox{
	width:120px;
	font-size:9pt;
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
DIV {
	margin:5pt 10pt 5pt 10pt;
	line-height:1.8;
	font-size:9pt;
}
TABLE {
	line-height:1.8;
	font-size:9pt;
}
.main_title {
	font-size:20pt;
	font-weight:bold;
	text-align:left;
	padding:10px; 
}
.main_mid_title {
	font-size:13pt;
	font-weight:bold;
	text-align:left;
	padding:5px; 
}
.main_contents {
	font-size:9pt;
	text-align:left;
	padding:10px; 
	border:1px dotted silver;
	background-color: white;
}
.main_top_menu {
	font-size:10pt;
	text-align:left;
	padding:0px; 
	margin:0pt;
	background-color:white;
}
.main_foot {
	font-size:10pt;
	text-align:left;
	line-height:1.4;
	background-color:white;
	width:100%
}
A:link {TEXT-DECORATION: none}
A:visited {TEXT-DECORATION: none}
A:hover {BORDER-BOTTOM: 1px; TEXT-DECORATION: underline}
</STYLE>
</HEAD>
<BODY>
<DIV style="text-align:center;">
<DIV style="margin: 0 auto;width:800px;">
<table border="0" cellpadding="0" cellspacing="0" width="760">
	<tr>
		<td>
			<DIV class="main_top_menu">
			<?php include '_head.menu.php'; ?>
			</DIV>
		</td>
		<td></td>
	</tr>
	<tr>
		<td>
		<DIV style="text-align:right;">
		<?php include '_head.login.php'; ?>
		</div>
		</td>
		<td></td>
	</tr>
	<tr>
	<td valign="top" width="640">
		<DIV style="padding:20px;">