<?php echo $this->Html->link("Edit room details", array('controller' => 'rooms', 'action' => 'edit', $room['Room']['id']), array('class'=>'btn edit-room'));?>

<?php $subscriber_ids = array();?>
<?php $current_user = $this->Session->read('Auth.User');?>
<?php foreach($room['Subscriber'] as $subscriber):?>
    <?php $subscriber_ids[] = $subscriber['User']['id'];?>
<?php endforeach;?>

<?php
$names = [];
foreach($room['Subscriber'] as $subscriber) {
    $names[] = $this->element("user_link", array("user" => $subscriber['User']));
}
?>

<h2>
    <?php echo $room['Room']['name'];?>
    <span class="subscription-links">
        <?php if(in_array($current_user['id'], $subscriber_ids)):?>
            <?php echo $this->Html->link('[Unsubscribe]', array('controller' => 'subscribers','action' => 'delete', $room['Room']['id']), array('class' => 'unsubscribe'));?>
        <?php else:?>
            <?php echo $this->Html->link('[Subscribe]', array('controller' => 'subscribers','action' => 'add', $room['Room']['id']), array('class' => 'subscribe'));?>
        <?php endif;?>
    </span>
</h2>

<p class="subscribers">
    <?php echo count($subscriber_ids);?> subscriber<?php if(count($subscriber_ids) != 1):?>s<?php endif;?>:
    <strong><?php echo join(", ", $names);?></strong>
</p>

<?php echo $this->element("post_list", array("posts"=>$posts, 'displayRoom' => false));
