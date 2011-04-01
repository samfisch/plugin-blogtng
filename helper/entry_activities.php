<?php

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_TAB')) define('DOKU_TAB', "\t");

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

class helper_plugin_blogtng_entry_activities extends helper_plugin_blogtng_entry {

    function tpl_entry($included=true, $readmore='syntax',
                       $inc_level=true, $skipheader=false) {
        $content = $this->get_entrycontent($readmore, $inc_level, $skipheader);

        if ($included) {
            $content = $this->_convert_footnotes($content);
            #$content .= $this->_edit_button();
        } else {
            $content = tpl_toc(true).$content;
        }

        echo html_secedit($content, !$included);
        return true;
    }

    function _convert_instructions(&$ins, $inc_level, $readmore, $skipheader ) {
        #return parent::_convert_instructions( &$ins, $inc_level, $readmore, $skipheader );
        global $ID;

        $firstsec = 2;

        $id = $this->entry['page'];
        if (!page_exists($id)) return false;

        // check if included page is in same namespace
        $ns = getNS($id);
        $convert = (getNS($ID) == $ns) ? false : true;

        $first_header = true;
        $first_section = true;
        $open_sections = 0;
        $n = count($ins);
        $unset = array( );
        for ($i = 0; $i < $n; $i++) {
            $current = $ins[$i][0];
            if ($convert && (substr($current, 0, 8) == 'internal')) {
                // convert internal links and media from relative to absolute
                $ins[$i][1][0] = $this->_convert_internal_link($ins[$i][1][0], $ns);
            } elseif ( strpos( $current, 'header' ) !== false ) {

                $level_relative = $ins[$i][1][1];
                if( $firstsec_start && $firstsec == $level_relative ) {
                    #$ins = array_slice( $ins, $firstsec_start-$unset, $i-$firstsec_start );
                    #$ins = array_slice( $ins, 0, $i-$unset );
                    $ins = array_slice( $ins, 0, $firstsec_stop );
                    $ins[] = array('section_close', array());
                    break;
                }
                if( $firstsec && $firstsec == $level_relative ) {
                   $firstsec_start = $i;
                }

                // convert header levels and convert first header to permalink
                $text = $ins[$i][1][0];
                $level = $ins[$i][1][1];

                // change first header to permalink
                if ($first_header) {
                    $first_header = false;
                    if($skipheader){
                        #unset($ins[$i]);
                        $unset[] = $i;
                        continue;
                    }else{
                        $ins[$i] = array('plugin',
                            array(
                                'blogtng_header',
                                array(
                                    $text,
                                    $level
                                ),
                            ),
                            $ins[$i][1][2]
                        );
                    }
                }

                // increase level of header
                if ($inc_level) {
                    $level = $level + 1;
                    if ($level > 5) $level = 5;
                    if (is_array($ins[$i][1][1])) {
                        // permalink header
                        $ins[$i][1][1][1] = $level;
                    } else {
                        // normal header
                        $ins[$i][1][1] = $level;
                    }
                }
            } elseif ($current == 'section_open') {
                // the same for sections
                if ($inc_level) $level = $ins[$i][1][0] + 1;
                if ($level > 5) $level = 5;
                $ins[$i][1][0] = $level;
                $open_sections++;

            } elseif ($current == 'section_close') {

                if( $firstsec_start ) {
                   $firstsec_stop = $i; 
                }

                $level_relavite--;
                $open_sections--;
    
            } elseif (($current == 'plugin') && ($ins[$i][1][0] == 'blogtng_readmore') && $readmore) {
                // cut off the instructions here
                $this->_read_more($ins, $i, $open_sections, $inc_level);
                $open_sections = 0;
                break;
            }
        }

        foreach( $unset as $i ) {
            unset( $ins[$i] );
        }
        $this->_finish_convert($ins, $open_sections);
        return true;
    }


}
// vim:ts=4:sw=4:et:
