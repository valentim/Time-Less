<?php

require_once dirname(__FILE__).'/../Controler.class.php';

require_once 'PHPUnit/Autoload.php';

/**
 * Controler test case.
 */
class ControlerTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var Controler
	 */
	private $Controler;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated ControlerTest::setUp()
		

		$this->Controler = new Controler(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ControlerTest::tearDown()
		

		$this->Controler = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests Controler->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated ControlerTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->Controler->__construct(/* parameters */);
	
	}
	
	/**
	 * Tests Controler->__toString()
	 */
	public function test__toString() {
		// TODO Auto-generated ControlerTest->test__toString()
		$this->markTestIncomplete ( "__toString test not implemented" );
		
		$this->Controler->__toString(/* parameters */);
	
	}

}

