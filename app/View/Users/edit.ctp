<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Edit Details'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('email');
        echo $this->Form->input('display_name');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Save'));?>
</div>