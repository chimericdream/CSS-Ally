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
abstract class Browser {
    const n0_255_regex = '([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])';

    public function color_regex()
    {
        $colors = '('
                    . '#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})\b|'
                    . 'aqua|'
                    . 'black|'
                    . 'blue|'
                    . 'fuchsia|'
                    . 'gray|'
                    . 'green|'
                    . 'lime|'
                    . 'maroon|'
                    . 'navy|'
                    . 'olive|'
                    . 'orange|'
                    . 'purple|'
                    . 'red|'
                    . 'silver|'
                    . 'teal|'
                    . 'white|'
                    . 'yellow|'
                    . 'rgb\(\s*' . self::n0_255_regex . '\s*,\s*' . self::n0_255_regex . '\s*,\s*' . self::n0_255_regex . '\s*\)|'
                    . 'rgb\(\s*(\d{1,2}%|100%)\s*,\s*(\d{1,2}%|100%)\s*,\s*(\d{1,2}%|100%)\s*\)'
                . ')';

        return $colors;
    } //end color_regex

    public function length_regex()
    {
        $length = '(\-?\d+\.?\d*)(px|em)';

        return $length;
    } //end length_regex

    public function percent_regex()
    {
        $percent = '((\-?\d+\.?\d*)%)';

        return $percent;
    } //end percent_regex

    public function border_style_regex()
    {
        $border = '(none|hidden|dotted|dashed|solid|double|groove|ridge|inset|outset)';
        
        return $border;
    } //end border_style_regex

    public function border_width_regex()
    {
        $border = '(thin|medium|thin|' . $this->length_regex() . ')';
        
        return $border;
    } //end border_width_regex
    
    /**
     * Syntax:
     * background-size: <bg-size> [ , <bg-size> ]*
     *
     * <bg-size> = [ <length> | <percentage> | auto ]{1,2} | cover | contain
     */
    public function background_size($cssString = '')
    {
        return $cssString;
    } //end background_size

    /**
     * Syntax:
     * border-*-*-radius: [ <length> | <%> ] [ <length> | <%> ]?
     * border-radius: [ <length> | <percentage> ]{1,4} [ / [ <length> | <percentage> ]{1,4} ]?
     */
    public function border_radius($cssString = '')
    {
        return $cssString;
    } //end border_radius

    /**
     * Syntax:
     * box-shadow: none | <shadow> [ , <shadow> ]*
     *
     * <shadow> = inset? && [ <length>{2,4} && <color>? ]
     */
    public function box_shadow($cssString = '')
    {
        return $cssString;
    } //end box_shadow

    /**
     * Syntax:
     * column-count: <integer> | auto
     */
    public function column_count($cssString = '')
    {
        return $cssString;
    } //end column_count

    /**
     * Syntax:
     * column-gap: <length> | normal
     */
    public function column_gap($cssString = '')
    {
        return $cssString;
    } //end column_gap

    /**
     * Syntax:
     * column-rule: <column-rule-width> <column-rule-style> (<column-rule-color> | transparent)
     * column-rule-color: (<color> | transparent)
     * column-rule-style: <border-style>
     * column-rule-width: <border-width>
     */
    public function column_rule($cssString = '')
    {
        return $cssString;
    } //end column_rule

    /**
     * Syntax:
     * column-span: none | all
     */
    public function column_span($cssString = '')
    {
        return $cssString;
    } //end column_span

    /**
     * Syntax:
     * column-width: <length> | auto
     */
    public function column_width($cssString = '')
    {
        return $cssString;
    } //end column_width

    public function columns($cssString = '')
    {
        return $cssString;
    } //end columns
} //end abstract class Browser