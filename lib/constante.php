<?php

/*define('WEBROOT', dirname($_SERVER['SCRIPT_NAME']).'/');*/
define('WWW_ROOT', dirname(dirname(__FILE__)));

$directory = basename(dirname(dirname(__FILE__)));
$url = explode($directory, $_SERVER['REQUEST_URI']);

if(count($url) == 1){
	define('WEBROOT', '/');

}else{
	define('WEBROOT',$url[0]. 'portfolio/');

}


/*define('IMAGES', WWW_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);*/
define('IMAGES', WEBROOT.'images');

