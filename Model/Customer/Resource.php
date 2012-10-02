<?php
class Customer_Resource {
	
	private static $_host = 'fakeapi.betterservers.com';
	private static $_path = 'customer/[id]';
	private static $_port = 3000;
	private static $_secure = false;
	private static $_singleton;
	
	public static function getSingleton() {
		if(!isset(self::$_singleton)) {
			self::$_singleton = new Customer_Resource();
		}
		return self::$_singleton;
	}
	
	public static function load($id) {
		
		$host   = self::$_host;
		$port   = self::$_port;
		$path   = self::$_path;
		$secure = self::$_secure;
		
		$url = ($secure ? 'https://' : 'http://')
			 . $host
			 . ($port ? ':'.$port : '')
			 . ($path ? '/'.$path : '');
		
		$url = preg_replace('#\[id\]#', $id, $url);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$a = json_decode($response);
		
		return $a;
	}

}
?>
