<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Webkit
 *
 * @author Bill
 */
class Browser_Webkit implements Browser {
    public $targetVersion;

    public function borderRadius($cssString = '')
    {
        $value      = '(\s*)(\d+\.?\d*)(px|em|%);?';
        $replace    = '${1}${2}${3}';
        $properties = array(
            'border-radius'              => array(
                'prefix' => '-webkit-border-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-webkit-border-top-right-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-webkit-border-top-left-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-webkit-border-bottom-right-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-webkit-border-bottom-left-radius',
                'format' => '${1}${2}${3}',
            ),
        );
        
        foreach ($properties as $standard => $webkit) {
            $cssString = preg_replace("/{$standard}:{$value}/", "{$standard}:{$replace};\n{$webkit['prefix']}:{$webkit['format']};", $cssString);
        }
        
        return $cssString;
    }
} //end class Browser_Webkit