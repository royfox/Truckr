<p class="edit_links">
    <?php echo $this->Html->link('Add new tag', array('action' => 'add'));?>
</p>


<?php foreach($tags as $tag):?>
    <?php echo $this->element("tag_link", array("tag" => $tag['Tag']));?>
<?php endforeach;?>