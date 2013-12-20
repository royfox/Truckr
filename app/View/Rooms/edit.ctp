<div class="rooms form">
<?php echo $this->Form->create('Room');?>
    <fieldset>
        <legend><?php echo __('Edit Room Details'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('colour');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Save'));?>
</div>
