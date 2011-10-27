<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Webkit
 *
 * @author Bill
 */
class Browser_Webkit extends Browser {
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
                'prefix' => '-webkit-border-radius',
            ),
            'border-top-right-radius'    => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-top-right-radius',
            ),
            'border-top-left-radius'     => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-top-left-radius',
            ),
            'border-bottom-right-radius' => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-bottom-right-radius',
            ),
            'border-bottom-left-radius'  => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-webkit-border-bottom-left-radius',
            ),
        );
        
        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$webkit['value']}/";
            $rep       = '${1}' . "{$webkit['prefix']}:{$webkit['replace']};" . '${1}' . "{$standard}:{$webkit['replace']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }
        
        return $cssString;
    }

    public function box_shadow($cssString = '') {
        $color      = $this->color_regex();
        $length     = $this->length_regex();
        $shadow     = '(inset)?(\s*' . $length . '){2,4}(\s\s*' . $color . ')?';
        $value      = '(\s*)(none|' . $shadow . '(,\s*' . $shadow . ')*);?';
        $replace    = '${2}${3}';
        $properties = array(
            'box-shadow' => array(
                'prefix' => '-webkit-box-shadow',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $webkit) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$webkit['prefix']}:{$webkit['format']};" . '${1}' . "{$standard}:{$replace};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    }
} //end class Browser_Webkit