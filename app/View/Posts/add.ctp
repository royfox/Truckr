<?php echo $this->Html->script("jquery.textarea.js");?>

<h3>Add post</h3>

<div>
    <fieldset>
    <?php
        echo $this->Form->create('Post');
        echo $this->Form->input('room_id',array('type'=>'select'));
        echo $this->Form->input('title', array(
            'class'=>'wide', 'tabindex' => 1
        ));
        echo $this->element('write', array('textarea' => $this->Form->input('content', array('tabindex' => 2))));
        ?>
        <?php $upload_dir = time().rand(10000,99999);
        echo $this->Form->hidden('upload_dir', array(
            'value' => $upload_dir
        ));
        echo $this->Upload->edit('post', $upload_dir);
        echo $this->Form->input('Subscriber',array(
            'label' => __('Subscribers (<span class="checkbox_modifier" select="true">All</span> / <span class="checkbox_modifier" select="false">None</span>)',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $users
        ));
        echo $this->Form->end('Save Post', array('tabindex' => 3));
    ?>
     </fieldset>
</div>
