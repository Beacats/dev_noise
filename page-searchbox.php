<?php wp_head(); ?>
<?php
the_content();
?>





<ul>
<?php
// global $post;
// $paged = get_query_var('page') ?: 1; //ページネーションを使いたいなら指定
$args = array(
    // 'paged' => $paged, //ページネーションを使いたいなら指定
    // 'posts_per_page' => 3, //３記事のみ出力
    'post_status' => 'publish', //公開の記事だけ
    'post_type' => 'emc', //カスタム投稿slag
    'orderby' => 'date', //日付を出力する基準
    'order' => 'DESC' //表示する順番（逆はASC）

);
$search_products = get_posts($args);
if ($search_products) : foreach ($search_products as $post) : setup_postdata($post); // 繰り返し START
?>

        <!-- ここにループさせたい内容を書く -->
<?php

    $class_array = array(); // class用の配列を定義
    $emc_tag_raw = get_the_terms($post->ID, 'emc_tag'); // 検索用製品カテゴリを取得
    $emc_industry_raw = get_the_terms($post->ID, 'emc_industry'); // 検索用業界・産業を取得
    $emc_test_standard_tag_raw = get_the_terms($post->ID, 'emc_test_standard_tag'); // 検索用試験規格を取得

    if ($emc_tag_raw) : // 検索用製品カテゴリが存在していれば$class_arrayに追加
        foreach ($emc_tag_raw as $emc_tag) {
            $emc_tag_name = 'msd'. $emc_tag->name;
            array_push($class_array, $emc_tag_name);
        }
    endif;
    if ($emc_industry_raw) : // 検索用業界・産業が存在していれば$class_arrayに追加
        foreach ($emc_industry_raw as $emc_industry) {
            $emc_industry_name = 'msd'. $emc_industry->name;
            array_push($class_array, $emc_industry_name);
        }
    endif;
    if ($emc_test_standard_tag_raw) : // 検索用試験規格が存在していれば$class_arrayに追加
        foreach ($emc_test_standard_tag_raw as $emc_test_standard_tag) {
            $emc_test_standard_tag_name = 'msd'. $emc_test_standard_tag->name;
            array_push($class_array, $emc_test_standard_tag_name);
        }
    endif;
    
    
    
    if ($emc_tag_raw || $emc_industry_raw || $emc_test_standard_tag_raw) : // 検索用製品カテゴリ,検索用業界・産業,検索用試験規格のいずれかを持つか判定
        // 検索用タグを持つ場合
        echo the_field('product_title_main');
        ?>
        <li class='<?php
        foreach ($class_array as $kono_class):
        echo $kono_class;
        ?> <?php
        endforeach;
        ?>'>
        <?php
    else:
        // 検索用タグを持たない場合
        echo '検索タグがありません';
    endif;
// foreach( $terms as $term ) {
// echo '<li>'.$term->name.'</li>';
// }
?>


 
    <?php endforeach; // 繰り返し END
    ?>
</ul>

<?php else : // 対象の投稿が無い場合
?>
    <div class="result">
        <p>記事がまだありません</p>
    </div>

<?php // if終了
endif; ?>




<?php wp_footer(); ?>