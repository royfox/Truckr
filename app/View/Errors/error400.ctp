<style>
    #navigation { display:none; }
</style>
    
<h2 style="font-size:40px;">404: <?php echo $name; ?></h2>
<p style="font-size:18px;">By the Hammer of Thor, that page wasn't found!</p>

<p class="error">
	<strong><?php echo __d('cake', 'Error'); ?>: </strong>
	<?php printf(
		__d('cake', 'The requested address %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	); ?>
</p>
<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
endif;
?>