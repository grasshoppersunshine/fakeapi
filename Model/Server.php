<?php
class Server extends Model_Abstract {
	
	function __construct() {
		$this->_resource_class = 'Server_Resource';
	}
	
	public function getId() {
		return $this->_get('id');
	}
	
	public function setId($id) {
		$this->_set('id', $id);
		return $this;
	}
	
	public function getIp() {
		return $this->_get('ip');
	}
	
	public function setIp($ip) {
		$this->_set('ip', $ip);
		return $this;
	}
	
	public function getHostname() {
		return $this->_get('hostname');
	}
	
	public function setHostname($hostname) {
		$this->_set('hostname', $hostname);
		return $this;
	}
	
	public function getDiskspace() {
		return $this->_get('diskspace');
	}
	
	public function setDiskspace($diskspace) {
		$this->_set('diskspace', $diskspace);
		return $this;
	}
	
	public function getDiskspaceUnits() {
		return $this->_get('diskspace_units');
	}
	
	public function setDiskspaceUnits($units) {
		$this->_set('diskspace_units', $units);
		return $this;
	}
	
	public function getDiskUsed() {
		return $this->_get('disk_used');
	}
	
	public function setDiskUsed($used) {
		$this->_set('disk_used', $used);
		return $this;
	}
	
	public function getState() {
		return $this->_get('state');
	}
	
	public function setState($state) {
		$this->_set('state', $state);
		return $this;
	}
	
	private function _getCustomerId() {
		return $this->_get('customer_id');
	}
	
	private function _setCustomerId($id) {
		$this->_set('customer_id', $id);
		return $this;
	}
	
	public function load($cid, $sid) {
		$a = $this->getResource()->load($cid, $sid);
		$this->_data = get_object_vars($a);
		$this->_set('secret', '4358648622');
		$this->_setCustomerId($cid);
	}
	
	public function save() {
		$cid = $this->_getCustomerId() ? $this->_getCustomerId() : false;
		if($cid && $this->getId()) {
			$this->getResource()->save($cid, $this->getId(), $this->_data);
		}
	}
}
?>
