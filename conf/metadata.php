<?php
$blogtng_meta__excluded_syntax = array('info', 'blogtng_commentreply', 'blogtng_blog', 'blogtng_readmore', 'blogtng_header', 'blogtng_topic');
$blogtng_meta__included_syntax = array();

$meta['comments_allow_web']       = array('onoff');
$meta['comments_subscription']    = array('onoff');
$meta['comments_allow_syntax']   = array(
                                       'multicheckbox',
                                       '_choices' => array_diff(plugin_list('syntax'), $blogtng_meta__included_syntax),
                                   );
$meta['comments_xhtml_renderer']  = array(
                                       'multicheckbox',
                                       '_choices' => array_diff(plugin_list('syntax'), $blogtng_meta__excluded_syntax),
                                   );
$meta['editform_set_date']        = array('onoff');
$meta['tags']                     = array('string');
$meta['sqlite_version'] = array('multichoice', '_choices' => array('SQLite2', 'SQLite3'));
