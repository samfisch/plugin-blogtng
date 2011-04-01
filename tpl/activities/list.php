<?php
/**
 * default list template
 *
 * This template is used by the <blog list> syntax and can be chosen
 * using the 'tpl' attribute. It is used to display a single entry in
 * the list and is called multiple times (once for each shown entry)
 *
 * This example shows full entries and add a footer with info
 * on tags and comments.
 */
?>
<div class="blogtng_list activities">
<p>
<a href="<?php $entry->tpl_link()?>" class="wikilink1 blogtng_permalink"><?php $entry->tpl_title()?></a> --
<? $entry->tpl_entry(true, 'syntax', true, true ); ?>
</p>
<div class="blogtng_footer level1">
    <?php $entry->tpl_lastmodified('%Y-%m-%d %H:%M')?>
    &middot;
    <?php $entry->tpl_author()?>
    &middot;
    <?php $entry->tpl_tags('')?>
</div>
</div>
