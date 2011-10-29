<?php
/**
 * CssAlly
 * 
 * Copyright (C) 2011 Bill Parrott
 * 
 * LICENSE
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author     Bill Parrott <bill@cssally.com>
 * @link       http://cssally.com/
 * @category   CssAlly
 * @package    CssAlly
 * @copyright  2011 Bill Parrott
 * @license    GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * @see Browser 
 */
require_once dirname(__FILE__) . '/Browser.php';

/**
 * @author Bill
 */
class CssAlly {
    private $_browsers = array(
        'explorer'  => true,
        'konqueror' => null,
        'mozilla'   => true,
        'opera'     => true,
        'webkit'    => true,
    );
    private $_builtCss  = '';
    private $_cachefile = '';
    private $_defaultOptions = array(
        'compress' => true,
        'minify'   => true,
        'gzip'     => true,
        'cssDir'   => null,
    );
    private $_files     = array();
    private $_options = array();
    private $_rules = array(
        'background-size' => true,
        'border-radius'   => true,
        'box-shadow'      => true,
        'column-count'    => true,
        'column-gap'      => true,
        'column-rule'     => true,
        'column-span'     => true,
        'column-width'    => true,
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
            $this->_options = array_merge($this->_defaultOptions, $options);
        }

        if (is_null($this->_options['cssDir'])) {
            throw new InvalidArgumentException('You must specify the directory in which your CSS files are stored.');
        }

        $this->setBrowsers($this->_browsers);
    } //end __construct

    public function __call($method, $arguments)
    {
        if (method_exists('Browser', $method)) {
            $cssString = $arguments[0];
            foreach ($this->_browsers as $browser) {
                if ($browser instanceof Browser) {
                    $cssString = $browser->$method($cssString);
                }
            }
            return $cssString;
        }
    } //end __call

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

    /**
     * Builds CSS string for the cache file
     */
    public function buildCssString()
    {
        foreach ($this->_files as $file) {
            $this->_builtCss .= file_get_contents($file);
        }
    } //end buildCssString

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
    } //end checkCache

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
    } //end compress

    public function generateFileName()
    {
        $this->_cachefile = md5(implode('', $this->_files)) . '.css';
    } //end generateFileName

    public function getBrowser($browser)
    {
        return (isset($this->_browsers[$browser])) ? $this->_browsers[$browser] : null;
    } //end getBrowser

    public function getBrowsers()
    {
        return $this->_browsers;
    } //end getBrowsers

    public function getBuiltCss()
    {
        return $this->_builtCss;
    } //end getBuiltCss

    public function getCacheFileName()
    {
        return $this->_cachefile;
    } //end getCacheFileName

    public function getCssFromCache()
    {
        $this->_builtCss = file_get_contents($this->_cachefile);
    } //end getCssFromCache

    public function getFileList()
    {
        return $this->_files;
    } //end getFileList

    public function getOption($option)
    {
        return isset($this->_options[$option]) ? $this->_options[$option] : null;
    } //end getOption

    public function getOptions()
    {
        return $this->_options;
    } //end getOptions

    public function output()
    {
        header("Content-type: text/css");
        echo $this->_builtCss;
        exit;
    } //end output

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

    public function runCssRules()
    {
        foreach ($this->_rules as $rule => $run) {
            if ($run) {
                $methodName = str_replace('-', '_', $rule);
                $this->$methodName();
            }
        }
    } //end runCssRules

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

    public function setBuiltCss($css)
    {
        $this->_builtCss = $css;
    } //end setBuiltCss

    public function setOption($option, $value)
    {
        $this->_options[$option] = $value;
    } //end setOption

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
    } //end writeCache
} //end class CssAlly