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
 * @see CssAlly
 */
require_once dirname(__FILE__) . '/../../src/CssAlly.php';

/**
 * Test class for CssAlly utility functions
 *
 * This class tests the utility functions of the CssAlly class. These functions
 * include such things as setting which browsers are targeted, adding CSS files
 * to be parsed, and so on.
 *
 * @category   CssAlly
 * @package    CssAlly_Tests
 * @author     Bill Parrott <bill@cssally.com>
 * @uses       BaseTest
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 * @see        CssAlly
 */
class CssAllyTest extends BaseTest
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
        $this->_object = new CssAlly(array(), array('cssDir' => 'path'));
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
     * @covers CssAlly::__construct
     *
     * @return void
     */
    public function testConstructorSetsDefaultBrowsers()
    {
        $browserList = $this->_object->getBrowsers();
        $this->assertInstanceOf('Browser_Explorer', $browserList['explorer']);
        $this->assertNull($browserList['konqueror']);
        $this->assertInstanceOf('Browser_Mozilla', $browserList['mozilla']);
        $this->assertInstanceOf('Browser_Opera', $browserList['opera']);
        $this->assertInstanceOf('Browser_Webkit', $browserList['webkit']);
    }

    /**
     * @covers CssAlly::__construct
     * @covers CssAlly::setBrowsers
     * @dataProvider constructorSetsBrowsersProvider
     *
     * @return void
     */
    public function testConstructorSetsBrowsers(array $browsers)
    {
        $this->_object = new CssAlly($browsers, array('cssDir' => 'path'));
        $browserList = $this->_object->getBrowsers();
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $browserList[$name]);
            } else {
                $this->assertNull($browserList[$name]);
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
     * @covers CssAlly::__construct
     * @dataProvider constructorWithNonDefaultOptionsProvider
     * @param array $options
     *
     * @return void
     */
    public function testConstructorWithNonDefaultOptions(array $options)
    {
        $this->_object = new CssAlly(array(), $options);
        foreach ($options as $option => $value) {
            $this->assertEquals($value, $this->_object->getOption($option));
        }
    }

    public function constructorWithNonDefaultOptionsProvider()
    {
        return array(
            array(
                array(
                    'compress' => true,
                    'minify'   => true,
                    'gzip'     => true,
                    'cssDir'   => 'path',
                ),
                array(
                    'compress' => false,
                    'minify'   => false,
                    'gzip'     => true,
                    'cssDir'   => 'apath',
                ),
                array(
                    'compress' => true,
                    'minify'   => false,
                    'gzip'     => true,
                    'cssDir'   => 'thispath',
                ),
                array(
                    'compress' => true,
                    'minify'   => true,
                    'gzip'     => false,
                    'cssDir'   => 'thatpath',
                ),
                array(
                    'compress' => false,
                    'minify'   => true,
                    'gzip'     => false,
                    'cssDir'   => 'somepath',
                ),
            ),
        );
    }

    /**
     * @covers CssAlly::__construct
     *
     * @return void
     */
    public function testConstructorSetsDefaultDirectoryWithoutCssDir()
    {
        $this->_object = new CssAlly();
        $cssDir = $this->_object->getOption('cssDir');

        $this->assertEquals('./css', $cssDir);
    }

    /**
     * @depends testConstructorSetsBrowsers
     * @covers CssAlly::getBrowser
     * @dataProvider constructorSetsBrowsersProvider
     * @param type $browser
     *
     * @return void
     */
    public function testGetBrowser(array $browsers)
    {
        $this->_object = new CssAlly($browsers, array('cssDir' => 'path'));
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $this->_object->getBrowser($name));
            } else {
                $this->assertNull($this->_object->getBrowser($name));
            }
        }
    }

    /**
     * @covers CssAlly::setBrowser
     * @depends testGetBrowser
     * @dataProvider setBrowserProvider
     * @param type $browser
     * @param type $generate
     *
     * @return void
     */
    public function testSetBrowser($browser, $useBrowserRules)
    {
        $this->_object->setBrowser($browser, $useBrowserRules);
        if ($useBrowserRules) {
            $className = 'Browser_' . ucfirst($browser);
            $this->assertInstanceOf($className, $this->_object->getBrowser($browser));
        } else {
            $this->assertNull($this->_object->getBrowser($browser));
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
     *
     * @return void
     */
    public function testSetMultipleBrowsers(array $browsers)
    {
        $this->_object->setBrowsers($browsers);
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->assertInstanceOf($className, $this->_object->getBrowser($name));
            } else {
                $this->assertNull($this->_object->getBrowser($name));
            }
        }
    }

    /**
     * @covers CssAlly::setBuiltCss
     * @covers CssAlly::getBuiltCss
     * @dataProvider compressProvider
     * @param type $cssString
     *
     * @return void
     */
    public function testSetBuiltCss($cssString)
    {
        $this->_object->setBuiltCss($cssString);
        $this->assertEquals($cssString, $this->_object->getBuiltCss());
    }

    /**
     * @covers CssAlly::compress
     * @depends testSetBuiltCss
     * @dataProvider compressProvider
     * @param type $cssString
     * @param type $expectedString
     *
     * @return void
     */
    public function testCompress($cssString, $expectedString)
    {
        $this->_object->setBuiltCss($cssString);
        $this->_object->compress();

        $this->assertEquals($expectedString, $this->_object->getBuiltCss());
    }

    public function compressProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'compressed';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::addCssFile
     * @dataProvider addCssFileProvider
     * @param type $filePath
     *
     * @return void
     */
    public function testAddCssFile($filePath)
    {
        $path = dirname(__FILE__) . '/../css';
        $this->_object = new CssAlly(array(), array('cssDir' => $path));
        $this->_object->addCssFile($filePath);
        $this->assertContains($path . '/' . $filePath, $this->_object->getFileList());
    }

    public function addCssFileProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh   = opendir($path);

        $fileList = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $fileList[] = array("{$file}");
            }
        }
        closedir($dh);

        return $fileList;
    }

    /**
     * @covers CssAlly::addCssFiles
     * @dataProvider addCssFilesProvider
     * @param array $files
     *
     * @return void
     */
    public function testAddCssFiles(array $files)
    {
        $path = dirname(__FILE__) . '/../css';
        $this->_object = new CssAlly(array(), array('cssDir' => $path));
        $this->_object->addCssFiles($files);
        foreach ($files as $file) {
            $this->assertContains($path . '/' . $file, $this->_object->getFileList());
        }
    }

    public function addCssFilesProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $dh   = opendir($path);

        $fileList = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}")) {
                $fileList[] = array("{$file}");
            }
        }
        closedir($dh);

        return array($fileList);
    }

    /**
     * @covers CssAlly::removeVariables
     * @depends testSetBuiltCss
     * @dataProvider removeVariablesProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testRemoveVariables($cssString, $expectedString)
    {
        $cssString = $this->_object->removeVariables($cssString);

        $this->assertEquals($expectedString, $cssString);
    }

    public function removeVariablesProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'remove-vars';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::processImports
     * @dataProvider processImportsProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testProcessImports($cssString, $expectedString)
    {
        $this->_object->setOption('cssDir', dirname(__FILE__) . '/../css');
        $this->_object->setBuiltCss($cssString);
        $this->_object->processImports();

        $this->assertEquals($expectedString, $this->_object->getBuiltCss());
    }

    public function processImportsProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'import';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::parseVariables
     * @depends testRemoveVariables
     * @dataProvider parseVariablesProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testParseVariables($cssString, $expectedString)
    {
        $this->_object->setBuiltCss($cssString);
        $this->_object->parseVariables();

        $this->assertEquals($expectedString, $this->_object->getBuiltCss());
    }

    public function parseVariablesProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'variables';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::removeMixins
     * @depends testSetBuiltCss
     * @dataProvider removeMixinsProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testRemoveMixins($cssString, $expectedString)
    {
        $cssString = $this->_object->removeMixins($cssString);

        $this->assertEquals($expectedString, $cssString);
    }

    public function removeMixinsProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'remove-mixins';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::processMixins
     * @depends testRemoveMixins
     * @dataProvider processMixinsProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testProcessMixins($cssString, $expectedString)
    {
        $this->_object->setBuiltCss($cssString);
        $this->_object->processMixins();

        $this->assertEquals($expectedString, $this->_object->getBuiltCss());
    }

    public function processMixinsProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'mixins';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }

    /**
     * @covers CssAlly::processNestedRules
     * @dataProvider processNestedRulesProvider
     * @param string $cssString      The string to be tested
     * @param string $expectedString The expected result
     *
     * @return void
     */
    public function testProcessNestedRules($cssString, $expectedString)
    {
        $this->_object->setBuiltCss($cssString);
        $this->_object->processNestedRules();

        $this->assertEquals($expectedString, $this->_object->getBuiltCss());
    }

    public function processNestedRulesProvider()
    {
        $path = dirname(__FILE__) . '/../css';
        $subFolder = 'nesting';

        $strings = $this->getCssStrings($path, $subFolder);

        return $strings;
    }
}