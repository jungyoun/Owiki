<?php
//---------------------------------- DB����
$config['db_host'] =		'[%db_host%]';	//ȣ��Ʈ
$config['db_name'] =		'[%db_name%]';		//DB�̸�
$config['db_user'] =		'[%db_user%]';		//DB�����̸� 
$config['db_pass'] =		'[%db_pass%]';		//DB���Ӻ�й�ȣ

//---------------------------------- ����Ʈ����
$config['admin']['id'] =	'[%admin_id%]';
$config['dir']['site'] =	$_SERVER['DOCUMENT_ROOT'].'/';
$config['url']['site'] =	'[%site_url%]';
$config['site']['name'] =	'[%site_name%]';

//---------------------------------- ���� ��� ����
$config['dir']['exec'] =	$config['dir']['site'].'[%install_dir%]';
$config['url']['exec'] =	$config['url']['site'].'[%install_dir%]';

//---------------------------------- 
// ���� ���� ���� �̰��� �ִ� ������ �� ��Ű�� ������ �ߺ��Ǵ°��� �ִٸ� �� ���� ������ ������ ��ģ��.
//----------------------------------
$config['max']['all_list'] =				10;
$config['max']['page_index'] =				10;
$config['max']['modify_list_day'] =			5;
$config['max']['modify_list'] =				20;
$config['max']['delete_list'] =				10;
$config['max']['make_wiki_space'] =			1; //�� ������ ����� �ִ� ��Ű����
$config['max']['make_wiki_page'] =			0; //�� ��Ű�������� �����Ҽ� �ִ� �������
$config['max']['make_wiki_list'] =			50; //������ ��Ű ��Ͽ��� ������ ���
$config['max']['make_wiki_list_main'] =		10; //main���� ������ ��
$config['max']['admin_category_list'] =		20;
$config['max']['admin_category_title'] =	50;
$config['max']['admin_menu_list'] =			20;
$config['max']['admin_menu_title'] =		50;
$config['max']['admin_interwiki_list'] =	20;
$config['max']['admin_interwiki_title'] =	50;
$config['max']['contents_view'] =			1; //������ ���м����� ���������� ���������� ��κ��� �����ٲ���
$config['max']['result_list'] =				10;

//---------------------------------- 
//�Ʒ��� rss,counter ������ ��ü�� ������ ��ģ��.
//�̰����� false�� �����ϸ� ������ü���� ����Ҽ� ����
//true�� ������ �� Ŭ���� ������ ������
//----------------------------------
$config['use']['rss'] =		true;
$config['use']['counter'] = true;

/*
������ʹ� �ٲ��� �ʾƵ� �������� �۵��ϴ� ����
*/

//---------------------------------- ���̺��̸�
$config['db_table']['page_data'] =			'owiki_page_data';		//���̺�
$config['db_table']['page_name'] =			'owiki_page_name';
$config['db_table']['user'] =				'owiki_user';
$config['db_table']['space'] =				'owiki_space';
$config['db_table']['category'] =			'owiki_category'; //ī�װ� ����� �����ϴ� ���̺�

//---------------------------------- ��μ���
$config['dir']['skin'] =					$config['dir']['exec'].'skins/';
$config['dir']['data'] =					$config['dir']['exec'].'data/';
$config['dir']['rss'] =						$config['dir']['exec'].'rss/';

$config['url']['skin'] =					$config['url']['exec'].'skins/';
$config['url']['main'] =					$config['url']['exec'].'main/';
$config['url']['rss'] =						$config['url']['exec'].'rss/';

//---------------------------------- ���ϸ��
$config['file']['def'] =					'index.php';
$config['file']['main_def'] =				'index.php';
$config['file']['join'] =					'join.php';
$config['file']['join_reg'] =				'join_reg.php';
$config['file']['make'] =					'make.php';
$config['file']['make_reg'] =				'make_reg.php';
$config['file']['login'] =					'login.php';

//---------------------------------- ��Ų(��) ���ϸ��
$config['form']['view'] =					'view.php';
$config['form']['dview'] =					'dview.php';
$config['form']['edit'] =					'edit.php';
$config['form']['login'] =					'login.php';
$config['form']['history'] =				'history.php';
$config['form']['diff'] =					'diff.php';
$config['form']['list'] =					'list.php';
$config['form']['dlist'] =					'dlist.php';
$config['form']['update'] =					'update.php';
$config['form']['config'] =					'config.php';
$config['form']['admin'] =					'admin.php';
$config['form']['member'] =					'member.php';
$config['form']['preview'] =				'preview.php';
$config['form']['result'] =					'result.php';

//---------------------------------- ����
$config['ver'] = '0.9.9.17 beta';

//---------------------------------- ����� �� ���� ���̵� ���
$config['filter']['id'] = 
'root,bin,daemon,adm,lp,sync,shutdown,halt,mail,news,uucp,operator,games,gopher,ftp,nobody,vcsa,mailnull,rpm,rpc,xfs,rpcuser,nfsnobody,nscd,ident,radvd,named,pcap,mysql,postgres,oracle,dba,sa,administrator,master,webmaster,operator,admin,sysadmin,test,guest,anonymous,sysop,moderator,www,hwangjungyoun,story4u.net,story4u,odgin,odgin.com,sex,king,http,mms,id'; 
$config['filter']['url'] = 
'root,bin,daemon,adm,lp,sync,shutdown,halt,mail,news,uucp,operator,games,gopher,ftp,nobody,vcsa,mailnull,rpm,rpc,xfs,rpcuser,nfsnobody,nscd,ident,radvd,named,pcap,mysql,postgres,oracle,dba,sa,administrator,master,webmaster,operator,admin,sysadmin,test,guest,anonymous,sysop,moderator,www,hwangjungyoun,story4u.net,story4u,odgin,odgin.com,sex,king,http,mms,id'; 

//---------------------------------- ����̸� ����
$config['title']['join_level'][0] = '�մ�';
$config['title']['join_level'][1] = '���Դ��';
$config['title']['join_level'][2] = 'ȸ��';
$config['title']['join_level'][3] = '���';

//---------------------------------- �޼�����
//common �޼���
$config['msg']['common'][0] = '������ �����ϴ�.';
$config['msg']['common'][1] = '�α����� ���ּ���.';
$config['msg']['common'][2] = '�����Ǿ����ϴ�.';
$config['msg']['common'][3] = '������ �������� ���� �̿��� �Դϴ�.';
$config['msg']['common'][4] = '�̿��� ������ �����ϴ�.';

//write �޼���
$config['msg']['write'][0] = '���̻� ���ο� ������ �ۼ��� �� �����ϴ�.';
$config['msg']['write'][1] = '������ �Է��� �ּ���.';
$config['msg']['write'][2] = '���ü����� �߻��Ͽ����ϴ�.������ �κ���\n�����ؼ� ������ �ٽ� ������ �ּ���.';

//admin �޼���
$config['msg']['admin'][0] = '����Ǿ����ϴ�.';
$config['msg']['admin'][1] = '��ڰ� �ƴմϴ�.';
$config['msg']['admin'][2] = '��Ű �̸��� �Է��� �ּ���.';
$config['msg']['admin'][3] = '��Ű �Ұ��� �Է��� �ּ���.';
$config['msg']['admin'][4] = '��Ų�� ������ �ּ���.';
$config['msg']['admin'][5] = '�������� �ʴ� ��Ų�Դϴ�.'; //�Ϲ������� ������ ����. ����ڰ� �ҹ����� �����Ҷ��� �̷� �޼����� ��.
//join �޼���
$config['msg']['join'][0] = '���ԵǾ����ϴ�.';
$config['msg']['join'][1] = '���Խ�û�� �Ǿ����ϴ�.����� ������ �ʿ��մϴ�.';
$config['msg']['join'][2] = 'Ż��Ǿ����ϴ�.';
$config['msg']['join'][3] = '��ȣ�� ����Ǿ����ϴ�.';
$config['msg']['join'][4] = '���� ��ȣ�� Ʋ���ϴ�.'; //���� �Ϻκ��� �ڹٽ�ũ��Ʈ�� ���� ó���ϴ°͵��� �����Ƿ� �ڹٽ�ũ��Ʈ�� ���߿� ��������ش�.
$config['msg']['join'][5] = '���������� ����Ǿ����ϴ�.';
$config['msg']['join'][6] = '�̹� ���Ե� ���̵� �Դϴ�.';
$config['msg']['join'][7] = '������ �� ���� ���̵� �Դϴ�.';
$config['msg']['join'][8] = '�̹� ���Ե� �����ּ� �Դϴ�.';
$config['msg']['join'][9] = '���̵�� �ּ� 4�ڿ��� 12�ڱ����� ������ �Ǵ� ���ڿ��� �մϴ�.';
$config['msg']['join'][10] = '��ȣ�� �ּ� 4�ڿ��� 12�ڱ����� ������ �Ǵ� ���ڿ��� �մϴ�.';
$config['msg']['join'][11] = '������ �����Ͻðڽ��ϱ�?';
$config['msg']['join'][12] = '����ó�����Դϴ�.\n���� Ż���Ͻðڽ��ϱ�?';
$config['msg']['join'][13] = '���� Ż���Ͻðڽ��ϱ�?';

//---------------------------------- ������� ���°����� ���� �ε����� ��������
$config['idx'][]=array('��ü','');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'ī\'))');
$config['idx'][]=array('ī','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'ī\' and binary a.n_title_idx < \'Ÿ\'))');
$config['idx'][]=array('Ÿ','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'Ÿ\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \'��\'))');
$config['idx'][]=array('��','and (a.n_title_idx like \'��%\' or (binary a.n_title_idx >= \'��\' and binary a.n_title_idx < \''.chr(0xfe).'\'))');
$config['idx'][]=array('A','and (binary a.n_title_idx like \'a%\' or binary a.n_title_idx like \'A%\')');
$config['idx'][]=array('B','and (binary a.n_title_idx like \'b%\' or binary a.n_title_idx like \'B%\') ');
$config['idx'][]=array('C','and (binary a.n_title_idx like \'c%\' or binary a.n_title_idx like \'C%\') ');
$config['idx'][]=array('D','and (binary a.n_title_idx like \'d%\' or binary a.n_title_idx like \'D%\') ');
$config['idx'][]=array('E','and (binary a.n_title_idx like \'e%\' or binary a.n_title_idx like \'E%\') ');
$config['idx'][]=array('F','and (binary a.n_title_idx like \'f%\' or binary a.n_title_idx like \'F%\') ');
$config['idx'][]=array('G','and (binary a.n_title_idx like \'g%\' or binary a.n_title_idx like \'G%\') ');
$config['idx'][]=array('H','and (binary a.n_title_idx like \'h%\' or binary a.n_title_idx like \'H%\') ');
$config['idx'][]=array('I','and (binary a.n_title_idx like \'i%\' or binary a.n_title_idx like \'I%\') ');
$config['idx'][]=array('J','and (binary a.n_title_idx like \'j%\' or binary a.n_title_idx like \'J%\') ');
$config['idx'][]=array('K','and (binary a.n_title_idx like \'k%\' or binary a.n_title_idx like \'K%\') ');
$config['idx'][]=array('L','and (binary a.n_title_idx like \'l%\' or binary a.n_title_idx like \'L%\') ');
$config['idx'][]=array('M','and (binary a.n_title_idx like \'m%\' or binary a.n_title_idx like \'M%\') ');
$config['idx'][]=array('N','and (binary a.n_title_idx like \'n%\' or binary a.n_title_idx like \'N%\') ');
$config['idx'][]=array('O','and (binary a.n_title_idx like \'o%\' or binary a.n_title_idx like \'O%\') ');
$config['idx'][]=array('P','and (binary a.n_title_idx like \'p%\' or binary a.n_title_idx like \'P%\') ');
$config['idx'][]=array('Q','and (binary a.n_title_idx like \'q%\' or binary a.n_title_idx like \'Q%\') ');
$config['idx'][]=array('R','and (binary a.n_title_idx like \'r%\' or binary a.n_title_idx like \'R%\') ');
$config['idx'][]=array('S','and (binary a.n_title_idx like \'s%\' or binary a.n_title_idx like \'S%\') ');
$config['idx'][]=array('T','and (binary a.n_title_idx like \'t%\' or binary a.n_title_idx like \'T%\') ');
$config['idx'][]=array('U','and (binary a.n_title_idx like \'u%\' or binary a.n_title_idx like \'U%\') ');
$config['idx'][]=array('V','and (binary a.n_title_idx like \'v%\' or binary a.n_title_idx like \'V%\') ');
$config['idx'][]=array('W','and (binary a.n_title_idx like \'w%\' or binary a.n_title_idx like \'W%\') ');
$config['idx'][]=array('X','and (binary a.n_title_idx like \'x%\' or binary a.n_title_idx like \'X%\') ');
$config['idx'][]=array('Y','and (binary a.n_title_idx like \'y%\' or binary a.n_title_idx like \'Y%\') ');
$config['idx'][]=array('Z','and (binary a.n_title_idx like \'z%\' or binary a.n_title_idx like \'Z%\') ');
$config['idx'][]=array('��Ÿ','(a.n_title_idx >= \''.chr(0).'\' and a.n_title_idx < \''.chr(65).'\')');
?>