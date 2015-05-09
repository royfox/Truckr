
<?php echo $this->Html->script("jquery.textarea.js");?>

<div>
    <fieldset>
        <legend><?php echo __('Edit Post'); ?></legend>
        <?php
            echo $this->Form->create('Post', array('action' => 'edit'));
            echo $this->Form->input('room_id',array('type'=>'select'));
            echo $this->Form->input('title', array(
                'class'=>'wide',
            ));
            echo $this->element('write', array('textarea' => $this->Form->input('content')));
        ?>
       <?php
        echo $this->Form->input('id', array('type' => 'hidden'));
        if($this->request->data['Post']['upload_dir']){
            $this->Form->hidden('upload_dir');
        } else {
            $upload_dir = time().rand(10000,99999);
            $this->Form->hidden('upload_dir', array("value" => $upload_dir));
        }
        echo $this->Upload->edit('post', $this->request->data['Post']['upload_dir']);
        echo $this->Form->end('Save Post');
       ?>
    </fieldset>
</div>
