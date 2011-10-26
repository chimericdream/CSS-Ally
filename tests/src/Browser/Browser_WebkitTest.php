<?php
require_once dirname(__FILE__) . '/../BaseTest.php';
require_once dirname(__FILE__) . '/../../../src/Browser/Webkit.php';

/**
 * Test class for Browser_Webkit.
 * Generated by PHPUnit on 2011-09-06 at 23:10:15.
 */
class Browser_WebkitTest extends BaseTest {

    /**
     * @var Browser_Webkit
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Browser_Webkit;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Browser_Webkit::borderRadius
     * @dataProvider borderRadiusProvider
     */
    public function testBorderRadius($cssString, $webkitValue)
    {
        $cssString = $this->object->borderRadius($cssString);
        $this->assertContains($webkitValue, $cssString);
    }
    
    public function borderRadiusProvider()
    {
        $strings = array(
            array("p {border-radius: 5px;}",             "-webkit-border-radius: 5px;"),
            array("p {border-radius: 5px}",              "-webkit-border-radius: 5px;"),
            array("p {border-top-right-radius: 5px}",    "-webkit-border-top-right-radius: 5px;"),
            array("p {border-top-left-radius: 5px}",     "-webkit-border-top-left-radius: 5px;"),
            array("p {border-bottom-right-radius: 5px}", "-webkit-border-bottom-right-radius: 5px;"),
            array("p {border-bottom-left-radius: 5px}",  "-webkit-border-bottom-left-radius: 5px;"),
        );
        return $strings;
    }
}