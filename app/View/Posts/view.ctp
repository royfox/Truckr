
<div class="subscribers">
    <?php $subscriber_ids = array();?>
    <?php if(count($post['Subscriber'])):?>
        <?php $subscriber_names = array();?>
        <?php foreach($post['Subscriber'] as $subscriber):?>
            <?php $subscriber_names[] = $subscriber['User']['display_name'];?>
            <?php $subscriber_ids[] = $subscriber['User']['id'];?>
        <?php endforeach;?>
        Subscribed to updates: <span class="list"><?php echo join(", ", $subscriber_names);?></span>
    <?php else:?>
        No subscribers
    <?php endif;?>

    <?php $current_user = $this->Session->read('Auth.User');?>

    <?php if(in_array($current_user['id'], $subscriber_ids)):?>
        <span class="manage_subscription unsubscribe">
            <?php echo $this->Html->link('Unsubscribe', array('controller' => 'subscribers','action' => 'delete', $post['Post']['id']));?>
        </span>
    <?php else:?>
    <span class="manage_subscription subscribe">
        <?php echo $this->Html->link('Subscribe', array('controller' => 'subscribers','action' => 'add', $post['Post']['id']));?>
    </span>
    <?php endif;?>

</div>

<div class="page_meta">
    <?php foreach($post['PostTag'] as $tag):?>
        <?php echo $this->element("tag_link", array("tag" => $tag['Tag']));?>
    <?php endforeach;?>
    <span class="date">
        Last modified <?php echo $this->Time->nice($post['Post']['modified']);?>  by <?php echo $this->element("user_link", array("user" => $post['User']));?>
    </span>
    <span class="admin">
        <?php echo $this->Html->link('Edit tags', array('action' => 'tag', $post['Post']['id']));?>
         |
        <?php echo $this->Form->postLink('Delete post', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
         |
        <?php echo $this->Html->link('Edit post', array('action' => 'edit', $post['Post']['id']));?>
    </span>
</div>


<h2><?php echo $post['Post']['title']?></h2>

<div class="post">

    <div class="content">
        <?php echo Markdown($post['Post']['content']); ?>
    </div>

</div>

<div class="comments">
     <?php foreach($post['Comment'] as $comment):?>
      <div class="comment">
          <div class="picture">
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
        <div class="picture">
            <?php echo $this->Gravatar->image($current_user['email'], array('size' => 70, 'default'=>'identicon'), array('alt' => 'Gravatar')); ?>
        </div>
        <div class="content">
            <h4>Add comment</h4>
            <div class="body">
                <?php
                    echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments','action'=>'add', $post['Post']['id'])));
                    echo $this->Form->input('body', array('rows' => '6'));
                    echo $this->Form->end('Save');
                ?>
            </div>
        </div>
    </div>
</div>





