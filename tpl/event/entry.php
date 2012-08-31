<?php
/**
 * default entry template
 *
 * This template is used to display a single entry when the 'default'
 * blog was chosen from the dropdown on editing a page.
 *
 * It displays the entry and adds comments and navigational elements.
 */
global $conf;
$dformat_bak = $conf['dformat'];
$conf['dformat'] = '%d %m';
?>
<div class="blogtng_entry">
    <div class="blogtng_postnavigation level1">
    <?php if ($link = $entry->tpl_previouslink('« @TITLE@ - @DATE@', $entry->entry['page'], true)) { ?>
        <div class="blogtng_prevlink">
            <?php echo $link?>
        </div>
    <?php } ?>
    <?php if ($link = $entry->tpl_nextlink('@DATE@ - @TITLE@ »', $entry->entry['page'], true)) { ?>
        <div class="blogtng_nextlink">
            <?php echo $link?>
        </div>
    <?php } ?>
    </div>

<h1>
<a name="blog_start"><?php $entry->tpl_created( '%d %m - ' ) ?><?php $entry->tpl_title( ) ?></a>
</h1>
    <?php #$entry->tpl_entry(false, false, false) ?>
    <?php #$entry->tpl_content( 'small', 'list') ?>
    <?php echo $this->get_entrycontent( false, false, true ) ?>

    <?php if ($entry->entry['commentstatus'] != 'disabled') {?>
        <h2 id="the__comments">Comments</h2>
        <div class="level2">
            <?php $entry->tpl_comments('default') ?>
            <?php $entry->tpl_commentform() ?>
        </div>
    <?php } ?>
</div>
<?php

$conf['dformat'] = $dformat_bak;
?>
