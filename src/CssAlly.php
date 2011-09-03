<?php
/**
 * @author Bill
 */
class CssAlly {
    private $_browsers = array(
        'explorer'  => true,
        'konqueror' => false,
        'mozilla'   => true,
        'opera'     => true,
        'webkit'    => true,
    );
    
    public function __construct()
    {
        
    } //end __construct
    
    public function prefix()
    {
    } //end prefix

    public function getBrowser($browser)
    {
    } //end getBrowser
    
    public function setBrowser($browser, $generate)
    {
    } //end setBrowser
    
    public function setBrowsers(array $browsers)
    {
    } //end setBrowsers
    
    public function borderRadius($cssString = '')
    {
        
    } //end borderRadius
} //end class CssAlly