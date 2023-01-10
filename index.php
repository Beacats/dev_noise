<?php wp_head(); ?>
<?php 
$this_category_group='emc_category';
$this_category_slug= array();

$this_category_slug=["ess", "ess-option","eps","eps-option", "vds" , "vds-option","lss","lss-option","atss","atss-option","swcs","swcs-option", "ins", "ins-option","fns","fns-option" ,"no-classification"];
$count = count($this_category_slug);
// echo $this_category_slug;
for ($i = 1; $i <= $count; $i++):
  $arry_num = $i - 1;
  
  $this_category_slug=["ess", "ess-option","eps","eps-option", "vds" , "vds-option","lss","lss-option","atss","atss-option","swcs","swcs-option", "ins", "ins-option","fns","fns-option" ,"no-classification"];
  $this_category = $this_category_slug[$arry_num];
  
   $args = array(
    'post_type' => 'emc',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
      array(
        'taxonomy' => $this_category_group,
        'terms' => $this_category,
        'field' => 'slug',
        'include_children' => false,
      ),
    ),
  );
  $terms_title = get_term_by('slug',$this_category , $this_category_group);

  echo "<h2>".$terms_title -> name."</h2>";
   $the_query = new WP_Query($args);
   if ($the_query->have_posts()):
    while ($the_query->have_posts()): $the_query->the_post(); 
    
    $terms = get_the_terms($post->ID, $this_category_group);
    foreach ($terms as $term) {
        $this_category = $term->name;
        $term_p = $term->parent;
    }
    $this_category_slug = $term->slug;
    
    $product_type = get_field('product_or_option');
    if($product_type === 'option') {
      $term_p_ob = get_term($term_p, $this_category_group);
      $this_category = $term_p_ob-> name;
      $this_category_slug = $term_p_ob-> slug;
      $option_category = get_field('option_category');
    }
    $this_category_option_slug = $this_category_slug.'-option';
    
    
    ?>
    <ul>
    <li>
                <a
                  href="<?php echo get_permalink($product_related); ?>" target='_blank'>
                  
                  <h4>
                  <span><?php echo $this_category ?>

<?php if($option_category) {
    echo'&nbsp';
    echo $option_category ;
}
?>
</span>
                    <?php echo the_field('product_title_main', $product_related); ?>
                  </h4>
                </a>
    </ul>


<?php endwhile; endif;?>
<?php endfor; ?>
<?php wp_reset_postdata();?>

<?php wp_footer(); ?>