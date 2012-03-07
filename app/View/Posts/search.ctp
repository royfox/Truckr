<h3>Search: &quot;<?php echo $query;?>&quot;</h3>

<?php echo $this->element("post_list", array("posts"=>$posts, 'query' => $query));