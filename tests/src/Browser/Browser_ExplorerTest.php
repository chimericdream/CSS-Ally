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
 * @see Browser_Explorer 
 */
require_once dirname(__FILE__) . '/../../../src/Browser/Explorer.php';

/**
 * Test class for Explorer CSS rules.
 * 
 * This class individually tests all of the Explorer-prefixed versions of CSS
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
 * @see        Browser_Explorer
 */
class Browser_ExplorerTest extends BaseTest
{
    /**
     * @var Browser_Explorer
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
        $this->_object = new Browser_Explorer;
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
     * @covers Browser_Explorer::animation
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
        $subFolder = 'animation/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-delay rules together
     * @covers Browser_Explorer::animationDelay
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
        $subFolder = 'animation-delay/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-direction rules together
     * @covers Browser_Explorer::animationDirection
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
        $subFolder = 'animation-direction/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-duration rules together
     * @covers Browser_Explorer::animationDuration
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
        $subFolder = 'animation-duration/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-iteration-count rules together
     * @covers Browser_Explorer::animationIterationCount
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
        $subFolder = 'animation-iteration-count/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-keyframes rules together
     * @covers Browser_Explorer::animationKeyframes
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
        $subFolder = 'animation-keyframes/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-name rules together
     * @covers Browser_Explorer::animationName
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
        $subFolder = 'animation-name/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-play-state rules together
     * @covers Browser_Explorer::animationPlayState
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
        $subFolder = 'animation-play-state/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * Test all animation-timing-function rules together
     * @covers Browser_Explorer::animationTimingFunction
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
        $subFolder = 'animation-timing-function/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::borderImage
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
        $subFolder = 'border-image/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::linearGradient
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
        $subFolder = 'linear-gradient/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::radialGradient
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
        $subFolder = 'radial-gradient/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transform
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
        $subFolder = 'transform/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transformOrigin
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
        $subFolder = 'transform-origin/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transitionDelay
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
        $subFolder = 'transition-delay/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transitionDuration
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
        $subFolder = 'transition-duration/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transitionProperty
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
        $subFolder = 'transition-property/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Explorer::transitionTimingFunction
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
        $subFolder = 'transition-timing-function/explorer';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }
}