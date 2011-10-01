<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Opera
 *
 * @author Bill
 */
class Browser_Opera implements Browser {
    public $targetVersion;

    public function borderRadius($cssString = '')
    {
        $value      = '(\s*)(\d+\.?\d*)(px|em|%);?';
        $replace    = '${1}${2}${3}';
        $properties = array(
            'border-radius'              => array(
                'prefix' => '-o-border-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-o-border-top-right-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-o-border-top-left-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-o-border-bottom-right-radius',
                'format' => '${1}${2}${3}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-o-border-bottom-left-radius',
                'format' => '${1}${2}${3}',
            ),
        );
        
        foreach ($properties as $standard => $opera) {
            $cssString = preg_replace("/{$standard}:{$value}/", "{$standard}:{$replace};\n{$opera['prefix']}:{$opera['format']};", $cssString);
        }
        
        return $cssString;
    }
} //end class Browser_Opera