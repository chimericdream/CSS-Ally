<?php

require_once dirname(__FILE__) . '/../../../src/Browser/Opera.php';

/**
 * Test class for Browser_Opera.
 * Generated by PHPUnit on 2011-09-06 at 23:10:15.
 */
class Browser_OperaTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Browser_Opera
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Browser_Opera;
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
            array("p {border-radius: 5px;}",             "-o-border-radius: 5px;"),
            array("p {border-radius: 5px}",              "-o-border-radius: 5px;"),
            array("p {border-top-right-radius: 5px}",    "-o-border-top-right-radius: 5px;"),
            array("p {border-top-left-radius: 5px}",     "-o-border-top-left-radius: 5px;"),
            array("p {border-bottom-right-radius: 5px}", "-o-border-bottom-right-radius: 5px;"),
            array("p {border-bottom-left-radius: 5px}",  "-o-border-bottom-left-radius: 5px;"),
        );
        return $strings;
    }
}