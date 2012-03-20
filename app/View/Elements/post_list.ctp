<?php if(count($posts) == 0):?>
      <p>No posts found.</p>
<?php else:?>
    <div class="post_list">
        <?php foreach ($posts as $post): ?>

        <div class="single_post">
            <span class="label time  label-success">
                <?php echo $this->Time->timeAgoInWords($post['Post']['modified']); ?>
            </span>
            <h4><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?></h4>
            <div class="tags">
                <?php foreach($post['PostTag'] as $tag):?>
                    <?php echo $this->element("tag_link", array("tag" => $tag['Tag']));?>
                <?php endforeach;?>
            </div>
            <div class="meta">
                <span class="author label">
                    <?php echo $this->element("user_link", array("user" => $post['User']));?>
                </span>
            </div>
            <?php if(isset($query)):?>
                <div class="excerpt">
                   <?php echo $this->Text->highlight($this->Text->excerpt($post['Post']['title']." : ".Sanitize::html(Markdown($post['Post']['content']), array('remove' => true)), $query, 200, '...'), $query, array('format' => '<span class="label label-warning">\1</span>'));?>
                </div>
            <?php endif;?>
            <div style="clear:both;"></div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endif;?>
