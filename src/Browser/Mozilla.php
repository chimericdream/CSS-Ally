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
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animation($cssString = '')
    {
        $name  = $this->identRegex();
        $dur   = $this->timeRegex();
        $func  = $this->timingFuncRegex();
        $delay = $this->timeRegex();
        $count = '(?:infinite|' . $this->numberRegex() . ')';
        $dir   = '(?:normal|alternate)';

        $anim = '(?:'
                . $name . '(?:\s+' . $dur . ')?(?:\s+' . $func . ')?(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+' . $dir . ')?'
              . '|'
                . '(?:' . $name . '\s+)?' . $dur . '(?:\s+' . $func . ')?(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+' . $dir . ')?'
              . '|'
                . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?' . $func . '(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+' . $dir . ')?'
              . '|'
                . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func . '\s+)?' . $delay . '(?:\s+' . $count . ')?(?:\s+' . $dir . ')?'
              . '|'
                . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func . '\s+)?(?:' . $delay . '\s+)?' . $count . '(?:\s+' . $dir . ')?'
              . '|'
                . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func . '\s+)?(?:' . $delay . '\s+)?(?:' . $count . '\s+)?' . $dir
              . ')';

        $search    = '/(\s*)(?<!-)(animation:\s*)(' . $anim . '(?:,\s*' . $anim . ')*);?/';
        $replace   = '${1}-moz-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animation

    /**
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationDelay($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<!-)animation-delay:(\s*)(' . $time . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-moz-animation-delay:${2}${3};${1}'
                   . 'animation-delay:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationDelay

    /**
     * Syntax:
     * animation-direction: normal|alternate [, normal|alternate]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationDirection($cssString = '')
    {
        $dir       = '(?:normal|alternate)';

        $search    = '/(\s*)(?<!-)animation-direction:(\s*)(' . $dir . '(?:,\s*' . $dir . ')*);?/';
        $replace   = '${1}-moz-animation-direction:${2}${3};${1}'
                   . 'animation-direction:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationDirection

    /**
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationDuration($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<!-)animation-duration:(\s*)(' . $time . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-moz-animation-duration:${2}${3};${1}'
                   . 'animation-duration:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationDuration

    /**
     * Syntax:
     * animation-iteration-count: infinite|<number> [, infinite|<number>]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationIterationCount($cssString = '')
    {
        $number    = $this->numberRegex();
        $count     = '(?:infinite|' . $number . ')';

        $search    = '/(\s*)(?<!-)animation-iteration-count:(\s*)(' . $count . '(?:,\s*' . $count . ')*);?/';
        $replace   = '${1}-moz-animation-iteration-count:${2}${3};${1}'
                   . 'animation-iteration-count:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationIterationCount

    /**
     * Syntax:
     * @keyframes <identifier> {
     *     [ [from|to|<percentage>] [, [from|to|<percentage>]]* block ]*
     * }
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationKeyframes($cssString = '')
    {
        $ident = $this->identRegex();
        $pct   = $this->percentRegex();
        $point = '(?:(?:from|to|' . $pct . ')(?:,\s*(?:from|to|' . $pct . '))*)';
        $block = '(?:\{[^\}]*\})';

        $rules = '(?:\s*' . $point . '\s*' . $block . '\s*)*';

        $search    = '/(\s*)\@(?<!-)(keyframes\s+' . $ident . '\s*\{' . $rules . '\})/';
        $replace   = '${1}@-moz-${2}' . "\n" . '${1}@${2}';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationKeyframes

    /**
     * Syntax:
     * animation-name: none|<name> [, none|<name>]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationName($cssString = '')
    {
        $name = $this->identRegex();

        $search    = '/(\s*)(?<!-)animation-name:(\s*)(' . $name . '(?:,\s*' . $name . ')*);?/';
        $replace   = '${1}-moz-animation-name:${2}${3};${1}'
                   . 'animation-name:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationName

    /**
     * Syntax:
     * animation-play-state: running|paused [, running|paused]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationPlayState($cssString = '')
    {
        $state     = '(?:running|paused)';

        $search    = '/(\s*)(?<!-)animation-play-state:(\s*)(' . $state . '(?:,\s*' . $state . ')*);?/';
        $replace   = '${1}-moz-animation-play-state:${2}${3};${1}'
                   . 'animation-play-state:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationPlayState

    /**
     * Syntax:
     * animation-timing-function: <timing-function> [, <timing-function>]*
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationTimingFunction($cssString = '')
    {
        $func = $this->timingFuncRegex();

        $search    = '/(\s*)(?<!-)animation-timing-function:(\s*)(' . $func . '(?:,\s*' . $func . ')*);?/';

        $replace   = '${1}-moz-animation-timing-function:${2}${3};${1}'
                   . 'animation-timing-function:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationTimingFunction

    /**
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function backgroundClip($cssString = '')
    {
        $rule = '(?:(?:padding|border|content)-box)';

        $search    = '/(\s*)(?<!-)background-clip:(\s*)(' . $rule . '(?:,\s*' . $rule . ')*);?/';
        $replace   = '${1}-moz-background-clip:${2}${3};${1}'
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
        $replace   = '${1}-moz-background-origin:${2}${3};${1}'
                   . 'background-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end backgroundOrigin

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
     * Syntax:
     * border-image: none | [<image> [<number>|<percentage>]{1,4} [/<border-width>{1,4}]?] && [stretch|repeat|round]{0,2}
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function borderImage($cssString = '')
    {
        $img = $this->uriRegex();
        $num = $this->numberRegex();
        $pct = $this->percentRegex();
        $bwd = $this->borderWidthRegex();

        $search = '(none|(?:' . $img . '(?:\s+(?:' . $pct . '|' . $num . ')){1,4}(?:\s*\/\s*(?:' . $bwd . ')(?:(?:\s+' . $bwd . '){1,3})?)?(?:\s+(?:stretch|repeat|round)){0,2}))';

        $search    = '/(\s*)(?<!-)(border-image:(?:\s*))' . $search . ';?/';
        $replace   = '${1}-moz-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end borderImage

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

        foreach ($properties as $mozilla) {
            $search    = "/(\s*)(?<!-)columns:{$mozilla['value']}/";
            $rep       = '${1}' . "-moz-columns:{$mozilla['replace']};"
                       . '${1}' . "columns:{$mozilla['replace']};";

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
        $position = '(?:(?:(?:' . $point . '|' . $angle . ')|' . $point . '\s+' . $angle . '),\s*)?';
        $linear   = '(?<!-)(?:repeating-)?linear-gradient\(' . $position . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<!-)background:\s*(?:' . $color . '\s+)?)(' . $linear . ')([^;\r\n]*);?';
        $bgrep    = '${1}-moz-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $linear . ');?';
        $bgimgrep = '${1}${2}-moz-${3};${1}${2}${3};';

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
        $bgrep    = '${1}-moz-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<!-)background-image:)(\s*)(' . $radial . ')([^;\r\n]*);?';
        $bgimgrep = '${1}${2}-moz-${3}${20};${1}${2}${3}${20};';

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
     * Add Mozilla rules for transform
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

        $replace = '${1}-moz-transform:${2};${1}'
                . 'transform:${2};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transform

    /**
     * Add Mozilla rules for transform-origin
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

        $replace   = '${1}-moz-transform-origin:${2}${3};${1}'
                   . 'transform-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transformOrigin

    /**
     * Add Mozilla rules for transition
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transition($cssString = '')
    {
        $prop = $this->animatablePropertyRegex();
        $dur   = $this->timeRegex();
        $func  = $this->timingFuncRegex();
        $delay = $this->timeRegex();

        $trans = '(?:'
                . $prop . '(?:\s+' . $dur . ')?(?:\s+' . $func . ')?(?:\s+' . $delay . ')?'
              . '|'
                . '(?:' . $prop . '\s+)?' . $dur . '(?:\s+' . $func . ')?(?:\s+' . $delay . ')?'
              . '|'
                . '(?:' . $prop . '\s+)?(?:' . $dur . '\s+)?' . $func . '(?:\s+' . $delay . ')?'
              . '|'
                . '(?:' . $prop . '\s+)?(?:' . $dur . '\s+)?(?:' . $func . '\s+)?' . $delay
              . ')';

        $search    = '/(\s*)(?<!-)(transition:\s*)(' . $trans . '(?:,\s*' . $trans . ')*);?/';
        $replace   = '${1}-moz-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transition

    /**
     * Add Mozilla rules for transition-delay
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionDelay($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<!-)transition-delay:(\s*)(' . $time . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-moz-transition-delay:${2}${3};${1}'
                   . 'transition-delay:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionDelay

    /**
     * Add Mozilla rules for transition-duration
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionDuration($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<!-)transition-duration:(\s*)(' . $time . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-moz-transition-duration:${2}${3};${1}'
                   . 'transition-duration:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionDuration

    /**
     * Add Mozilla rules for transition-property
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionProperty($cssString = '')
    {
        $property = $this->animatablePropertyRegex();

        $search    = '/(\s*)(?<!-)transition-property:(\s*)(none|all|' . $property . '(?:,\s*' . $property . ')*);?/';
        $replace   = '${1}-moz-transition-property:${2}${3};${1}'
                   . 'transition-property:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionProprty

    /**
     * Add Mozilla rules for transition-timing-function
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionTimingFunction($cssString = '')
    {
        $num  = $this->numberRegex();
        $func = '(?:ease-in-out|linear|ease-in|ease-out|ease|cubic-bezier\(' . $num . ',\s*' . $num . ',\s*' . $num . ',\s*' . $num . '\))';

        $search    = '/(\s*)(?<!-)transition-timing-function:(\s*)(' . $func . '(?:,\s*' . $func . ')*);?/';

        $replace   = '${1}-moz-transition-timing-function:${2}${3};${1}'
                   . 'transition-timing-function:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionTimingFunction
} //end class Browser_Mozilla