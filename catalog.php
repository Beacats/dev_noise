<?php wp_head(); ?>
	<div class="catalog_section">
  <?php
           $relation_object = get_field('catalog_file');
           $catalog_books = get_field('catalog_book');
           foreach ( $catalog_books as  $catalog_book):
          $thumbnail_src;
          if(get_field('pdf_thumbnail')) {
              $thumbnail_src = get_field('pdf_thumbnail', $product_doc);
          } else {
            
            $pdf_id = $relation_object['id'];
            $thumbnail_id = get_post_thumbnail_id( $pdf_id );
            $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
          }
          ?>
    <?php echo do_shortcode('[dflip id="'.$catalog_book.'" type="thumb"][/dflip]'); 
    endforeach;
    ?>
    <span class='book_id' style='display:none;'><?php echo $catalog_book; ?></span>
    <span class='thumb_url' style='display:none;'><?php echo $thumbnail_src; ?></span>

  </div><!-- /.catalog_section -->

  <script
  src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.5.1.min.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/wookmark.min.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>


<?php wp_footer(); ?>
<script>
  jQuery(function($){
    let $catalog_book_id = $('.book_id').text();
    let $catalog_thumb_url = $('.thumb_url').text();

    $(`#df_${$catalog_book_id} ._df_book-cover`).css('backgroundImage',`url(${$catalog_thumb_url})`).removeClass('_df_thumb-not-found');
  });
</script>