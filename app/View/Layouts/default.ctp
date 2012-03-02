<?php $siteName = "Truck"; ?>
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

		echo $this->Html->css('cake.generic');
        echo $this->Html->css('main');
        echo $this->Html->css('prettify');
        echo $this->Html->script('prettify/prettify.js');
        echo $this->Html->script('jquery.js');
		echo $scripts_for_layout;
	?>
</head>
<body onload="prettyPrint();">
	<div id="container">
        <div id="wrapper">
            <div id="header">
                <h1><?php echo $this->Html->link("Truckr", '/'); ?></h1>
                <?php if($this->Session->read('Auth.User')):?>
                    <div class="permalinks actions">
                        <?php echo $this->Html->link('Add Post', array('action' => 'add')); ?>
                         <?php echo $this->Html->link("Logout", '/logout', array('class'=>'logout')); ?>
                    </div>
                <?php endif;?>
            </div>
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