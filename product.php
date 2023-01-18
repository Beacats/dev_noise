<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="<?php echo get_template_directory_uri(); ?>/style.css">
  <link rel="stylesheet"
    href="<?php echo get_template_directory_uri(); ?>/css/import.css">
  <title><?php the_title(); ?></title>
</head>
<?php wp_head(); ?>


<body class="product-child">
  <header>

  </header>
  <?php $status_A = get_field('title-summary-image_display_pattern');?>
  <?php $add_className; ?>
  <?php if($status_A == 'pattern_is_column'):
      $add_className = 'display_column';
  endif;
    ?>





  <section class="product-child_mv <?php echo $add_className; ?>">
    <div class="container column">
      <div class="title_content ">
        <?php
    $this_category; // 製品カテゴリー名
    $this_category_slug;// 製品カテゴリースラッグ
    $exclude_id = get_the_ID(); //この投稿のID
    $this_post_type =get_post_type_object(get_post_type())->name;//カスタム投稿名
    $option_category;//オプション品カテゴリー
    $this_category_group;
    $product_type = get_field('product_or_option');
    if (is_singular('emc')) {
       //静電気試験機
        $this_category_group = 'emc_category';//カテゴリータクソノミースラッグ
    } elseif(is_singular('rfsys')) {
        $this_category_group = 'rfsys_category';//カテゴリータクソノミースラッグ
    } elseif(is_singular('emc-test-serv')) {
        $this_category_group = 'emc-test-serv_category';//カテゴリータクソノミースラッグ
    }



    $terms = get_the_terms($post->ID, $this_category_group);
    foreach ($terms as $term) {
        $this_category = $term->name;
        $term_p = $term->parent;
    }
    $this_category_slug = $term->slug;


    if($product_type === 'option') {
        $term_p_ob = get_term($term_p, $this_category_group);
        $this_category = $term_p_ob-> name;
        $this_category_slug = $term_p_ob-> slug;
        $option_category = get_field('option_category');
    }
    $this_category_option_slug = $this_category_slug.'-option';

    ?>

        <p><?php echo $this_category ?>

          <?php if($option_category) {
              echo'&nbsp';
              echo $option_category ;
          }
    ?>
        </p>
        <h1>
          <?php echo the_field('product_title_main'); ?>
        </h1>
      </div><!-- /.title_content -->

      <div class="description_content">
        <?php // サマリータイトルを表示する start?>
        <?php if (get_post_meta($post->ID, 'product_summary_title', true)) : ?>
        <h2>
          <?php echo the_field('product_summary_title'); ?>
        </h2>
        <?php else : ?>
        <?php // 値が存在しなかった場合?>
        <?php endif; ?>
        <?php // サマリータイトルを表示する end?>

        <?php if (get_post_meta($post->ID, 'product_summary_text', true)) : ?>
        <p>
          <?php echo the_field('product_summary_text'); ?>
        </p>
        <?php else : ?>
        <?php // 値が存在しなかった場合?>
        <?php endif; ?>
        <?php // サマリーテキストを表示する end?>
      </div><!-- /.description_content -->

      <div class="img_content">
        <?php $product_image = get_field('product_image');
        if ($product_image) :  ?>

        <figure>
          <img
            src="<?php echo $product_image['url']; ?>"
            alt="<?php echo $product_image['alt']; ?>">
        </figure>

        <?php endif; ?>
        <?php // 画像を表示する end?>
      </div><!-- /.img_conent -->

    </div><!-- /.container -->
  </section><!-- /.product-child_mv -->



  <nav class="product-child_pageNav">
    <div class="container">
      <ul>
        <!-- 表示されているものをJqueryで自動生成 -->
        <!-- <li><a href="#">特徴</a></li>-->
      </ul>
    </div><!-- /.container -->
  </nav>

  <?php
 $product_tile = SCF::get('product_tile');
    $product_one_column = SCF::get('product_one-column');

    if (get_post_meta($post->ID, 'product_movie', true) || get_post_meta($post->ID, 'product_tile_title', true) || get_post_meta($post->ID, 'product_one-column_detail', true)): ?>
  <section class=" nav_item characteristics" id="characteristics">
    <h3>特徴</h3>
    <?php if (get_post_meta($post->ID, 'product_movie', true)) : ?>
    <div class="youtube_content_innerBox">
      <div class="youtube_content">
        <!-- youtubeの動画IDからサムネイルを取得、動画の視聴は別タブ（ポップアップにて） -->
        <a href="javascript:void(0);" onclick="openWin()" class="imgBox">
          <img
            src="http://img.youtube.com/vi/<?php echo SCF::get('product_movie'); ?>/maxresdefault.jpg"
            alt="">
          <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
              d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
          </svg>
        </a>
      </div><!-- /.youtube_content -->
    </div><!-- /.innerBox -->
    <?php endif; ?>

    <div class="characteristics_content">
      <?php
         $status_B = SCF::get('product_display_pattern');
        if($status_B == 'pattern_is_tile'):
            ?>
      <!-- タイル表示 -->

      <ul class='tile_wrapper'>
        <?php
                 foreach ($product_tile as $tile_item) :
                     $status_C = $tile_item['product_tile_layout'];

                     ?>
        <li>
          <div class="excerpt_content <?php echo $status_C ?>">
            <h4>
              <?php echo $tile_item['product_tile_title'] ?>
            </h4>

            <?php
              if ($tile_item['product_tile_image']):
                  $imgurl = wp_get_attachment_image_src($tile_item['product_tile_image'], 'full');  ?>
            <img src="<?php echo $imgurl[0]; ?>" alt="製品画像">
            <?php endif; ?>
            <?php
                    if ($tile_item['product_tile_summary']):?>
            <p>
              <?php echo $tile_item['product_tile_summary'] ?>
            </p>
            <?php endif;?>

          </div><!-- /.excerpt_content -->

          <!-- ポップアップ -->
          <div class="detail_content">
            <div class="detail_content_innreBox">
              <h4 class="product_title">
                <?php echo $tile_item['product_tile_title'] ?>
              </h4>
              <!-- テキストエディターを表示 -->
              <?php echo apply_filters('the_content', $tile_item['product_tile_detail']); ?>

            </div><!-- /.detail_content_innreBox -->
          </div><!-- /.detail_content -->

        </li>

        <?php endforeach;?>
      </ul>
      <!-- ワンカラム -->
      <?php elseif($status_B == 'pattern_is_one-column'): ?>
      <?php
          $oneColumn = SCF::get('product_one-column');
          foreach ($oneColumn as $fields):
              ?>
      <div class="one-column_detail container">
        <?php echo apply_filters('the_content', $fields['product_one-column_detail']); ?>
      </div>
      <?php endforeach; ?>

      <?php endif; ?>
    </div><!-- /.characteristics_content -->


    <div class="characteristics_popup">
      <div class="popup_innreBox">
        <div class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
              d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z" />
          </svg></div>
      </div><!-- /.detail_content_innreBox -->
    </div><!-- /.characteristics_popup -->
  </section><!-- /.characteristics -->
  <?php endif; ?>

  <?php if (get_post_meta($post->ID, 'product_case_study', true)) : ?>
  <section class=" nav_item case-study" id="case-study">
    <h3>活用事例</h3>
    <div class="purpose_list_content">
      <ul class="purpose_list">
        <li>
          <a href="#">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/Group 14.png"
              alt="">
            <p>活用事例</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/Group 14.png"
              alt="">
            <p>活用事例</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/Group 14.png"
              alt="">
            <p>活用事例</p>
          </a>
        </li>
      </ul>
    </div><!-- /.purpose_list_content -->
  </section><!-- /#case-study.case-study -->
  <?php endif; ?>

  <?php if (get_post_meta($post->ID, 'product_spec_annotation', true)) : ?>
  <section class=" nav_item specifications" id="specifications">
    <h3 style="display:none;">仕様詳細</h3>

    <div class="detail_content specifications_detail_content">
      <?php echo apply_filters('the_content', scf::get('product_spec_annotation')); ?>
    </div><!-- /.specifications_detail_content -->
  </section><!-- /#specifications.specifications -->
  <?php endif; ?>


  <section class="contact_section" id="contact_section">
    <h3>お問合せ</h3>
  </section><!-- /.contact_section -->


  <?php


    $tax_name =  $this_category_group; //タクソノミー指定
    $term_slug = $this_category_slug; //親タームslug指定
    $termsparent = get_terms($tax_name, array('slug' => $term_slug)); //親ターム情報取得
    $termchildren = get_terms($tax_name, array('parent' => $termsparent[0]->term_id)); //子ターム情報取得
    $option_categorys = SCF::get('select_option_cat');
    foreach ($termchildren as $termchild):
        $termchild_slug = $termchild->slug;
    endforeach;
    $args = array(
      'post_type' => $this_post_type,
      'posts_per_page' => -1,
      'order' => 'ASC',
      "post__not_in" => [$exclude_id], // 除外する記事のIDを指定
      'tax_query' => array(
        array(
          'taxonomy' => $this_category_group,
          'terms' => array($this_category_option_slug),
          'field' => 'slug',
          'include_children' => false,
        ),
      ),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts() && $termchild_slug) :?>
  <section class="nav_item product_options" id="product_options">

    <?php  if($product_type === 'option'): ?>
    <h3><?php echo $this_category; ?> オプション品</h3>
    <?php else: ?>
    <h3>オプション</h3>
    <?php endif ?>
    <div class="product_options_content">
      <div id="tabArea">


        <?php
 // オプション品カテゴリー表示
    $optionNum = 1;
    $related_option_title = array();
    while ($the_query->have_posts()): $the_query->the_post();
        $this_terms = get_the_terms($post->ID, $this_category_group);
        $this_termsSlug = $this_terms[0]->slug;

        if($this_termsSlug === $termchild_slug):
            // 表示するオプションに限定があるが場合
            if($option_categorys):
                foreach($option_categorys as $option_category):
                    if(!in_array($option_category, $related_option_title)):
                        array_push($related_option_title, $option_category);
                        ?>
        <input type="radio" name="tab"
          id="tab<?php echo $optionNum ?>"
          data-num="tabBody<?php echo $optionNum ?>">
        <label
          for="tab<?php echo $optionNum ?>"><?php echo $option_category ; ?></label>


        <?php
                        $optionNum++;
                    endif;
                endforeach;
            else:
                // 表示するオプションに限定がない
                $option_category = get_field('option_category');
                if(!in_array($option_category, $related_option_title)):
                    array_push($related_option_title, $option_category);

                    ?>

        <input type="radio" name="tab"
          id="tab<?php echo $optionNum ?>"
          data-num="tabBody<?php echo $optionNum ?>">
        <label
          for="tab<?php echo $optionNum ?>"><?php echo $option_category ; ?></label>
        <?php endif; ?>
        <?php $optionNum++; ?>


        <?php endif; ?>
        <?php endif; ?>

        <?php endwhile; ?>
        <?php endif;?>
        <?php wp_reset_postdata();



    if($related_option_title) {
        $count = count($related_option_title);
    }
    // オプション品製品表示
    $args = array(
      'post_type' => $this_post_type,
      'posts_per_page' => -1,
      'order' => 'ASC',
      "post__not_in" => [$exclude_id], // 除外する記事のIDを指定
      'tax_query' => array(
        array(
          'taxonomy' => $this_category_group,
          'terms' => array($this_category_option_slug),
          'field' => 'slug',
          'include_children' => false,
        ),
      ),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()):
        for ($i = 1; $i <= $count; $i++):
            $arry_num = $i - 1;
            $related_cat = $related_option_title[$arry_num];
            ?>

        <div class="tabBody tabBody<?php echo $i?>">
          <ul class="purpose_list">
            <?php while ($the_query->have_posts()): $the_query->the_post();
                $option_category = get_field('option_category');

                $kono_post_id = get_the_ID();
                if($related_cat === $option_category && $kono_post_id !== $exclude_id):

                    ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php $product_image = get_field('product_image');
                if ($product_image) :  ?>

                <figure>
                  <img
                    src="<?php echo $product_image['url']; ?>"
                    alt="<?php echo $product_image['alt']; ?>">
                </figure>

                <?php endif; ?>
                <p>
                  <?php echo the_field('product_title_main'); ?>
                </p>
              </a>
            </li>

            <?php
                endif;
                ?>
            <?php endwhile; ?>

          </ul>
        </div>
        <?php
        endfor;
    endif;

    ?>
        <?php wp_reset_postdata();?>


      </div>
    </div><!-- /.product_options_content -->
  </section><!-- /#product_options.product_options -->

  <?php if (get_field('product_docs_a') ||get_field('software_link') || get_field('manual_link')) : ?>
  <section class="nav_item this_product_catalog" id="this_product_catalog">
    <?php  if (get_field('product_docs_a')):?>
    <div class='this_product_catalog_innerBox catalog_list '>
      <h3 class='section_title'>カタログ・技術資料</h3>
      <ul class="purpose_list">
        <?php
       
        $product_docs = get_field('product_docs_a');
      foreach($product_docs as $product_doc) :
        $relation_object = get_field('catalog_file' ,$product_doc);
          ?>
        <li>
          <a href="<?php echo get_permalink($product_doc); ?>"
            target="_blank">
            <?php
                $thumbnail_src;
          if(get_field('pdf_thumbnail', $product_doc)) {
              $thumbnail_src = get_field('pdf_thumbnail', $product_doc);
          } else {
            
            $pdf_id = $relation_object['id'];
            // $pdfurl = wp_get_attachment_url($pdf_id);
           
            $thumbnail_id = get_post_thumbnail_id( $pdf_id );
            $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
          }
          ?>
            <img src="<?php echo $thumbnail_src;?>" alt="">
            <p class="catalog_title">
              <?php echo get_post($product_doc)->post_title;  ?>
            </p>
            <p class="more">資料を読む</p>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    

    <?php 
    endif;
    if(get_field('software_link')): ?>
    <div class='this_product_catalog_innerBox soft_file'>
      <h3>ソフトウエア</h3>
      <ul class="purpose_list software_list">
        <?php
        $software_link = get_field('software_link');
        foreach($software_link as $software) :

            ?>
        <li>
          <a href="<?php echo get_field('d3downloads_file', $software); ?>"
            target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/img/zip.png" alt="">
            <p class="catalog_title">
              <?php echo get_post($software)->post_title;  ?>
            </p>
            <p>
              <?php echo get_field('d3downloads_text', $software) ?>
            </p>
            <p class="more">ダウンロード</p>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php endif;
    if(get_field('manual_link')): ?>

    <div class='this_product_catalog_innerBox user-manual'>
      <h3>取扱説明書</h3>
      <ul class="purpose_list manual_list">
        <?php
            $manual_link = get_field('manual_link');
        foreach($manual_link as $manual) :
          $relation_object = get_field('myalbum' ,$manual);
            ?>
        <li>
          <a href="<?php echo $relation_object['url']; ?>"
            target="_blank">
            <?php
                   $pdf_id = $relation_object['id'];
                   $thumbnail_id = get_post_thumbnail_id( $pdf_id );
                   $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
            ?>
            <img src="<?php echo $thumbnail_src;?>" alt="">
            <p class="catalog_title">
              <?php echo get_post($manual)->post_title;  ?>
            </p>
            <p class="more">ダウンロード</p>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php endif; ?>
    <?php

    if(get_field('product_docs_a')||get_field('software_link') || get_field('manual_link')):

        ?>

    <div class="contentBox container">
      
      <?php
    endif;
    if (get_field('product_docs_a')):?>  

    <div  id='catalog_list'>
      <h3>カタログ・技術資料</h3>
    </div>
    <?php
    endif;
    $software_link = get_field('software_link');
    if($software_link):
        ?>
      <div class="nav_item" id="soft_file">
        <h3 class='section_title'>ソフトウエア</h3>
      </div>


      <?php endif; ?>
      <?php
         $manual_link = get_field('manual_link');
    if($manual_link):
        ?>
      <div class="nav_item" id="user-manual">
        <h3 class='section_title'>取扱説明書</h3>
      </div>
        <?php endif; ?>

        <?php if(get_field('product_docs_a') || get_field('software_link') || get_field('manual_link')) {
            echo"</div><!-- /.contentBox -->";
        } ?>
  </section><!-- /#this_product_catalog.this_product_catalog -->
  <?php endif; ?>





  <?php

          $args = array(
            'post_type' => $this_post_type,
            'posts_per_page' => -1,
            'order' => 'DESC',
            "post__not_in" => [$exclude_id], // 除外する記事のIDを指定
            'tax_query' => array(
              array(
                'taxonomy' => $this_category_group,
                'terms' => array($this_category_slug),
                'field' => 'slug',
                'include_children' => false,
              ),
            ),
          );
    $the_query = new WP_Query($args);
    ?>
  <?php if ($the_query->have_posts() || get_post_meta($post->ID, 'product_related', true)): ?>


  <section class="related_products">
    <?php  if($product_type === 'option'): ?>
    <h3><?php echo $this_category; ?></h3>

    <?php else: ?>
    <h3>関連製品</h3>
    <?php endif ?>
    <article>
      <ul class="purpose_list">
        <?php while ($the_query->have_posts()): $the_query->the_post();  ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php $product_image = get_field('product_image');
            if ($product_image) :  ?>

            <figure>
              <img
                src="<?php echo $product_image['url']; ?>"
                alt="<?php echo $product_image['alt']; ?>">
            </figure>

            <?php endif; ?>
            <h4>
              <?php echo the_field('product_title_main'); ?>
            </h4>

            <p class="text">
              <?php echo SCF::get('product_summary_title'); ?>
            </p>
            <p class="more">詳しくはこちら</p>
          </a>
        </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata();?>

        <?php if(get_post_meta($post->ID, 'product_related', true)):
            $products_related = SCF::get('product_related');
            foreach ($products_related as  $product_related):

                ?>
        <li>
          <a href="<?php echo get_permalink($product_related); ?>">
            <?php $product_image = get_field('product_image', $product_related);
            if ($product_image) :  ?>

            <figure>
              <img
                src="<?php echo $product_image['url']; ?>"
                alt="<?php echo $product_image['alt']; ?>">
            </figure>

            <?php endif; ?>
            <h4>
              <?php echo the_field('product_title_main', $product_related); ?>
            </h4>

            <p class="text">
              <?php echo the_field('product_summary_title', $product_related); ?>
            </p>
            <p class="more">詳しくはこちら</p>
          </a>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </article>
  </section><!-- /.related_products -->
  <?php endif;?>

  <?php 
  $seminar_contents = SCF::get('seminar_contents');
  if (!empty($seminar_contents[0]['seminar_youtube_id'])) : 
  ?>
  <section class='seminar_move'>
    <h3>セミナー動画</h3>
    <div class="purpose_list_content">
      <ul class="purpose_list">
        <?php 
        foreach ($seminar_contents as $seminar_content) :
          $video_url = 'https://www.youtube.com/watch?v='.$seminar_content['seminar_youtube_id'];
          $oembed_url = "https://www.youtube.com/oembed?url={$video_url}&format=json";
          $ch = curl_init( $oembed_url );
          curl_setopt_array( $ch, [CURLOPT_RETURNTRANSFER => 1] );
          $resp = curl_exec( $ch );
           
          $metas = json_decode( $resp, true );
        ?>
        <li>
          <a href="javascript:void(0);" >
          <img
            src="http://img.youtube.com/vi/<?php echo  $seminar_content['seminar_youtube_id']; ?>/maxresdefault.jpg"
            alt="">
            <p><?php echo $metas['title'];?></p>
          </a>
          <p class='youtube_url' style='display:none;'><?php echo $video_url; ?></p>
        </li>
        <?php endforeach;?>
      </ul>
    </div><!-- /.purpose_list_content -->
  
</section>
<?php endif; ?>







</body>
<p id='youtubeId' style='display:none;'><?php echo SCF::get('product_movie'); ?></p>
<script
  src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.5.1.min.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/wookmark.min.js">
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<script>
  var textMsg = document.getElementById('youtubeId');
  var textMsgtext = textMsg.textContent;

  function openWin() {
    console.log(textMsgtext);
    resizable = window.open(`https://www.youtube.com/watch?v=${textMsgtext}`, "ノイズ研究所",
      "width=820,height=600,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
    resizable.focus();
  }


 
</script>
<?php wp_footer(); ?>

</html>