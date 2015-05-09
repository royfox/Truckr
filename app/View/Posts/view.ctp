<?php echo $this->Html->script("jquery.textarea.js");?>

<div id="post-page">

    <h1 class="post-header" style="border-color:<?php echo $post['Room']['colour'];?>"><?php echo $post['Post']['title']; ?></h1>

    <div class="dateline"">
        <span class="gravatar">
            <?php echo $this->Gravatar->image($post['User']['email'], array('size' => 25), array('alt' => 'Gravatar', 'default'=>'identicon')); ?>
        </span>
        <span class="name">
            <?php echo $this->element("user_link", array("user" => $post['User']));?>
        </span>
        <?php echo $this->Time->nice($post['Post']['created']);?>
        in
        <?php echo $this->Html->link($post['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $post['Room']['id']));?>
        <span class="links">
            <?php echo $this->Form->postLink('Delete post', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link minor_link edit_link'));?>
            <span class="divider">|</span>
            <?php echo $this->Html->link('Edit post', array('action' => 'edit', $post['Post']['id']), array('class'=>'minor_link edit_link'));?>
        </span>
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
                <div class="dateline border" style="border-color:<?php echo $post['Room']['colour'];?>">
                    <span class="gravatar">
                        <?php echo $this->Gravatar->image($comment['User']['email'], array('size' => 25), array('alt' => 'Gravatar', 'default'=>'identicon')); ?>
                    </span>
                    <span class="name">
                        <?php echo $this->element("user_link", array("user" => $comment['User']));?>
                    </span>
                    <?php echo $this->Time->nice($comment['created']);?>
                    <span class="links">
                        <?php echo $this->Form->postLink('Delete comment', array('controller'=>'comments', 'action' => 'delete', $comment['id'], $post['Post']['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
                    </span>
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

    <br /><br />

    <div id="add-comment">
        <h4>Add a comment</h4>
        <?php
        echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments','action'=>'add', $post['Post']['id'])));
        echo $this->element('write', array('textarea' => $this->Form->input('body')));
        echo $this->Form->end('Save comment');
        ?>
    </div>

</div>




<script>
    $(".subscribers img").tooltip();
</script>




