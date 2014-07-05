<?php

class HomeController extends Controller{

	public function __construct()
	{
		$this->set_tpl("shared/tplMaster.php");
	}

	public function index()
	{
		$model = new Foo();
		$model->firstname = "Kristof";
		$model->menu = array("home", "menu item 2", "menu item 3" );
		return $this->view('home/index.php', $model);
	}
	
	public function hello()
	{
		$data = new Foo2();
		return $this->json($data);
	}

	public function customer($params)
	{
		echo 'Nr Customer = ' . $params[0] . '<hr />';
		return $this->index();
	}
	
	
}


?>
