<?php

use Way\Tests\Assert;
use Way\Tests\Should;

class RoutesTest extends TestCase {

	public function testCallMapIndex() {
		$this->call('GET', '/');
		$this->assertResponseOk();
	}
	
	//public function testCallWriteSession() {
	//	$crawler = $this->client->request('GET', 'writeSession/26011201');
	//	$this->assertTrue($this->client->getResponse()->isOk());
	//}

	//public function testCallMain() {
	//	$crawler = $this->client->request('GET', '/main');
	//	$this->assertTrue($this->client->getResponse()->isOk());
	//}

	//public function testCallVillageGeneralInformation() {
	//	$crawler = $this->client->request('GET', 'villageGeneralInformation');
	//	$this->assertTrue($this->client->getResponse()->isOk());
	//}

//	public function testTest() {	
//		$crawler = $this->client->request('GET', 'villageDirectors');
//		$this->assertTrue($this->client->getResponse()->isOk());
//		$this->call('GET', 'main');
//		$this->assertResponseOk();
//	}
	
	public function testItWorks() {
		$name = 'Joe';

		Should::equal('Joe', $name);
		Assert::equals('Joe', $name);
	}
	
	public function testFetchesItemsInArrayUntilKey() {
		//Arrange
		$name = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Nail'];

		//Act
		$result = $this->array_until('Matthew', $name);

		//Assert
		$expected = ['Taylor', 'Dayle'];
		$this->assertEquals($expected, $result);
	}

	/**
	 * @expectedException InvalidArgumentException
	*/
	public function testThrowsExceptionIfKeyDoesNotExist() {
		//Given this set of data
		$names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];
		$result = $this->array_until('Bob', $names);
	}

	function array_until($stopPoint, $arr) {
		$index = array_search($stopPoint, $arr);

		if (false === $index) {
			throw new InvalidArgumentException('Key does not exist in array');
		}

		return array_slice($arr, 0, $index);
	}

	public function testGeneratesAnchorTag() {
		$actual = link_to('dogs/1', 'show Dog');
		$expect = '<a href="http://localhost/dogs/1">show Dog</a>';
		Assert::equals($expect, $actual);
	}

	public function testAppliesAttributeUsingArray() {
		$actual = link_to('/dog/1', 'Show dog', ['class' => 'button']);
		$expect = '<a href="http://localhost/dog/1" class="button">Show dog</a>';
		$this->assertEquals($expect, $actual);
	}
}
