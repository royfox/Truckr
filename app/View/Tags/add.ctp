<div>
    <h3>Add tag</h3>
    <fieldset>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name', array(
            'class'=>'wide',
        ));
        echo $this->Form->input('description', array(
            'class'=>'wide',
        ));
        echo $this->Form->input('Category',array(
            'label' => __('Categories',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $all_categories
        ));
        echo $this->Form->end('Save Tag');
    ?>
     </fieldset>
</div>
