<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('login_name');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>