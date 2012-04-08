<h3 class="list_heading"><?php echo $status['Status']['name'];?> posts</h3>

<p class="list_strapline">
    <?php echo $status['Status']['description'];?>
</p>

<?php echo $this->element("post_list", array("posts"=>$posts));?>