<?php
require_once dirname(__FILE__) . '/../Browser.php';

/**
 * Description of Browser_Explorer
 *
 * @author Bill
 */
class Browser_Explorer implements Browser {
    public $targetVersion;

    /**
     * border-radius is supported in IE9+, but there's no prefix for IE8-
     * @param String $cssString 
     */
    public function borderRadius($cssString = '') {
        return $cssString;
    }
} //end class Browser_Explorer