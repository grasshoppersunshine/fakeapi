<?php
class View_Index {
	
	public function indexAction() {
		
		$c = new Customer();
		$c->load(23);
		
		$_SESSION['customer'] = $c;
		
		$vars = array(
			'customer'=>$c
		);
		
		Template::go('index.html', $vars);
	}
}
?>
