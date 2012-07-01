<p class="edit_links">
    <?php echo $this->Html->link('Add new tag', array('action' => 'add'), array('class'=>'btn btn-info'));?>
</p>


<h3>Tag Tree</h3>
    <br />

<div class="large_tags">
    <div class="tag_form">
        <?php echo $this->element('recursive_tags', array('tag'=> $tags[0], 'parent_string' => ""));?>
    </div>
</div>

