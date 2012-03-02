
<table class="post_list">
   <!-- <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>-->

    <?php foreach ($posts as $post): ?>
    <tr class="headline">
        <td class="title">
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <td class="date">
            <?php echo $this->Time->niceShort($post['Post']['modified']); ?>
        </td>
    </tr>
    <tr class="excerpt">
        <td colspan="2">
            <?php echo $this->Text->truncate(Sanitize::html(Markdown($post['Post']['content']), array('remove' => true)), 100, array(
                    'ending' => '...',
                    'exact' => false
              ));?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
