<div>
    <fieldset>
        <legend><?php echo __('Add Tag'); ?></legend>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name');
        echo $this->Form->input('description');
        echo $this->Form->end('Save Tag');
    ?>
     </fieldset>
</div>
