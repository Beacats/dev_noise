jQuery(function ($) {
    let $winW = $(window).innerWidth();
    let $winH = $(window).innerHeight();

   
    
    $('.nav_item').each(function(){
        let $section_id = $(this).attr('id');
        let $section_title;
        $section_title = $(this).find('>h3').text();
        if($section_title === ''){
            // $section_title = $(this).find('a >h3').text();
            $section_title = $(this).find('.section_title:eq(0)').text();
        }
        console.log( $section_title);

        if ($(this).is(':visible')) {
            // 表示されている場合の処理
            $('.product-child_pageNav ul').append(`<li><a href="#${$section_id}">${$section_title}</a></li>`);
        }
    });


   if($('#this_product_catalog').length){
    let $list_num = 1;
    $('.this_product_catalog_innerBox').each(function(){
        $(this).addClass(`list_num${$list_num}`);
        $list_num++;
    });

    $('.this_product_catalog .contentBox >div').click(function(){
        let $open_id = $(this).attr('id');
        $('.this_product_catalog .contentBox >div').show();
        $(this).hide();
        $('.this_product_catalog_innerBox').hide();
        $(`.this_product_catalog_innerBox.${$open_id}`).show();
    });



   }


   $(".characteristics_content .tile_wrapper img").imagesLoaded(function(){
       let $item = $('.characteristics_content .tile_wrapper');
       let $itemW = $item.innerWidth();
       let $item_offset = ($itemW - ($itemW * 0.95)) / 3;
       console.log($item_offset);
       let options = {
           // レイアウトのオプション
           autoResize: true, // リサイズ時にレイアウトを更新
           container: $('.characteristics_content .tile_wrapper'), //コンテナを指定（CSS の設定で中央寄せ等する場合必要）
           //itemWidth: 180, // 列の幅の指定（オプション）
           offset: $item_offset , //アイテム間のマージン（オプション）
           outerOffset: 0, // コンテナからのオフセット（オプション） 
        //    fillEmptySpace: true // 最後の空いたスペースを「.wookmark-placeholder」で埋める（オプション）
       };
       $item.wookmark(options);  

   });

   $(".characteristics_content ul li").click(function(){
    let $content_clone = $(this).find('.detail_content_innreBox').clone(true);
    $('.characteristics_popup .popup_innreBox').append($content_clone);
    $('.characteristics_popup').show();
   });

   $('.characteristics_popup .closeBtn').click(function(){
    $('.characteristics_popup').hide();
    $('.characteristics_popup .popup_innreBox .detail_content_innreBox').remove();
   });

  $('#tabArea label').click(function(){
    let $open_body;
    let $kono_id;
    $kono_id =  $(this).attr('for');
    $open_body = $('#' + $kono_id).attr('data-num');
    $('.tabBody').hide();
    $('.' + $open_body).show()
  });


      
    $(window).on('load', function() {
        
    });
});//jQuery

$(window).resize(function () {
    //contactページTOP画像高さ揃え
    $winW = $(window).innerWidth();
    $winH = $(window).innerHeight();
   
});





