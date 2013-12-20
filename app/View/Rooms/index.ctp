<?php echo $this->Html->link("Create a new room", array('controller' => 'rooms', 'action' => 'add'), array('class'=>'btn edit-room'));?>

<ul class="nav nav-pills">
  <li><?php echo $this->Html->link('Latest', array('controller' => 'posts', 'action' => 'index'));?></li>
  <li class="active"><?php echo $this->Html->link('Rooms', array('controller' => 'rooms', 'action' => 'index'));?></li>
</ul>


<div class="alert">
    All rooms, sorted by most recent activity
</div>

<table style="width:100%;margin-top:30px;">
    <?php foreach($rooms as $room):?>
    <tr>
        <td class="room-badge-large">
                <?php echo $this->element("room_badge", array('room' => $room['Room']));?>
        </td>
        <td class="table-posts">
            <?php echo $this->element("post_list", array("posts"=>$room['Post'], 'displayRoom' => false));?>
            <br /><br />
        </td>
    </tr>
    <?php endforeach;?>
</table>




