<?php 
/** 
* Simplest possible usage of HTML_AJAX_Server 
* 
* The server responds to ajax calls and also serves the js client libraries, so they can be used directly from the PEAR data dir 
* 304 not modified headers are used when server client libraries so they will be cached on the browser reducing overhead 
* 
* @category   HTML 
* @package    AJAX 
* @author     Joshua Eichorn <josh@bluga.net> 
* @copyright  2005 Joshua Eichorn 
* @license    http://www.php.net/license/3_0.txt  PHP License 3.0 
* @version    Release: @package_version@ 
* @link       http://pear.php.net/package/HTML_AJAX 
*/ 

// include the server class 
include 'HTML/AJAX/Server.php'; 

// include the test class will be registering 
class test { 
    function test() { 
    } 
    function _private() { 
    } 
    function echo_string($string) { 
        return $string; 
    } 
    function slow_echo_string($string) { 
        sleep(2); 
        return $string; 
    } 
    function error_test($string) { 
        trigger_error($string); 
    } 
} 

// create our new server 
$server = new HTML_AJAX_Server(); 

// register an instance of the class were registering 
$test =& new test(); 
$server->registerClass($test); 

// handle different types of requests possiblities are 
// ?client=all - request for all javascript client files 
// ?stub=classname - request for proxy stub for given class, can be combined with client but this may hurt caching unless stub=all is used 
// ?c=classname&m=method - an ajax call, server handles serialization and handing things off to the proper method then returning the results 
$server->handleRequest(); 
?> 