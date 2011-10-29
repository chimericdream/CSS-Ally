<?php
/**
 * CssAlly
 * 
 * Copyright (C) 2011 Bill Parrott
 * 
 * LICENSE
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * PHP Version 5
 * 
 * @category   CssAlly
 * @package    CssAlly_Tests
 * @subpackage CssAlly_Tests_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 */

/**
 * @see BaseTest 
 */
require_once dirname(__FILE__) . '/../BaseTest.php';

/**
 * @see Browser_Webkit
 */
require_once dirname(__FILE__) . '/../../../src/Browser/Webkit.php';

/**
 * Test class for Webkit CSS rules.
 * 
 * This class individually tests all of the Webkit-prefixed versions of CSS
 * rules.
 *
 * @category   CssAlly
 * @package    CssAlly_Tests
 * @subpackage CssAlly_Tests_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @uses       BaseTest
 * @see        Browser_Webkit
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 */
class Browser_WebkitTest extends BaseTest
{
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
     * @covers Browser_Webkit::background_size
     * @dataProvider backgroundSizeProvider
     */
    public function testBackgroundSize($cssString, $expectedString)
    {
        $cssString = $this->object->background_size($cssString);
        $this->assertEquals($expectedString, $cssString);
    }
    
    public function backgroundSizeProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $shadowCss        = file_get_contents("{$path}/background-size/webkit/{$file}");
                $testCssStrings[] = array($css, $shadowCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::border_radius
     * @dataProvider borderRadiusProvider
     */
    public function testBorderRadius($cssString, $expectedString)
    {
        $cssString = $this->object->border_radius($cssString);
        $this->assertEquals($expectedString, $cssString);
    }
    
    public function borderRadiusProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $radiusCss        = file_get_contents("{$path}/border-radius/webkit/{$file}");
                $testCssStrings[] = array($css, $radiusCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::box_shadow
     * @dataProvider boxShadowProvider
     */
    public function testBoxShadow($cssString, $expectedString)
    {
        $cssString = $this->object->box_shadow($cssString);
        $this->assertEquals($expectedString, $cssString);
    }
    
    public function boxShadowProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $shadowCss        = file_get_contents("{$path}/box-shadow/webkit/{$file}");
                $testCssStrings[] = array($css, $shadowCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::column_count
     * @dataProvider columnCountProvider
     */
    public function testColumnCount($cssString, $expectedString)
    {
        $cssString = $this->object->column_count($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnCountProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-count/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::column_gap
     * @dataProvider columnGapProvider
     */
    public function testColumnGap($cssString, $expectedString)
    {
        $cssString = $this->object->column_gap($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnGapProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-gap/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::column_rule
     * @dataProvider columnRuleProvider
     */
    public function testColumnRule($cssString, $expectedString)
    {
        $cssString = $this->object->column_rule($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnRuleProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-rule/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::column_span
     * @dataProvider columnSpanProvider
     */
    public function testColumnSpan($cssString, $expectedString)
    {
        $cssString = $this->object->column_span($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnSpanProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-span/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::column_width
     * @dataProvider columnWidthProvider
     */
    public function testColumnWidth($cssString, $expectedString)
    {
        $cssString = $this->object->column_width($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnWidthProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/column-width/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }
}