<h3>User: <?php echo $user['User']['username'];?></h3>

<?php echo $this->element("post_list", array("posts"=>$posts));