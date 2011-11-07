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
 * Webkit CSS rules
 *
 * This class contains all of the Webkit-prefixed versions of CSS rules.
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
class Browser_Webkit extends Browser
{
    /**
     * Add Webkit rules for background-size
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
                'prefix' => '-webkit-background-size',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$webkit['prefix']}:{$webkit['format']};"
                       . '${1}' . "{$standard}:{$replace};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end backgroundSize

    /**
     * Add Webkit rules for border-radius
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
                'prefix' => '-webkit-border-radius',
            ),
            'border-top-right-radius'    => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-top-right-radius',
            ),
            'border-top-left-radius'     => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-top-left-radius',
            ),
            'border-bottom-right-radius' => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-bottom-right-radius',
            ),
            'border-bottom-left-radius'  => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-bottom-left-radius',
            ),
        );

        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$webkit['value']}/";
            $rep       = '${1}' . "{$webkit['prefix']}:{$webkit['replace']};"
                       . '${1}' . "{$standard}:{$webkit['replace']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end borderRadius

    /**
     * Add Webkit rules for box-shadow
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
                'prefix' => '-webkit-box-shadow',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$webkit['prefix']}:{$webkit['format']};"
                       . '${1}' . "{$standard}:{$replace};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end boxShadow

    /**
     * Add Webkit rules for column-count
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnCount($cssString = '')
    {
        $search    = '/(\s*)(?<!-)column-count:(\s*)(auto|\d+);?/';
        $replace   = '${1}-webkit-column-count:${2}${3};${1}'
                   . 'column-count:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnCount

    /**
     * Add Webkit rules for column-gap
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnGap($cssString = '')
    {
        $length    = $this->lengthRegex();
        $search    = '/(\s*)(?<!-)column-gap:(\s*)(normal|' . $length . ');?/';
        $replace   = '${1}-webkit-column-gap:${2}${3};${1}column-gap:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnGap

    /**
     * Add Webkit rules for column-rule
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnRule($cssString = '')
    {
        $width      = $this->borderWidthRegex();
        $style      = $this->borderStyleRegex();
        $color      = $this->colorRegex();

        $properties = array(
            'column-rule'              => array(
                'value'   => '(\s*)((' . $width . ')(\s*)(' . $style . ')'
                          . '(\s*)(' . $color . '|transparent)?);?',
                'replace' => '${2}${3}',
                'prefix'  => '-webkit-column-rule',
            ),
            'column-rule-color'    => array(
                'value'   => '(\s*)(' . $color . '|transparent);?',
                'replace' => '${2}${3}',
                'prefix'  => '-webkit-column-rule-color',
            ),
            'column-rule-style'     => array(
                'value'   => '(\s*)(' . $style . ');?',
                'replace' => '${2}${3}',
                'prefix'  => '-webkit-column-rule-style',
            ),
            'column-rule-width' => array(
                'value'   => '(\s*)(' . $width . ');?',
                'replace' => '${2}${3}',
                'prefix'  => '-webkit-column-rule-width',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search    = "/(\s*)(?<!-){$standard}:{$mozilla['value']}/";
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['replace']};"
                       . '${1}' . "{$standard}:{$mozilla['replace']};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end columnRule

    /**
     * Add Webkit rules for column-span
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnSpan($cssString = '')
    {
        $search    = '/(\s*)(?<!-)column-span:(\s*)(all|none);?/';
        $replace   = '${1}-webkit-column-span:${2}${3};${1}'
                   . 'column-span:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnSpan

    /**
     * Add Webkit rules for column-width
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnWidth($cssString = '')
    {
        $length     = $this->lengthRegex();

        $search    = '/(\s*)(?<!-)column-width:(\s*)(auto|' . $length . ');?/';
        $replace   = '${1}-webkit-column-width:${2}${3};${1}'
                   . 'column-width:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end columnWidth

    /**
     * Add Webkit rules for columns
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columns($cssString = '')
    {
        $length = $this->lengthRegex();

        $properties = array(
            array( // matches "columns: auto;" and "columns: auto auto;"
                'value'   => '((\s*)auto(\s+auto)?)(?! );?',
                'replace' => '${2}',
            ),
            array( // matches "columns: auto 12em;" and "columns: 12em;" and "columns: 12em auto;"
                'value'   => '((\s*)((auto\s+)?' . $length . '|' . $length . '(\s+auto)?))(?! );?',
                'replace' => '${2}',
            ),
            array( // matches "columns: auto 2;" and "columns: 2;" and "columns: 2 auto;"
                'value'   => '((\s*)((auto\s+)?([1-9][0-9]*)|([1-9][0-9]*)(\s+auto)?))(?!( |px|em|\d));?',
                'replace' => '${2}',
            ),
        );

        foreach ($properties as $webkit) {
            $search    = "/(\s*)(?<!-)columns:{$webkit['value']}/";
            $rep       = '${1}' . "-webkit-columns:{$webkit['replace']};"
                       . '${1}' . "columns:{$webkit['replace']};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end columns

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
        $bgrep    = '${1}-webkit-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $linear . ');?';
        $bgimgrep = '${1}${2}-webkit-${3};${1}${2}${3};';

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
        $bgrep    = '${1}-webkit-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $radial . ')([^;\r\n]*);?';
        $bgimgrep = '${1}${2}-webkit-${3}${20};${1}${2}${3}${20};';

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
     * Add Webkit rules for transform
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
        
        $replace = '${1}-webkit-transform:${2};${1}'
                . 'transform:${2};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transform

    /**
     * Add Webkit rules for transform-origin
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
        
        $replace   = '${1}-webkit-transform-origin:${2}${3};${1}'
                   . 'transform-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transformOrigin

    /**
     * Add Webkit rules for transition-property
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionProperty($cssString = '')
    {
        $property = $this->propertyRegex();
        
        $search    = '/(\s*)(?<!-)transition-property:(\s*)(none|all|' . $property . '(?:,\s*' . $property . ')*);?/';
        $replace   = '${1}-webkit-transition-property:${2}${3};${1}'
                   . 'transition-property:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionProprty
} //end class Browser_Webkit