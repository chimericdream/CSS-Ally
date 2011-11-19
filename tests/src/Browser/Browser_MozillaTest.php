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
 * @see Browser_Mozilla
 */
require_once dirname(__FILE__) . '/../../../src/Browser/Mozilla.php';

/**
 * Test class for Mozilla CSS rules.
 * 
 * This class individually tests all of the Mozilla-prefixed versions of CSS
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
 * @see        Browser_Mozilla
 */
class Browser_MozillaTest extends BaseTest
{
    /**
     * @var Browser_Mozilla
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
        $this->_object = new Browser_Mozilla;
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
     * Test all animation rules together
     * @covers Browser_Mozilla::animation
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-delay rules together
     * @covers Browser_Mozilla::animationDelay
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-delay/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-direction rules together
     * @covers Browser_Mozilla::animationDirection
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-direction/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-duration rules together
     * @covers Browser_Mozilla::animationDuration
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-duration/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-iteration-count rules together
     * @covers Browser_Mozilla::animationIterationCount
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-iteration-count/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-keyframes rules together
     * @covers Browser_Mozilla::animationKeyframes
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-keyframes/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-name rules together
     * @covers Browser_Mozilla::animationName
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-name/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-play-state rules together
     * @covers Browser_Mozilla::animationPlayState
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-play-state/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-timing-function rules together
     * @covers Browser_Mozilla::animationTimingFunction
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'animation-timing-function/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::backgroundClip
     * @dataProvider backgroundClipProvider
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'background-clip/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::backgroundOrigin
     * @dataProvider backgroundOriginProvider
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
        $path = dirname(__FILE__) . '/../../css';
        $subFolder = 'background-origin/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::backgroundSize
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
        $subFolder = 'background-size/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::borderImage
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
        $subFolder = 'border-image/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::borderRadius
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
        $subFolder = 'border-radius/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::boxShadow
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
        $subFolder = 'box-shadow/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columnCount
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
        $subFolder = 'column-count/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columnGap
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
        $subFolder = 'column-gap/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columnRule
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
        $subFolder = 'column-rule/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columnSpan
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
        $subFolder = 'column-span/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columnWidth
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
        $subFolder = 'column-width/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::columns
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
        $subFolder = 'columns/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::linearGradient
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
        $subFolder = 'linear-gradient/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::radialGradient
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
        $subFolder = 'radial-gradient/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transform
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
        $subFolder = 'transform/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transformOrigin
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
        $subFolder = 'transform-origin/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transitionDelay
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
        $subFolder = 'transition-delay/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transitionDuration
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
        $subFolder = 'transition-duration/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transitionProperty
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
        $subFolder = 'transition-property/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Mozilla::transitionTimingFunction
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
        $subFolder = 'transition-timing-function/mozilla';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }
}