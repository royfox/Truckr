<?php $class = (isset($size) && $size == 'large') ? "btn-large" : "btn-mini";?>
<?php echo $this->Html->link($tag['name'], array('controller' => 'tags', 'action' => 'view', $tag['slug']), array('class' => 'btn btn-default '.$class)); ?>