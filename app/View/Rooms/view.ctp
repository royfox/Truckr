<?php echo $this->Html->link("Edit room details", array('controller' => 'rooms', 'action' => 'edit', $room['Room']['id']), array('class'=>'btn edit-room'));?>

<h2><?php echo $room['Room']['name'];?></h2>

<?php echo $this->element("post_list", array("posts"=>$posts, 'displayRoom' => false));
