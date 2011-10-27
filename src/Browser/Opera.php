<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Opera
 *
 * @author Bill
 */
class Browser_Opera extends Browser {
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
                'prefix' => '-o-border-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-top-right-radius'    => array(
                'prefix' => '-o-border-top-right-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-top-left-radius'     => array(
                'prefix' => '-o-border-top-left-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-right-radius' => array(
                'prefix' => '-o-border-bottom-right-radius',
                'format' => '${2}${3}${4}',
            ),
            'border-bottom-left-radius'  => array(
                'prefix' => '-o-border-bottom-left-radius',
                'format' => '${2}${3}${4}',
            ),
        );
        
        foreach ($properties as $standard => $opera) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$standard}:{$replace};" . '${1}' . "{$opera['prefix']}:{$opera['format']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }
        
        return $cssString;
    }
} //end class Browser_Opera