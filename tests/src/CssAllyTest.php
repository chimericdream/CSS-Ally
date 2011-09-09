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
    public function testConstructorSetsDefaultBrowsers(array $browsers)
    {
        $this->assertInstanceOf('Browser_Explorer', $this->object->_browsers['explorer']);
        $this->assertNull($this->object->_browsers['konqueror']);
        $this->assertInstanceOf('Browser_Mozilla', $this->object->_browsers['mozilla']);
        $this->assertInstanceOf('Browser_Opera', $this->object->_browsers['opera']);
        $this->assertInstanceOf('Browser_Webkit', $this->object->_browsers['webkit']);
    }

    /**
     * @covers CssAlly::__construct
     * @covers CssAlly::_loadBrowsers
     * @dataProvider constructorSetsBrowsersProvider
     */
    public function testConstructorSetsBrowsers(array $browsers)
    {
        $this->object = new CssAlly($browsers);
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $this->object->_browsers[$name]);
            } else {
                $this->assertNull($this->object->_browsers[$name]);
            }
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
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $this->object->getBrowser($name));
            } else {
                $this->assertNull($this->object->getBrowser($name));
            }
        }
    }

    /**
     * @covers CssAlly::setBrowser
     * @depends testGetBrowser
     * @dataProvider setBrowserProvider
     * @param type $browser
     * @param type $generate
     */
    public function testSetBrowser($browser, $useBrowserRules)
    {
        $this->object->setBrowser($browser, $useBrowserRules);
        if ($useBrowserRules) {
            $className = 'Browser_' . ucfirst($browser);
            $this->assertInstanceOf($className, $this->object->getBrowser($browser));
        } else {
            $this->assertNull($this->object->getBrowser($browser));
        }
    }

    public function setBrowserProvider()
    {
        return array(
            array('explorer', true),
            array('konqueror', true),
            array('mozilla', true),
            array('opera', true),
            array('webkit', true),
            array('explorer', false),
            array('konqueror', false),
            array('mozilla', false),
            array('opera', false),
            array('webkit', false),
        );
    }

    /**
     * @covers CssAlly::setBrowsers
     * @depends testSetBrowser
     * @dataProvider constructorSetsBrowsersProvider
     * @param array $browsers
     */
    public function testSetMultipleBrowsers(array $browsers)
    {
        $this->object->setBrowsers($browsers);
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $this->object->getBrowser($name));
            } else {
                $this->assertNull($this->object->getBrowser($name));
            }
        }
    }

    /**
     * @covers CssAlly::compress
     * @dataProvider compressProvider
     * @param type $cssString
     * @param type $expectedCompressedString
     */
    public function testCompress($cssString, $expectedCompressedString)
    {
        $this->object->_builtCss = $cssString;
        $this->object->compress();

        $this->assertEquals($expectedCompressedString, $this->object->_builtCss);
    }

    public function compressProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css        = file_get_contents("{$path}/{$file}");
                $compressed = file_get_contents("{$path}/compressed/{$file}");
                $testCssStrings[] = array($css, $compressed);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }
}