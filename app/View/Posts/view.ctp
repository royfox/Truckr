<?php echo $this->Html->script("jquery.textarea.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Converter.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Sanitizer.js");?>
<?php echo $this->Html->script("pagedown/Markdown.Editor.js");?>

<h1><?php echo $post['Post']['title']?></h1>

<table class="post_meta table table-condensed">
    <tbody>
    <tr>
        <td><span class="label">Author</span></td>
        <td><?php echo $this->element("user_link", array("user" => $post['User']));?></td>
        <td>
            <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link minor_link edit_link'));?>
            <span class="divider">|</span> <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
        </td>
    </tr>
    <tr>
        <td><span class="label">Subscribers</span></td>
        <td>
            <?php $subscriber_ids = array();?>
            <?php if(count($post['Subscriber'])):?>
                <?php $subscriber_names = array();?>
                <?php foreach($post['Subscriber'] as $subscriber):?>
                    <?php $subscriber_names[] = $subscriber['User']['display_name'];?>
                    <?php $subscriber_ids[] = $subscriber['User']['id'];?>
                <?php endforeach;?>
                <span class="list"><?php echo join(", ", $subscriber_names);?></span>
            <?php else:?>
                No subscribers
            <?php endif;?>
        </td>
        <td>
            <?php $current_user = $this->Session->read('Auth.User');?>
            <?php if(in_array($current_user['id'], $subscriber_ids)):?>
                <span class="manage_subscription unsubscribe">
                    <?php echo $this->Html->link('Unsubscribe', array('controller' => 'subscribers','action' => 'delete', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
                </span>
            <?php else:?>
            <span class="manage_subscription subscribe">
                <?php echo $this->Html->link('Subscribe', array('controller' => 'subscribers','action' => 'add', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
            </span>
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <td><span class="label">Tags</span></td>
        <td>
            <?php foreach($post['PostTag'] as $tag):?>
                <?php echo $this->element("tag_link", array("tag" => $tag['Tag']));?>
            <?php endforeach;?>
        </td>
        <td><?php echo $this->Html->link('Edit tags', array('action' => 'tag', $post['Post']['id']), array('class'=>'minor_link edit_link'));?></td>
    </tr>
    <tr>
        <td><span class="label">Date</span></td>
        <td>
            <?php echo $this->Time->timeAgoInWords($post['Post']['created']);?>
            (last modified <?php echo $this->Time->niceShort($post['Post']['modified']);?>)
        </td>
        <td>

        </td>
    </tr>
    </tbody>
</table>



<div class="post">

    <div class="content">
        <?php echo Markdown($post['Post']['content']); ?>
        <?php if($post['Post']['upload_dir']):?>
            <?php echo $this->Upload->view('post', $post['Post']['upload_dir']);?>
        <?php endif;?>
    </div>

</div>

<div class="comments">
     <?php foreach($post['Comment'] as $comment):?>
      <div class="comment post">
          <div class="picture thumbnail">
              <?php echo $this->Gravatar->image($comment['User']['email'], array('size' => 70), array('alt' => 'Gravatar', 'default'=>'identicon')); ?>
          </div>
          <div class="content">
              <div class="title">
                  <?php echo $this->element("user_link", array("user" => $comment['User']));?>, <?php echo $this->Time->nice($comment['modified']);?> (<?php echo $this->Form->postLink('Delete', array('controller'=>'comments', 'action' => 'delete', $comment['id'], $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>)
              </div>
              <div class="body">
                  <?php echo Markdown($comment['body']);?>
              </div>
          </div>
      </div>
      <?php endforeach;?>
</div>

<div class="add_comment">
    <div class="comment add_comment">
        <?php $current_user = $this->Session->read('Auth.User');?>
        <div class="picture thumbnail">
            <?php echo $this->Gravatar->image($current_user['email'], array('size' => 70, 'default'=>'identicon'), array('alt' => 'Gravatar')); ?>
        </div>
        <div class="content">
            <h4>Add a comment</h4>
            <div class="body">
                <?php
                    echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments','action'=>'add', $post['Post']['id'])));
                    echo $this->Form->input('body', array(
                        'rows' => '6',
                        'class'=>'wmd-input wide',
                        'id'=>'wmd-input',
                        'between' => '<div class="wmd-panel"><div id="wmd-button-bar" class="wmd-button-bar"></div>',
                        'after' => '</div>'
                    ));
        ?>
            <div id="wmd-preview" class="post wmd-panel wmd-preview"></div>
            <?php echo $this->Form->end('Save');?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("textarea").tabby();
        var converter1 = Markdown.getSanitizingConverter();
        var editor1 = new Markdown.Editor(converter1);
        editor1.run();
    });
</script>




