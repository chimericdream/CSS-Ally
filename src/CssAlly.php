<?php
require_once dirname(__FILE__) . '/Browser.php';

/**
 * @author Bill
 */
class CssAlly {
    public $_browsers = array(
        'explorer'  => true,
        'konqueror' => false,
        'mozilla'   => true,
        'opera'     => true,
        'webkit'    => true,
    );

    public function __construct(array $browsers = array(), array $options = array())
    {
        if (!empty($browsers)) {
            $this->_browsers['explorer']  = (isset($browsers['explorer']))  ? $browsers['explorer']  : $this->_browsers['explorer'];
            $this->_browsers['konqueror'] = (isset($browsers['konqueror'])) ? $browsers['konqueror'] : $this->_browsers['konqueror'];
            $this->_browsers['mozilla']   = (isset($browsers['mozilla']))   ? $browsers['mozilla']   : $this->_browsers['mozilla'];
            $this->_browsers['opera']     = (isset($browsers['opera']))     ? $browsers['opera']     : $this->_browsers['opera'];
            $this->_browsers['webkit']    = (isset($browsers['webkit']))    ? $browsers['webkit']    : $this->_browsers['webkit'];
        }
    } //end __construct

    public function prefix()
    {
    } //end prefix

    public function getBrowser($browser)
    {
        return (isset($this->_browsers[$browser])) ? $this->_browsers[$browser] : false;
    } //end getBrowser

    public function setBrowser($browser, $useBrowserRules)
    {
        $this->_browsers[$browser] = $useBrowserRules;
    } //end setBrowser

    public function setBrowsers(array $browsers)
    {
        foreach ($browsers as $browser => $useBrowserRules) {
            $this->setBrowser($browser, $useBrowserRules);
        }
    } //end setBrowsers

    public function borderRadius($cssString = '')
    {
    } //end borderRadius
} //end class CssAlly