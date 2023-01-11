<?php
function my_admin_script(){
  
  // jQuery のコードだった場合
  wp_enqueue_script( 'my_admin_script', get_template_directory_uri().'/js/my_admin_script.js', array('jquery'));
   
}
add_action( 'admin_enqueue_scripts', 'my_admin_script' );



/*	カスタム投稿のパーマリンク設定
-----------------------------------------------------*/
//パーマリンクからタクソノミー名を削除
function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy){
  return str_replace('/'.$taxonomy.'/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set',11,3);

//リライトルールの追加	
//★それぞれownersblogはカスタム投稿タイプ名、emc_categoryはカスタムタクソノミー名を挿入

//↓カスタム投稿タイプの一覧ページ
add_rewrite_rule('emc/page/([0-9]+)/?$', 'index.php?post_type=emc&paged=$matches[1]', 'top');
add_rewrite_rule('emc/page/([0-9]+)/?$', 'index.php?post_type=emc&paged=$matches[1]', 'top');

//↓親タームに属する記事ページ
add_rewrite_rule('emc/([^/]+)/([0-9]+)/?$', 'index.php?post_type=emc&p=$matches[2]', 'top');

//↓親ターム一覧ページ
add_rewrite_rule('emc/([^/]+)/?$', 'index.php?emc_category=$matches[1]', 'top');
add_rewrite_rule('emc/([^/]+)/page/([0-9]+)/?$', 'index.php?emc_category=$matches[1]&paged=$matches[2]', 'top');

//↓子ターム一覧ページ
add_rewrite_rule('emc/([^/]+)/([^/]+)/?$', 'index.php?emc_category=$matches[2]', 'top');
add_rewrite_rule('emc/([^/]+)/([^/]+)/page/([0-9]+)/?$', 'index.php?emc_category=$matches[1]&paged=$matches[2]', 'top');
   

/*	タクソノミー未選択公開時にデフォルトで特定のタームを選択させる
-----------------------------------------------------*/
function add_defaulttaxonomy($post_ID) {
 global $wpdb;
 //カスタム分類のタームを取得
 $curTerm = wp_get_object_terms($post_ID, 'emc_category');//★カスタムタクソノミー名
 //ターム指定数が未設定の時に特定のタームを指定
 if (0 == count($curTerm)) {
   $defaultTerm= array(1);//★選択させたいタームID
   wp_set_object_terms($post_ID, $defaultTerm, 'emc_category');//★カスタムタクソノミー名
 }
}
//カスタム投稿
add_action('publish_emc', 'add_defaulttaxonomy');//★publish_カスタム投稿タイプ名




// 記事の抽出
function get_child_pages($number = -1, $spacified_id = null, $cat_name = null, $type = 'post', $order = 'ASC', $orderby = null, $exclude_id = 49)
{
    if (isset($spacified_id)) :
        $parent_id = $spacified_id;
    else :
        $parent_id = get_the_ID();
    endif;
    $args = array(

        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $number,
        'post_type'  => $type,
        'post_perent' => $parent_id,
        'category_name' => $cat_name, // 表示したいカテゴリーのスラッグを指定
        "post__not_in"  => array($exclude_id),//除外する記事
    );

    $child_pages = new WP_Query($args);
    return $child_pages;
}


// フロセンさん作業分
// Contact Form 7読み込み制限
function wpcf7_file_control() {
  if(!is_page('form')) {
      wp_dequeue_style('contact-form-7');
      wp_dequeue_script('contact-form-7');
  }
}
add_action('wp_enqueue_scripts', 'wpcf7_file_control');

// 管理画面用CSS・JSの読み込み
function add_admin_style()
{
  wp_enqueue_style('admin-style', get_stylesheet_directory_uri() . '/css/admin.css');
  wp_enqueue_script('admin-script', get_stylesheet_directory_uri() . '/js/admin.js', '', '', true);
}
add_action('admin_enqueue_scripts', 'add_admin_style');

// テーマ用CSSの読み込み
function theme_enqueue_styles()
{
  wp_enqueue_script('jquery'); // jQueryの読み込み
  wp_enqueue_style('lity-style', get_stylesheet_directory_uri() . '/css/lity.min.css'); // Lity（モーダル）スタイル
  wp_enqueue_script('lity-script', get_stylesheet_directory_uri() . '/js/lity.min.js'); // Lity（モーダル）スクリプト
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/css/style.css'); // 独自スタイル

  // formページのみ読み込み
  if ( is_page( 'form' ) ) {
      wp_enqueue_script('catalog-auth-script', get_stylesheet_directory_uri() . '/js/catalog-auth.js'); // カタログ認証スクリプト
  }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// カタログ閲覧判定
function catalog_auth() {
  // 管理者は対象外とする
  if ( !current_user_can( 'administrator' ) ) {
      // catalogページのみ実行
      if ( is_singular( 'catalog' ) ) { // カタログ・技術資料の投稿タイプで判定
        // アクセスしたページのURLを取得
        $this_url = preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', get_permalink());
          if(isset($_COOKIE['noisekenInfo_completed'])) {
              // Cookieを保持→閲覧可能
          } else {
              // Cookieを未保持
              if (date_default_timezone_get() != 'Asia/Tokyo') { // タイムゾーンが東京ではない場合は東京に設定
                  date_default_timezone_set('Asia/Tokyo');
              }
              if (isset($_GET['viewable'])) {
                  // パラメータviewableを保持
                  $viewable = $_GET['viewable'];
                  $unix = mktime(0,0,0,date('m'),date('d'),date('Y')) * 1000; // Unixタイム取得とJSのgetTimeと桁数を合わせる
                  if ($viewable == $unix) {
                      // パラメータとUnixが一致する→閲覧可能
                      // hrefの値にパラメータ追記
                      ?>
                      <script>
                          document.addEventListener('DOMContentLoaded', function () {
                              let myElement = document.querySelectorAll('a');
                              for (let i = 0; i < myElement.length; i++) {
                                  const isParameter = myElement[i].getAttribute('href').indexOf('?') != -1 ? '&' : '?';
                                  myElement[i].setAttribute('href', myElement[i].getAttribute('href') + isParameter +'viewable=<?php echo $viewable; ?>');
                              }
                          });
                      </script>
                      <?php
                  } else {
                      // パラメータとUnixが一致しない
                      header('Location: /form/?url='.$this_url);
                      exit;
                  }
              } else {
                  // パラメータviewableを未保持
                  header('Location: /form/?url='.$this_url);
                  exit;
              }
          }
      }
  }
}
// add_action('wp', 'catalog_auth');

get_template_part('functions/taxonomy_sort');

