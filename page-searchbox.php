<?php wp_head(); ?>
<?php
the_content();
?>


<?php
$input_count = 1;
?>

<div class="search_box">

    <?php // 検索用製品カテゴリチェックボックス START
    $emc_tag_terms = get_terms('emc_tag'); // 検索用製品カテゴリを取得
    if ($emc_tag_terms) :
    ?>
    <dl>
        <dt>検索用製品カテゴリ</dt>
        <dd>
            <?php foreach ($emc_tag_terms as $emc_tag_term) : ?>
            <div class="type">
                <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" value="type_<?php echo $emc_tag_term->slug; ?>">
                <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_tag_term->name; ?></label>
            </div>
            <?php $input_count++; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用製品カテゴリチェックボックス END
    endif; ?>

    <?php // 検索用業界・産業チェックボックス START
    $emc_industry_terms = get_terms('emc_industry'); // 検索用業界・産業を取得
    if ($emc_industry_terms) :
    ?>
    <dl>
        <dt>検索用業界・産業</dt>
        <dd>
            <?php foreach ($emc_industry_terms as $emc_industry_term) : ?>
            <div class="type">
                <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" value="type_<?php echo $emc_industry_term->slug; ?>">
                <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_industry_term->name; ?></label>
            </div>
            <?php $input_count++; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用業界・産業チェックボックス END
    endif; ?>

    <?php // 検索用試験規格チェックボックス START
    $emc_test_standard_tag_terms = get_terms('emc_test_standard_tag'); // 検索用試験規格を取得
    if ($emc_test_standard_tag_terms) :
    ?>
    <dl>
        <dt>検索用試験規格</dt>
        <dd>
            <?php foreach ($emc_test_standard_tag_terms as $emc_test_standard_tag_term) : ?>
            <div class="type">
                <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" value="type_<?php echo $emc_test_standard_tag_term->slug; ?>">
                <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_test_standard_tag_term->name; ?></label>
            </div>
            <?php $input_count++; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用試験規格チェックボックス END
    endif; ?>



</div>





<ul class="search_list">
<?php
$args = array(
    'post_status' => 'publish', // 公開記事が対象
    'post_type' => 'emc', // カスタム投稿slag
    'orderby' => 'date', // 日付を基準
    'order' => 'DESC' // 降順で表示
);
$search_products = get_posts($args);
if ($search_products) : foreach ($search_products as $post) : setup_postdata($post); // 繰り返し START
?>


<?php

    $class_array = array(); // class用の配列を定義
    $emc_tags = get_the_terms($post->ID, 'emc_tag'); // 検索用製品カテゴリを取得
    $emc_industry_tags = get_the_terms($post->ID, 'emc_industry'); // 検索用業界・産業を取得
    $emc_test_standard_tags = get_the_terms($post->ID, 'emc_test_standard_tag'); // 検索用試験規格を取得

    if ($emc_tags) : // 検索用製品カテゴリが存在していれば$class_arrayに追加
        foreach ($emc_tags as $emc_tag) {
            $emc_tag_name = $emc_tag->slug . ' ';
            array_push($class_array, $emc_tag_name);
        }
    endif;
    if ($emc_industry_tags) : // 検索用業界・産業が存在していれば$class_arrayに追加
        foreach ($emc_industry_tags as $emc_industry) {
            $emc_industry_name = $emc_industry->slug . ' ';
            array_push($class_array, $emc_industry_name);
        }
    endif;
    if ($emc_test_standard_tags) : // 検索用試験規格が存在していれば$class_arrayに追加
        foreach ($emc_test_standard_tags as $emc_test_standard_tag) {
            $emc_test_standard_tag_name = $emc_test_standard_tag->slug . ' ';
            array_push($class_array, $emc_test_standard_tag_name);
        }
    endif;

    if ($class_array) : // 検索用製品カテゴリ,検索用業界・産業,検索用試験規格のいずれかを持つか判定
        // 検索用タグを持つ場合
        ?>
        <li class="<?php foreach ($class_array as $this_class) : echo $this_class; endforeach;?>">
        <?php echo the_field('product_title_main'); ?>
        </li>
        <?php
    else:
        // 検索用タグを持たない場合
        echo '検索タグがありません';
    endif;

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