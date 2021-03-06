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
 * @package    CssAlly
 * @subpackage CssAlly_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 */

/**
 * @see Browser
 */
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Konqueror CSS rules
 *
 * This class contains all of the Konqueror-prefixed versions of CSS rules.
 *
 * @category   CssAlly
 * @package    CssAlly
 * @subpackage CssAlly_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @uses       Browser
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 */
class Browser_Konqueror extends Browser
{
    /**
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function backgroundClip($cssString = '')
    {
        $rule = '(?:(?:padding|border|content)-box)';

        $search    = '/(\s*)(?<!-)background-clip:(\s*)(' . $rule . '(?:,\s*' . $rule . ')*);?/';
        $replace   = '${1}-khtml-background-clip:${2}${3};${1}'
                   . 'background-clip:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end backgroundClip

    /**
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function backgroundOrigin($cssString = '')
    {
        $rule = '(?:(?:padding|border|content)-box)';

        $search    = '/(\s*)(?<!-)background-origin:(\s*)(' . $rule . '(?:,\s*' . $rule . ')*);?/';
        $replace   = '${1}-khtml-background-origin:${2}${3};${1}'
                   . 'background-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end backgroundOrigin
} //end class Browser_Konqueror