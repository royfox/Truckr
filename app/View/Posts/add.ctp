

<?php echo $this->Html->script("jquery.textarea.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Converter.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Sanitizer.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Editor.js");?>


<div>
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
    <?php
        echo $this->Form->create('Post');
        echo $this->Form->input('title');
        echo $this->Form->input('content', array(
            'rows' => '6',
            'class'=>'wmd-input',
            'id'=>'wmd-input',
            'between' => '<div class="wmd-panel"><div id="wmd-button-bar" class="wmd-button-bar"></div>',
            'after' => '</div>'
        ));
        ?>
        <div id="wmd-preview" class="post wmd-panel wmd-preview"></div>
        <?php
        echo $this->Form->input('Subscriber',array(
            'label' => __('Subscriber',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $users
        ));
        echo $this->Form->end('Save Post');
    ?>
     </fieldset>
</div>



<script>
    $(document).ready(function () {
        $("textarea").tabby();
        var converter1 = Markdown.getSanitizingConverter();
        var editor1 = new Markdown.Editor(converter1);
        editor1.run();
    });
</script>