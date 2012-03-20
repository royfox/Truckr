<p class="edit_links">
    <?php echo $this->Html->link('Edit tag', array('action' => 'edit', $tag['Tag']['id']));?>
</p>

<h3>Posts tagged &quot;<?php echo $tag['Tag']['name'];?>&quot;</h3>

<p><?php echo $tag['Tag']['description'];?></p>

<?php echo $this->element("post_list", array("posts"=>$posts));