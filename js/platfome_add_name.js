jQuery(function($){
  
  const $platform = $('body');
  
  var br =  window.navigator.userAgent.toLowerCase();
  if(br.indexOf("chrome") !== -1) {
    $browser_name = 'chrome';
  } else if(br.indexOf("safari") !== -1) {
    $browser_name = 'safari';
  } else if(br.indexOf("firefox") !== -1) {
    $browser_name = 'firefox';
   
  } else if (br.indexOf("ucbrowser") !== -1) { //まだ未対応(プルリクにある)
    $browser_name = 'ucbrowser';
  } else if (br.indexOf("samsung") !== -1) {
    $browser_name = 'samsungbrowser';
  } else if (br.indexOf("opera") !== -1) {
    $browser_name = 'opera';
  } else if (br.indexOf("ie") !== -1) {
    $('.ie_polyfill').show();

    $browser_name = 'ie';
  } else if(br.indexOf("edge") !== -1) {
    $browser_name = 'edge';
  } else {
    $browser_name = 'other_browser';
  }

  console.log($browser_name);
  $platform.addClass($browser_name);

});


