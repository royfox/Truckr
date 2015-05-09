<?php echo $this->Html->link("Create a new room", array('controller' => 'rooms', 'action' => 'add'), array('class'=>'btn edit-room'));?>

<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Latest', array('controller' => 'posts', 'action' => 'index'));?></li>
    <li class="active"><?php echo $this->Html->link('Rooms', array('controller' => 'rooms', 'action' => 'index'));?></li>
</ul>


<?php foreach($rooms as $room):?>
    <div class="room-summary"style="border-color:<?php echo $room['Room']['colour'];?>">
        <h3 class="room-block">
            <?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $room['Room']['id']));?>
            <?php echo isset($postCounts[$room['Room']['id']]) ? $postCounts[$room['Room']['id']] : 0; ?> posts, <?php echo count($room['Subscriber']);?> subscriber<?php if(count($room['Subscriber']) != 1):?>s<?php endif;?>
        </h3>
    </div>
<?php endforeach;?>





