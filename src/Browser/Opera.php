<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Opera
 *
 * @author Bill
 */
class Browser_Opera extends Browser {
    public function background_size($cssString = '')
    {
        $length     = $this->length_regex();
        $percent    = $this->percent_regex();
        $bgsize     = '((\s*(' . $length . '|' . $percent . '|auto)){1,2}|\s*cover|\s*contain)';
        $value      = '(\s*)(' . $bgsize . '(,\s*' . $bgsize . ')*);?';
        $replace    = '${2}${3}';
        $properties = array(
            'background-size' => array(
                'prefix' => '-o-background-size',
                'format' => '${2}${3}',
            ),
        );

        foreach ($properties as $standard => $opera) {
            $search    = "/(\s*)(?<!-){$standard}:{$value}/";
            $rep       = '${1}' . "{$opera['prefix']}:{$opera['format']};" . '${1}' . "{$standard}:{$replace};";

            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end background_size

    public function border_radius($cssString = '')
    {
        $length     = $this->length_regex();
        $percent    = $this->percent_regex();
        $shorthand  = array(
            'value'   => '(\s*)((\s*(' . $length . '|' . $percent . ')){1,4}(\s*\/\s*(\s*(' . $length . '|' . $percent . ')){1,4})?);?',
            'replace' => '${2}${3}',
        );
        $longhand   = array(
            'value'   => '(\s*)((' . $length . '|' . $percent . ')(\s\s*(' . $length . '|' . $percent . '))?);?',
            'replace' => '${2}${3}',
        );

        $properties = array(
            'border-radius'              => array(
                'value'   => $shorthand['value'],
                'replace' => $shorthand['replace'],
                'prefix' => '-o-border-radius',
            ),
            'border-top-right-radius'    => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-top-right-radius',
            ),
            'border-top-left-radius'     => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-top-left-radius',
            ),
            'border-bottom-right-radius' => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-bottom-right-radius',
            ),
            'border-bottom-left-radius'  => array(
                'value'   => $longhand['value'],
                'replace' => $longhand['replace'],
                'prefix' => '-o-border-bottom-left-radius',
            ),
        );

        foreach ($properties as $standard => $opera) {
            $search    = "/(\s*)(?<!-){$standard}:{$opera['value']}/";
            $rep       = '${1}' . "{$opera['prefix']}:{$opera['replace']};" . '${1}' . "{$standard}:{$opera['replace']};";
            $cssString = preg_replace($search, $rep, $cssString);
        }

        return $cssString;
    } //end border_radius
} //end class Browser_Opera