<p>
    <strong><?php echo $comment['User']['display_name'];?></strong> posted a new comment on the post <a href = "<?php echo $urlRoot;?>/posts/view/<?php echo $comment['Post']['id'];?>"><?php echo $comment['Post']['title'];?></a>:
</p>

<hr />

<div class="content">
    <?php echo Markdown($comment['Comment']['body']); ?>
</div>
