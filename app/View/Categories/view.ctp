<h3 class="list_heading">Posts categorised &quot;<?php echo $category['Category']['name'];?>&quot;</h3>

<p class="list_strapline"><?php echo $category['Category']['description'];?></p>

<?php echo $this->element("post_list", array("posts"=>$posts));