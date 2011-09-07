<?php
require_once dirname(__FILE__) . '/Browser.php';

/**
 * @author Bill
 */
class CssAlly {
    public $_browsers = array(
        'explorer'  => true,
        'konqueror' => null,
        'mozilla'   => true,
        'opera'     => true,
        'webkit'    => true,
    );

    public $_options = array();

    private $_defaultOptions = array(
        'compress' => true,
        'minify'   => true,
        'gzip'     => true,
        'cssDir'   => null,
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

        if (empty($options)) {
            $this->_options = $this->_defaultOptions;
        } else {
            $this->_options = $options;
        }

        if (is_null($this->_options['cssDir'])) {
            //@todo: throw exception
        }

        $this->_loadBrowsers($this->_browsers);
    } //end __construct

    public function run()
    {

    } //end run

    public function addCssFile($filePath)
    {
        include_once $this->_options['cssDir'] . "/{$filePath}";
    } //end addCssFile

    public function addCssFiles(array $filePaths)
    {
        foreach ($filePaths as $file) {
            $this->addCssFile($file);
        }
    } //end addCssFiles

    private function _loadBrowsers(array $browsers)
    {
        foreach ($browsers as $name => $value) {
            if ($value) {
                $className = 'Browser_' . ucfirst($name);
                $this->_browsers[$name] = new $className;
            } else {
                $this->_browsers[$name] = null;
            }
        }
    } //end _loadBrowsers

    public function getBrowser($browser)
    {
        return (isset($this->_browsers[$browser])) ? $this->_browsers[$browser] : null;
    } //end getBrowser

    public function setBrowser($browser, $useBrowserRules)
    {
        if (!$useBrowserRules) {
            $this->_browsers[$browser] = null;
            return;
        }

        $className = 'Browser_' . ucfirst($browser);
        if ($this->_browsers[$browser] instanceof $className) {
            return;
        }

        $this->_browsers[$browser] = new $className;
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