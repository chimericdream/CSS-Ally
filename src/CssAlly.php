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

    public $_defaultOptions = array(
        'compress' => true,
        'minify'   => true,
        'gzip'     => true,
        'cssDir'   => null,
    );

    public $_files = array();
    public $_cachefile = '';
    public $_builtCss = '';

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
            $this->_options = array_merge($options, $this->_defaultOptions);
        }

        if (is_null($this->_options['cssDir'])) {
            //@todo: throw exception
        }

        $this->setBrowsers($this->_browsers);
    } //end __construct

    public function run()
    {
        $this->generateFileName();
        if (!$this->checkCache()) {
            $this->buildCssString();
            $this->runCssRules();
            $this->compress();
            $this->writeCache();
        } else {
            $this->getCssFromCache();
        }
        $this->output();
    } //end run

    public function generateFileName()
    {
        $this->_cachefile = md5(implode('', $this->_files)) . '.css';
    } //end _generateFileName

    public function compress()
    {
        if ($this->_options['compress']) {
            /* remove comments */
            $this->_builtCss = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $this->_builtCss);

            /* remove tabs, spaces, newlines, etc. */
            $arr = array("\r\n", "\r", "\n", "\t", "  ", "    ", "    ");
            $this->_builtCss = str_replace($arr, "", $this->_builtCss);

            /* remove extra spaces within property declarations */
            $this->_builtCss = str_replace(', ', ',', $this->_builtCss);
            $this->_builtCss = str_replace(array('; ', ' ;', ' ; '), ';', $this->_builtCss);
            $this->_builtCss = str_replace(array(': ', ' :', ' : '), ':', $this->_builtCss);
            $this->_builtCss = str_replace(array('{ ', ' {', ' { '), '{', $this->_builtCss);
            $this->_builtCss = str_replace(array('} ', ' }', ' } '), '}', $this->_builtCss);
        }
    } //end _compress

    /**
     * Builds CSS string for the cache file
     */
    public function buildCssString()
    {
        foreach ($this->_files as $file) {
            $this->_builtCss .= file_get_contents($file);
        }
    } //end _buildCssString

    public function getCssFromCache()
    {
        $this->_builtCss = file_get_contents($this->_cachefile);
    } //end _getCssFromCache
    
    /**
     * Writes the cache into file
     */
    public function writeCache()
    {
        $f = fopen($this->_cachefile, "w");
        // lock file to prevent problems under high load
        flock($f, LOCK_EX);
        fwrite($f, $this->_builtCss);
        fclose($f);
    } //end _writeCache

    /**
     * Compare the modification time of cache file against the CSS files
     * @return bool
     */
    public function checkCache()
    {
        if(file_exists($this->_cachefile)) {
            $lastModified = 0;
            foreach($this->_files as $file) {
                $cssModified = filemtime($file);
                if($cssModified > $lastModified) {
                    $lastModified = $cssModified;
                }
            }

            if(filemtime($this->_cachefile) >= $lastModified) {
                return true;
            }
        }
        return false;
    } //end _checkCache

    public function output()
    {
        header("Content-type: text/css");
        echo $this->_builtCss;
        exit;
    } //end _output

    public function addCssFile($filePath)
    {
        $this->_files[] = $this->_options['cssDir'] . "/{$filePath}";
    } //end addCssFile

    public function addCssFiles(array $filePaths)
    {
        foreach ($filePaths as $file) {
            $this->addCssFile($file);
        }
    } //end addCssFiles

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

    public function runCssRules()
    {
        $this->borderRadius($this->_builtCss);
    } //end _runCssRules
    
    public function borderRadius($cssString = '')
    {
    } //end borderRadius
} //end class CssAlly