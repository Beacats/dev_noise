jQuery(function ($){
  if($('body.post-type-emc.post-php').length ||$('body.post-type-emc.post-new-php').length ||  $('body.post-type-rfsys.post-php').length ||$('body.post-type-rfsys.post-new-php').length ||  $('body.post-type-emc-test-serv.post-php').length ||$('body.post-type-emc-test-serv.post-new-php').length){
    $('.smart-cf-meta-box-repeat-tables').each(function(){
       
      if($(this).has('th')){
        $(this).find('th').each(function(){
          let $th_name = $(this).text();
          if($th_name.match(/^特徴表示パターン_タイル_レイアウト$/)){

            $(this).parents('.smart-cf-meta-box-repeat-tables').addClass('product_tile_box');
            return;
          }else if($th_name.match(/^特徴表示パターン_ワンカラム_詳細$/)){
            $(this).parents('.smart-cf-meta-box-repeat-tables').addClass('product_one-column_box');
            return;
          }
        });

        $('.smart-cf-meta-box-table .instruction').each(function(){
          let $this_tex = $(this).text();
          if($this_tex ==='製品本体またはオプション品を選択してください'){
            $(this).parents('table').addClass('select_product_type');
          }else if($this_tex ==='オプション品の場合は種別を選択してください'){
            $(this).parents('table').addClass('select_option_type');
          }
        });
        
      }
    });

function product_box($val_text){
  if($val_text ==='pattern_is_tile'){
    $('.product_tile_box').show();
    $('.product_one-column_box').hide();
  }else if($val_text ==='pattern_is_one-column'){
    $('.product_tile_box').hide();
    $('.product_one-column_box').show();

  }

  if($val_text === 'product'){
    $('.select_option_type').hide();
  }else if($val_text === 'option'){
    $('.select_option_type').show();

  }
}
  
  $('input[name="smart-custom-fields[product_display_pattern][0]"]').each(function(){
    if($(this).attr('checked')==='checked'){
      let $val_text = $(this).val();
      product_box($val_text)
    }
  });

  $('.select_product_type input').each(function(){
    if($(this).attr('checked')==='checked'){
      let $val_text = $(this).val();
      product_box($val_text)
    }
  });


$('input:radio').change(function(){
  let $val_text = $(this).val();
  product_box($val_text)
});

}




});