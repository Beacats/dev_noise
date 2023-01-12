<?php if (is_singular(array('emc', 'rfsys', 'emc-test-serv'))):?>
	<?php get_template_part('product'); ?>

<?php elseif(is_singular('catalog')): ?>
	<?php get_template_part('catalog'); ?>

	
<?php endif; ?>

