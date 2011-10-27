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
        $replace    = '${2}${3}${4}';
        $properties = array(
            'border-radius'              => array(
                'prefix' => '-webkit-border-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-webkit-border-top-right-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-webkit-border-top-left-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-webkit-border-bottom-right-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-webkit-border-bottom-left-radius',
                'format' => '${2}${3}${4}',
            ),
        );
        
        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$standard}:{$replace};" . '${1}' . "{$webkit['prefix']}:{$webkit['format']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }
        
        return $cssString;
    }
} //end class Browser_Webkit