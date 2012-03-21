<div>
    <fieldset>
        <legend><?php echo __('Add Tag'); ?></legend>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name', array(
            'class'=>'wide',
        ));
        echo $this->Form->input('description', array(
            'class'=>'wide',
        ));
        echo $this->Form->end('Save Tag');
    ?>
     </fieldset>
</div>
