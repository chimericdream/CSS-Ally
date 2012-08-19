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
    /**
     * Add Explorer rules for animation
     *
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
                    . $name . '(?:\s+' . $dur . ')?(?:\s+' . $func
                    . ')?(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+'
                    . $dir . ')?'
              . '|'
                    . '(?:' . $name . '\s+)?' . $dur . '(?:\s+' . $func
                    . ')?(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+'
                    . $dir . ')?'
              . '|'
                    . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?' . $func
                    . '(?:\s+' . $delay . ')?(?:\s+' . $count . ')?(?:\s+'
                    . $dir . ')?'
              . '|'
                    . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func
                    . '\s+)?' . $delay . '(?:\s+' . $count . ')?(?:\s+'
                    . $dir . ')?'
              . '|'
                    . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func
                    . '\s+)?(?:' . $delay . '\s+)?' . $count . '(?:\s+'
                    . $dir . ')?'
              . '|'
                    . '(?:' . $name . '\s+)?(?:' . $dur . '\s+)?(?:' . $func
                    . '\s+)?(?:' . $delay . '\s+)?(?:' . $count . '\s+)?'
                    . $dir
              . ')';

        $search    = '/(\s*)(?<![-$])(animation:\s*)(' . $anim . '(?:,\s*' . $anim
                   . ')*);?/';
        $replace   = '${1}-ms-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animation

    /**
     * Add Explorer rules for amination-delay
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationDelay($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<![-$])animation-delay:(\s*)(' . $time . '(?:,\s*'
                   . $time . ')*);?/';
        $replace   = '${1}-ms-animation-delay:${2}${3};${1}'
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

        $search    = '/(\s*)(?<![-$])animation-direction:(\s*)(' . $dir
                   . '(?:,\s*' . $dir . ')*);?/';
        $replace   = '${1}-ms-animation-direction:${2}${3};${1}'
                   . 'animation-direction:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationDirection

    /**
     * Add Explorer rules for animation-duration
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function animationDuration($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<![-$])animation-duration:(\s*)(' . $time
                   . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-ms-animation-duration:${2}${3};${1}'
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

        $search    = '/(\s*)(?<![-$])animation-iteration-count:(\s*)(' . $count
                   . '(?:,\s*' . $count . ')*);?/';
        $replace   = '${1}-ms-animation-iteration-count:${2}${3};${1}'
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
        $point = '(?:(?:from|to|' . $pct . ')(?:,\s*(?:from|to|' . $pct
               . '))*)';
        $block = '(?:\{[^\}]*\})';

        $rules = '(?:\s*' . $point . '\s*' . $block . '\s*)*';

        $search    = '/(\s*)\@(?<![-$])(keyframes\s+' . $ident . '\s*\{' . $rules
                   . '\})/';
        $replace   = '${1}@-ms-${2}' . "\n" . '${1}@${2}';
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

        $search    = '/(\s*)(?<![-$])animation-name:(\s*)(' . $name . '(?:,\s*'
                   . $name . ')*);?/';
        $replace   = '${1}-ms-animation-name:${2}${3};${1}'
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

        $search    = '/(\s*)(?<![-$])animation-play-state:(\s*)(' . $state
                   . '(?:,\s*' . $state . ')*);?/';
        $replace   = '${1}-ms-animation-play-state:${2}${3};${1}'
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

        $search    = '/(\s*)(?<![-$])animation-timing-function:(\s*)(' . $func
                   . '(?:,\s*' . $func . ')*);?/';

        $replace   = '${1}-ms-animation-timing-function:${2}${3};${1}'
                   . 'animation-timing-function:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end animationTimingFunction

    /**
     * Syntax:
     * border-image: none | [<image> [<number>|<percentage>]{1,4} ...
     *      [/<border-width>{1,4}]?] && [stretch|repeat|round]{0,2}
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

        $search = '(none|(?:' . $img . '(?:\s+(?:' . $pct . '|' . $num
                . ')){1,4}(?:\s*\/\s*(?:' . $bwd . ')(?:(?:\s+' . $bwd
                . '){1,3})?)?(?:\s+(?:stretch|repeat|round)){0,2}))';

        $search    = '/(\s*)(?<![-$])(border-image:(?:\s*))' . $search . ';?/';
        $replace   = '${1}-ms-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end borderImage

    public function linearGradient($cssString = '')
    {
        $point    = $this->bgPosRegex();
        $angle    = $this->angleRegex();
        $color    = $this->colorRegex();
        $length   = $this->lengthRegex();
        $percent  = $this->percentRegex();
        $stop     = '(?:' . $color . '(?:\s+(?:' . $percent . '|'
                  . $length . '))?)';
        $linear   = '(?<![-$])(?:repeating-)?linear-gradient\((?:(?:(?:'
                  . $point . '|' . $angle . ')|' . $point . '\s+' . $angle
                  . '),\s*)?' . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<![-$])background:\s*(?:' . $color . '\s+)?)('
                  . $linear . ')([^;\r\n]*);?';
        $bgrep    = '${1}-ms-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<![-$])background-image:)(\s*)(' . $linear . ');?';
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
        $stop     = '(?:' . $color . '(?:\s+(?:' . $percent . '|'
                  . $length . '))?)';
        $position = '(?:(?:(?:' . $point . '|' . $angle . ')|'
                  . $point . '\s+' . $angle . '),\s*)?';
        $shape    = '(?:circle|ellipse)';
        $size     = '(?:closest-side|closest-corner|farthest-side|'
                  . 'farthest-corner|contain|cover)';
        $radial   = '(?<![-$])(?:repeating-)?radial-gradient\(' . $position
                  . '(?:(?:(?:' . $shape . '|' . $size . ')|' . $shape . '\s+'
                  . $size . '|(?:' . $length . '|' . $percent . '){2}),\s*)?'
                  . $stop . '(?:,\s*' . $stop . ')+\)';
        $bg       = '(\s*(?<![-$])background:\s*(?:' . $color . '\s+)?)('
                  . $radial . ')([^;\r\n]*);?';
        $bgrep    = '${1}-ms-${8}${25};${1}${8}${25};';
        $bgimg    = '(\s*(?<![-$])background-image:)(\s*)(' . $radial
                  . ')([^;\r\n]*);?';
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

        $search = '/(\s*)(?<![-$])transform:((\s*)(' . $functions . ')(?:\s+('
                . $functions . '))*);?/';

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

        $search    = '/(\s*)(?<![-$])transform-origin:(\s*)(((0|' . $percent . '|'
                   . $length . '|left|center|right)(\s+(0|' . $percent . '|'
                   . $length . '|top|center|bottom))?|((left|center|right)'
                   . '(\s+(top|center|bottom))?|((left|center|right)\s+)?'
                   . '(top|center|bottom))));?/';

        $replace   = '${1}-ms-transform-origin:${2}${3};${1}'
                   . 'transform-origin:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transformOrigin

    /**
     * Add Webkit rules for transition
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
                    . $prop . '(?:\s+' . $dur . ')?(?:\s+' . $func
                    . ')?(?:\s+' . $delay . ')?'
               . '|'
                    . '(?:' . $prop . '\s+)?' . $dur . '(?:\s+' . $func
                    . ')?(?:\s+' . $delay . ')?'
               . '|'
                    . '(?:' . $prop . '\s+)?(?:' . $dur . '\s+)?' . $func
                    . '(?:\s+' . $delay . ')?'
               . '|'
                    . '(?:' . $prop . '\s+)?(?:' . $dur . '\s+)?(?:' . $func
                    . '\s+)?' . $delay
               . ')';

        $search    = '/(\s*)(?<![-$])(transition:\s*)(' . $trans
                   . '(?:,\s*' . $trans . ')*);?/';
        $replace   = '${1}-ms-${2}${3};${1}${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transition

    /**
     * Add Explorer rules for transition-delay
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionDelay($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<![-$])transition-delay:(\s*)(' . $time
                   . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-ms-transition-delay:${2}${3};${1}'
                   . 'transition-delay:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionDelay

    /**
     * Add Explorer rules for transition-duration
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionDuration($cssString = '')
    {
        $time = $this->timeRegex();

        $search    = '/(\s*)(?<![-$])transition-duration:(\s*)(' . $time
                   . '(?:,\s*' . $time . ')*);?/';
        $replace   = '${1}-ms-transition-duration:${2}${3};${1}'
                   . 'transition-duration:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionDuration

    /**
     * Add Explorer rules for transition-property
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionProperty($cssString = '')
    {
        $property = $this->animatablePropertyRegex();

        $search    = '/(\s*)(?<![-$])transition-property:(\s*)(none|all|'
                   . $property . '(?:,\s*' . $property . ')*);?/';
        $replace   = '${1}-ms-transition-property:${2}${3};${1}'
                   . 'transition-property:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionProprty

    /**
     * Add Explorer rules for transition-timing-function
     *
     * @param string $cssString The CSS to be parsed
     *
     * @return string The parsed output
     */
    public function transitionTimingFunction($cssString = '')
    {
        $func = $this->timingFuncRegex();

        $search    = '/(\s*)(?<![-$])transition-timing-function:(\s*)('
                   . $func . '(?:,\s*' . $func . ')*);?/';

        $replace   = '${1}-ms-transition-timing-function:${2}${3};${1}'
                   . 'transition-timing-function:${2}${3};';
        $cssString = preg_replace($search, $replace, $cssString);

        return $cssString;
    } //end transitionTimingFunction
} //end class Browser_Explorer