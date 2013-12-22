<?php if($userWasMentioned):?>
    <p>
        <strong><?php echo $post['User']['display_name'];?></strong> mentioned you in a new message:
    </p>
<?php else:?>
    <p>
        <strong><?php echo $post['User']['display_name'];?></strong> posted a new message:
    </p>
<?php endif;?>

<h3><a href = "<?php echo $urlRoot;?>/posts/view/<?php echo $post['Post']['id'];?>"><?php echo $post['Post']['title'];?></a></h3>

<div class="content">
    <?php echo $this->element('ciconia', array('content' => $post['Post']['content'], 'emoji' => false)); ?>
</div>
