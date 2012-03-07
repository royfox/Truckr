<h3>Subject: <?php echo $subject['Subject']['name'];?></h3>

<?php echo $this->element("post_list", array("posts"=>$posts));