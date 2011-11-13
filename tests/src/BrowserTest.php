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
require_once dirname(__FILE__) . '/BaseTest.php';

/**
 * @see Browser
 */
require_once dirname(__FILE__) . '/../../src/Browser.php';

/**
 * Test class for browser-prefixed CSS rules
 *
 * This class tests each CSS rule in full. In other words, for each CSS rule,
 * the test validates the output when all vendor prefixed versions of the rule
 * have been generated.
 *
 * @category   CssAlly
 * @package    CssAlly_Tests
 * @subpackage CssAlly_Tests_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @uses       BaseTest
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 * @see        CssAlly
 */
class BrowserTest extends BaseTest
{
    /**
     * @var CssAlly
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
        $browsers = array(
            'explorer'  => true,
            'konqueror' => true,
            'mozilla'   => true,
            'opera'     => true,
            'webkit'    => true,
        );
        $this->_object = new CssAlly($browsers, array('cssDir' => 'path'));
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
     * Test all rules together
     * @dataProvider fullRuleSetProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testFullRuleSet($cssString, $expectedString)
    {
        $this->_object->setBrowsers(array(
            'explorer'  => true,
            'konqueror' => true,
            'mozilla'   => true,
            'opera'     => true,
            'webkit'    => true,
        ));
        $this->_object->setOption('cssDir', dirname(__FILE__) . '/../css');
        $this->_object->setBuiltCss($cssString);
        $this->_object->processImports();
        $this->_object->parseVariables();
        $this->_object->runCssRules();
        $this->_object->compress();
        $cssString = $this->_object->getBuiltCss();
        $this->assertEquals($expectedString, $cssString);
    }

    public function fullRuleSetProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/_full/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all rules together
     * @dataProvider fullRuleSetNoCompressionProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testFullRuleSetNoCompression($cssString, $expectedString)
    {
        $this->_object->setBrowsers(array(
            'explorer'  => true,
            'konqueror' => true,
            'mozilla'   => true,
            'opera'     => true,
            'webkit'    => true,
        ));
        $this->_object->setOption('cssDir', dirname(__FILE__) . '/../css');
        $this->_object->setBuiltCss($cssString);
        $this->_object->processImports();
        $this->_object->parseVariables();
        $this->_object->runCssRules();
        $cssString = $this->_object->getBuiltCss();
        $this->assertEquals($expectedString, $cssString);
    }

    public function fullRuleSetNoCompressionProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/_fullnocompress/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation rules together
     * @covers Browser::animation
     * @dataProvider animationProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimation($cssString, $expectedString)
    {
        $cssString = $this->_object->animation($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-delay rules together
     * @covers Browser::animationDelay
     * @dataProvider animationDelayProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationDelay($cssString, $expectedString)
    {
        $cssString = $this->_object->animationDelay($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationDelayProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-delay/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-direction rules together
     * @covers Browser::animationDirection
     * @dataProvider animationDirectionProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationDirection($cssString, $expectedString)
    {
        $cssString = $this->_object->animationDirection($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationDirectionProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-direction/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-duration rules together
     * @covers Browser::animationDuration
     * @dataProvider animationDurationProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationDuration($cssString, $expectedString)
    {
        $cssString = $this->_object->animationDuration($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationDurationProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-duration/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-iteration-count rules together
     * @covers Browser::animationIterationCount
     * @dataProvider animationIterationCountProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationIterationCount($cssString, $expectedString)
    {
        $cssString = $this->_object->animationIterationCount($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationIterationCountProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-iteration-count/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-keyframes rules together
     * @covers Browser::animationKeyframes
     * @dataProvider animationKeyframesProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationKeyframes($cssString, $expectedString)
    {
        $cssString = $this->_object->animationKeyframes($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationKeyframesProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-keyframes/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-name rules together
     * @covers Browser::animationName
     * @dataProvider animationNameProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationName($cssString, $expectedString)
    {
        $cssString = $this->_object->animationName($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationNameProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-name/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-play-state rules together
     * @covers Browser::animationPlayState
     * @dataProvider animationPlayStateProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationPlayState($cssString, $expectedString)
    {
        $cssString = $this->_object->animationPlayState($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationPlayStateProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-play-state/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all animation-timing-function rules together
     * @covers Browser::animationTimingFunction
     * @dataProvider animationTimingFunctionProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testAnimationTimingFunction($cssString, $expectedString)
    {
        $cssString = $this->_object->animationTimingFunction($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function animationTimingFunctionProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/animation-timing-function/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all background-clip rules together
     * @covers Browser::backgroundClip
     * @dataProvider backgroundClipProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBackgroundClip($cssString, $expectedString)
    {
        $cssString = $this->_object->backgroundClip($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function backgroundClipProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/background-clip/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all background-origin rules together
     * @covers Browser::backgroundOrigin
     * @dataProvider backgroundOriginProvider
     *
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBackgroundOrigin($cssString, $expectedString)
    {
        $cssString = $this->_object->backgroundOrigin($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function backgroundOriginProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/background-origin/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * Test all background-size rules together
     * @covers Browser::backgroundSize
     * @dataProvider backgroundSizeProvider
     *
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
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $bgCss     = file_get_contents("{$path}/background-size/{$file}");
                $strings[] = array($css, $bgCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::borderImage
     * @dataProvider borderImageProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testBorderImage($cssString, $expectedString)
    {
        $cssString = $this->_object->borderImage($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function borderImageProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $radiusCss        = file_get_contents("{$path}/border-image/{$file}");
                $testCssStrings[] = array($css, $radiusCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::borderRadius
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
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $borderCss = file_get_contents("{$path}/border-radius/{$file}");
                $strings[] = array($css, $borderCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::boxShadow
     * @dataProvider boxShadowProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testBoxShadow($cssString, $expectedString)
    {
        $cssString = $this->_object->boxShadow($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function boxShadowProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $shadowCss = file_get_contents("{$path}/box-shadow/{$file}");
                $strings[] = array($css, $shadowCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columnCount
     * @dataProvider columnCountProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumnCount($cssString, $expectedString)
    {
        $cssString = $this->_object->columnCount($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnCountProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/column-count/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columnGap
     * @dataProvider columnGapProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumnGap($cssString, $expectedString)
    {
        $cssString = $this->_object->columnGap($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnGapProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/column-gap/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columnRule
     * @dataProvider columnRuleProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumnRule($cssString, $expectedString)
    {
        $cssString = $this->_object->columnRule($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnRuleProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/column-rule/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columnSpan
     * @dataProvider columnSpanProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumnSpan($cssString, $expectedString)
    {
        $cssString = $this->_object->columnSpan($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnSpanProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/column-span/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columnWidth
     * @dataProvider columnWidthProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumnWidth($cssString, $expectedString)
    {
        $cssString = $this->_object->columnWidth($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnWidthProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/column-width/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::columns
     * @dataProvider columnsProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testColumns($cssString, $expectedString)
    {
        $cssString = $this->_object->columns($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function columnsProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/columns/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::linearGradient
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
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/linear-gradient/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::radialGradient
     * @dataProvider radialGradientProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testRadialGradient($cssString, $expectedString)
    {
        $cssString = $this->_object->radialGradient($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function radialGradientProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css              = file_get_contents("{$path}/{$file}");
                $columnCss        = file_get_contents("{$path}/radial-gradient/{$file}");
                $testCssStrings[] = array($css, $columnCss);
            }
        }
        closedir($dh);

        return $testCssStrings;
    }

    /**
     * @covers Browser::transform
     * @dataProvider transformProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTransform($cssString, $expectedString)
    {
        $cssString = $this->_object->transform($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transformProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transform/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::transformOrigin
     * @dataProvider transformOriginProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTransformOrigin($cssString, $expectedString)
    {
        $cssString = $this->_object->transformOrigin($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transformOriginProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transform-origin/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::transitionDelay
     * @dataProvider transitionDelayProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTransitionDelay($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionDelay($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionDelayProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transition-delay/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::transitionDuration
     * @dataProvider transitionDurationProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTransitionDuration($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionDuration($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionDurationProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transition-duration/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::transitionProperty
     * @dataProvider transitionPropertyProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTransitionProperty($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionProperty($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionPropertyProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transition-property/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }

    /**
     * @covers Browser::transitionTimingFunction
     * @dataProvider transitionTimingFunctionProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     */
    public function testTimingFunction($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionTimingFunction($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionTimingFunctionProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh = opendir($path);

        $strings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $css       = file_get_contents("{$path}/{$file}");
                $colCss    = file_get_contents("{$path}/transition-timing-function/{$file}");
                $strings[] = array($css, $colCss);
            }
        }
        closedir($dh);

        return $strings;
    }
}