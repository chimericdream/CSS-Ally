<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Mozilla
 *
 * @author Bill
 */
class Browser_Mozilla implements Browser {
    public $targetVersion;

    public function borderRadius($cssString = '')
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
} //end class Browser_Mozilla