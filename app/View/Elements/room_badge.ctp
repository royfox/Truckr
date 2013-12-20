<?php echo $this->Html->link($room['name'], array('controller' => 'rooms', 'action' => 'view', $room['id']), array('style'=>'background-color:'.$room['colour'].';', 'class'=>'room-badge'));?>

