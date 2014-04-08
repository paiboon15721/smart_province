<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

//	public function testFormSelectYear() {
//		$select = $this->formBuilder->selectYear('year', 2000, 2001);
//		$this->assertEquals('<select name="year"><option value="2000">2000</option><option value="2001">2001</option></select>', $select);
//	}
}
