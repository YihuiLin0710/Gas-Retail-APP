<?php
class ProfileTest extends PHPUnit_Framework_TestCase
{
	public function testSetValues()
	{
		$pages = new \Profile();
		$this->assertEquals($pages->setValues());
	}
}
?>


