<?php
require_once dirname(__FILE__) . '/Browser/Explorer.php';
require_once dirname(__FILE__) . '/Browser/Konqueror.php';
require_once dirname(__FILE__) . '/Browser/Mozilla.php';
require_once dirname(__FILE__) . '/Browser/Opera.php';
require_once dirname(__FILE__) . '/Browser/Webkit.php';

/**
 * Description of Browser
 *
 * @author Bill
 */
interface Browser {
    public function borderRadius($cssString = '');
} //end interface Browser