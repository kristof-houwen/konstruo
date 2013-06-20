<?php

//require_once(SITE_PATH . '/lib/sitsol/StsController.php');

class HomeController extends StsController{

	public function __construct()
	{
		$this->set_masterTpl('shared/tplMaster.html');
	}

	public function index()
	{
		$model = new Foo();
		$model->firstname = "Kristof";
		$model->menu = array("1" => "home", "2" => "menu item 2", "3" => "menu item 3" );
		return $this->view($model,'home/index.php');
	}
	
	public function customer($params)
	{
		echo 'Nr Customer = ' . $params[0] . '<hr />';
		return $this->index();
	}
	
	
}


?>
