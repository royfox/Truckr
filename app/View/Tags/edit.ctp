<div>
    <fieldset>
        <legend><?php echo __('Add Tag'); ?></legend>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name');
        echo $this->Form->input('description');
        echo $this->Form->input('Category',array(
            'label' => __('Categories',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $all_categories,
            'selected' => $categories
        ));
        echo $this->Form->end('Save Tag');
    ?>
     </fieldset>
</div>
