<div>
    <fieldset>
        <legend><?php echo __('Add Tag'); ?></legend>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name');
        echo $this->Form->input('parents', array(
            'class'=>'wide',
            'selected' => $this->request->data['Tag']['parent_tag_id']
        ));
        echo $this->Form->end('Save Tag');
    ?>

     </fieldset>
</div>
