<?php if (is_singular(array('emc', 'rfsys', 'emc-test-serv'))):?>
	<?php get_template_part('product'); ?>

<?php elseif(is_singular('catalog')): ?>
	<?php wp_head(); ?>
	
	<?php 
		echo do_shortcode('[dflip id="43"][/dflip]'); 
		?>
		<?php wp_footer(); ?>
<?php endif; ?>

