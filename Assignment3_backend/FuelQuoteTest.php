<?php
class ProfileTest extends PHPUnit_Framework_TestCase
{
	public function testSetValues()
	{
		$pages = new \Fuel_quote();
		$this->assertEquals($pages->setValues());
	}
}
?>