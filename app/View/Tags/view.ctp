<p class="edit_links">
    <?php echo $this->Html->link('Edit tag', array('action' => 'edit', $tag['Tag']['id']), array('class'=>'btn btn-info'));?>
</p>

<h3 class="list_heading">Posts tagged &quot;<?php echo $tag['Tag']['name'];?>&quot;</h3>

<p class="list_strapline"><?php echo $tag['Tag']['description'];?></p>

<?php echo $this->element("post_list", array("posts"=>$posts));