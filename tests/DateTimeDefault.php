<?
/*
	* Test Timely 
	*
	* (c) Ray - teemodev@gmail.com
	*
	* For the full copyright and license information, please view the LICENSE
*/
class DateTimeDefault extends PHPUnit_Framework_TestCase {
		public function testmakeDate() {
			$this->assertEquals( "2014-04-12" , Timely::create("2014-04-12")->format("Y-m-d"));
		}
}
?>