<p class="edit_links">
    <?php echo $this->Html->link('Edit tag details', array('action' => 'edit', $tag['Tag']['id']), array('class'=>'btn btn-info'));?>
</p>

<h3 class="list_heading">Posts tagged &quot;<?php echo $tag['Tag']['name'];?>&quot;</h3>

<?php echo $this->element("post_list", array("posts"=>$posts));