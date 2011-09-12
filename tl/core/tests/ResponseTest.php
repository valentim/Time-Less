<?php

require_once '../View.class.php';
require_once '../Response.class.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Response test case.
 */
class ResponseTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var Response
	 */
	private $Response;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated ResponseTest::setUp()
		

		$this->Response = new Response('index', array('dado'=>1));
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ResponseTest::tearDown()
		

		$this->Response = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	
	/**
	 * Tests Response->getResponse()
	 */
	public function testIfResponseIsNotEmpty() {
	
		$this->assertNotEmpty($this->Response->getResponse());
	
	}

}

