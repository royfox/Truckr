<?php echo $this->Html->script("jquery.textarea.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Converter.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Sanitizer.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Editor.js");?>

<div>
    <div style="position:absolute;position: absolute;right: 44px;top: 113px; font-weight:bold;color:red; ">
<?php echo $this->Form->postLink('Delete tag', array('action' => 'delete', $this->request->data['Tag']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
    </div>
    <fieldset>
        <legend><?php echo __('Edit Tag'); ?></legend>
    <?php
        echo $this->Form->create('Tag');
        echo $this->Form->input('name');
        echo $this->Form->input('parents', array(
            'class'=>'wide',
            'selected' => $this->request->data['Tag']['parent_tag_id']
        ));
        echo $this->Form->input('documentation', array(
            'rows' => '6',
            'class'=>'wmd-input wide',
            'id'=>'wmd-input',
            'between' => '<div class="wmd-panel"><div id="wmd-button-bar" class="wmd-button-bar"></div>',
            'after' => '</div>'
        )); ?>
        <div id="wmd-preview" class="post wmd-panel wmd-preview"></div>
        <?php
            echo $this->Form->end('Save Tag');
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
