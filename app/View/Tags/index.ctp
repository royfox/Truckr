<p class="edit_links">
    <?php echo $this->Html->link('Add new tag', array('action' => 'add'), array('class'=>'btn btn-info'));?>
</p>


<h3>All Tags</h3>
    <br />

<div class="large_tags">
    <?php foreach($tags as $tag):?>
        <?php echo $this->element("tag_link", array("tag" => $tag['Tag'], 'size' => 'large'));?>
    <?php endforeach;?>
</div>

