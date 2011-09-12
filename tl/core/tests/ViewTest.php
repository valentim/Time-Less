<?php

require_once '../View.class.php';
require_once 'PHPUnit/Autoload.php';

/**
 * View test case.
 */
class ViewTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var View
	 */
	private $View;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated ViewTest::setUp()
		

		$this->View = new View('index');
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ViewTest::tearDown()
		

		$this->View = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests View->getRealPath()
	 */
	public function testIfRealPathIsString() {
		$this->assertInternalType('string',$this->View->getRealPath());
	
	}
	
	
	/**
	 * Tests View->getRealPath()
	 */
	public function testIfFileExists() {
		$this->assertFileExists($this->View->getRealPath());
	
	}

}

