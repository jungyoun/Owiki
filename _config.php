<?php
//---------------------------------- DB설정
$config['db_host'] =		'[%db_host%]';	//호스트
$config['db_name'] =		'[%db_name%]';		//DB이름
$config['db_user'] =		'[%db_user%]';		//DB유저이름 
$config['db_pass'] =		'[%db_pass%]';		//DB접속비밀번호

//---------------------------------- 사이트설정
$config['admin']['id'] =	'[%admin_id%]';
$config['dir']['site'] =	$_SERVER['DOCUMENT_ROOT'].'/';
$config['url']['site'] =	'[%site_url%]';
$config['site']['name'] =	'[%site_name%]';

//---------------------------------- 메인 경로 설정
$config['dir']['exec'] =	$config['dir']['site'].'[%install_dir%]';
$config['url']['exec'] =	$config['url']['site'].'[%install_dir%]';

//---------------------------------- 
// 각종 제한 설정 이곳에 있는 설정과 각 위키의 설정중 중복되는것이 있다면 이 곳의 설정이 영향을 미친다.
//----------------------------------
$config['max']['all_list'] =				10;
$config['max']['page_index'] =				10;
$config['max']['modify_list_day'] =			5;
$config['max']['modify_list'] =				20;
$config['max']['delete_list'] =				10;
$config['max']['make_wiki_space'] =			1; //한 유저가 만들수 있는 위키공간
$config['max']['make_wiki_page'] =			0; //한 위키공간에서 생성할수 있는 문서목록
$config['max']['make_wiki_list'] =			50; //개설된 위키 목록에서 보여줄 목록
$config['max']['make_wiki_list_main'] =		10; //main에서 보여줄 양
$config['max']['admin_category_list'] =		20;
$config['max']['admin_category_title'] =	50;
$config['max']['admin_menu_list'] =			20;
$config['max']['admin_menu_title'] =		50;
$config['max']['admin_interwiki_list'] =	20;
$config['max']['admin_interwiki_title'] =	50;
$config['max']['contents_view'] =			1; //본문을 구분선으로 나누었을때 한페이지에 몇부분을 보여줄껀지
$config['max']['result_list'] =				10;

//---------------------------------- 
//아래의 rss,counter 설정은 전체에 영향을 미친다.
//이곳에서 false로 설정하면 서버전체에서 사용할수 없고
//true로 설정시 각 클럽의 설정에 따른다
//----------------------------------
$config['use']['rss'] =		true;
$config['use']['counter'] = true;

/*
여기부터는 바꾸지 않아도 문제없이 작동하는 설정
*/

//---------------------------------- 테이블이름
$config['db_table']['page_data'] =			'owiki_page_data';		//테이블
$config['db_table']['page_name'] =			'owiki_page_name';
$config['db_table']['user'] =				'owiki_user';
$config['db_table']['space'] =				'owiki_space';
$config['db_table']['category'] =			'owiki_category'; //카테고리 목록을 저장하는 테이블

//---------------------------------- 경로설정
$config['dir']['skin'] =					$config['dir']['exec'].'skins/';
$config['dir']['data'] =					$config['dir']['exec'].'data/';
$config['dir']['rss'] =						$config['dir']['exec'].'rss/';

$config['url']['skin'] =					$config['url']['exec'].'skins/';
$config['url']['main'] =					$config['url']['exec'].'main/';
$config['url']['rss'] =						$config['url']['exec'].'rss/';

//---------------------------------- 파일명들
$config['file']['def'] =					'index.php';
$config['file']['main_def'] =				'index.php';
$config['file']['join'] =					'join.php';
$config['file']['join_reg'] =				'join_reg.php';
$config['file']['make'] =					'make.php';
$config['file']['make_reg'] =				'make_reg.php';
$config['file']['login'] =					'login.php';

//---------------------------------- 스킨(폼) 파일명들
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

//---------------------------------- 버전
$config['ver'] = '0.9.9.17 beta';

//---------------------------------- 사용할 수 없는 아이디 목록
$config['filter']['id'] = 
'root,bin,daemon,adm,lp,sync,shutdown,halt,mail,news,uucp,operator,games,gopher,ftp,nobody,vcsa,mailnull,rpm,rpc,xfs,rpcuser,nfsnobody,nscd,ident,radvd,named,pcap,mysql,postgres,oracle,dba,sa,administrator,master,webmaster,operator,admin,sysadmin,test,guest,anonymous,sysop,moderator,www,hwangjungyoun,story4u.net,story4u,odgin,odgin.com,sex,king,http,mms,id'; 
$config['filter']['url'] = 
'root,bin,daemon,adm,lp,sync,shutdown,halt,mail,news,uucp,operator,games,gopher,ftp,nobody,vcsa,mailnull,rpm,rpc,xfs,rpcuser,nfsnobody,nscd,ident,radvd,named,pcap,mysql,postgres,oracle,dba,sa,administrator,master,webmaster,operator,admin,sysadmin,test,guest,anonymous,sysop,moderator,www,hwangjungyoun,story4u.net,story4u,odgin,odgin.com,sex,king,http,mms,id'; 

//---------------------------------- 계급이름 정의
$config['title']['join_level'][0] = '손님';
$config['title']['join_level'][1] = '가입대기';
$config['title']['join_level'][2] = '회원';
$config['title']['join_level'][3] = '운영자';

//---------------------------------- 메세지들
//common 메세지
$config['msg']['common'][0] = '권한이 없습니다.';
$config['msg']['common'][1] = '로그인을 해주세요.';
$config['msg']['common'][2] = '삭제되었습니다.';
$config['msg']['common'][3] = '정보를 공개하지 않은 이용자 입니다.';
$config['msg']['common'][4] = '이용자 정보가 없습니다.';

//write 메세지
$config['msg']['write'][0] = '더이상 새로운 문서를 작성할 수 없습니다.';
$config['msg']['write'][1] = '제목을 입력해 주세요.';
$config['msg']['write'][2] = '동시수정이 발생하였습니다.수정된 부분을\n참고해서 문서를 다시 수정해 주세요.';

//admin 메세지
$config['msg']['admin'][0] = '저장되었습니다.';
$config['msg']['admin'][1] = '운영자가 아닙니다.';
$config['msg']['admin'][2] = '위키 이름을 입력해 주세요.';
$config['msg']['admin'][3] = '위키 소개를 입력해 주세요.';
$config['msg']['admin'][4] = '스킨을 선택해 주세요.';
$config['msg']['admin'][5] = '존재하지 않는 스킨입니다.'; //일반적으로 쓰이지 않음. 사용자가 불법으로 접근할때만 이런 메세지가 뜸.
//join 메세지
$config['msg']['join'][0] = '가입되었습니다.';
$config['msg']['join'][1] = '가입신청이 되었습니다.운영자의 수락이 필요합니다.';
$config['msg']['join'][2] = '탈퇴되었습니다.';
$config['msg']['join'][3] = '암호가 변경되었습니다.';
$config['msg']['join'][4] = '기존 암호가 틀립니다.'; //여기 일부분은 자바스크립트가 먼저 처리하는것들이 있으므로 자바스크립트랑 나중에 연결시켜준다.
$config['msg']['join'][5] = '개인정보가 변경되었습니다.';
$config['msg']['join'][6] = '이미 가입된 아이디 입니다.';
$config['msg']['join'][7] = '가입할 수 없는 아이디 입니다.';
$config['msg']['join'][8] = '이미 가입된 메일주소 입니다.';
$config['msg']['join'][9] = '아이디는 최소 4자에서 12자까지의 영문자 또는 숫자여야 합니다.';
$config['msg']['join'][10] = '암호는 최소 4자에서 12자까지의 영문자 또는 숫자여야 합니다.';
$config['msg']['join'][11] = '정말로 가입하시겠습니까?';
$config['msg']['join'][12] = '가입처리중입니다.\n정말 탈퇴하시겠습니까?';
$config['msg']['join'][13] = '정말 탈퇴하시겠습니까?';

//---------------------------------- 문서목록 보는곳에서 사용될 인덱스와 쿼리정보
$config['idx'][]=array('전체','');
$config['idx'][]=array('가','and (a.n_title_idx like \'ㄱ%\' or (binary a.n_title_idx >= \'가\' and binary a.n_title_idx < \'나\'))');
$config['idx'][]=array('나','and (a.n_title_idx like \'ㄴ%\' or (binary a.n_title_idx >= \'나\' and binary a.n_title_idx < \'다\'))');
$config['idx'][]=array('다','and (a.n_title_idx like \'ㄷ%\' or (binary a.n_title_idx >= \'다\' and binary a.n_title_idx < \'라\'))');
$config['idx'][]=array('라','and (a.n_title_idx like \'ㄹ%\' or (binary a.n_title_idx >= \'라\' and binary a.n_title_idx < \'마\'))');
$config['idx'][]=array('마','and (a.n_title_idx like \'ㅁ%\' or (binary a.n_title_idx >= \'마\' and binary a.n_title_idx < \'바\'))');
$config['idx'][]=array('바','and (a.n_title_idx like \'ㅂ%\' or (binary a.n_title_idx >= \'바\' and binary a.n_title_idx < \'사\'))');
$config['idx'][]=array('사','and (a.n_title_idx like \'ㅅ%\' or (binary a.n_title_idx >= \'사\' and binary a.n_title_idx < \'아\'))');
$config['idx'][]=array('아','and (a.n_title_idx like \'ㅇ%\' or (binary a.n_title_idx >= \'아\' and binary a.n_title_idx < \'자\'))');
$config['idx'][]=array('자','and (a.n_title_idx like \'ㅈ%\' or (binary a.n_title_idx >= \'자\' and binary a.n_title_idx < \'차\'))');
$config['idx'][]=array('차','and (a.n_title_idx like \'ㅊ%\' or (binary a.n_title_idx >= \'차\' and binary a.n_title_idx < \'카\'))');
$config['idx'][]=array('카','and (a.n_title_idx like \'ㅋ%\' or (binary a.n_title_idx >= \'카\' and binary a.n_title_idx < \'타\'))');
$config['idx'][]=array('타','and (a.n_title_idx like \'ㅌ%\' or (binary a.n_title_idx >= \'타\' and binary a.n_title_idx < \'파\'))');
$config['idx'][]=array('파','and (a.n_title_idx like \'ㅍ%\' or (binary a.n_title_idx >= \'파\' and binary a.n_title_idx < \'하\'))');
$config['idx'][]=array('하','and (a.n_title_idx like \'ㅎ%\' or (binary a.n_title_idx >= \'하\' and binary a.n_title_idx < \''.chr(0xfe).'\'))');
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
$config['idx'][]=array('기타','(a.n_title_idx >= \''.chr(0).'\' and a.n_title_idx < \''.chr(65).'\')');
?>