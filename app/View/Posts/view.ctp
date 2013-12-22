<?php echo $this->Html->script("jquery.textarea.js");?>

<h1>
    <?php echo $this->element("room_badge", array('room' => $post['Room']));?>
    <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?>
</h1>


<div class="dateline">
    <?php echo $this->Time->nice($post['Post']['created']);?>
    <span class="links">
        <?php echo $this->Form->postLink('Delete post', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link minor_link edit_link'));?>
         <span class="divider">|</span> <?php echo $this->Html->link('Edit post', array('action' => 'edit', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
    </span>

</div>

<div class="user-thumb">
    <div class="gravatar">
        <?php echo $this->Gravatar->image($post['User']['email'], array('size' => 45), array('alt' => 'Gravatar', 'default'=>'identicon')); ?>
    </div>
    <span class="name"><?php echo $this->element("user_link", array("user" => $post['User']));?></span>
</div>

<div class="post">
    <div class="content">
        <?php echo $this->element("ciconia", array("content" => $post['Post']['content'])); ?>
        <?php if($post['Post']['upload_dir']):?>
            <?php echo $this->Upload->view('post', $post['Post']['upload_dir']);?>
        <?php endif;?>
    </div>

</div>

<div class="comments">
     <?php foreach($post['Comment'] as $comment):?>
      <div class="comment">
          <div class="dateline">
              <?php echo $this->Time->nice($comment['created']);?>
              <span class="links">
                  <?php echo $this->Form->postLink('Delete comment', array('controller'=>'comments', 'action' => 'delete', $comment['id'], $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
              </span>

          </div>
          <div class="user-thumb">
              <div class="gravatar">
                  <?php echo $this->Gravatar->image($comment['User']['email'], array('size' => 45), array('alt' => 'Gravatar', 'default'=>'identicon')); ?>
              </div>
              <span class="name"><?php echo $this->element("user_link", array("user" => $comment['User']));?></span>
          </div>

          <div class="content">
              <div class="title">

              </div>
              <div class="body">
                  <?php echo $this->element("ciconia", array("content" => $comment['body']));?>
              </div>
          </div>
      </div>
      <?php endforeach;?>
</div>


<div class="subscribers">
        <div class="dateline">

            <?php $subscriber_ids = array();?>
            <?php $current_user = $this->Session->read('Auth.User');?>
            <?php foreach($post['Subscriber'] as $subscriber):?>
                <?php $subscriber_ids[] = $subscriber['User']['id'];?>
            <?php endforeach;?>
            This post has <?php echo count($subscriber_ids);?> subscriber<?php if(count($subscriber_ids) != 1):?>s<?php endif;?>
            <span class="links">
                <?php if(in_array($current_user['id'], $subscriber_ids)):?>
                    <span class="manage_subscription unsubscribe">
                        <?php echo $this->Html->link('Unsubscribe', array('controller' => 'subscribers','action' => 'delete', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
                    </span>
                <?php else:?>
                    <span class="manage_subscription subscribe">
                        <?php echo $this->Html->link('Subscribe', array('controller' => 'subscribers','action' => 'add', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
                    </span>
                <?php endif;?>
            </span>
        </div>
        <?php if(count($post['Subscriber'])):?>
            <?php foreach($post['Subscriber'] as $subscriber):?>
                <?php echo $this->Gravatar->image($subscriber['User']['email'], array('size' => 20), array('alt' => 'Gravatar', 'default'=>'identicon', 'title' => $subscriber['User']['display_name'].' is subscribed to ths post')); ?>
            <?php endforeach;?>
        <?php else:?>
             <span class="value">No subscribers</span>
        <?php endif;?>
        <?php $current_user = $this->Session->read('Auth.User');?>

</div>

<br /><br />

<div id="add-comment">
    <h4>Add a comment</h4>
    <?php
        echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments','action'=>'add', $post['Post']['id'])));
        echo $this->element('write', array('textarea' => $this->Form->input('body')));
        echo $this->Form->end('Save comment');
    ?>
</div>


<script>
    $(".subscribers img").tooltip();
</script>




