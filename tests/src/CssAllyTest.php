<?php

require_once dirname(__FILE__) . '/../../src/CssAlly.php';

/**
 * Test class for CssAlly.
 * Generated by PHPUnit on 2011-09-03 at 00:15:08.
 */
class CssAllyTest extends PHPUnit_Framework_TestCase {

    /**
     * @var CssAlly
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new CssAlly;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers CssAlly::__construct
     * @dataProvider constructorSetsBrowsersProvider
     */
    public function testConstructorSetsBrowsers(array $browsers)
    {
        $this->object = new CssAlly($browsers);
        foreach ($browsers as $name => $value) {
            $this->assertEquals($browsers[$name], $this->object->_browsers[$name]);
        }
    }

    public function constructorSetsBrowsersProvider()
    {
        return array(
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => false,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => false,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => false,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => false,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => false,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
            array(
                array(
                    'explorer'  => true,
                    'konqueror' => true,
                    'mozilla'   => true,
                    'opera'     => true,
                    'webkit'    => true,
                ),
            ),
        );
    }

    /**
     * @depends testConstructorSetsBrowsers
     * @covers CssAlly::getBrowser
     * @dataProvider constructorSetsBrowsersProvider
     * @param type $browser
     */
    public function testGetBrowser(array $browsers)
    {
        $this->object = new CssAlly($browsers);
        foreach ($browsers as $name => $value) {
            $this->assertEquals($browsers[$name], $this->object->getBrowser($name));
        }
    }

//    /**
//     * @covers CssAlly::setBrowser
//     * @depends testGetBrowser
//     * @param type $browser
//     * @param type $generate
//     */
//    public function testSetBrowser($browser, $useBrowserRules)
//    {
//    }

    /**
     * @covers CssAlly::setBrowsers
     * @depends testSetBrowser
     * @param array $browsers
     */
    public function testSetMultipleBrowsers(array $browsers)
    {
    }
}