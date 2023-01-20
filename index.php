<?php wp_head(); ?>
<style>
  ul,
  p,
  li {
    display: inline;
  }

  ul {
    list-style: inside;
    display: inline-block;
  }

  li {
    list-style: inside;

  }
</style>

<h2>EMC試験機</h2>
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
    $terms_title = get_term_by('slug', $this_category, $this_category_group);?>


<?php echo "<h3 style='font-weight:400;'>".$terms_title -> name."</h3>";
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
    <a href="<?php echo get_permalink($product_related); ?>"
      target='_blank'>

      <p>
        <span><?php echo $this_category ?>

          <?php if($option_category) {
              echo'&nbsp';
              echo $option_category ;
          }
            ?>
        </span>
        <?php echo the_field('product_title_main', $product_related); ?>
      </p>
    </a>
  </li>
</ul>


<?php endwhile; endif;?>
<?php endfor; ?>
<?php wp_reset_postdata();?>

<h2>RF関連製品・試験システム</h2>
<?php
            $this_category_group='rfsys_category';
$this_category_slug= array();

$this_category_slug=["rf-products", "immunity-test-system","emission-measurement-system","shield-room", "emcsys-ae" , "vds-option","lss","lss-option","atss","atss-option","swcs","anechoic-chamber"];
$count = count($this_category_slug);
// echo $this_category_slug;
for ($i = 1; $i <= $count; $i++):
    $arry_num = $i - 1;

    $this_category_slug=["rf-products", "immunity-test-system","emission-measurement-system","shield-room", "emcsys-ae" , "vds-option","lss","lss-option","atss","atss-option","swcs","anechoic-chamber"];
    $this_category = $this_category_slug[$arry_num];

    $args = array(
     'post_type' => 'rfsys',
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
    $terms_title = get_term_by('slug', $this_category, $this_category_group);

    echo "<h3 style='font-weight:400;'>".$terms_title -> name."</h3>";
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
    <a href="<?php echo get_permalink($product_related); ?>"
      target='_blank'>

      <p>
        <span><?php echo $this_category ?>


        </span>
        <?php echo the_field('product_title_main', $product_related); ?>
      </p>
    </a>
  </li>
</ul>


<?php endwhile; endif;?>
<?php endfor; ?>
<?php wp_reset_postdata();?>

<h2>EMC試験サービス</h2>
<?php
$this_category_group='emc-test-serv_category';
$this_category_slug= array();

$this_category_slug=["test-lab-funabashi", "emc-test-serv"];
$count = count($this_category_slug);
// echo $this_category_slug;
for ($i = 1; $i <= $count; $i++):
    $arry_num = $i - 1;

    $this_category_slug=["test-lab-funabashi", "emc-test-serv"];
    $this_category = $this_category_slug[$arry_num];

    $args = array(
     'post_type' => 'emc-test-serv',
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
    $terms_title = get_term_by('slug', $this_category, $this_category_group);

    echo "<h3 style='font-weight:400;'>".$terms_title -> name."</h3>";
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
    <a href="<?php echo get_permalink($product_related); ?>"
      target='_blank'>

      <p>
        <span><?php echo $this_category ?>


        </span>
        <?php echo the_field('product_title_main', $product_related); ?>
      </p>
    </a>
  </li>
</ul>


<?php endwhile; endif;?>
<?php endfor; ?>
<?php wp_reset_postdata();?>

<?php wp_footer(); ?>