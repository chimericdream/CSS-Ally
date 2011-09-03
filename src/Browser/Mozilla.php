<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Mozilla
 *
 * @author Bill
 */
class Browser_Mozilla extends Browser {
    public function borderRadius($cssString = '')
    {
        $value      = '(\s*)(\d+\.?\d*)(px|em|%);?';
        $replace    = '${1}${2}${3}';
        $properties = array(
            'border-radius'              => array(
                'prefix' => '-moz-border-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-moz-border-radius-topright',
                'format' => '${1}${2}${3}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-moz-border-radius-topleft',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-moz-border-radius-bottomright',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-moz-border-radius-bottomleft',
                'format' => '${1}${2}${3}',
            ),
        );
        
        foreach ($properties as $standard => $mozilla) {
            $cssString = preg_replace("/{$standard}:{$value}/", "{$standard}:{$replace};\n{$mozilla['prefix']}:{$mozilla['format']};", $cssString);
        }
        
        return $cssString;
    } //end borderRadius
} //end class Browser_Mozilla