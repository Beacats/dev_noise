<?php
function my_add_filter() {
  global $post_type;
  if ( 'emc' == $post_type ) {
?>
    <select name="emc_category">
      <option value="">タクソノミー指定なし</option>
<?php
      $terms = get_terms('emc_category');
      foreach ($terms as $term) { ?>
        <option value="<?php echo $term->slug; ?>" <?php if ( $_GET['emc_category'] == $term->slug ) { print 'selected'; } ?>><?php echo $term->name; ?></option>
<?php
      }
?>
    </select>
<?php
  }elseif('rfsys' == $post_type){
    ?>
        <select name="rfsys_category">
          <option value="">タクソノミー指定なし</option>
    <?php
          $terms = get_terms('rfsys_category');
          foreach ($terms as $term) { ?>
            <option value="<?php echo $term->slug; ?>" <?php if ( $_GET['rfsys_category'] == $term->slug ) { print 'selected'; } ?>><?php echo $term->name; ?></option>
    <?php
          }
    ?>
        </select>
    <?php
      }
}
add_action( 'restrict_manage_posts', 'my_add_filter' );
?>