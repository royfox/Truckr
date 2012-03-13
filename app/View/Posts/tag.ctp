<div>
    <h3>Tags for &quot;<?php echo $post['Post']['title']?>&quot;</h3>
    <fieldset>
    <?php
        echo $this->Form->create('Post');
        echo $this->Form->input('Tag',array(
            'label' => false,
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $all_tags,
            'selected' => $tags
        ));
        echo $this->Form->end('Save Tags');
    ?>
     </fieldset>
</div>

