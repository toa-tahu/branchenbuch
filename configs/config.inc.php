<?php

if ($_REQUEST['q'] && strpos($_REQUEST['q'], "<") !== false)  {
	header('HTTP/1.1 404 Not Found'); 
	echo file_get_contents('error.html');
	header('Connection: close');
	die();
}

function make_url($str)
{
	$str = strtolower($str);
	$str = preg_replace('/�/','ae',$str);
	$str = preg_replace('/�/','ue',$str);
	$str = preg_replace('/�/','oe',$str);
	$str = preg_replace('/�/','ss',$str);
	$str = preg_replace("/ /", "_", $str);
	$str = preg_replace("/[^a-z0-9_]/", "", $str);
	return $str;
}

function make_uri($str)
{
	$str = strtolower($str);
	$str = preg_replace('/�/','ae',$str);
	$str = preg_replace('/�/','ue',$str);
	$str = preg_replace('/�/','oe',$str);
	$str = preg_replace('/�/','ae',$str);
	$str = preg_replace('/�/','ue',$str);
	$str = preg_replace('/�/','oe',$str);
	$str = preg_replace('/�/','ss',$str);
	$str = preg_replace('/ /','+',$str);
	//$str = preg_replace("/[^a-z0-9_-\.]/", "", $str);
	return $str;
}

function decodeuri($str) {
	$str = urldecode($str);
	//$str = str_replace('ae', '�', $str);
	//$str = str_replace('ue', '�', $str);
	//$str = str_replace('oe', '�', $str);
	//$str = str_replace('Ae', '�', $str);
	//$str = str_replace('Ue', '�', $str);
	//$str = str_replace('Oe', '�', $str);
	return $str;
}

$request_uri = getenv('REQUEST_URI');
$http_host = $_SERVER["HTTP_HOST"];

if($http_host=="branchenbuchdeutschland.de"
|| $http_host=="www.branchenbuch-deutschland.de"
|| $http_host=="branchenbuch-deutschland.de"
|| $http_host=="www.bbd24.de"
|| $http_host=="bbd24.de"
|| $http_host=="www.branchenbuchdeutschland.com"
|| $http_host=="branchenbuchdeutschland.com"
|| $http_host=="www.zielplus.de"
|| $http_host=="zielplus.de"
|| $http_host=="www.ziel-plus.de"
|| $http_host=="ziel-plus.de"
|| $http_host=="www.brachenbuch.de"
|| $http_host=="brachenbuch.de"
|| $http_host=="www.tft-tv.de"
|| $http_host=="tft-tv.de"
|| $http_host=="www.xsms.de"
|| $http_host=="xsms.de"
|| $http_host=="www.presse-express.de"
|| $http_host=="presse-express.de"
|| $http_host=="www.alufelgen-reifen.de"
|| $http_host=="alufelgen-reifen.de"
|| $http_host=="www.aktuellestrompreise.de"
|| $http_host=="aktuellestrompreise.de"
|| $http_host=="www.aktuelle-strompreise.de"
|| $http_host=="aktuelle-strompreise.de"
|| $http_host=="www.preisistheiss.de"
|| $http_host=="preisistheiss.de"
|| $http_host=="www.preis-ist-heiss.de"
|| $http_host=="preis-ist-heiss.de"
|| $http_host=="www.eede.de"
|| $http_host=="eede.de"
|| $http_host=="www.stadtkalender.de"
|| $http_host=="stadtkalender.de"
|| $http_host=="www.iphone-telefonbuch.de"
|| $http_host=="iphone-telefonbuch.de"
|| $http_host=="www.iphonetelefonbuch.de"
|| $http_host=="iphonetelefonbuch.de"
|| $http_host=="www.iphone-branchenbuch.de"
|| $http_host=="iphone-branchenbuch.de"
|| $http_host=="www.iphonebranchenbuch.de"
|| $http_host=="iphonebranchenbuch.de"
|| $http_host=="www.iphone-fax.de"
|| $http_host=="iphone-fax.de"
|| $http_host=="www.iphonefax.de"
|| $http_host=="iphonefax.de"
|| $http_host=="www.allesnulleuro.de"
|| $http_host=="allesnulleuro.de"
|| $http_host=="www.alles0euro.de"
|| $http_host=="alles0euro.de"
|| $http_host=="www.branchenbuchdeutschland.eu"
|| $http_host=="branchenbuchdeutschland.eu"
|| $http_host=="www.eubranchenbuch.eu"
|| $http_host=="eubranchenbuch.eu"
|| $http_host=="www.branchenbuchmobil.de"
|| $http_host=="branchenbuchmobil.de"
|| $http_host=="www.branchenbuch-baden-wuerttemberg.de"
|| $http_host=="branchenbuch-baden-wuerttemberg.de"
|| $http_host=="www.branchenbuch-brandenburg.de"
|| $http_host=="branchenbuch-brandenburg.de"
|| $http_host=="www.branchenbuch-niedersachsen.de"
|| $http_host=="branchenbuch-niedersachsen.de"
|| $http_host=="www.branchenbuch-nordrhein-westfalen.de"
|| $http_host=="branchenbuch-nordrhein-westfalen.de"
|| $http_host=="www.branchenbuch-rheinland-pfalz.de"
|| $http_host=="branchenbuch-rheinland-pfalz.de"
|| $http_host=="www.branchenbuch-saarland.de"
|| $http_host=="branchenbuch-saarland.de"
|| $http_host=="www.branchenbuch-sachsen-anhalt.de"
|| $http_host=="branchenbuch-sachsen-anhalt.de"
|| $http_host=="www.branchenbuch-schleswig-holstein.de"
|| $http_host=="branchenbuch-schleswig-holstein.de"
|| $http_host=="www.branchenbuch-thueringen.de"
|| $http_host=="branchenbuch-thueringen.de"
|| $http_host=="www.branchenbuchbadenwuerttemberg.de"
|| $http_host=="branchenbuchbadenwuerttemberg.de"
|| $http_host=="www.branchenbuchbrandenburg.de"
|| $http_host=="branchenbuchbrandenburg.de"
|| $http_host=="www.branchenbuchmecklenburgvorpommern.de"
|| $http_host=="branchenbuchmecklenburgvorpommern.de"
|| $http_host=="www.branchenbuch-mobil.de"
|| $http_host=="branchenbuch-mobil.de"
){
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: https://www.branchenbuchdeutschland.de"); 
	header("Connection: close");
	die();
}

//if($http_host != "www.branchenbuchdeutschland.de" && !strpos($http_host, '.bbd24.de')) {
if($http_host != "localhost:8080" && !strpos($http_host, '.bbd24.de')) {
	header("HTTP/1.1 404");
	header("Connection: close");
    die();
}

if($request_uri=="/branchenverzeichnis"){
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: https://www.branchenbuchdeutschland.de/branchenbuch"); 
	header("Connection: close");
	die();
}

if($request_uri=="/telefonbuch"){
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: https://www.branchenbuchdeutschland.de/p/telefonbuch"); 
	header("Connection: close");
	die();
}

if($request_uri=="/p/telefonbuch"){
	die();
}

if($request_uri=='/branchenbuch-eintrag'){
	header('HTTP/1.1 301 Moved Permanently'); 
	header('Location: https://www.branchenbuchdeutschland.de/p/e_start/branchenbuch-eintrag'); 
	header('Connection: close');
	die();
}

if($request_uri=='/branchenbuch-kundenbereich'){
	header('HTTP/1.1 301 Moved Permanently'); 
	header('Location: https://www.branchenbuchdeutschland.de/p/l/branchenbuch-kundenbereich'); 
	header('Connection: close');
	die();
}

// Alte Detaileintragslinks aussperren
if(strpos($request_uri,'/suchmaschine')===0) {
	header('HTTP/1.1 404 Not Found'); 
	echo file_get_contents('error.html');
	header('Connection: close');
	die();
}

// Wenn eine SSL-Verbindung auf nicht sch�tzenswerte Bereiche versucht wird,
// werden diese Anfragen auf http: umgeleitet.
/*
if($_SERVER["SERVER_PORT"]==443 
&& $_REQUEST["p"]!="e"
&& $_REQUEST["p"]!="em"
&& $_REQUEST["p"]!="em2"
&& $_REQUEST["p"]!="em3"
&& $_REQUEST["p"]!="e2") {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://".$http_host.$request_uri);
	header("Connection: close");
	die();
}
*/
// Immer auf HTTPS umleiten
if($_SERVER["SERVER_PORT"]==80
  && !strpos($_SERVER["REQUEST_URI"], "admin/") 
  && !strpos($_SERVER["REQUEST_URI"], "api/")
  ) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://".$http_host.$request_uri);
	header("Connection: close");
	die();
}

/*
 * Die Umleitung von nicht SEF maskierten Eintr�gen erfolgt in diesem Skript
 * erst nach dem initialiseren der Datenbanken weiter unten.
 */

$_GET['esearch'] = $_GET['extended_search_start'];

// SEF Maskierung
if(strpos($request_uri,'/branchenbuch')===0) {	
	// Dateipfad ermitteln
	$uriPath = substr($request_uri, 14);
	// ... zerlegen
	$uriPath = explode('/', $uriPath);
	
	// Branchensuche aktivieren
	$_GET['p'] = 's';

	// UMLEITUNG DER ALTEN LINKSTRUKTUR
	if(strpos($uriPath[0], "_")) {
		$request_uri = str_replace("_", "+", $request_uri);
		header('HTTP/1.1 301 Moved Permanently'); 
		header('Location: https://www.branchenbuchdeutschland.de'.$request_uri); 
		header('Connection: close');
		die();
	}
	
	
	// Geoinfo setzen
	$uriGeo = explode('+', $uriPath[0], 2);
	if($uriGeo[0]!='deutschland'
	&& $uriGeo[0]!='eintrag'
	&& $uriGeo[0]!='firmenindex'
	&& $uriGeo[0]!='detailsuche') {
		if($uriGeo[0]=='stadt') {
			$city = $uriGeo[1];
			$city = preg_replace(array('/(?<!a)ue/', '/oe/', '/ae/'), array('�', '�', '�'), $city);
			$_GET['city'] = ucwords(strtolower(decodeuri($city)));
			$_GET['q_detail']['ort'] = $_GET['city'];
		} else {
			$_GET['bl'] = $uriGeo[0];
			if($uriGeo[1]) {
				$uriGeo2 = explode('+stadt+', $uriGeo[1], 2);
				$_GET['ort'] = $uriGeo2[0];
				if ($uriGeo2[1]) {
					$city = $uriGeo2[1];
					$city = preg_replace(array('/(?<!a)ue/', '/oe/', '/ae/'), array('�', '�', '�'), $city);
					$_GET['city'] = ucwords(strtolower(decodeuri($city)));
					$_GET['q_detail']['ort'] = $_GET['city'];
				}
			}
			//if($uriGeo[2])
			//	$_GET['ort'] .= ' '.$uriGeo[2];
		}
	}
	
	// BranchenInfo setzen
	if($uriPath[1] 
	&& $uriGeo[0]!='eintrag'
	&& $uriGeo[0]!='firmenindex'
	&& $uriGeo[0]!='detailsuche'
	&& ($uriPath[1][0] != '?')) {
		$_GET['branche'] = $uriPath[1];
	}
	
	// Flag setzen, um Stadtdetailseiten zu maskieren
	if($uriPath[0]=='eintrag' && $uriPath[1]) {
		$eintrag = ucfirst(strtolower($uriPath[1]));
		// Weiterleitung von alter Version mit "_" zur neuen mit "-"
		if(strpos($eintrag, "_")!==false) {
			$eintrag = str_replace("_", "-", $eintrag);
			header('HTTP/1.1 301 Moved Permanently'); 
			header('Location: https://www.branchenbuchdeutschland.de/branchenbuch/eintrag/'.$eintrag); 
			header('Connection: close');
			die();
		}
	}
	// evtl. Seitenwechsel setzen
	if($uriPath[2] && preg_match("/^s([0-9]{1,2})\.html$/", $uriPath[2], $match)) {
		$_GET['pages'] = $match[1];
	}
	// Firmenindex ansprechen
	if($uriGeo[0]=='firmenindex') {
		$_GET['p']='firmidx';
		if($uriPath[0]) {
			$_GET["idxSelChar"] = $uriPath[1];
		}
	}
	
	// Detailsuche aktivieren
	if($uriGeo[0]=='detailsuche' || $_GET['extended_search_start']) {
		$_GET['esearch']='1';
	}
	
} else {
	// Alte Detaileintragslinks aussperren
	if(strpos($request_uri,'/telefonbuch')!==0 && preg_match("/([0-9]{5,})\.html$/", $_SERVER['REQUEST_URI'], $match)) {
		header('HTTP/1.1 410 Gone'); 
		echo file_get_contents('error2.html');
		header("Connection: close");
		die();
	}
}

// Fehlerhafte Links ignorieren
if(strpos($_GET["branche"], "_")===0) {
	header('HTTP/1.1 404 Not found'); 
	echo file_get_contents('error.html');
	header('Connection: close');
	die();
}


if((strpos($request_uri,'/suchmaschine/')===0)
|| strpos($request_uri, 'datenschutz.php')) {
	header('HTTP/1.1 301 Moved Permanently'); 
	header('Location: https://www.branchenbuchdeutschland.de'); 
	header('Connection: close');
	die();
}

if($http_host=="bbd24.local" || $http_host=="matthiasfranke.dyndns.org"){
	
	//define('BASE_DIR','/srv/www/htdocs/franke/auktion');
	define('BASE_DIR', realpath(dirname(__FILE__).'/../../'));
	define('ROOT_DIR',BASE_DIR.'/html');
	define('MB_DIR',BASE_DIR.'/files');
	define('UPDATE_DIR',BASE_DIR.'/updates');
	define('ROOT_URL','bbd24.local');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'xxxx');
	define('DB_NAME', 'xxxx');
	define('SYS_MAIL', 'info@matthiasfranke.com');
		
} else {
	
	define('BASE_DIR','/var/www/vhosts/branchenbuchdeutschland.de');
	define('ROOT_DIR',BASE_DIR.'/httpdocs');
	define('MB_DIR',BASE_DIR.'/files');
	define('UPDATE_DIR',BASE_DIR.'/updates');
	define('ROOT_URL','www.branchenbuchdeutschland.de');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'xxxxx');
	define('DB_PASS', 'xxxxx');
	define('DB_NAME', 'branchenbuch');
	define('SYS_MAIL', 'info@branchenbuchdeutschland.de');
	
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
$aTestIps = array(
	"92.72.226.107",#Paul
	#"84.184.83.191" #Rochus
);

/*
echo "<pre style='display: none;'>";
var_dump($_SERVER["REQUEST_URI"]);
echo "</pre>";*/
if($_SERVER['PHP_SELF']=="/admin/index.php" || $_SERVER['PHP_SELF']=="/admin/mail.php"){
	define('TPL_DIR',BASE_DIR.'/p_templates/admin');
	define('TPL_DIR_C',BASE_DIR.'/p_templates_c/admin');
} else {
	if(
		!isset($_SESSION["member"]) 
		or strpos($_SERVER["REQUEST_URI"], "/branchenbuch") !== FALSE
		or $_SERVER["REQUEST_URI"] == "/" 
		or $_SERVER["REQUEST_URI"] == "/index.php" 
		or (
			$_SERVER["PHP_SELF"] == "/index.php" and (
				$_GET["p"] == "s" or
				$_GET["p"] == "agb" or
				$_GET["p"] == "impressum"
			)
		)
	) {
		define('TPL_DIR',BASE_DIR.'/p_templates/'.$_SESSION['language']);
		define('TPL_DIR_C',BASE_DIR.'/p_templates_c/'.$_SESSION['language']);
	} else {
			
		if(
			(
				$_GET["p"] == "e" 
				or $_GET["p"] == "em" 
				or $_GET["p"] == "em2"
				or $_GET["p"] == "em3"
				or $_GET["p"] == "em4"
				or $_GET["p"] == "em5"
				or $_GET["p"] == "em6"
				or $_GET["p"] == "preview"
			) #and in_array($_SERVER['REMOTE_ADDR'], $aTestIps) and $_REQUEST['paul'] != "1"
		) {
			define('TPL_DIR',BASE_DIR.'/p_templates/'.$_SESSION['language']);
			define('TPL_DIR_C',BASE_DIR.'/p_templates_c/'.$_SESSION['language']);
		} else {
			define('TPL_DIR',BASE_DIR.'/templates/'.$_SESSION['language']);
			define('TPL_DIR_C',BASE_DIR.'/templates_c/'.$_SESSION['language']);
		}
	}
	
	
	/*
	if($_REQUEST['paul'] == "1" or in_array($_SERVER['REMOTE_ADDR'], $aTestIps)) {
		if(!isset($_SESSION["member"])) {
			define('TPL_DIR',BASE_DIR.'/p2_templates/'.$_SESSION['language']);
			define('TPL_DIR_C',BASE_DIR.'/p2_templates_c/'.$_SESSION['language']);
		} else {
			define('TPL_DIR',BASE_DIR.'/templates/'.$_SESSION['language']);
			define('TPL_DIR_C',BASE_DIR.'/templates_c/'.$_SESSION['language']);
		}
	} else {
		define('TPL_DIR',BASE_DIR.'/templates/'.$_SESSION['language']);
		define('TPL_DIR_C',BASE_DIR.'/templates_c/'.$_SESSION['language']);
	}
	*/
}
define('CONFIG_DIR',ROOT_DIR.'/configs');
define('SPAW_DIR',ROOT_DIR.'/spaw');
define('FCK_DIR',ROOT_DIR.'/admin/fckeditor');

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
require_once(CLASS_DIR.'/PAY.class.php');
require_once(CLASS_DIR.'/IMAGES.class.php');
require_once(CLASS_DIR.'/MAIL.class.php');
require_once(CLASS_DIR.'/ADMIN.class.php');
require_once(SPAW_DIR.'/spaw.inc.php');
require_once(FCK_DIR.'/fckeditor.php');
require_once(CLASS_DIR.'/html2fpdf.php');


$smarty = new Smarty();
$auth = new AUTH();
$images = new IMAGES();
$mailtpl = new MAILTPL();
$GLOBALS['dbapi'] = new DBAPI;

# Paul
if($_REQUEST['paul'] == "1" or in_array($_SERVER['REMOTE_ADDR'], $aTestIps)) {
	#ini_set('display_startup_errors',1);
	#ini_set('display_errors',1);
	#error_reporting(-1);
	
	$smarty->template_dir = TPL_DIR;
	$smarty->compile_dir = TPL_DIR_C;
}


require_once $smarty->_get_plugin_filepath('function', 'eval');

# Subdomain
if(empty($_SERVER['QUERY_STRING'])){
	if(preg_match('/^(.*?).bbd24.de/',$_SERVER['HTTP_HOST'],$res)){
		//echo "treffer";
		if($res[1]<>"www"){
			$res[1]=str_replace('www.','',$res[1]);
			$url_pages=DBAPI::check_member_subdomain_page($res[1]);		
			/*if($res[1]=='alfahosting'){
				header('Location:http://alfahosting.givs.de');
				die();
			}*/
			if($url_pages){
				header('Location:'.$url_pages);
				die();
			} else {
				$url_pages_member=DBAPI::check_member_subdomain($res[1]);		
				if(!empty($url_pages_member)){
					$member = DBApi::get_member_by_kunde($url_pages_member);
					$branchen = DBApi::get_member_branchen_neu($member['id']);
					$orte = DBApi::get_member_laender_neu($member['id']);	
					header('Location: https://www.branchenbuchdeutschland.de/branchenbuch/eintrag/'.make_uri($member['firma']).'_'.make_uri($member['ort']).'_'.make_url($member['id']).'.html');
					die();
				} else {
					header('HTTP/1.1 404 Not Found'); 
					echo $res[1]."BLA";
					echo file_get_contents('error.html');
					header("Connection: close");
					die();
				}
			}
		}
	}
}

// Umleiten aller Nicht SEF-Maskierten Anfragen
if((strpos($request_uri, '/p/s/')!==false || strpos($request_uri, 'p=s&')!==false) && !strpos($request_uri, 'q=') && !strpos($request_uri, 'tel=')) {
	// Bundesland ermitteln
	if($_GET['bl']) {
		if(is_numeric($_GET['bl'])) {
			$str_bl = DBAPI::get_bl_name($_GET['bl']);
		} else {
			$str_bl = $_GET['bl'];
		}
	}
	//echo "S:".$_GET['bl'].":E";
	// Ort ermitteln
	if($_GET['ort']) {
		if(is_numeric($_GET['ort'])) {
			$str_ort = DBAPI::get_orte_name($_GET['ort']);
		} else {
			$str_ort = $_GET['ort'];
		}
	}
	// Branche ermitteln
	if($_GET['branche']) {
		if(is_numeric($_GET['branche'])) {
			$branchen_array = DBAPI::get_branchen_neu($_GET['branche']);
			if($branchen_array) {
				$str_branche = DBAPI::get_branche_name_neu($_GET['branche']);
			} else {
				// Es handelt sich um eine Unterbranche
				$str_branche2 = DBAPI::get_branche_name_neu($_GET['branche']);
				$str_branche = DBAPI::get_branche_parent($_GET['branche']);
				$str_branche = DBAPI::get_branche_name_neu($str_branche);
			}
		} else {
			$str_branche = DBAPI::get_branche_name_name($_GET['branche'], true);
		}
	}
	if((!$str_bl) && (!$str_branche)) {
		$str_location = '/branchenbuch';
	} else {
		if(!$str_bl) {
			$str_location = '/branchenbuch/deutschland';
		} else {
			$str_location = '/branchenbuch/'.make_uri($str_bl);
			if($str_ort)
				$str_location .= '_'.make_uri($str_ort);
		}
		if($str_branche) {
			$str_location .= '/'.make_uri($str_branche);
			if($str_branche2)
				$str_location .= '_'.make_uri($str_branche2);
		}
	}
	header('HTTP/1.1 301 Moved Permanently'); 
	header('Location: https://www.branchenbuchdeutschland.de'.$str_location); 
	header('Connection: close');
	die();
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

// Wenn Unterseite angefordert und kein p �bergeben, dann p=s setzen
//if(!$_GET['p'] && $request_uri!='/' && $request_uri) {
//	$_GET['p']='s';
//}

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
	// Anfagswert �ber aktuelle Mikrosekunde setzen
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

if($_REQUEST['insite'] !== 'true'){
	if($_REQUEST['_unsetMobile'])
		$_SESSION['_unsetMobile'] = $_REQUEST['_unsetMobile']; 
	/*
	if(!$_SESSION['_unsetMobile'] && strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {
		$iphone=true;
		if(strpos($request_uri,'/iphone')!==0) {
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: https://www.branchenbuchdeutschland.de/iphone"); 
			header("Connection: close");
			die();
		}
	}
	*/
}
//if($http_host=='www.branchenbuchdeutschland.de') $google_api_key='ABQIAAAA0OICHwiLAOnunFR0KwPdchSGk_q_vSQ700ZrGnhS1uZKPz1V4BTbh3ZYZKeFRgCZBTwEBKImtBwgaA';
//if($http_host=='www.bbd24.de') $google_api_key='ABQIAAAA0OICHwiLAOnunFR0KwPdchSpWNi7ggvefSy4dNxXDUJYkMWTbBTfZaG8cjpI_Xxwse7AmuvQiU9Fag';
if($http_host=='www.branchenbuchdeutschland.de') $google_api_key='AIzaSyBvUgrkf7goIMtmVteHUZYeB0AC_qqNBSI';
if($http_host=='www.bbd24.de') $google_api_key='AIzaSyBvUgrkf7goIMtmVteHUZYeB0AC_qqNBSI';
$smarty->assign("google_api_key",$google_api_key);
$smarty->cache_dir = '../cache';

?>