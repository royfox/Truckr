<?php if(count($posts) == 0):?>
      <p>No posts found.</p>
<?php else:?>
    <table class="post_list">
        <?php foreach ($posts as $post): ?>
        <tr class="headline">
            <td class="title">
                <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?>
                <span class="date">
                    <?php echo $this->Time->niceShort($post['Post']['modified']); ?>  by <?php echo $this->element("user_link", array("user" => $post['User']));?>
                </span>
            </td>
            <td class="meta">
                <?php echo $this->element("category_link", array("category" => $post['Category']));?>
                <?php echo $this->element("subject_link", array("subject" => $post['Subject']));?>
            </td>
        </tr>
        <?php if(isset($query)):?>
            <tr>
                <td colspan="2">
                    <?php echo $this->Text->highlight($this->Text->excerpt($post['Post']['title']." : ".Sanitize::html(Markdown($post['Post']['content']), array('remove' => true)), $query, 200, '...'), $query, array('format' => '<span class="highlight">\1</span>'));?>
                </td>
            </tr>
        <?php endif;?>
        <?php endforeach; ?>
    </table>
<?php endif;?>