
<p>
    <?php
        $crumb_strings = array();
        $crumb_strings[] = $this->Html->link("Home", array('controller'=>'tags', 'action' => 'index'));
        foreach($breadcrumbs as $crumb){
            $crumb_strings[] = $this->Html->link($crumb['Tag']['name'], array('controller'=>'tags', 'action' => 'view', $crumb['Tag']['slug']));
        }

        echo join(" &raquo ", $crumb_strings);
    ?>
</p>

<h3 class="list_heading" style="float:left"><?php echo $tag['Tag']['name'];?></h3>
<p class="edit_links faint" style="float:left; margin-left:10px;">
    <?php echo $this->Html->link('Edit details and documentation', array('action' => 'edit', $tag['Tag']['id']), array('class'=>'btn btn-info'));?>
</p>

<ul class="nav nav-tabs" style="clear:both;padding-top:8px;">
  <li class="active">
    <a href="#">Documentation</a>
  </li>
  <li><a href="#">Posts</a></li>
</ul>

<div id="documentation" class="toggleable_content">
    <?php if(strlen($tag['Tag']['documentation']) > 4):?>
        <?php echo Markdown($tag['Tag']['documentation']); ?>
    <?php else:?>
        <p>This tag has not yet been documented.</p>
    <?php endif;?>
</div>

<div id="post_list" style="display:none;" class="toggleable_content">
    <?php echo $this->element("post_list", array("posts"=>$posts));?>
</div>




<script>
    $(".nav-tabs a").click(function(){
       if($(this).parent().hasClass("active")){
           return;
       }
       $(".toggleable_content").toggle();
       $(this).parent().parent().find("li").removeClass("active");
       $(this).parent().addClass("active");
    });
</script>