
<?php echo $this->Html->script("jquery.textarea.js");?>

<?php
    echo $this->Form->create('Post', array('action' => 'edit'));
    echo $this->Form->input('title');
    echo $this->Form->input('content', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');?>

<script>
    $(document).ready(function () {
         $("textarea").tabby();
    });
</script>