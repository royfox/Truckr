

<div class="post_meta">
    <span class="date">
        <?php echo $this->Time->niceShort($post['Post']['modified']);?>
    </span>
    <span class="admin">
        <?php echo $this->Form->postLink('Delete post', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?'));?>
         |
        <?php echo $this->Html->link('Edit post', array('action' => 'edit', $post['Post']['id']));?>
    </span>
</div>

<h2><?php echo $post['Post']['title']?></h2>

<div class="content">
    <p><?php echo Markdown($post['Post']['content']); ?></p>
</div>

