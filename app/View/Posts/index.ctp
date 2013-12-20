<ul class="nav nav-pills">
  <li class="active"><?php echo $this->Html->link('Latest', array('controller' => 'posts', 'action' => 'index'));?></li>
  <li><?php echo $this->Html->link('Rooms', array('controller' => 'rooms', 'action' => 'index'));?></li>
</ul>

<?php echo $this->element("post_list", array("posts"=>$posts, "show_pagination" => true));?>


