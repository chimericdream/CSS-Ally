<?php
require_once dirname(__FILE__) . '/BaseTest.php';
require_once dirname(__FILE__) . '/../../src/CssAlly.php';

/**
 * Test class for CssAlly.
 */
class CssRulesTest extends BaseTest {

    /**
     * @var CssAlly
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new CssAlly(array(), array('cssDir' => 'path'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Browser::background_size
     * @dataProvider backgroundSizeProvider
     * @param type $cssString
     * @param type $expectedString
     */
    public function testBackgroundSize($cssString, $expectedString)
    {
        $cssString = $this->object->background_size($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function backgroundSizeProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $compressed       = file_get_contents("{$path}/background-size/{$file}");
                $testCssStrings[] = array($css, $compressed);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::border_radius
     * @dataProvider borderRadiusProvider
     * @param type $cssString
     * @param type $expectedString
     */
    public function testBorderRadius($cssString, $expectedString)
    {
        $cssString = $this->object->border_radius($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function borderRadiusProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $compressed       = file_get_contents("{$path}/border-radius/{$file}");
                $testCssStrings[] = array($css, $compressed);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::box_shadow
     * @dataProvider boxShadowProvider
     */
    public function testBoxShadow($cssString, $expectedString)
    {
        $cssString = $this->object->box_shadow($cssString);
        $this->assertEquals($expectedString, $cssString);
    }
    
    public function boxShadowProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $shadowCss        = file_get_contents("{$path}/box-shadow/{$file}");
                $testCssStrings[] = array($css, $shadowCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::column_count
     * @dataProvider columnCountProvider
     */
    public function testColumnCount($cssString, $expectedString)
    {
        $cssString = $this->object->column_count($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnCountProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-count/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::column_gap
     * @dataProvider columnGapProvider
     */
    public function testColumnGap($cssString, $expectedString)
    {
        $cssString = $this->object->column_gap($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnGapProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-gap/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::column_rule
     * @dataProvider columnRuleProvider
     */
    public function testColumnRule($cssString, $expectedString)
    {
        $cssString = $this->object->column_rule($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnRuleProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-rule/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::column_span
     * @dataProvider columnSpanProvider
     */
    public function testColumnSpan($cssString, $expectedString)
    {
        $cssString = $this->object->column_span($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnSpanProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-span/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::column_width
     * @dataProvider columnWidthProvider
     */
    public function testColumnWidth($cssString, $expectedString)
    {
        $cssString = $this->object->column_width($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnWidthProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-width/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }
}