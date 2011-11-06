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
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 * @see        Browser_Webkit
 */
class Browser_WebkitTest extends BaseTest
{
    /**
     * @var Browser_Webkit
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->_object = new Browser_Webkit;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers Browser_Webkit::backgroundSize
     * @dataProvider backgroundSizeProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBackgroundSize($cssString, $expectedString)
    {
        $cssString = $this->_object->backgroundSize($cssString);
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
     * @covers Browser_Webkit::borderRadius
     * @dataProvider borderRadiusProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBorderRadius($cssString, $expectedString)
    {
        $cssString = $this->_object->borderRadius($cssString);
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
     * @covers Browser_Webkit::boxShadow
     * @dataProvider boxShadowProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBoxShadow($cssString, $expectedString)
    {
        $cssString = $this->_object->boxShadow($cssString);
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
     * @covers Browser_Webkit::columnCount
     * @dataProvider columnCountProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumnCount($cssString, $expectedString)
    {
        $cssString = $this->_object->columnCount($cssString);
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
     * @covers Browser_Webkit::columnGap
     * @dataProvider columnGapProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumnGap($cssString, $expectedString)
    {
        $cssString = $this->_object->columnGap($cssString);
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
     * @covers Browser_Webkit::columnRule
     * @dataProvider columnRuleProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumnRule($cssString, $expectedString)
    {
        $cssString = $this->_object->columnRule($cssString);
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
     * @covers Browser_Webkit::columnSpan
     * @dataProvider columnSpanProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumnSpan($cssString, $expectedString)
    {
        $cssString = $this->_object->columnSpan($cssString);
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
     * @covers Browser_Webkit::columnWidth
     * @dataProvider columnWidthProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumnWidth($cssString, $expectedString)
    {
        $cssString = $this->_object->columnWidth($cssString);
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

    /**
     * @covers Browser_Webkit::columns
     * @dataProvider columnsProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testColumns($cssString, $expectedString)
    {
        $cssString = $this->_object->columns($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnsProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/columns/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::linearGradient
     * @dataProvider linearGradientProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testLinearGradient($cssString, $expectedString)
    {
        $cssString = $this->_object->linearGradient($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function linearGradientProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/linear-gradient/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::transform
     * @dataProvider transformProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransform($cssString, $expectedString)
    {
        $cssString = $this->_object->transform($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transformProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/transform/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser_Webkit::transformOrigin
     * @dataProvider transformOriginProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransformOrigin($cssString, $expectedString)
    {
        $cssString = $this->_object->transformOrigin($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transformOriginProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/transform-origin/webkit/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }
}