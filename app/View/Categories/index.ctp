<?php foreach($categories as $category):?>

        <div class="category_links">
            <h3>
                <?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['slug'])); ?>
            </h3>
            <ul>
            <?php foreach($category['CategoryTag'] as $tag):?>
                <li><?php echo $this->Html->link($tag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $tag['Tag']['slug'])); ?></li>
            <?php endforeach;?>
            </ul>
        </div>


<?php endforeach;?>

<div style="clear:both;"></div>