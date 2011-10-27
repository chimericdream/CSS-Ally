<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Mozilla
 *
 * @author Bill
 */
class Browser_Mozilla extends Browser {
    public $targetVersion;

    /**
     * @todo Rewrite this to incorporate the entire syntax of border-radius
     * @param string $cssString
     * @return string 
     */
    public function border_radius($cssString = '')
    {
        $value      = '(\s*)(\d+\.?\d*)(px|em|%);?';
        $replace    = '${2}${3}${4}';
        $properties = array(
            'border-radius'              => array(
                'prefix' => '-moz-border-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-moz-border-radius-topright',
                'format' => '${2}${3}${4}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-moz-border-radius-topleft',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-moz-border-radius-bottomright',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-moz-border-radius-bottomleft',
                'format' => '${2}${3}${4}',
            ),
        );

        foreach ($properties as $standard => $mozilla) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$standard}:{$replace};" . '${1}' . "{$mozilla['prefix']}:{$mozilla['format']};";
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
            $rep       = '${1}' . "{$standard}:{$replace};" . '${1}' . "{$mozilla['prefix']}:{$mozilla['format']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    }
} //end class Browser_Mozilla