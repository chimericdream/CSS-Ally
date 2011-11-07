<?php
/**
 * CssAlly
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
 * @see Browser_Explorer
 */
require_once dirname(__FILE__) . '/Browser/Explorer.php';
/**
 * @see Browser_Konqueror
 */
require_once dirname(__FILE__) . '/Browser/Konqueror.php';
/**
 * @see Browser_Mozilla
 */
require_once dirname(__FILE__) . '/Browser/Mozilla.php';
/**
 * @see Browser_Opera
 */
require_once dirname(__FILE__) . '/Browser/Opera.php';
/**
 * @see Browser_Webkit
 */
require_once dirname(__FILE__) . '/Browser/Webkit.php';

/**
 * Base class for browser CSS rules
 *
 * This class contains NOP methods for all CSS rules supported by CssAlly. Any
 * browsers which have vendor-prefixed versions of these rules will override
 * the appropriate method(s). For all other rules, this class simply returns the
 * CSS string as it was passed into the method call.
 *
 * In addition, this class holds common regular expressions used in many rules,
 * such as validating a color, length (px, em, etc), or border-type properties.
 *
 * @abstract
 * @category   CssAlly
 * @package    CssAlly
 * @subpackage CssAlly_Browser
 * @author     Bill Parrott <bill@cssally.com>
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       http://cssally.com/
 */
abstract class Browser
{
    public function angleRegex()
    {
        //0-360deg|0-400grad|(num)rad|(num)turn
        $angle = '(?:\-?(?:' . $this->n0360Regex() . 'deg|'
               . $this->n0400Regex() . 'grad|' . $this->numberRegex() . 'rad|'
               . $this->numberRegex() . 'turn|0))';

        return $angle;
    } //end angleRegex

    public function bgPosRegex()
    {
        $pos = '(?:(?:(?:' . $this->percentRegex() . '|' . $this->lengthRegex()
             . '|left|center|right)(?:\s+(' . $this->percentRegex() . '|'
             . $this->lengthRegex() . '|top|center|bottom))?)|(?:(?:'
             . $this->percentRegex() . '|' . $this->lengthRegex()
             . '|top|center|bottom)(?:\s+(' . $this->percentRegex() . '|'
             . $this->lengthRegex() . '|left|center|right))?)|(?:'
             . '(?:left|center|right)|(?:top|center|bottom))|inherit)';

        return $pos;
    } //end bgPosRegex

    /**
     * Generate a string containing a regular expression for valid color choices
     * in CSS
     *
     * @return string
     */
    public function colorRegex()
    {
        $colors = '(?:'
                    . $this->hexRegex() . '\b|'
                    . 'aqua|'
                    . 'black|'
                    . 'blue|'
                    . 'fuchsia|'
                    . 'gray|'
                    . 'green|'
                    . 'lime|'
                    . 'maroon|'
                    . 'navy|'
                    . 'olive|'
                    . 'orange|'
                    . 'purple|'
                    . 'red|'
                    . 'silver|'
                    . 'teal|'
                    . 'white|'
                    . 'yellow|'
                    . 'hsl\('
                        . '\s*' . $this->n0360Regex() . '\s*,'
                        . '\s*' . $this->percentRegex() . '\s*,'
                        . '\s*' . $this->percentRegex() . '\s*'
                        . '\)|'
                    . 'hsla\('
                        . '\s*' . $this->n0360Regex() . '\s*,'
                        . '\s*' . $this->percentRegex() . '\s*,'
                        . '\s*' . $this->percentRegex() . '\s*,'
                        . '\s*' . $this->numberRegex() . '\s*'
                        . '\)|'
                    . 'rgba\(' // Hex value
                        . '\s*' . $this->n0255Regex() . '\s*,'
                        . '\s*' . $this->n0255Regex() . '\s*,'
                        . '\s*' . $this->n0255Regex() . '\s*,'
                        . '\s*' . $this->numberRegex() . '\s*'
                        . '\)|'
                    . 'rgba\(' // Percentage
                        . '\s*(\d{1,2}%|100%)\s*,'
                        . '\s*(\d{1,2}%|100%)\s*,'
                        . '\s*(\d{1,2}%|100%)\s*,'
                        . '\s*' . $this->numberRegex() . '\s*'
                        . '\)|'
                    . 'rgb\(' // Hex value
                        . '\s*' . $this->n0255Regex() . '\s*,'
                        . '\s*' . $this->n0255Regex() . '\s*,'
                        . '\s*' . $this->n0255Regex() . '\s*'
                        . '\)|'
                    . 'rgb\(' // Percentage
                        . '\s*(\d{1,2}%|100%)\s*,'
                        . '\s*(\d{1,2}%|100%)\s*,'
                        . '\s*(\d{1,2}%|100%)\s*'
                        . '\)'
                . ')';

        return $colors;
    } //end colorRegex

    public function hexRegex()
    {
        $hex = '(?:#(?:[0-9A-Fa-f]{3}|[0-9A-Fa-f]{6}))';

        return $hex;
    } //end hexRegex

    /**
     * Generate a string containing a regular expression for valid length values
     * in CSS
     *
     * @return string
     */
    public function lengthRegex()
    {
        $length = '(?:' . $this->numberRegex() . '(?:em|ex|in|cm|mm|pt|pc|px))';

        return $length;
    } //end lengthRegex

    public function n0255Regex()
    {
        $num = '(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])';

        return $num;
    } //end n0255Regex

    public function n0360Regex()
    {
        $num = '(?:[0-9]|[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|360)';

        return $num;
    } //end n0360Regex

    public function n0400Regex()
    {
        $num = '(?:[0-9]|[1-9][0-9]|[1-3][0-9][0-9]|400)';

        return $num;
    } //end n0400Regex

    public function numberRegex()
    {
        $num = '(?:(?:\+|\-)?\d+\.?\d*)';

        return $num;
    } //end numberRegex

    /**
     * Generate a string containing a regular expression for valid percentages
     *
     * @return string
     */
    public function percentRegex()
    {
        $percent = '(?:' . $this->numberRegex() . '%)';

        return $percent;
    } //end percentRegex

    public function propertyRegex()
    {
        $property = '(?:[-a-zA-Z]+)';
        
        return $property;
    } //end propertyRegex
    
    /**
     * Generate a string containing a regular expression for valid border-style
     * values in CSS
     *
     * @return string
     */
    public function borderStyleRegex()
    {
        $border = '(?:none|hidden|dotted|dashed|solid|'
                . 'double|groove|ridge|inset|outset)';

        return $border;
    } //end borderStyleRegex

    /**
     * Generate a string containing a regular expression for valid border-width
     * values in CSS
     *
     * @return string
     */
    public function borderWidthRegex()
    {
        $border = '(?:thin|medium|thin|' . $this->lengthRegex() . ')';

        return $border;
    } //end borderWidthRegex

    /**
     * Syntax:
     * background-size: <bg-size> [, <bg-size>]*
     *
     * <bg-size> = [<length>|<percentage>|auto]{1,2} | cover | contain
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function backgroundSize($cssString = '')
    {
        return $cssString;
    } //end backgroundSize

    /**
     * Syntax:
     * border-*-*-radius: [<length>|<%>] [<length>|<%>]?
     * border-radius: [<length>|<percentage>]{1,4} ...
     *                [ / [<length>|<percentage>]{1,4}]?
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function borderRadius($cssString = '')
    {
        return $cssString;
    } //end borderRadius

    /**
     * Syntax:
     * box-shadow: none | <shadow> [, <shadow>]*
     *
     * <shadow> = inset? && [<length>{2,4} && <color>?]
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function boxShadow($cssString = '')
    {
        return $cssString;
    } //end boxShadow

    /**
     * Syntax:
     * column-count: <integer> | auto
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnCount($cssString = '')
    {
        return $cssString;
    } //end columnCount

    /**
     * Syntax:
     * column-gap: <length> | normal
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnGap($cssString = '')
    {
        return $cssString;
    } //end columnGap

    /**
     * Syntax:
     * column-rule: <column-rule-width> <column-rule-style> ...
     *              [<column-rule-color>|transparent]
     * column-rule-color: [<color>|transparent]
     * column-rule-style: <border-style>
     * column-rule-width: <border-width>
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnRule($cssString = '')
    {
        return $cssString;
    } //end columnRule

    /**
     * Syntax:
     * column-span: none | all
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnSpan($cssString = '')
    {
        return $cssString;
    } //end columnSpan

    /**
     * Syntax:
     * column-width: <length> | auto
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columnWidth($cssString = '')
    {
        return $cssString;
    } //end columnWidth

    /**
     * Syntax:
     * columns: <column-width> | <column-count>
     *
     * <column-width> = <length> | auto
     * <column-count> = <integer> | auto
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function columns($cssString = '')
    {
        return $cssString;
    } //end columns

    /**
     * Syntax:
     * linear-gradient([<point> || <angle>,]? <stop>, <stop> [,<stop>]*)
     *
     * <point> = <background-position>
     * <stop> = <color> [<percentage>|<length>]?
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function linearGradient($cssString = '')
    {
        return $cssString;
    } //end linearGradient

    /**
     * Syntax:
     * radial-gradient([<position>,]? [[[<shape> || <size>]|[<length> | <percentage>]{2}],]? <color-stop>[, <color-stop>]+)
     *
     * <position> = <background-position>
     * <shape> = circle | ellipse
     * <size> = closest-side | farthest-side | closest-corner | farthest-corner | contain | cover
     * <color-stop> = <color> [<percentage>|<length>]?
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function radialGradient($cssString = '')
    {
        return $cssString;
    } //end radialGradient

    /**
     * Syntax:
     * transform: none | <transform-function> [<transform-function>]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transform($cssString = '')
    {
        return $cssString;
    } //end transform

    /**
     * Syntax:
     * transform-origin: [[<percentage>|<length>|left|center|right] ...
     *                       [<percentage>|<length>|top|center|bottom ]?]
     *                   |
     *                   [[left|center|right] || [top|center|bottom]]
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transformOrigin($cssString = '')
    {
        return $cssString;
    } //end transformOrigin

    /**
     * Syntax:
     * transition-property: none | all | [ <IDENT> ] [ ‘,’ <IDENT> ]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionProperty($cssString = '')
    {
        return $cssString;
    } //end transitionProprty
} //end abstract class Browser