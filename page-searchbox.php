<?php wp_head(); ?>
<?php
the_content();
?>

<?php
$input_count = 1;
?>
<div class="search_box">
    <?php // 検索用製品カテゴリチェックボックス START
    $emc_tag_terms = get_terms('emc_tag', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => false)); // 検索用製品カテゴリを全件取得
    if ($emc_tag_terms) :
    ?>
    <dl>
        <dt>検索用製品カテゴリ</dt>
        <dd>
            <?php foreach ($emc_tag_terms as $emc_tag_term) : ?>
            <div>
                <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" class="chk_search" value="<?php echo $emc_tag_term->slug; ?>" checked>
                <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_tag_term->name; ?></label>
            </div>
            <?php $input_count++; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用製品カテゴリチェックボックス END
    endif; ?>
    <?php // 検索用業界・産業チェックボックス START
    $emc_industry_terms = get_terms('emc_industry', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => false)); // 検索用業界・産業を全件取得
    if ($emc_industry_terms) :
    ?>
    <dl>
        <dt>検索用業界・産業</dt>
        <dd>
            <?php foreach ($emc_industry_terms as $emc_industry_term) : ?>
            <div>
                <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" class="chk_search" value="<?php echo $emc_industry_term->slug; ?>" checked>
                <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_industry_term->name; ?></label>
            </div>
            <?php $input_count++; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用業界・産業チェックボックス END
    endif; ?>
    <?php // 検索用試験規格チェックボックス START
    $emc_test_standard_tag_terms = get_terms('emc_test_standard_tag', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => false)); // 検索用試験規格を全件取得
    if ($emc_test_standard_tag_terms) :
    ?>
    <dl>
        <dt>検索用試験規格</dt>
        <dd>
            <?php foreach ($emc_test_standard_tag_terms as $emc_test_standard_tag_term) : ?>
                <?php // 子タームのみ表示
                if ($emc_test_standard_tag_term->parent) :
                ?>
                <div>
                    <input type="checkbox" id="check<?php echo $input_count; ?>" name="check<?php echo $input_count;?>" class="chk_search" value="<?php echo $emc_test_standard_tag_term->slug; ?>" checked>
                    <label for="check<?php echo $input_count; ?>"class="checkbox<?php echo $input_count; ?>"><?php echo $emc_test_standard_tag_term->name; ?></label>
                </div>
                <?php $input_count++; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </dd>
    </dl>
    <?php // 検索用試験規格チェックボックス END
    endif; ?>
</div>

<hr>

<div class="result_box">
<?php
$args = array(
    'post_status' => 'publish', // 公開記事が対象
    'post_type' => 'emc', // カスタム投稿slag
    'orderby' => 'date', // 日付を基準
    'order' => 'DESC' // 降順で表示
);
$search_products = new WP_Query($args); // 投稿を取得
if($search_products->have_posts()): // if 投稿があるか START
?>
<ul class="search_list">
<?php
while($search_products->have_posts()): $search_products->the_post(); // 繰り返し START
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
    if ($class_array) : // 検索用製品カテゴリ,検索用業界・産業,検索用試験規格のいずれかを持つか判定 START
    ?>
    <li class="<?php foreach ($class_array as $this_class) : echo $this_class; endforeach;?>">
        <?php echo the_field('product_title_main'); ?>
    </li>
    <?php // 検索用製品カテゴリ,検索用業界・産業,検索用試験規格のいずれかを持つか判定 END
    endif; ?>
<?php
endwhile; // 繰り返し END
?>
</ul>
<?php
endif; // if 投稿があるか END
wp_reset_postdata();
?>
</div>

<style>
    .search_box dl dd {
        display: flex;
        flex-wrap: wrap;
    }
    .hide {
        display: none;
    }
</style>

<script>
(function ($) {
    $('.chk_search').on('click',function () { // チェックボックスをクリック
        let arrs_type_remove = [];
        let arrs_type_add = [];
        $('[class="chk_search"]:not(:checked)').each(function () { // チェックボックスにチェックが入っていないval（class）を非表示用配列に格納
            arrs_type_remove.push($(this).val());
        });
        $('[class="chk_search"]:checked').each(function () { // チェックボックスにチェックが入っているval（class）を表示用配列に格納
            arrs_type_add.push($(this).val());
        });
        $('.search_list li').each(function () { // 一旦class.hideを削除
            $(this).removeClass('hide');
        });
        arrs_type_remove.forEach(function (val) { // 非表示用配列に存在するclassを持っている要素にclass.hideを追加
            $('.search_list li').each(function () {
                if ($(this).hasClass(val)) {
                    $(this).addClass('hide');
                }
            });
        });
        arrs_type_add.forEach(function (val) { // 表示用配列に存在するclassを持っている要素からclass.hideを削除
            $('.search_list li').each(function () {
                if ($(this).hasClass(val)) {
                    $(this).removeClass('hide');
                }
            });
        });
    });
})(jQuery);
</script>

<?php wp_footer(); ?>