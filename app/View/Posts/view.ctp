

<div class="post_meta">
    <span class="date">
        Last modified <?php echo $this->Time->nice($post['Post']['modified']);?>  by <?php echo $this->element("user_link", array("user" => $post['User']));?>
    </span>
    <span class="admin">
        <?php echo $this->Form->postLink('Delete post', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
         |
        <?php echo $this->Html->link('Edit post', array('action' => 'edit', $post['Post']['id']));?>
    </span>
</div>

<h2><?php echo $post['Post']['title']?></h2>

<div class="content">
    <p><?php echo Markdown($post['Post']['content']); ?></p>
</div>

<div class="comments">
     <?php foreach($post['Comment'] as $comment):?>
      <div class="comment">
          <div class="title">
              <?php echo $this->element("user_link", array("user" => $comment['User']));?>, <?php echo $this->Time->nice($comment['modified']);?>
          </div>
          <div class="content">
              <?php echo Markdown($comment['body']);?>
          </div>
      </div>
      <?php endforeach;?>
</div>



