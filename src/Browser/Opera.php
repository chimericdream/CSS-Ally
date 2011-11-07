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
 * Opera CSS rules
 *
 * This class contains all of the Opera-prefixed versions of CSS rules.
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
class Browser_Opera extends Browser
{
    /**
     * Add Opera rules for background-size
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
                'prefix' => '-o-background-size',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $opera) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$opera['prefix']}:{$opera['format']};"
                       . '${1}' . "{$standard}:{$replace};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end backgroundSize

    /**
     * Add Opera rules for border-radius
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
                'prefix' => '-o-border-radius',
            ),
            'border-top-right-radius'    => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-top-right-radius',
            ),
            'border-top-left-radius'     => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-top-left-radius',
            ),
            'border-bottom-right-radius' => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-bottom-right-radius',
            ),
            'border-bottom-left-radius'  => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-bottom-left-radius',
            ),
        );

        foreach ($properties as $standard => $opera) {
            $search = "/(\s*)(?<!-){$standard}:{$opera['value']}/";
            $rep = '${1}' . "{$opera['prefix']}:{$opera['replace']};"
                 . '${1}' . "{$standard}:{$opera['replace']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end border_radius

    public function linearGradient($cssString = '')
    {
        $point    = $this->bgPosRegex();
        $angle    = $this->angleRegex();
        $color    = $this->colorRegex();
        $length   = $this->lengthRegex();
        $percent  = $this->percentRegex();
        $stop     = '(?:' . $color . '(?:\s+(?:' . $percent . '|' . $length . '))?)';
        $linear   = '(?<!-)(?:repeating-)?linear-gradient\((?:(?:(?:' . $point . '|' . $angle . ')|' . $point . '\s+' . $angle . '),\s*)?' . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<!-)background:\s*(?:' . $color . '\s+)?)(' . $linear . ')([^;\r\n]*);?';
        $bgrep    = '${1}-o-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $linear . ');?';
        $bgimgrep = '${1}${2}-o-${3};${1}${2}${3};';

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
        $radial   = '(?<!-)(?:repeating-)?radial-gradient\(' . $position . '(?:(?:(?:' . $shape . '|' . $size . ')|' . $shape . '\s+' . $size . '|(?:' . $length . '|' . $percent . '){2}),\s*)?' . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<!-)background:\s*(?:' . $color . '\s+)?)(' . $radial . ')([^;\r\n]*);?';
        $bgrep    = '${1}-o-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $radial . ')([^;\r\n]*);?';
        $bgimgrep = '${1}${2}-o-${3}${20};${1}${2}${3}${20};';

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
     * Add Opera rules for transform
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
        
        $replace = '${1}-o-transform:${2};${1}'
                . 'transform:${2};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transform

    /**
     * Add Opera rules for transform-origin
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
        
        $replace   = '${1}-o-transform-origin:${2}${3};${1}'
                   . 'transform-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transformOrigin

    /**
     * Add Opera rules for transition-property
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionProperty($cssString = '')
    {
        $property = $this->animatablePropertyRegex();
        
        $search    = '/(\s*)(?<!-)transition-property:(\s*)(none|all|' . $property . '(?:,\s*' . $property . ')*);?/';
        $replace   = '${1}-o-transition-property:${2}${3};${1}'
                   . 'transition-property:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionProprty
} //end class Browser_Opera