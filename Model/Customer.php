<?php
class Customer extends Model_Abstract {
	
	function __construct() {
		$this->_resource_class = 'Customer_Resource';
	}
	
	public static function getSingleton() {
		if(!self::$_singleton) {
			self::$_singleton = new Customer();
		}
		return self::$_singleton;
	}
	
	public function getId() {
		return $this->_get('id');
	}
	
	public function setId($id) {
		$this->_set('id', $id);
		return $this;
	}
	
	public function getName() {
		return $this->_get('name');
	}
	
	public function setName($name) {
		$this->_set('name', $name);
		return $this;
	}
	
	public function getPhone($phone) {
		return $this->_get('phone');
	}
	
	public function setPhone($phone) {
		$this->_set('phone', $phone);
		return $this;
	}
	
	public function getServerIdList() {
		return $this->_get('servers');
	}
	
	public function load($id) {
		$a = $this->getResource()->load($id);
		$this->_data = get_object_vars($a);
	}
}
?>
