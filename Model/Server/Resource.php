<?php
class Server_Resource {
	
	private static $_host = 'fakeapi.betterservers.com';
	private static $_path = 'customer/[cid]/server/[sid]';
	private static $_port = 3000;
	private static $_secure = false;
	private static $_singleton;
	
	private static function _getUrl($cid, $sid) {
		$host   = self::$_host;
		$port   = self::$_port;
		$path   = self::$_path;
		$secure = self::$_secure;
		
		$url = ($secure ? 'https://' : 'http://')
			 . $host
			 . ($port ? ':'.$port : '')
			 . ($path ? '/'.$path : '');
		
		$url = preg_replace('#\[cid\]#', $cid, $url);
		$url = preg_replace('#\[sid\]#', $sid, $url);
		
		return $url;
	}
	
	public static function getSingleton() {
		if(!isset(self::$_singleton)) {
			self::$_singleton = new Server_Resource();
		}
		return self::$_singleton;
	}
	
	public static function load($cid, $sid) {
		
		$url = self::_getUrl($cid, $sid);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$a = json_decode($response);
		
		return $a;
	}
	
	public static function save($cid, $sid, $params) {
		
		$url = self::_getUrl($cid, $sid);
		
		$query = '';
		foreach($params as $k=>$v) {
			if($k == 'state' || $k == 'secret') {
				$query .= empty($query) ? '' : '&';
				$query .= "$k=$v";
			}
		}
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		$response = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($response);
	}

}
?>
