<?php
/**
 * small list template
 *
 * This template is used by the <blog list> syntax and can be chosen
 * using the 'tpl' attribute. It is used to display a single entry in
 * the list and is called multiple times (once for each shown entry)
 *
 * This example shows only entry abstracts with comment numbers
 */
?>
<div class="blogtng_list_short">
<h3>
<a href="<?php $entry->tpl_link( )?>"><?php $entry->tpl_created( '%d %m - ' ) ?><?php $entry->tpl_title( ) ?></a>
</h3>
<p>
<?php $entry->tpl_abstract(100)?><br />
</p>
</div>

