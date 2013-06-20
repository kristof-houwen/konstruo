<?php

//require_once(SITE_PATH . '/lib/sitsol/StsController.php');

class HomeController extends StsController{

	public function __construct()
	{
		
	}

	public function index()
	{
		$model = new Foo();
		$model->firstname = "Kristof";
		$model->menu = array("home", "menu item 2", "menu item 3" );
		return $this->view($model,'home/index.php');
	}
	
	public function customer($params)
	{
		echo 'Nr Customer = ' . $params[0] . '<hr />';
		return $this->index();
	}
	
	
}


?>
