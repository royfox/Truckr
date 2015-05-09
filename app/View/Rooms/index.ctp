<?php echo $this->Html->link("Create a new room", array('controller' => 'rooms', 'action' => 'add'), array('class'=>'btn edit-room'));?>

<ul class="nav nav-pills">
  <li class="active"><?php echo $this->Html->link('Rooms', array('controller' => 'rooms', 'action' => 'index'));?></li>
  <li><?php echo $this->Html->link('Feed', array('controller' => 'posts', 'action' => 'index'));?></li>
</ul>
    <?php foreach($rooms as $room):?>

        <h3 class="room-block">
            <?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $room['Room']['id']));?>
            <span class="badge"><?php echo $postCounts[$room['Room']['id']];?> posts</span>
        </h3>

            <?php echo $this->element("post_list", array("posts"=>$room['Post'], 'displayRoom' => false));?>
            <br /><br />

    <?php endforeach;?>





