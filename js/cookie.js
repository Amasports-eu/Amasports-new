$(
    function () {
        var ck = false;
        if ( document.cookie && document.cookie.match(/cookie=1/) ) {
            ck = true;
        }
         
        if ( ! ck ) {
            $("body").append(
                "<section id='cookie'>\
                    Questo sito utilizza cookie di profilazione e di terze parti per offrirti una migliore esperienza di navigazione sul sito. Se vuoi saperne di più premi\
                    <a href='http://tuosito.it/pagina_da_richiamare.html'>questo link</a> oppure \
                    <a href='#' data-show='none' data-setc='closecookie'>Chiudi</a> per continuare la navigazione.\
                </section>"
            );
             
            $("#cookie").css({
                position: "fixed"
                , bottom: 0
                , left: 0
                , width: "100%"
                , background: "white"
                , "z-index": 9960
                , padding: "1em"
                , color: "#7f7f7f"
                , "text-align": "center"
                , "box-shadow": "0 .5em .5em rgba(0,0,0,.5)"
                , margin: 0
                , "min-height": 0
            });
             
            $("#cookie>a").css({
                "text-decoration": "none"
                , width: "8em"
                , background: "#3f95ea"
                , color: "#fff"
                , "border-radius": ".2em"
                , display: "inline-block"
                , "text-align": "center"
            });
             
            $("#cookie>a:first").css({
                background: "#52d3aa"
            });
             
            $("a[data-setc='closecookie']").click(
                function (e) {
                    $("#cookie").remove();
                    document.cookie = [
                        encodeURIComponent('cookie'), '=1',
                        '; expires=Sat, 31 Dec 2050 00:00:00 UTC',
                        '; path=/'
                    ].join('');
                }
            );
        }
    }
);
