<p>
    <strong><?php echo $post['User']['display_name'];?></strong> posted a new message:
</p>

<h3><a href = "<?php echo $urlRoot;?>/posts/view/<?php echo $post['Post']['id'];?>"><?php echo $post['Post']['title'];?></a></h3>

<div class="content">
    <?php echo $this->element('ciconia', array('content' => $post['Post']['content'])); ?>
</div>
