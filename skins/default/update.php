<div class="top_color">
<span class="title_color">�ֱ� <?php echo $config['max']['modify_list_day']?>�ϰ� ��������</span>
</div>
<DIV class="contents_color">
<?php
		if($_GET['type']<>'all_category') { //�̺κ��� �Ǻκ� ó���ϴ°�
		$tmp_c_name_1='select_page';
		$tmp_c_name_2='no_select_page';
		}else{
		$tmp_c_name_1='no_select_page';
		$tmp_c_name_2='select_page';
		}
			?>
				<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
				<DIV class="<?php echo $tmp_c_name_2?>" style="float:left;">
					<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=update&amp;type=all_category">��κ���</a>
				</DIV>
				<DIV class="no_select_space" style="float:left;width:5px;">&nbsp;</DIV>
				<DIV class="<?php echo $tmp_c_name_1?>" style="float:left;">
					<a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=update&amp;type=set_category">�� �з�</a> <a href="<?php echo $config['url']['exec'].$config['file']['def']?>?url=<?php echo $_GET['url']?>&amp;mode=config&amp;type=category">[����]</a>
				</DIV>
				<DIV class="no_select_space" style="float:left;width:200px;">&nbsp;</DIV>
			<?php
		// �� �з�, ��� �з� <- ���ڿ� ��Ƶа����� ���ߵ�
?>
<div style="clear:left;">
<div style="height:10px;">&nbsp;</div>
<?php
		if (count($skin['data'])>0){ //�ڷᰡ �Ѱ��� ������
		for($i=0;$i<count($skin['data']);$i++){ //�ټ���ŭ ����
			if($tmp_date>$skin['data'][$i][1]) break;
			if ($skin['data'][$i][3]==''){ //���̵�ó��
				$skin['data'][$i][3]=$skin['data'][$i][2];
			}else{
				$skin['data'][$i][3]='<a href="'.$config['url']['main'].$config['file']['main_def'].'?page=profile&amp;id='.$skin['data'][$i][3].'" target="_blank">'.$skin['data'][$i][3].'</a>';
			}//���̵�ó�� ��
			$tmp_date=plus_day(-$config['max']['modify_list_day']); //���ó�¥���� ������ ��¥�� ������ �ӽ�����
			if (strpos($skin['get_my_category'],';'.$skin['data'][$i][6].';')!==false){
				$same=true;
			}else{
				$same=false;
			}
				if(!$same) {
					if ($skin['get_my_category']==''){
						$select_start = '<span class="select_cm_line">';
						$select_end='</span>';
					}else{
						$select_start = '<span class="cm_line">';
						$select_end='</span>';
					}
				}else{
					$select_start = '<span class="select_cm_line">';$select_end='</span>';}
					if ($skin['data'][$i][6]<>'') 
					{
						//$tmp_cm='<a href=\''.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;mode=list_category&amp;category='.urlencode($skin['data'][$i][6]).'\'>['.$skin['data'][$i][6].']</a>&nbsp;&nbsp;';
						$tmp_cm=$skin['data'][$i][6].'/';
					}
					if($_GET['type']=='all_category' or $same) 
					{
						if ($skin['data'][$i][1]>$tmp_date && date('Ymd',$skin['data'][$i][1])<>$tmp_date_2)
						{
							//$tmp_str.='<br>'.date('Y�� m�� d��',$skin['data'][$i][1]).'<br>';
							$tmp_str.='</DIV><DIV style="margin-bottom:10px;margin-top:10px;text-align:left;">'.date('Y�� m�� d��',$skin['data'][$i][1]).'</DIV><DIV style="padding-left:20px;">';
							$tmp_date_2=date('Ymd',$skin['data'][$i][1]);
						}
						if ($skin['data'][$i][7]==0){
							if (date('Ymd',$skin['data'][$i][8])==date('Ymd',$skin['data'][$i][1])){
								$tmp_type_1 = ' (����)';
							}else{
								$tmp_type_1 = '';
							}
							$tmp_str.=$select_start.date('H:i',$skin['data'][$i][1]).'&nbsp;&nbsp;&nbsp;&nbsp;<a href=\''.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$skin['data'][$i][4].'\'>'.$tmp_cm.add_space($skin['data'][$i][0]).'</a>'.$tmp_type_1.' - '.$skin['data'][$i][3].' '.' '.$select_end.'<br>';
						}else{
							$tmp_str.=$select_start.date('H:i',$skin['data'][$i][1]).'&nbsp;&nbsp;&nbsp;&nbsp;<a href=\''.$config['url']['exec'].$config['file']['def'].'?url='.$_GET['url'].'&amp;no='.$skin['data'][$i][4].'&amp;mode=history\'>'.$tmp_cm.add_space($skin['data'][$i][0]).'</a> <span style="color:red;">(����)</span> - '.$skin['data'][$i][3].' '.' '.$select_end.'<br>';
						}
					}
				$tmp_cm='';
			}
			if ($tmp_str=='') $tmp_str.='<div style="padding-top:10px;color:red;text-align:center;">���οö�� ���� �����ϴ�.</div>';
		}else{
			$tmp_str.='<div style="padding-top:10px;color:red;text-align:center;">���οö�� ���� �����ϴ�.</div>';
		}
		echo '<DIV>'.$tmp_str.'</DIV>';
?>
</div>
</DIV>