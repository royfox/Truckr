<div class="rooms form">
<?php echo $this->Form->create('Room');?>
    <h3>Create a new room</h3>
    <br />
    <fieldset>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('colour', array('placeholder' => 'e.g. #32C26B'));
        echo $this->Form->input('slack_channel', array('placeholder' => 'e.g. #channel'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
