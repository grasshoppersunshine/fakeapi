<?php
class View_Server {
	
	public function viewAction() {
		$server = $this->_loadServer();
		Template::go('server.html', array('server'=>$server));
	}
	
	public function startAction() {
		$server = $this->_loadServer();
		if($server->getId()) {
			$server->setState('start');
			$server->save();
		}
		header('Location:/index.php/server/view?id='.$server->getId());
	}
	
	public function stopAction() {
		$server = $this->_loadServer();
		if($server->getId()) {
			$server->setState('stop');
			$server->save();
		}
		header('Location:/index.php/server/view?id='.$server->getId());
	}
	
	private function _loadServer() {
		$server = new Server();
		
		$id = intval($_REQUEST['id']);
		$c = isset($_SESSION['customer']) ? $_SESSION['customer'] : false;
		$cid = $c ? $c->getId() : 0;
		
		if($id && $cid) {
			$server->load($cid, $id);
		}
		return $server;
	}
}
?>
