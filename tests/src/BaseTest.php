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
 * @category  CssAlly
 * @package   CssAlly_Tests
 * @author    Bill Parrott <bill@cssally.com>
 * @copyright 2011 Bill Parrott
 * @license   GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link      http://cssally.com/
 */

/**
 * Base class for unit tests
 * 
 * Any common functionality for unit tests goes here.
 *
 * @category  CssAlly
 * @package   CssAlly_Tests
 * @author    Bill Parrott <bill@cssally.com>
 * @uses      PHPUnit_Framework_TestCase
 * @copyright 2011 Bill Parrott
 * @license   GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link      http://cssally.com/
 */
class BaseTest extends PHPUnit_Framework_TestCase
{
    public function getCssStrings($path, $subFolder = null)
    {
        $dh = opendir($path);

        $testCssStrings = array();
        while (false !== ($file = readdir($dh))) {
            if (!is_dir("{$path}/{$file}") && substr($file, -3) == 'css') {
                $css              = file_get_contents("{$path}/{$file}");
                if (!is_null($subFolder)) {
                    $expcted          = file_get_contents("{$path}/{$subFolder}/{$file}");
                    $testCssStrings[] = array($css, $expcted);
                } else {
                    $testCssStrings[] = array();
                }
            }
        }
        closedir($dh);

        return $testCssStrings;
    }
    
    public function getCssFileList()
    {
        
    }
}