

<?php echo $this->Html->script("jquery.textarea.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Converter.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Sanitizer.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Editor.js");?>


<h3>Add post</h3>

<div>
    <fieldset>
    <?php
        echo $this->Form->create('Post');
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
        <?php $upload_dir = time().rand(10000,99999);
        echo $this->Form->input('Subscriber',array(
            'label' => __('Subscribers (<span class="checkbox_modifier" select="true">All</span> / <span class="checkbox_modifier" select="false">None</span>)',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $users
        ));
        echo $this->Form->hidden('upload_dir', array(
            'value' => $upload_dir
        ));
        echo $this->Upload->edit('post', $upload_dir);
        echo $this->Form->end('Save Post');
    ?>
     </fieldset>
</div>



<script>
    $(document).ready(function () {
        $(".checkbox_modifier").css({'cursor':'pointer'}).click(function(){
            $('input[type=checkbox]').attr('checked',$(this).attr("select") == "true");
        });
        $("textarea").tabby();
        var converter1 = Markdown.getSanitizingConverter();
        var editor1 = new Markdown.Editor(converter1);
        editor1.run();
    });
</script>