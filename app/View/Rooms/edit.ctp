<div class="rooms form">
<?php echo $this->Form->create('Room');?>
    <fieldset>
        <legend><?php echo __('Edit Room Details'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('colour');
        echo $this->Form->input('Subscriber',array(
            'label' => __('Subscribers',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $users,
            'selected' => $subscribers
        ));?>
    </fieldset>
<?php echo $this->Form->end(__('Save'));?>
</div>
