<?php if($userWasMentioned):?>
    <p>
        <strong><?php echo $comment['User']['display_name'];?></strong> mentioned you in a new comment on the post <a href = "<?php echo $urlRoot;?>/posts/view/<?php echo $comment['Post']['id'];?>"><?php echo $comment['Post']['title'];?></a>:
    </p>
<?php else:?>
    <p>
        <strong><?php echo $comment['User']['display_name'];?></strong> posted a new comment on the post <a href = "<?php echo $urlRoot;?>/posts/view/<?php echo $comment['Post']['id'];?>"><?php echo $comment['Post']['title'];?></a>:
    </p>
<?php endif;?>

<hr />

<div class="content">
    <?php echo $this->element('ciconia', array('content' => $comment['Comment']['body'], 'emoji' => false)); ?>
</div>
