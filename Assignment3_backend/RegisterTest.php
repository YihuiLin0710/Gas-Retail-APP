
<?php
class ProfileTest extends PHPUnit_Framework_TestCase
{
	public function testSetValues()
	{
		$pages = new \Register();
		$this->assertEquals($pages->setValues());
	}
}
?>

