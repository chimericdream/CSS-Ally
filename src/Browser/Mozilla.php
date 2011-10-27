<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Mozilla
 *
 * @author Bill
 */
class Browser_Mozilla extends Browser {
    public $targetVersion;

    public function border_radius($cssString = '')
    {
        $length     = $this->length_regex();
        $shorthand  = array(
            'value'   => '(\s*)((\s*' . $length . '){1,4}(\s*\/\s*(\s*' . $length . '){1,4})?);?',
            'replace' => '${2}${3}',
        );
        $longhand   = array(
            'value'   => '(\s*)(' . $length . '(\s\s*' . $length . ')?);?',
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
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['replace']};" . '${1}' . "{$standard}:{$mozilla['replace']};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end borderRadius

    public function box_shadow($cssString = '') {
        $color      = $this->color_regex();
        $length     = $this->length_regex();
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
            $rep       = '${1}' . "{$mozilla['prefix']}:{$mozilla['format']};" . '${1}' . "{$standard}:{$replace};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    }
} //end class Browser_Mozilla