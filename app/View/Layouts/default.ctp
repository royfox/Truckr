<?php $siteName = "Truckr"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteName ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
        echo $this->Html->css('prettify');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-responsive');
    ?>
        <link rel="stylesheet/less" type="text/css" href="/css/main.less">
    <?php
        echo $this->Html->script('prettify/prettify.js');
        echo $this->Html->script('jquery.js');
        echo $this->Html->script('global.js');
        echo $this->Html->script('cake-bootstrap.js');
        echo $this->Html->script('less-1.3.0.min.js');
		echo $scripts_for_layout;
	?>
</head>
<body onload="prettyPrint();">
	<div id="container">
        <div id="wrapper">
            <div id="header">
                <h1><?php echo $this->Html->link("truckr", '/'); ?></h1>
                <?php if($user = $this->Session->read('Auth.User')):?>
                    <div class="username">
                        Logged in as <?php echo $this->Html->link($user['username'], array('controller'=>'users','action'=>'edit', $user['id'])); ?>
                        | <?php echo $this->Html->link("Log out", '/logout', array('class'=>'logout')); ?>
                    </div>
                <?php endif;?>
            </div>
            <?php if(!isset($hide_navigation)):?>
                <div id="navigation">
                    <div id="search">
                        <form action="/posts/search">
                            <input class="search" type="text" name="query"/>
                            <a class="btn" onclick="$('#search form').submit();">
                                <i class="icon-search"></i>
                            </a>
                        </form>
                    </div>
                    <?php echo $this->Html->link('Add Post', array('controller'=>'posts', 'action' => 'add'), array('class' => 'btn btn-success')); ?>
                    &nbsp;
                    <?php echo $this->Html->link('Browse', array('controller'=>'categories', 'action' => 'index'), array('class' => 'btn')); ?>

                </div>
            <?php endif;?>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>

            </div>
            <div id="footer"></div>
        </div>
    </div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>