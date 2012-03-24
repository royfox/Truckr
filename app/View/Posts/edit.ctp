
<?php echo $this->Html->script("jquery.textarea.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Converter.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Sanitizer.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Editor.js");?>


<div>
    <fieldset>
        <legend><?php echo __('Edit Post'); ?></legend>
        <?php
            echo $this->Form->create('Post', array('action' => 'edit'));
            echo $this->Form->input('title', array(
                'class'=>'wide',
            ));
            echo $this->Form->input('content', array(
                'rows' => '6',
                'class'=>'wmd-input wide',
                'id'=>'wmd-input',
                'between' => '<div class="wmd-panel"><div id="wmd-button-bar" class="wmd-button-bar"></div>',
                'after' => '</div>'
            ));
        ?>
       <div id="wmd-preview" class="post wmd-panel wmd-preview"></div>
       <?php
        echo $this->Form->input('id', array('type' => 'hidden'));
        if($post['Post']['upload_dir']){
            $this->Form->hidden('upload_dir');
        } else {
            $upload_dir = time().rand(10000,99999);
            $this->Form->hidden('upload_dir', array("value" => $upload_dir));
        }
        echo $this->Upload->edit('post', $this->request->data['Post']['upload_dir']);
            echo $this->Form->input('Subscriber',array(
                'label' => __('Subscribers',true),
                'type' => 'select',
                'multiple' => 'checkbox',
                'options' => $users,
                'selected' => $subscribers
            ));?>
            <?php echo $this->Form->end('Save Post');?>
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