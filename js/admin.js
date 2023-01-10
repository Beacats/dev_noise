(function ($) {
    // カスタム投稿の製品本体_or_オプション品ラジオボタン
    function product_or_option() {
        let value = $("input[name='smart-custom-fields[product_or_option][0]']:checked").val();
        switch (value) {
            case "product":
                $("input[name='smart-custom-fields[product_or_option][0]']").parents('.smart-cf-meta-box-table').next().addClass('custom-field-none');
                break;
            case "option":
                $("input[name='smart-custom-fields[product_or_option][0]']").parents('.smart-cf-meta-box-table').next().removeClass('custom-field-none');
                break;
            default:
                console.log('予期せぬエラーです');
                break;
        }
    }
    product_or_option();
    $("input[name='smart-custom-fields[product_or_option][0]']").on('click', function () {
        product_or_option();
    });

    // カスタム投稿の特徴表示パターン選択ラジオボタン
    function product_display_pattern() {
        let value = $("input[name='smart-custom-fields[product_display_pattern][0]']:checked").val();
        switch (value) {
            case "pattern_is_tile":
                $("input[name='smart-custom-fields[product_display_pattern][0]']").parents('.smart-cf-meta-box-table').next().removeClass('custom-field-none');
                $("input[name='smart-custom-fields[product_display_pattern][0]']").parents('.smart-cf-meta-box-table').next().next().addClass('custom-field-none');
                break;
            case "pattern_is_one-column":
                $("input[name='smart-custom-fields[product_display_pattern][0]']").parents('.smart-cf-meta-box-table').next().addClass('custom-field-none');
                $("input[name='smart-custom-fields[product_display_pattern][0]']").parents('.smart-cf-meta-box-table').next().next().removeClass('custom-field-none');
                break;
            default:
                console.log('予期せぬエラーです');
                break;
        }
    }
    product_display_pattern();
    $("input[name='smart-custom-fields[product_display_pattern][0]']").on('click', function () {
        product_display_pattern();
    });
})(jQuery);