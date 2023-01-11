(function ($) {

    // Cookieよりカタログ・技術ページのURL取得
    function getCookieArray() {
        let cookieArray = new Array();
        if (document.cookie != '') {
            const tmp = document.cookie.split('; ');
            for (let i = 0; i < tmp.length; i++) {
                let data = tmp[i].split('=');
                cookieArray[data[0]] = decodeURIComponent(data[1]);
            }
        }
        return cookieArray;
    }
    const cookieKey = getCookieArray();
    const catalogCookie = cookieKey['c_page_url']; // カタログ・技術ページのURL

    // パラメータよりカタログ・技術ページのURL取得
    const url = new URL(window.location.href); // URLを取得
    const params = url.searchParams; // URLSearchParamsオブジェクトを取得
    const catalogParams = params.get('c_page_url'); // カタログ・技術ページのURL

    if (catalogCookie || catalogParams) {
        // カタログ・技術ページのURLを持つ
        if (navigator.cookieEnabled) { // Cookie有効/無効判定
            // フォーム送信完了処理
            document.addEventListener('wpcf7mailsent', function (event) {
                // Cookie有効：Cookieをセット（有効期限：1時間）
                document.cookie = 'noisekenInfo_completed=completed; max-age=3600; path=/;'; // path指定はドメイン直下
                location = catalogCookie; // カタログ閲覧ページへ遷移
            }, false);
        } else {
            // Cookie無効：Cookie利用促進メッセージ表示
            document.addEventListener('DOMContentLoaded', function () {
                lity('<div class="non-cookie-message"><p>クッキー利用を可能にすると、次回の入力を省くことができます。</p></div>');
            });
            // フォーム送信完了処理
            document.addEventListener('wpcf7mailsent', function (event) {
                // Cookie無効：YYYY/MM/DD 00:00:00をUNIXタイムスタンプで取得
                const now = new Date();
                const txt = `${now.getFullYear()}/${(now.getMonth() + 1)}/${now.getDate()}`
                const add = new Date(txt).getTime();
                location = catalogParams + '?viewable=' + add; // パラメータを付与してカタログ閲覧ページへ遷移
            }, false);
        }
    } else {
        // カタログ・技術ページのURLを持たない
    }

})(jQuery);