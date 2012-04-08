<div>
    <h3>Tags for &quot;<?php echo $post['Post']['title']?>&quot;</h3>
    <fieldset>
    <?php echo $this->Form->create('Post'); ?>
    <table class="tags">
    <?php foreach($categories as $category):?>
        <tr>
            <td class="category"><?php echo $category['Category']['name'];?></td>
            <td>
                <?php foreach($category['CategoryTag'] as $tag):?>
                    <div>
                        <?php $checked = in_array($tag['Tag']['id'], $tags) ? 'checked="checked"' : ""; ?>
                        <input type="checkbox" name="data[Post][Tag][]" <?php echo $checked;?> value="<?php echo $tag['Tag']['id'];?>">
                        <label><?php echo $tag['Tag']['name'];?></label>
                    </div>
                <?php endforeach;?>
            </td>
        </tr>

    <?php endforeach;?>
    </table>
    <?php echo $this->Form->end('Save Tags');?>
     </fieldset>
</div>

