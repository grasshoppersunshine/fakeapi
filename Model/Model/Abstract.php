<?php
class Model_Abstract {
	
	private static $_singleton;
	protected $_resource_class;
	protected $_data;
	
	public static function getSingleton() {
		if(!self::$_singleton) {
			self::$_singleton = new get_class(self);
		}
		return self::$_singleton;
	}
	
	public function getResource() {
		$class_name = $this->_resource_class;
		return $class_name::getSingleton();
	}
	
	protected function _get($k) {
		return isset($this->_data[$k]) ? $this->_data[$k] : null;
	}
	
	protected function _set($k, $v) {
		$this->_data[$k] = $v;
	}
	
	public function getErrorMessage() {
		return $this->_get('error');
	}
}
?>
