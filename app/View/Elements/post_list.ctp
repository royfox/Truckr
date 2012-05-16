<?php if(count($posts) == 0):?>
      <p>No posts found.</p>
<?php else:?>
    <?php if(!isset($show_pagination) || $show_pagination === true):?>
        <?php if($this->Paginator):?>
            <div class="sort">
                <?php if($this->Paginator->sortKey() == "Post.created"):?>
                    Sorted by created date. <?php echo $this->Paginator->sort('Post.modified', '(Sort by modified date)',array('direction' => 'desc'));?>
                <?php else:?>
                    Sorted by modified date. <?php echo $this->Paginator->sort('Post.created', '(Sort by created date)',array('direction' => 'desc'));?>
                <?php endif;?>
            </div>
        <?php endif;?>
    <?php endif;?>
    <div class="post_list">
        <?php foreach ($posts as $post): ?>
        <div class="single_post">
            <span class="label meta">
                <?php echo $this->element("user_link", array("user" => $post['User']));?> | <span class="time"><?php echo $this->Time->timeAgoInWords($post['Post']['created']); ?></span>
            </span>
            <h4>
                <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']));?>
                <?php if(count($post['Comment'])):?>
                    <span class="badge badge-warning"><?php echo count($post['Comment']);?></span>
                <?php endif;?>
            </h4>
            <?php if(isset($query)):?>
                <div class="excerpt">
                   <?php echo $this->Text->highlight($this->Text->excerpt($post['Post']['title']." : ".Sanitize::html(Markdown($post['Post']['content']), array('remove' => true)), $query, 200, '...'), $query, array('format' => '<span class="highlight">\1</span>'));?>
                </div>
            <?php endif;?>
            <div style="clear:both;"></div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endif;?>

<?php

if(!isset($show_pagination) || $show_pagination === true){
    if($this->Paginator){

        echo "<div class='pagination'>";

        if(isset($query)){
            $this->Paginator->options(array(
                'url' => array(
                    'query' => $query
                )
            ));
        }
        echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
        echo $this->Paginator->numbers();


        echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));

        echo "<span class='counter'>Page ";

        echo $this->Paginator->counter();
        echo "</span>";
        echo "</div>";
    }
}
?>
