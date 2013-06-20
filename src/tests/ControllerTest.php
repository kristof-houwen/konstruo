<?php

define('SITE_PATH', realpath(dirname(__FILE__)));
require_once(SITE_PATH . '/../StsController.php');

class ControllerTest extends PHPUnit_Framework_TestCase {

	public function testPHPUnitFrameworkSetup()
	{
		$this->assertEquals(1,1);
	}

	// controller gets viewengine injected via constructor
	// controller must create a view = call the viewEngine with the template
	// controller must give data to the view

	public function testControllerCreatesHtmlView()
	{	
		$viewMock = $this->getMock('StsHtmlView');
		$viewMock->expects($this->once())
						->method('set_masterTemplate');

		$controller = new StsController();
		$controller->set_masterTpl('helloworld.html');
		$view = $controller->view();
		$this->assertInstanceOf('StsHtmlView', $view);	
	 		
	}

	 
}


?>
