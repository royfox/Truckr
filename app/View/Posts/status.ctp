<div>
    <h3>Status for &quot;<?php echo $post['Post']['title']?>&quot;</h3>
    <fieldset>
    <?php
        echo $this->Form->create('Post');
        echo $this->Form->input('Status', array('selected'=>$post['Post']['status_id']));
        echo $this->Form->end('Save Status');
    ?>
     </fieldset>
</div>

