<?php
/**
 * default entry template
 *
 * This template is used to display a single entry when the 'default'
 * blog was chosen from the dropdown on editing a page.
 *
 * It displays the entry and adds comments and navigational elements.
 */
?>
<div class="blogtng_entry">
    <div class="blogtng_postnavigation level1">
    <?php if ($link = $entry->tpl_previouslink('« @TITLE@', $entry->entry['page'], true)) { ?>
        <div class="blogtng_prevlink">
            <?php echo $link?>
        </div>
    <?php } ?>
    <?php if ($link = $entry->tpl_nextlink('@TITLE@ »', $entry->entry['page'], true)) { ?>
        <div class="blogtng_nextlink">
            <?php echo $link?>
        </div>
    <?php } ?>
    </div>
    <?php $entry->tpl_entry(false, false, false) ?>
<div class="xblogtng_footer level1">
    <a href="<?php $entry->tpl_link()?>" class="wikilink1 blogtng_permalink"><?php $entry->tpl_title()?></a>
    &middot;
    <?php $entry->tpl_created('%Y-%m-%d %H:%M')?>
    &middot;
    <?php $entry->tpl_author()?>
    &middot;
    <?php $entry->tpl_tags('')?>
    &middot;
    <?php if ($entry->entry['commentstatus'] != 'disabled') {?>
        <h2 id="the__comments">Comments</h2>
        <div class="level2">
            <?php $entry->tpl_commentform() ?>
            <?php $entry->tpl_comments('default') ?>
        </div>
    <?php } ?>
</div>
