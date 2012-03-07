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
    </tr>
    <?php endforeach; ?>

</table>