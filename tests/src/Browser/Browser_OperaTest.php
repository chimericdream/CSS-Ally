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
 * @see Browser_Opera
 */
require_once dirname(__FILE__) . '/../../../src/Browser/Opera.php';

/**
 * Test class for Opera CSS rules.
 * 
 * This class individually tests all of the Opera-prefixed versions of CSS
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
 * @see        Browser_Opera
 */
class Browser_OperaTest extends BaseTest
{
    /**
     * @var Browser_Opera
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
        $this->_object = new Browser_Opera;
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
     * @covers Browser_Opera::backgroundSize
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
        $subFolder = 'background-size/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::borderImage
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'border-image/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::borderRadius
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
        $subFolder = 'border-radius/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::linearGradient
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
        $subFolder = 'linear-gradient/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::radialGradient
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'radial-gradient/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transform
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
        $subFolder = 'transform/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transformOrigin
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
        $subFolder = 'transform-origin/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transitionDelay
     * @dataProvider transitionDelayProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransitionDelay($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionDelay($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionDelayProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'transition-delay/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transitionDuration
     * @dataProvider transitionDurationProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransitionDuration($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionDuration($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionDurationProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'transition-duration/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transitionProperty
     * @dataProvider transitionPropertyProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransitionProperty($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionProperty($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionPropertyProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'transition-property/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Opera::transitionTimingFunction
     * @dataProvider transitionTimingFunctionProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testTransitionTimingFunction($cssString, $expectedString)
    {
        $cssString = $this->_object->transitionTimingFunction($cssString);
        $this->assertEquals($expectedString, $cssString);
    }

    public function transitionTimingFunctionProvider()
    {
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'transition-timing-function/opera';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }
}