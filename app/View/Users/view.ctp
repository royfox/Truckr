<h3>User: <?php echo $user['User']['display_name'];?></h3>

<?php echo $this->element("post_list", array("posts"=>$posts));