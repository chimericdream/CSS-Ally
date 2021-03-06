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
 * @see Browser_Konqueror
 */
require_once dirname(__FILE__) . '/../../../src/Browser/Konqueror.php';

/**
 * Test class for Konqueror CSS rules.
 * 
 * This class individually tests all of the Konqueror-prefixed versions of CSS
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
 * @see        Browser_Konqueror
 */
class Browser_KonquerorTest extends BaseTest
{
    /**
     * @var Browser_Konqueror
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
        $this->_object = new Browser_Konqueror;
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
     * @covers Browser_Konqueror::backgroundClip
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
        $subFolder = 'background-clip/konqueror';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers Browser_Konqueror::backgroundOrigin
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
        $subFolder = 'background-origin/konqueror';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }
}