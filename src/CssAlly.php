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
 * PHP Version 5
 *
 * @category  CssAlly
 * @package   CssAlly
 * @author    Bill Parrott <bill@cssally.com>
 * @copyright 2011 Bill Parrott
 * @license   GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link      http://cssally.com/
 */

/**
 * @see Browser
 */
require_once dirname(__FILE__) . '/Browser.php';

/**
 * Core class for CssAlly
 *
 * This is the primary class for the CssAlly application. It contains the
 * functionality to load CSS files, parse them for CSS3 rules, and cache and
 * output the result. Which browser rules are used may be defined when the class
 * is instantiated or at any other time. In addition, specific rules may be
 * turned explicitly on or off (all are on by default).
 *
 * Example:
 * <code>
 * $css = new CssAlly();
 * $css->setOption('cssDir', '/path/to/css/folder');
 * $files = array('file1.css', 'file2.css', 'file3.css');
 * $css->addCssFiles($files);
 * $css->generate()->output();
 * </code>
 *
 * @category  CssAlly
 * @package   CssAlly
 * @author    Bill Parrott <bill@cssally.com>
 * @copyright 2011 Bill Parrott
 * @license   GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link      http://cssally.com/
 */
class CssAlly
{
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
    private $_fileList  = array();
    private $_options   = array();
    private $_rules     = array(
        'animation'                  => true,
        'animation-delay'            => true,
        'animation-direction'        => true,
        'animation-duration'         => true,
        'animation-iteration-count'  => true,
        'animation-keyframes'        => true,
        'animation-name'             => true,
        'animation-play-state'       => true,
        'animation-timing-function'  => true,
        'background-clip'            => true,
        'background-origin'          => true,
        'background-size'            => true,
        'border-image'               => true,
        'border-radius'              => true,
        'box-shadow'                 => true,
        'column-count'               => true,
        'column-gap'                 => true,
        'column-rule'                => true,
        'column-span'                => true,
        'column-width'               => true,
        'columns'                    => true,
        'linear-gradient'            => true,
        'radial-gradient'            => true,
        'transform'                  => true,
        'transform-origin'           => true,
        'transition'                 => true,
        'transition-delay'           => true,
        'transition-duration'        => true,
        'transition-property'        => true,
        'transition-timing-function' => true,
    );

    /**
     * The constructor sets up the basic settings for the class.
     *
     * @param array $browsers An array of the browsers to target. Each browser
     *                        should have one of the following formats:
     *                        <code>'name' => true</code> (add prefixes)
     *                        <code>'name' => null</code> (don't)
     * @param array $options  An array containing override values for the class
     *                        options.
     *
     * @return void
     */
    public function __construct(
        array $browsers = array(),
        array $options = array()
    ) {
        if (!empty($browsers)) {
            $this->_browsers['explorer']  = (isset($browsers['explorer'])) ?
                                            $browsers['explorer'] :
                                            $this->_browsers['explorer'];

            $this->_browsers['konqueror'] = (isset($browsers['konqueror'])) ?
                                            $browsers['konqueror'] :
                                            $this->_browsers['konqueror'];

            $this->_browsers['mozilla']   = (isset($browsers['mozilla'])) ?
                                            $browsers['mozilla']   :
                                            $this->_browsers['mozilla'];

            $this->_browsers['opera']     = (isset($browsers['opera'])) ?
                                            $browsers['opera']     :
                                            $this->_browsers['opera'];

            $this->_browsers['webkit']    = (isset($browsers['webkit'])) ?
                                            $browsers['webkit']    :
                                            $this->_browsers['webkit'];
        }

        if (empty($options)) {
            $this->_options = $this->_defaultOptions;
        } else {
            $this->_options = array_merge($this->_defaultOptions, $options);
        }

        if (is_null($this->_options['cssDir'])) {
            $this->_options['cssDir'] = './css';
        }

        $this->setBrowsers($this->_browsers);
    } //end __construct

    /**
     * The __call method usually serves as a means to call arbitrary functions.
     * In this case, it is a transparent wrapper for the CSS rules stored in the
     * Browser and Browser_* classes. This lets us call (for example)
     * CssAlly->borderRadius($cssString) without having to directly call the
     * appropriate method in the Browser* class.
     *
     * @param string $method    The name of the method requested. Assumed to be
     *                          the name of a method in the Browser class.
     * @param array  $arguments The arguments to be passed to the method.
     *                          Assumed to contain a single element - the CSS
     *                          string to be parsed.
     *
     * @return string The parsed CSS string
     */
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

    /**
     * Add a CSS file to be parsed. The path to the file should be relative to
     * the one specified in in the 'css-dir' option.
     *
     * @param string $filePath The path to the CSS file to be parsed
     *
     * @return self
     */
    public function addCssFile($filePath)
    {
        $path = $this->_options['cssDir'] . "/{$filePath}";
        $css  = file_get_contents($path);
        $file = array(
            'path'      => $path,
            'rawCss'    => $css,
            'parsedCss' => $css,
            'imports'   => array(),
        );
        $this->_files[]    = $file;
        $this->_fileList[] = $path;

        return $this;
    } //end addCssFile

    /**
     * Add an array of CSS files to be parsed. The path to each file should be
     * relative to the one specified in in the 'css-dir' option.
     *
     * @param array $filePaths An array of file paths to queue for parsing
     *
     * @return self
     */
    public function addCssFiles(array $filePaths)
    {
        foreach ($filePaths as $file) {
            $this->addCssFile($file);
        }

        return $this;
    } //end addCssFiles

    /**
     * This function parses the base string for imports, mixins, variables, and
     * nested rules.
     *
     * @return void
     */
    public function buildCssString()
    {
        $this->_builtCss = '';
        foreach ($this->_files as $file) {
            foreach ($file['imports'] as $import) {
                $this->_builtCss .= "\n\n" . $import['parsedCss'];
            }
            $this->_builtCss .= "\n\n" . $file['parsedCss'];
        }

        return $this;
    } //end buildCssString

    public function buildRawCssString()
    {
        $this->_builtCss = '';
        foreach ($this->_files as $file) {
            foreach ($file['imports'] as $import) {
                $this->_builtCss .= "\n\n" . $import['rawCss'];
            }
            $this->_builtCss .= "\n\n" . $file['rawCss'];
        }

        return $this;
    } //end buildRawCssString

    /**
     * Compare the modification time of cache file against each of the CSS files
     * in the _files array.
     *
     * @return bool Whether any CSS files are newer than the cached file
     */
    public function checkCache()
    {
        if (file_exists($this->_cachefile)) {
            $lastModified = 0;
            foreach ($this->_fileList as $file) {
                $cssModified = filemtime($file);
                if ($cssModified > $lastModified) {
                    $lastModified = $cssModified;
                }
            }

            if (filemtime($this->_cachefile) >= $lastModified) {
                return true;
            }
        }
        return false;
    } //end checkCache

    /**
     * Compress the built CSS string by removing comments, newlines, and extra
     * whitespace.
     *
     * @return void
     */
    public function compress()
    {
        if ($this->_options['compress']) {
            $css = $this->_builtCss;

            /* remove comments */
            $comments = "!/\*[^*]*\*+([^/][^*]*\*+)*/!";
            $css = preg_replace($comments, '', $css);

            /* remove tabs, spaces, newlines, etc. */
            $whitespace = array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ');
            $css = str_replace($whitespace, '', $css);

            /* remove extra spaces within property declarations */
            $css = str_replace(', ', ',', $css);
            $css = str_replace(array('; ', ' ;', ' ; '), ';', $css);
            $css = str_replace(array(': ', ' :', ' : '), ':', $css);
            $css = str_replace(array('{ ', ' {', ' { '), '{', $css);
            $css = str_replace(array('} ', ' }', ' } '), '}', $css);
            $css = str_replace(array('/ ', ' /', ' / '), '/', $css);

            $this->_builtCss = $css;
        }
    } //end compress

    public function deObfuscateKeyframes($css)
    {
        $css = preg_replace('/<<kf/', '{', $css);
        $css = preg_replace('/kf>>/', '}', $css);

        return $css;
    } //end deObfuscateKeyframes

    public function deObfuscateMixins($css)
    {
        $css = preg_replace('/<<mi/', '{', $css);
        $css = preg_replace('/mi>>/', '}', $css);

        return $css;
    } //end deObfuscateMixins

    /**
     * This method is where the magic happens. First, it determines the name of
     * the cache file, checks for its existence, and does one of two things. If
     * the cache file exists and is not out of date, it loads the CSS from the
     * cache file. If the cache file is out of date or does not exist, it runs
     * all of the CSS rules to build the CSS string and stores that into the
     * cache file.
     *
     * The method returns the <code>$this</code> reference so that css can be
     * output immediately, a la <code>CssAlly->generate()->output()</code>.
     *
     * @return self
     */
    public function generate()
    {
        $this->generateFileName();
        if (!$this->checkCache()) {
            $this->processImports($this->_files);
            $this->processMixins();
            $this->parseVariables();
            $this->processNestedRules();
            $this->runCssRules();
            $this->compress();
            $this->writeCache();
        } else {
            $this->getCssFromCache();
        }
        return $this;
    } //end generate

    /**
     * Generate a file name for the cache file. This is based on the names of
     * all the CSS files used to generate the built CSS.
     *
     * @return void
     */
    public function generateFileName()
    {
        $this->_cachefile = md5(implode('', $this->_fileList)) . '.css';
    } //end generateFileName

    /**
     * Get the Browser object for the requested browser name.
     *
     * @param string $browser The name of the browser.
     *
     * @return null|Browser
     */
    public function getBrowser($browser)
    {
        return (isset($this->_browsers[$browser])) ?
                $this->_browsers[$browser] : null;
    } //end getBrowser

    /**
     * Get the array of Browser objects.
     *
     * @return array
     */
    public function getBrowsers()
    {
        return $this->_browsers;
    } //end getBrowsers

    /**
     * Get the built CSS string.
     *
     * @return string The built CSS
     */
    public function getBuiltCss()
    {
        return $this->_builtCss;
    } //end getBuiltCss

    /**
     * Get the name of the cache file where the built CSS is stored.
     *
     * @return string The name of the cache file
     */
    public function getCacheFileName()
    {
        return $this->_cachefile;
    } //end getCacheFileName

    /**
     * Load the CSS string from the cache file.
     *
     * @return void
     */
    public function getCssFromCache()
    {
        $this->setBuiltCss(file_get_contents($this->_cachefile));
    } //end getCssFromCache

    /**
     * Get the list of files to be parsed.
     *
     * @return array The list of CSS files
     */
    public function getFileList()
    {
        return $this->_fileList;
    } //end getFileList

    public function getFiles()
    {
        return $this->_files;
    } //end getFiles

    /**
     * Get the current value of a given option
     *
     * @param string $option The name of the option to get the value of
     *
     * @return mixed The current value of the option requested
     */
    public function getOption($option)
    {
        return isset($this->_options[$option]) ?
                $this->_options[$option] : null;
    } //end getOption

    /**
     * Get the array of optionst
     *
     * @return array All of the options
     */
    public function getOptions()
    {
        return $this->_options;
    } //end getOptions

    public function obfuscateKeyframes($css)
    {
        $css = preg_replace('/(@keyframes[^{]+){/', '$1<<kf', $css);

        $pattern = '/(<<kf[^{]*){([^}]*)}/';
        $replace = '$1<<kf$2kf>>';
        while (preg_match($pattern, $css) == 1) {
            $css = preg_replace($pattern, $replace, $css);
        }

        $css = preg_replace('/(kf>>[^{}<>]+)}/', '$1kf>>', $css);

        return $css;
    } //end obfuscateKeyframes

    public function obfuscateMixins($css)
    {
        $css = preg_replace('/(@mixin[^{]+){/', '$1<<mi', $css);

        $pattern = '/(<<mi[^{}]*){([^{}]*)}/';
        $replace = '$1<<mi$2mi>>';
        while (preg_match($pattern, $css) == 1) {
            $css = preg_replace($pattern, $replace, $css);
        }

        $css = preg_replace('/((?:mi>>|<<mi)[^{}<>]+)}/', '$1mi>>', $css);

        return $css;
    } //end obfuscateMixins

    /**
     * Output the built CSS string to the browser.
     *
     * @return none
     */
    public function output()
    {
        header("Content-type: text/css");
        echo $this->_builtCss;
        exit;
    } //end output

    /**
     * Parse the CSS string for variables
     *
     * @return void
     */
    public function parseVariables()
    {
        $find = '/\s*\$([a-zA-Z][-_a-zA-Z0-9]{0,31})\s*=\s*([\'"])([^\'"]+)\2;/';
        $v    = array();
        preg_match_all($find, $this->_builtCss, $v);
        $vars = array();
        foreach ($v[1] as $index => $varname) {
            $vars[] = array(
                'name'  => $varname,
                'value' => $v[3][$index],
            );
        }
        $this->removeVariables();

        foreach ($vars as $var) {
            $find          = '/\$' . $var['name'] . '([^_a-zA-Z0-9])/';
            $this->_builtCss = preg_replace(
                $find,
                $var['value'] . '${1}',
                $this->_builtCss
            );
        }
    } //end parseVariables

    /**
     * Parse the CSS string for @import rules
     *
     * @return void
     */
    public function processImports(array $files = array())
    {
        $find = '/\@import\s+(?:url\((\'|")([^\'"\)]+)\1\)|(\'|")([^\'"]+)\3);\s*/';
        if (empty($files)) {
            $imports    = array();
            preg_match_all($find, $this->_builtCss, $imports);
            $imps = array_merge($imports[2], $imports[4]);

            foreach ($imps as $import) {
                if (empty($import)) {
                    continue;
                }

                $path = $this->getOption('cssDir') . '/' . $import;
                $css  = file_get_contents($path);

                $name = str_replace('.', '\.', $import);
                $find = '/\@import\s+(?:url\((\'|")' . $name . '\1\)|(\'|")' . $name . '\2);\s*/';
                $this->_builtCss = preg_replace(
                    $find,
                    $css . "\n\n",
                    $this->_builtCss
                );
            }

            return;
        }

        foreach ($files as &$file) {
            $imports    = array();
            preg_match_all($find, $file['rawCss'], $imports);
            $imps = array_merge($imports[2], $imports[4]);

            foreach ($imps as $import) {
                if (empty($import)) {
                    continue;
                }

                $name = str_replace('.', '\.', $import);
                $find = '/\@import\s+(?:url\((\'|")' . $name . '\1\)|(\'|")' . $name . '\2);\s*/';
                $file['parsedCss'] = preg_replace(
                    $find,
                    '',
                    $file['parsedCss']
                );

                $path = $this->getOption('cssDir') . '/' . $import;
                $css  = file_get_contents($path);
                $file['imports'][] = array(
                    'path'      => $path,
                    'rawCss'    => $css,
                    'parsedCss' => $css,
                    'imports'   => array(),
                );
            }
        }
    } //end processImports

    public function processMixins()
    {
        $find   = '/\s*\@mixin\s+([a-zA-Z][-_a-zA-Z0-9]+)\(((?:\$[a-zA-Z]+(?:\:\s*[^,\s\)]+)?(?:,\s*\$[a-zA-Z]+(?:\:\s*[^,\s\)]+)?)*)?)\)\s*\{((?:[-_a-zA-Z0-9:$;\s#]|\{\$[^}]+\})+)\}/';
        $m      = array();
        $mixins = array();

        preg_match_all($find, $this->_builtCss, $m);
        foreach ($m[1] as $index => $mixinName) {
            $pars      = preg_split('/,\s*/', $m[2][$index]);
            $params    = array();
            $reqParams = 0;
            $optParams = 0;
            if (!empty($pars[0])) {
                foreach ($pars as $p) {
                    $p                = preg_split('/:\s*/', $p);
                    $param            = array();
                    $param['name']    = substr($p[0], 1);
                    $param['default'] = isset($p[1]) ? $p[1] : '';

                    if (isset($p[1])) {
                        $optParams++;
                    } else {
                        $reqParams++;
                    }
                    $params[] = $param;
                }
            }
            $mixins[] = array(
                'name'          => $mixinName,
                'params'        => $params,
                'content'       => trim($m[3][$index]),
                'reqParamCount' => $reqParams,
                'optParamCount' => $optParams,
            );
        }
        $this->removeMixins();

        $singlePar = '(?:[^,\)]+)';
        foreach ($mixins as $mix) {
            $m      = array();
            $pcount = count($mix['params']);
            $pReg   = '()';
            if ($pcount >= 1) {
                $pReg  = '(';
                $start = ($pcount - 2) < 0 ? 0 : $pcount - 2;

                for ($r = 1; $r <= $mix['reqParamCount']; $r++) {
                    if ($r > 1) {
                        $pReg .= ',\s*';
                    }
                    $pReg .= $singlePar;
                }

                for ($o = 1; $o <= $mix['optParamCount']; $o++) {
                    $pReg .= '(?:';
                    if ($o > 1 || $mix['reqParamCount'] > 0) {
                        $pReg .= ',\s*';
                    }
                    $pReg .= $singlePar . ')?';
                }

                $pReg .= ')';
            }
            $find = "/(\s*)\@include\s+({$mix['name']}\({$pReg}\));/";
            preg_match_all($find, $this->_builtCss, $m);
            foreach ($m[0] as $index => $include) {
                $content = $m[1][$index] . preg_replace('/[\r\n]+\s*/', $m[1][$index], $mix['content']);
                $params  = preg_split('/,\s*/', $m[3][$index]);
                foreach ($mix['params'] as $pindex => $param) {
                    if (isset($params[$pindex]) && !empty($params[$pindex])) {
                        $replace = $params[$pindex];
                    } else {
                        $replace = $mix['params'][$pindex]['default'];
                    }
                    $pname = $mix['params'][$pindex]['name'];
                    $content = preg_replace('/#\{\$' . $pname . '\}/', $replace, $content);
                    $content = preg_replace('/\$' . $pname . '/', $replace, $content);
                }
                $includeRep = '/\s*\@include\s+' . $m[2][$index] . ';/';
                $includeRep = str_replace('(', '\(', $includeRep);
                $includeRep = str_replace(')', '\)', $includeRep);
                $this->_builtCss = preg_replace($includeRep, $content, $this->_builtCss, 1);
            }
        }
    } //end processMixins

    public function processNestedRules()
    {
        $css = $this->_builtCss;

        $css = $this->obfuscateMixins($css);
        $css = $this->obfuscateKeyframes($css);
        $somethingMatched = false;

        $step1 = '/(\s*([^\r\n{}]+){[^{}]*?\s*)(\s*[^\r\n{}]*{[^{}]*})([^{}]*})/';
        $step1replace = "$1$4\n\n$2$3\n\n";
        while (preg_match($step1, $css) == 1) {
            $css = preg_replace($step1, $step1replace, $css);
            $somethingMatched = true;
        }

        $step2 = '/(\s*([^\r\n{}]+){)([^{]+?)(((?:[^{;]+{[^{}]*})+)([^{;]+{[^{}]*})[^{}]*})/';
        $step2replace = "$1$3$5\n}\n\n$2$6\n\n";
        while (preg_match($step2, $css) == 1) {
            $css = preg_replace($step2, $step2replace, $css);
            $somethingMatched = true;
        }

        $step3 = '/(\s*([^\r\n{}]+){)(([^{};]+;)*)([^{};]+[^{;]+{[^{}]*})([^{}]+})/';
        $step3replace = "\n$1$3$6\n\n$2$5\n\n";
        while (preg_match($step3, $css) == 1) {
            $css = preg_replace($step3, $step3replace, $css);
            $somethingMatched = true;
        }

        if ($somethingMatched) {
            $step4 = '/({|;)\s*(\S)/';
            $step4replace = "$1\n    $2";

            $step5 = '/\s*}/';
            $step5replace = "\n}";

            $step6 = '/([^{}\/\*\s;])\s*[\r\n]\s*([^{}\*\s;])/';
            $step6replace = "$1 $2";

            $step7 = '/[\r\n]{2,}/';
            $step7replace = "\n\n";

            $step8 = '/\s*&:(hover|focus)/';
            $step8replace = ":$1";

            $css = preg_replace($step4, $step4replace, $css);
            $css = preg_replace($step5, $step5replace, $css);
            $css = preg_replace($step6, $step6replace, $css);
            $css = preg_replace($step7, $step7replace, $css);
            $css = preg_replace($step8, $step8replace, $css);

            $css = $this->deObfuscateKeyframes($css);
            $css = $this->deObfuscateMixins($css);

            $this->_builtCss = $css;
        }
    } //end processNestedRules

    /**
     * Remove mixin declarations from the CSS string
     *
     * @return void
     */
    public function removeMixins()
    {
        $search = '/\s*\@mixin\s+([a-zA-Z][-_a-zA-Z0-9]+)\(((?:\$[a-zA-Z]+(?:\:\s*[^,\s\)]+)?(?:,\s*\$[a-zA-Z]+(?:\:\s*[^,\s\)]+)?)*)?)\)\s*\{((?:[-_a-zA-Z0-9:$;\s#]|\{\$[^}]+\})+)\}\s*/';
        $this->_builtCss = preg_replace($search, '', $this->_builtCss);
    } //end removeMixins

    /**
     * Remove variable declarations from the CSS string
     *
     * @return void
     */
    public function removeVariables()
    {
        $search = '/\s*\$([a-zA-Z][-_a-zA-Z0-9]{0,31})\s*=\s*([\'"])([^\'"]+)\2;\s*/';
        $this->_builtCss = preg_replace($search, '', $this->_builtCss);
    } //end removeVariables

    /**
     * Cycle through the CSS rules in the _rules array and, if enabled (set to
     * true), run the method on the CSS string.
     *
     * @return void
     */
    public function runCssRules()
    {
        foreach ($this->_rules as $rule => $run) {
            if ($run) {
                $methodNameArr = explode('-', $rule);
                $methodName = '';
                if (count($methodNameArr) > 1) {
                    foreach ($methodNameArr as $index => $piece) {
                        if ($index > 0) {
                            $methodName .= ucfirst($piece);
                        } else {
                            $methodName .= $piece;
                        }
                    }
                } else {
                    $methodName = $methodNameArr[0];
                }
                $this->_builtCss = $this->$methodName($this->_builtCss);
            }
        }
    } //end runCssRules

    /**
     * Create a Browser_* object for a given browser name. If false is passed as
     * the second parameter, set the browser option to null.
     *
     * @param string $browser         The name of the browser
     * @param bool   $useBrowserRules Whether to add prefixed CSS for the
     *                                browser
     *
     * @return self
     */
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

        return $this;
    } //end setBrowser

    /**
     * Set multiple browser objects at once. The array should be formatted as
     * such:
     *
     * <code>'browser' => true|false</code>
     *
     * @param array $browsers An array of browsers to set the rules for
     *
     * @return self
     */
    public function setBrowsers(array $browsers)
    {
        foreach ($browsers as $browser => $useBrowserRules) {
            $this->setBrowser($browser, $useBrowserRules);
        }

        return $this;
    } //end setBrowsers

    /**
     * Directly set the CSS string to be parsed
     *
     * @param string $css The CSS string to store in the _builtCss property
     *
     * @return void
     */
    public function setBuiltCss($css)
    {
        $this->_builtCss = $css;
    } //end setBuiltCss

    /**
     * Set a particular option's value
     *
     * @param string $option The name of the option to set
     * @param string $value  The value to which to set the option
     *
     * @return self
     */
    public function setOption($option, $value)
    {
        $this->_options[$option] = $value;

        return $this;
    } //end setOption

    /**
     * Write the built CSS string into a file for caching purposes
     *
     * @return void
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