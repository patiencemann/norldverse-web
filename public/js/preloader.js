(function (html) {
    "use strict";

    html.className = html.className.replace(/\bno-js\b/g, "") + "js";

    /* Preloader
     * -------------------------------------------------- */
    const ssPreloader = function () {
        const body = document.querySelector("body");
        const preloader = document.querySelector("#preloader");

        window.addEventListener("load", function () {
            body.classList.remove("ss-preload");
            body.classList.add("ss-loaded");

            // page scroll position to top
            preloader.addEventListener("transitionstart", function gotoTop(e) {
                if (e.target.matches("#preloader")) {
                    window.scrollTo(0, 0);
                    preloader.removeEventListener(e.type, gotoTop);
                }
            });

            preloader.addEventListener(
                "transitionend",
                function afterTransition(e) {
                    if (e.target.matches("#preloader")) {
                        details.style.bottom =
                            window.innerHeight - details.offsetHeight + "px";
                        body.classList.add("ss-show");
                        e.target.style.display = "none";
                        preloader.removeEventListener(e.type, afterTransition);
                    }
                }
            );
        });

        window.addEventListener("beforeunload", function () {
            body.classList.remove("ss-show");
        });
    };

    /* Initialize
     * ------------------------------------------------------ */
    (function ssInit() {
        ssPreloader();
    })();
})(document.documentElement);
