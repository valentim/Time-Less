<?php

require_once '../Registry.class.php';
require_once '../Request.class.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Request test case.
 */
class RequestTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var Request
	 */
	private $Request;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated RequestTest::setUp()
		

		$this->Request = new Request("/test1/test2/");
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated RequestTest::tearDown()
		

		$this->Request = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	
	/**
	 * Tests Request->getController()
	 */
	public function testControlerMustBeString() {
		
		$this->assertInternalType('string', $this->Request->getController());
	
	}
	
	/**
	 * Tests Request->getAction()
	 */
	public function testActionMustBeString() {
		
		$this->assertInternalType('string', $this->Request->getAction());
	
	}
	
	/**
	 * Tests Request->getParam()
	 */
	public function testParamMustBeArray() {
	
		$this->assertInternalType('array', $this->Request->getParam());
	
	}
	
	/**
	 * Tests Request->getParam()
	 */
	public function testVerifyIfParamExist() {
	
		$this->assertNotEmpty($this->Request->getParam());
	
	}

}

