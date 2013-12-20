<?php echo $this->Html->link("Edit room details", array('controller' => 'rooms', 'action' => 'edit', $room['Room']['id']), array('class'=>'btn edit-room'));?>

<div class="room-badge-large">
     <?php echo $this->element("room_badge", array('room' => $room['Room']));?>
</div>

<?php echo $this->element("post_list", array("posts"=>$posts, 'displayRoom' => false));
