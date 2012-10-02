<?php
set_include_path(get_include_path().PATH_SEPARATOR.DIRNAME(__FILE__).DIRECTORY_SEPARATOR.'Model');

session_start();

class Template {
	public static function go($filename, $vars=array()) {
		foreach($vars as $k=>$v) {
			$$k = $v;
		}
		include 'Template/'.$filename;
	}
}

function __autoload($classname) {
	$file = preg_replace('#_#', DIRECTORY_SEPARATOR, $classname);
	$file .= '.php';
	include $file;
}

function dispatchRequest() {

	$request = preg_replace('#^/index.php#', '', $_SERVER['REQUEST_URI']);
	$request = preg_replace('#\?.*$#', '', $request);
	$request = trim($request, '/');

	if(!empty($request)) {
		$paths = explode('/', $request);
		if(count($paths) > 1) {
			$action = array_pop($paths).'Action';
		} else {
			$action = 'index';
		}
		$classname = str_replace(' ', '_', ucwords('view '.implode(' ', $paths)));
	} else {
		$classname = 'View_Index';
		$action = 'indexAction';
	}

	$o = new $classname();
	$o->$action();
}
?>
