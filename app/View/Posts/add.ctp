<?php echo $this->Html->script("jquery.textarea.js");?>

<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('content', array('rows' => '6'));
echo $this->Form->end('Save Post');
?>

<script>
    $(document).ready(function () {
         $("textarea").tabby();
    });
</script>