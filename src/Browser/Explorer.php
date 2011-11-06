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
 * Explorer CSS rules
 *
 * This class contains all of the Explorer-prefixed versions of CSS rules.
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
class Browser_Explorer extends Browser
{
    public function linearGradient($cssString = '')
    {
        $point    = $this->bgPosRegex();
        $angle    = $this->angleRegex();
        $color    = $this->colorRegex();
        $length   = $this->lengthRegex();
        $percent  = $this->percentRegex();
        $stop     = '(?:' . $color . '(?:\s+(?:' . $percent . '|' . $length . '))?)';
        $linear   = '(?<!-)linear-gradient\((?:(?:(?:' . $point . '|' . $angle . ')|' . $point . '\s+' . $angle . '),\s*)?' . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<!-)background:\s*(?:' . $color . '\s+)?)(' . $linear . ')([^;\r\n]*);?';
        $bgrep    = '${1}-ms-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $linear . ');?';
        $bgimgrep = '${1}${2}-ms-${3};${1}${2}${3};';

        $properties = array(
            array(
                'value'   => $bg,
                'replace' => $bgrep,
            ),
            array(
                'value'   => $bgimg,
                'replace' => $bgimgrep,
            ),
        );

        foreach ($properties as $mozilla) {
            $search = "/{$mozilla['value']}/";
            $rep    = $mozilla['replace'];

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end linearGradient

    public function radialGradient($cssString = '')
    {
        $point    = $this->bgPosRegex();
        $angle    = $this->angleRegex();
        $color    = $this->colorRegex();
        $length   = $this->lengthRegex();
        $percent  = $this->percentRegex();
        $stop     = '(?:' . $color . '(?:\s+(?:' . $percent . '|' . $length . '))?)';
        $position = '(?:(?:(?:' . $point . '|' . $angle . ')|' . $point . '\s+' . $angle . '),\s*)?';
        $shape    = '(?:circle|ellipse)';
        $size     = '(?:closest-side|closest-corner|farthest-side|farthest-corner|contain|cover)';
        $radial   = '(?<!-)radial-gradient\(' . $position . '(?:(?:(?:' . $shape . '|' . $size . ')|' . $shape . '\s+' . $size . '|(?:' . $length . '|' . $percent . '){2}),\s*)?' . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<!-)background:\s*(?:' . $color . '\s+)?)(' . $radial . ')([^;\r\n]*);?';
        $bgrep    = '${1}-ms-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $radial . ')([^;\r\n]*);?';
        $bgimgrep = '${1}${2}-ms-${3}${20};${1}${2}${3}${20};';

        $properties = array(
            array(
                'value'   => $bg,
                'replace' => $bgrep,
            ),
            array(
                'value'   => $bgimg,
                'replace' => $bgimgrep,
            ),
        );

        foreach ($properties as $prop) {
            $search = "/{$prop['value']}/";
            $rep    = $prop['replace'];

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end radialGradient

    /**
     * Add Explorer rules for transform
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transform($cssString = '')
    {
        $length = $this->lengthRegex();
        $number = $this->numberRegex();
        $angle  = $this->angleRegex();

        $transformFunctions = array(
            'matrix\(' . $number . '(?:,\s*' . $number . '){5}\)',
            'translate\(' . $length . '(?:,\s*' . $length . ')?\)',
            'translateX\(' . $length . '\)',
            'translateY\(' . $length . '\)',
            'scale\(' . $number . '(?:,\s*' . $number . ')?\)',
            'scaleX\(' . $number . '\)',
            'scaleY\(' . $number . '\)',
            'rotate\(' . $angle . '\)',
            'skewX\(' . $angle . '\)',
            'skewY\(' . $angle . '\)',
            'skew\(' . $angle . '(?:,\s*' . $angle . ')?\)',
        );
        
        $functions = implode('|', $transformFunctions);

        $search = '/(\s*)(?<!-)transform:((\s*)(' . $functions . ')(?:\s+(' . $functions . '))*);?/';
        
        $replace = '${1}-ms-transform:${2};${1}'
                . 'transform:${2};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transform

    /**
     * Add Explorer rules for transform-origin
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transformOrigin($cssString = '')
    {
        $length  = $this->lengthRegex();
        $percent = $this->percentRegex();

        $search    = '/(\s*)(?<!-)transform-origin:(\s*)(((0|' . $percent . '|'
                   . $length . '|left|center|right)(\s+(0|' . $percent . '|'
                   . $length . '|top|center|bottom))?|((left|center|right)'
                   . '(\s+(top|center|bottom))?|((left|center|right)\s+)?'
                   . '(top|center|bottom))));?/';
        
        $replace   = '${1}-ms-transform-origin:${2}${3};${1}'
                   . 'transform-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transformOrigin
} //end class Browser_Explorer