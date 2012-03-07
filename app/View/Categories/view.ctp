<h3>Category: <?php echo $category['Category']['name'];?></h3>

<?php echo $this->element("post_list", array("posts"=>$posts));