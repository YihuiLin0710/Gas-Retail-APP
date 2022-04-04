<?php
class ProfileTest extends PHPUnit_Framework_TestCase
{
	public function testSetValues()
	{
		$pages = new \Login();
		$this->assertEquals($pages->setValues());
	}
}
?>
