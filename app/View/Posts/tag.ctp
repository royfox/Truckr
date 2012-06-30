<div>
    <h3>Tags for &quot;<?php echo $post['Post']['title']?>&quot;</h3>
    <fieldset>
    <?php echo $this->Form->create('Post'); ?>
    <div class="tag_form">
        <?echo $this->element('recursive_tags', array('tag'=> $all_tags[0], 'parent_string' => "", 'show_checkboxes' => true));?>
    </div>
    <?php echo $this->Form->end('Save Tags');?>
     </fieldset>
</div>

