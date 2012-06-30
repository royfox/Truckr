<?php if($tag['id'] != 0):?>
    <div class="tag_box<?php if(isset($show_checkboxes) && $show_checkboxes):?> checkboxes<?php endif;?>">
        <?php if(isset($show_checkboxes) && $show_checkboxes):?>
        <?php for($i = $tag['level'] -1; $i > 0; $i--): ?>
            <div class="indent"></div>
        <?php endfor;?>
        <?php $checked = in_array($tag['id'], $selected_tags) ? 'checked="checked"' : ""; ?>
            <input type="checkbox" name="data[Post][Tag][]" <?php echo $checked;?> value="<?php echo $tag['id'];?>">
            <label><?php echo $tag['name'];?></label>
        <?php else:?>
        <span class="parent"><?php echo $parent_string;?></span><?php echo $this->Html->link($tag['name'], array('controller'=>'tags', 'action' => 'view', $tag['slug'])); ?>
        <span class="links">
            <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $tag['id']), array('confirm' => 'Are you sure?', 'class'=>'delete_link'));?>
            <span class="divider">|</span> <?php echo $this->Html->link('Edit tag details', array('action' => 'edit', $tag['id']), array('class'=>'edit_link'));?>
             <?php endif;?>
        </span>

    </div>
<?php endif;?>
<?php if(isset($tag['children'])):?>
    <?php foreach($tag['children'] as $child):?>
        <?echo $this->element('recursive_tags', array('tag'=> $child, 'parent_string'=> $tag['id'] == 0 ? "" : $parent_string.$tag['name']. " > ", 'show_checkboxes' => isset($show_checkboxes) && $show_checkboxes));?>
    <?php endforeach;?>
<?php endif;?>