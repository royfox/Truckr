<div style="line-height:2.3em">
    <?php foreach($tags as $tag):?>
        <?php $fontSize = ceil(($maxFontSize * $tag['0']['count'] - 1) / ($maxCount - 1)) + 12;?>
        <?php echo $this->Html->link($tag['Tag']['name'], array('controller'=>'tags', 'action' => 'view', $tag['Tag']['slug']), array('style'=>"font-size:".$fontSize."px;"));?>
    <?php endforeach;?>
</div>