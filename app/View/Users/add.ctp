<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User');?>
    <h3>Add user</h3>
    <br />
    <fieldset>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('email');
        echo $this->Form->input('display_name');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>