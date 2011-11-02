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
 * Mozilla CSS rules
 *
 * This class contains all of the Mozilla-prefixed versions of CSS rules.
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
class Browser_Mozilla extends Browser
{
    /**
     * Add Mozilla rules for background-size
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function backgroundSize($cssString = '')
    {
        $length     = $this->lengthRegex();
        $percent    = $this->percentRegex();
        $bgsize     = '((\s*(' . $length . '|' . $percent . '|auto)){1,2}|'
                    . '\s*cover|\s*contain)';
        $value      = '(\s*)(' . $bgsize . '(,\s*' . $bgsize . ')*);?';
        $replace    = '${2}${3}';
        $properties = array(
            'background-size' => array(
                'prefix' => '-moz-background-size',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['format']};"
                       . '${1}' . "{$standard}:{$replace};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end backgroundSize

    /**
     * Add Mozilla rules for border-radius
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function borderRadius($cssString = '')
    {
        $length     = $this->lengthRegex();
        $percent    = $this->percentRegex();
        $shorthand  = array(
            'value'   => '(\s*)((\s*(' . $length . '|' . $percent . ')){1,4}'
                      . '(\s*\/\s*(\s*(' . $length . '|' . $percent . ')){1,4}'
                      . ')?);?',
            'replace' => '${2}${3}',
        );
        $longhand   = array(
            'value'   => '(\s*)((' . $length . '|' . $percent . ')(\s\s*('
                      . $length . '|' . $percent . '))?);?',
            'replace' => '${2}${3}',
        );

        $properties = array(
            'border-radius'              => array(
                'value'   => $shorthand['value'],
                'replace' => $shorthand['replace'],
                'prefix'  => '-moz-border-radius',
            ),
            'border-top-right-radius'    => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix'  => '-moz-border-radius-topright',
            ),
            'border-top-left-radius'     => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix'  => '-moz-border-radius-topleft',
            ),
            'border-bottom-right-radius' => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix'  => '-moz-border-radius-bottomright',
            ),
            'border-bottom-left-radius'  => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix'  => '-moz-border-radius-bottomleft',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search    = "/(\s*)(?<!-){$standard}:{$mozilla['value']}/";
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['replace']};"
                       . '${1}' . "{$standard}:{$mozilla['replace']};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end borderRadius

    /**
     * Add Mozilla rules for box-shadow
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function boxShadow($cssString = '')
    {
        $color      = $this->colorRegex();
        $length     = $this->lengthRegex();
        $shadow     = '(inset)?(\s*' . $length . '){2,4}(\s\s*' . $color . ')?';
        $value      = '(\s*)(none|' . $shadow . '(,\s*' . $shadow . ')*);?';
        $replace    = '${2}${3}';
        $properties = array(
            'box-shadow' => array(
                'prefix' => '-moz-box-shadow',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['format']};"
                       . '${1}' . "{$standard}:{$replace};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end boxShadow

    /**
     * Add Mozilla rules for column-count
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnCount($cssString = '')
    {
        $search    = '/(\s*)(?<!-)column-count:(\s*)(auto|\d+);?/';
        $replace   = '${1}-moz-column-count:${2}${3};${1}'
                   . 'column-count:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnCount

    /**
     * Add Mozilla rules for column-gap
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnGap($cssString = '')
    {
        $length    = $this->lengthRegex();
        $search    = '/(\s*)(?<!-)column-gap:(\s*)(normal|' . $length . ');?/';
        $replace   = '${1}-moz-column-gap:${2}${3};${1}column-gap:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnGap

    /**
     * Add Mozilla rules for column-rule
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnRule($cssString = '')
    {
        $width = $this->borderWidthRegex();
        $style = $this->borderStyleRegex();
        $color = $this->colorRegex();

        $properties = array(
            'column-rule' => array(
                'value'   => '(\s*)((' . $width . ')(\s*)'
                          .  '(' . $style . ')(\s*)'
                          .  '(' . $color . '|transparent)?);?',
                'replace' => '${2}${3}',
                'prefix'  => '-moz-column-rule',
            ),
            'column-rule-color' => array(
                'value'   => '(\s*)(' . $color . '|transparent);?',
                'replace' => '${2}${3}',
                'prefix'  => '-moz-column-rule-color',
            ),
            'column-rule-style' => array(
                'value'   => '(\s*)(' . $style . ');?',
                'replace' => '${2}${3}',
                'prefix'  => '-moz-column-rule-style',
            ),
            'column-rule-width' => array(
                'value'   => '(\s*)(' . $width . ');?',
                'replace' => '${2}${3}',
                'prefix'  => '-moz-column-rule-width',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search = "/(\s*)(?<!-){$standard}:{$mozilla['value']}/";
            $rep    = '${1}' . "{$mozilla['prefix']}:{$mozilla['replace']};"
                    . '${1}' . "{$standard}:{$mozilla['replace']};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end columnRule

    /**
     * Add Mozilla rules for column-span
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnSpan($cssString = '')
    {
        $search    = '/(\s*)(?<!-)column-span:(\s*)(all|none);?/';
        $replace   = '${1}-moz-column-span:${2}${3};${1}column-span:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnSpan

    /**
     * Add Mozilla rules for column-width
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnWidth($cssString = '')
    {
        $length = $this->lengthRegex();

        $search    = '/(\s*)(?<!-)column-width:(\s*)(auto|' . $length . ');?/';
        $replace   = '${1}-moz-column-width:${2}${3};${1}'
                   . 'column-width:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnWidth

    /**
     * Add Mozilla rules for columns
     *
     * @todo Finish implementing this, then copy to Webkit
     * 
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columns($cssString = '')
    {
        $length = $this->lengthRegex();

        $search    = '/(\s*)(?<!-)columns:(\s*)(auto|' . $length . ');?/';
        $replace   = '${1}-moz-column:${2}${3};${1}'
                   . 'columns:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columns
} //end class Browser_Mozilla