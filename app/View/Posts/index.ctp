<h3 class="list_heading">Open Posts <?php echo $this->Html->link('View all open posts', array('controller'=>'posts', 'action' => 'status', 'open')); ?></h3>

<?php echo $this->element("post_list", array("posts"=>$open_posts, "show_pagination" => false));?>

<h3 class="list_heading">Archived Posts <?php echo $this->Html->link('View all archived posts', array('controller'=>'posts', 'action' => 'status', 'archived')); ?></h3>

<?php echo $this->element("post_list", array("posts"=>$archived_posts, "show_pagination" => false));?>

<h3 class="list_heading">Closed And Obsolete Posts <?php echo $this->Html->link('View all closed posts', array('controller'=>'posts', 'action' => 'status', 'closed')); ?> <span style="float:right; color:#777; font-size:13px;">&nbsp;|&nbsp;</span> <?php echo $this->Html->link('View all obsolete posts', array('controller'=>'posts', 'action' => 'status', 'obsolete')); ?></h3>

<?php echo $this->element("post_list", array("posts"=>$dead_posts, "show_pagination" => false));?>


