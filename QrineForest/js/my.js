// 厳格なエラーチェックモード
'use strict';

jQuery(function ($) {

    new my().init();

    /*
     * クラス的なものを構成
     */
    function my() {
        // 初期化処理
        this.init = function () {
            //プラグイン・外部ライブラリ関係の初期化処理
            plugins.init();

            // 見出しメニューを作成
            indexMenu();

            bindControls();

            // メニューの初期化処理
            themenu.init();
        };

        // プラグイン設定
        var plugins = {
            init: function () {
                this.hljs();
                this.mathjax();
            },
            hljs: function () {
                //シンタックスハイライトを初期化する
                hljs.initHighlightingOnLoad();
                // Highlightjs のデフォルト(<pre><code>）を変更する
                //$("code[class]").each(function (i, block) {
                //    hljs.highlightBlock(block);
                //});
            },
            mathjax: function () {
                //MathJaxの初期設定
                MathJax.Hub.Config({
                    tex2jax: {
                        inlineMath: [['$', '$'], ['\\(', '\\)']],
                        displayMath: [['$$', '$$'], ["\\[", "\\]"]],
                        processEscapes: true
                    },
                    "HTML-CSS": {
                        matchFontHeight: false
                    }
                });
            }
        };

        var bindControls = function () {
            // 全ての内部リンクをクリックした場合の処理
            $('a[href^="#"]').on("click", function () {
                // スクロールの速度
                var speed = 500; // ミリ秒
                // アンカーの値取得
                var href = $(this).attr('href');
                // 移動先を取得
                var target = $(href === '' || href === '#' ? 'html' : href);
                // 移動先を数値で取得　※ナビの高さ分位置を上に補正 ＋ α
                var position = target.offset().top - $('.header').height() - 15;

                // スムーススクロール
                $('html, body').animate({
                    scrollTop: position
                }, speed, 'swing');
            });
        };
        var themenu = {
            init: function () {
                // position: fixed; 要素の min-width の横スクロールを有効にする
                $(window).on("load scroll resize", function () {
                    $(".header").css("left", -Math.floor($(window).scrollLeft()) + "px");
                });

                // 最初にヘッダメニューを非表示にしておく
                $(".header .sidebar").hide();

                // ヘッダーの表示非表示を司るトグルボタン
                var down = true;
                var downDuration = 427;
                var headerHideHeight = $(".header").height();
                var xxx = 0;

                // ヘッダメニュー表示ボタンのクリック処理
                $("#header-show").click(function () {

                    // 標示フラグ（これから表示される＝現在非表示状態ならばTrue）
                    var toVisible = $(".header .sidebar").css("display") === "none";

                    // CSS使った方が duration 350 の時滑らかだ
                    // http://jqueryrotate.com/#documentation
                    $(this).rotate({
                        duration: downDuration * 2 + 50,
                        animateTo: xxx += 180
                    });

                    // ヘッダーバー表示時に .header の高さがブラウザ高さ以上ならば
                    // マウス位置で自動スクロールできるようにする
                    //alert($(".header").css("max-height") + " : " + $(".header").height())

                    if (toVisible) {
                        // 現在非表示    → これから表示される
                        //$(".header .sidebar").css({
                        //    // （ヘッダー全体の高さ上限 - 非表示状態のヘッダー高さ）をサイドバー部分の高さにする
                        //    height: "calc(" + ($(".header").css("max-height")) + " - " + $(".header").height() + "px)"
                        //})
                    } else {
                        // 現在表示     → これから非表示になる
                    }

                    $(".header .sidebar").css({
                        // CSSで幅を初期化
                        width: "100%" // ← は $(".sidebar-wrap").width() と同じ
                    }).slideToggle({
                        // サイドバーのスライド表示非表示を切り替える
                        duration: downDuration,
                        easing: "swing",
                        start: function () {
                            // 開始時の処理
                        },
                        complete: function () {
                            // 表示完了後の処理

                            // オーバーフローある場合は幅をスクロール幅分増加する
                            $(this).css({ width: "+=" + getBarWidth() });

                            if (toVisible) {
                                // ダウン表示が完了した
                                // 一番上へ戻るボタンを表示する
                                $(".back-to-top").css("display", "none");

                                if ($(".header-inner").height() > $(".header").height()) {
                                    // （ヘッダー全体の高さ上限 - 非表示状態のヘッダー高さ）をサイドバー部分の高さにする
                                    $(".header .sidebar").css("height", $(".header").height() - headerHideHeight + "px");
                                }
                            } else {
                                // 一番上へ戻るボタンを表示する
                                $(".back-to-top").css("display", "initial");
                                $(".header .sidebar").css("height", "auto");
                            }
                        }
                    });
                });
            }
        };
    }


    //スクロールバーの幅を取得
    function getBarWidth() {
        var outer = document.createElement("div");
        outer.style.width = "100px";
        outer.style.height = "100px";
        outer.style.overflow = "scroll";
        outer.style.border = "none";
        outer.style.visibility = "hidden";

        var inner = outer.cloneNode(false);
        outer.appendChild(inner);
        document.body.appendChild(outer);
        outer.scrollTop = 200;
        var barWidth = outer.scrollTop;
        document.body.removeChild(outer);
        return barWidth;
    }

    /**
     * 見出し（h1~h6）のメニューを特定IDブロックに自動挿入する
     */
    function indexMenu() {

        // メニューとするIDの階層情報
        var seed = '.myindex-sG2iQkP8';
        // 調査対象の記事のコンテナクラス
        var container = '.post-content';
        // 見出しレベル補正値（h2 → h1 とみなす）
        var lvx = 2;

        if ($(seed).size()) {// 対象要素が無ければ行わない

            var html = '<ul class="myindex-list">';
            var preLv = 0;// 一つ前の見出しレベル 初期値
            var heads = $(container + ' :header');
            var hSize = heads.size();

            // コールバックだから他の処理を待たせない
            heads.each(function (i) {
                var tag = $(this).get(0).tagName.toLowerCase();
                var lv = tag.charAt(1) - lvx;// この見出しレベル

                // 見出しにアンカーIDを設定する
                $(this).attr({
                    id: 'hn' + i
                });

                // アンカーHTMLを作成
                var style = 'style="margin-left:' + lv * 30 + 'px;"';
                var clazz = 'class="head-menu-h head-menu-' + tag + '"';
                var href = 'href="#hn' + i + '"';
                var headtext = getTextNodeString($(this));

                html += '<li ' + style + '><a ' + clazz + ' ' + href + '>' + headtext + '</a></li>';
            });

            html += '</ul>';
            //
            $(seed).append(html);
        }
    }

    // テキストノードのみを抽出して返す
    function getTextNodeString(target) {
        var nodes = target.contents().filter(function () {
            return this.nodeType === 3 // テキストノードか否か
                // && /\S/.test(this.data) // 空白か否か
                && $.inArray($(this).parent(), target); // 直下か否か
        });
        return nodes.text();
    }
    /*
     * 文字列の掛け算。O(log n)
     * str  繰り返し対象文字列
     * n 繰り返し回数
     */
    function times(str, n) {
        var i, part = str, res = '';
        for (i = 1; i <= n; i <<= 1, part += part) {
            if (n & i)
                res += part;
        }
        return res;
    }

});


