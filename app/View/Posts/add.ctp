

<?php echo $this->Html->script("jquery.textarea.js");?>

<div class="form">
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
    <?php
        echo $this->Form->create('Post');
        echo $this->Form->input('title');
        echo $this->Form->input('content', array('rows' => '6'));
        echo $this->Form->input('category_id');
        echo $this->Form->input('subject_id');
        echo $this->Form->end('Save Post');
    ?>
     </fieldset>
</div>



<script>
    $(document).ready(function () {
         $("textarea").tabby();
    });
</script>