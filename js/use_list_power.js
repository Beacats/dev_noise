jQuery(function($){

  const  $array_app1 = ['ドアロック', 'メモリーシート', 'サンルーフ' , 'パワースライドドア' , 'テールゲート', '電動ミラー', 'ステアリングロック', '電動チルト&テレスコピックステアリング', 'パワーウィンドウ','Door lock' ,'Memory seat' ,'Sunroof','Power slide door','Tail gate','Power mirror','Steering lock','Electrically tilt / telescopic steering','Power window'] ;
  const  $array_app2 = ['ワイパー', 'フューエルリッドオープナー', 'Wiper', 'Fuel lid opener', ] ;
  const  $array_app3 = ['クーリングファン', 'ブロアモーター', 'Cooling fan', 'Blower motor',] ;
  const  $array_app4 = ['フォグランプ', 'ヘッドランプ', '室内灯' , 'テールランプ' , 'Fog lamp','Head lamp','Interior light','Tail lamp',] ;
  const  $array_app5 = ['ウォッシャーポンプ', 'ホーン', '燃料ポンプ' , 'ウォーターポンプ' , 'Washer pump', 'Horn', 'Fuel pump', 'Water pump',] ;
  const  $array_app6 = ['デフォッガー', 'イグニッション', '電源供給' , 'PTCヒーター' , 'シートヒーター' , 'オーディオ' , 'Defogger' , 'Ignition', 'Power supply', 'PTC heater', 'Seat heater', 'Audio'] ;
  const  $array_app7 = ['スターターモーター', 'A/Cマグネットクラッチ', 'Starter motor', 'Air conditioner clutch',] ;
  const  $array_app8 = ['DC/DCコンバータ', 'DC/DC Converter',] ;


  if($('.use_list_power').length){
    const $location_host = $('#location_host').text();
    $('.use_list_power li a').each(function(){
      let $use_list_text = $(this).text();
      for (var i=1; i<=8; i++) {
       let $array_app = eval('$array_app' + i)
        if($.inArray($use_list_text, $array_app) !== -1){
          $(this).attr('href' , $location_host + '/product_app/app' + i);
        }
        // console.log($array_app);
      }

    });
  }

});