!(function (e) {
    "use strict";
    var t = e(window);
    t.on("load", function (a, o) {
        var s = e(document),
            i = e("html, body"),
            l = e(".preloader"),
            n = e(".toggle-password"),
            r = e(".hero-slider"),
            c = e(".course-carousel"),
            d = e(".view-more-carousel"),
            u = e(".view-more-carousel-2"),
            m = e(".testimonial-carousel"),
            g = e(".testimonial-carousel-2"),
            p = e(".testimonial-carousel-3"),
            v = e(".client-logo-carousel"),
            h = e(".blog-post-carousel"),
            // f = e(".select-container-select"),
            y = e(".card-preview"),
            b = e(".user-text-editor"),
            w = e(".category-carousel"),
            k = e(".featured-course-carousel"),
            C = e(".fullscreen-slider"),
            S = e(".generic-portfolio-list"),
            x = e('[data-fancybox="gallery"]'),
            q = e(".emoji-picker"),
            H = e(".counter"),
            L = e(".tags-input"),
            I = e(".qtyBtn"),
            j = e("#phone"),
            z = e(".cv-input"),
            M = e(".lazy"),
            P = e(".skillbar");
        l.delay("500").fadeOut(2e3),
            s.on("click", ".down-button", function () {
                e(this).toggleClass("active"), e(".header-top").slideToggle(200);
            }),
            t.on("resize", function () {
                t.width() > 991 ? e(".header-top").show() : e(".header-top").hide();
            }),
            e(".search-menu-toggle").on("click", function () {
                e(".mobile-search-form, .body-overlay").addClass("active"), e("body").css({ overflow: "hidden" });
            }),
            e(".search-bar-close, .body-overlay").on("click", function () {
                e(".mobile-search-form, .body-overlay").removeClass("active"), e("body").css({ overflow: "inherit" });
            }),
            e(".cat-menu-toggle").on("click", function () {
                e(".category-off-canvas-menu, .body-overlay").addClass("active"), e("body").css({ overflow: "hidden" });
            }),
            e(".cat-menu-close, .body-overlay").on("click", function () {
                e(".category-off-canvas-menu, .body-overlay").removeClass("active"), e("body").css({ overflow: "inherit" });
            }),
            e(".main-menu-toggle").on("click", function () {
                e(".main-off-canvas-menu, .body-overlay").addClass("active"), e("body").css({ overflow: "hidden" });
            }),
            e(".main-menu-close, .body-overlay").on("click", function () {
                e(".main-off-canvas-menu, .body-overlay").removeClass("active"), e("body").css({ overflow: "inherit" });
            }),
            e(".user-menu-toggle").on("click", function () {
                e(".user-off-canvas-menu, .body-overlay").addClass("active"), e("body").css({ overflow: "hidden" });
            }),
            e(".user-menu-close, .body-overlay").on("click", function () {
                e(".user-off-canvas-menu, .body-overlay").removeClass("active"), e("body").css({ overflow: "inherit" });
            }),
            e(".dashboard-menu-toggler").on("click", function () {
                e(".off--canvas-menu, .body-overlay").addClass("active"), e("body").css({ overflow: "hidden" });
            }),
            e(".dashboard-menu-close, .body-overlay").on("click", function () {
                e(".off--canvas-menu, .body-overlay").removeClass("active"), e("body").css({ overflow: "inherit" });
            }),
            e(".off-canvas-menu-list .sub-menu")
                .parent("li")
                .children("a")
                .append(function () {
                    return '<button class="sub-nav-toggler" type="button"><i class="la la-angle-down"></i></button>';
                }),
            e(".sub-nav-toggler").on("click", function () {
                var t = e(this);
                return (
                    t.toggleClass("active"),
                    t.parent().parent().siblings().children("a").find(".sub-nav-toggler").removeClass("active"),
                    t.parent().parent().children(".sub-menu").slideToggle(),
                    t.parent().parent().siblings().children(".sub-menu").slideUp(),
                    !1
                );
            });
        var D = e("#scroll-top");
        t.on("scroll", function () {
            e(this).scrollTop() > 200
                ? (e(".header-menu-content").addClass("fixed-top"), e("body").css("margin-top", e(".header-menu-content").outerHeight() + "px"))
                : (e(".header-menu-content").removeClass("fixed-top"), e("body").css("margin-top", "0")),
                e(this).scrollTop() >= 300 ? D.show() : D.hide();
            0 !== e(".skills .skill").length && spy_scroll(".skills .skill");
        }),
            s.on("click", "#scroll-top", function () {
                e(i).animate({ scrollTop: 0 }, 1e3);
            }),
            e(".page-scroll").on("click", function (t) {
                t.preventDefault();
                var a = e(this.hash);
                e(i).animate({ scrollTop: a.offset().top - 20 }, 600);
            }),
            e(r).length && e(r).owlCarousel({ items: 1,rtl: true, nav: !0, dots: !0, autoplay: !1, loop: !0, smartSpeed: 1e3, active: !0, navText: ["<i class='la la-angle-right'></i>", "<i class='la la-angle-left'></i>"] }),
            e(c).length &&
                e(c).owlCarousel({
                    loop: !0,
                    rtl: true,
                    items: 3,
                    nav: !0,
                    dots: !1,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 25,
                    navText: ["<i class='la la-arrow-right'></i>", "<i class='la la-arrow-left'></i>"],
                    responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 } },
                }),
            e(d).length && e(d).owlCarousel({ loop: !0, items: 1,rtl: true, nav: !1, dots: !0, smartSpeed: 500, autoplay: !0, margin: 15 }),
            e(u).length && e(u).owlCarousel({ loop: !0, items: 3,rtl: true, nav: !1, dots: !0, smartSpeed: 500, autoplay: !0, margin: 15, responsive: { 320: { items: 1 }, 768: { items: 2 }, 992: { items: 3 } } }),
            e(m).length &&
                e(m).owlCarousel({
                    loop: !0,
                    rtl: true,
                    items: 5,
                    nav: !1,
                    dots: !0,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 30,
                    autoHeight: !0,
                    responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 }},
                }),
            e(g).length &&
                e(g).owlCarousel({
                    loop: !0,
                    items: 2,
                    rtl: true,
                    nav: !0,
                    dots: !1,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 30,
                    autoHeight: !0,
                    navText: ["<i class='la la-angle-right'></i>", "<i class='la la-angle-left'></i>"],
                     responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 } },
                }),
            e(p).length &&
                e(p).owlCarousel({
                    loop: !0,
                    items: 3,
                    nav: !0,
                    rtl: true,
                    dots: !1,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 30,
                    autoHeight: !0,
                    navText: ["<i class='la la-arrow-right'></i>", "<i class='la la-arrow-left'></i>"],
                     responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 } },
                }),
            e(v).length && e(v).owlCarousel({ loop: !0,rtl: true, items: 5, nav: !1, dots: !1, smartSpeed: 500, autoplay: !0, responsive: { 0: { items: 2 }, 481: { items: 3 }, 768: { items: 4 }, 992: { items: 5 } } }),
            e(h).length && e(h).owlCarousel({ loop: !0,rtl: true, items: 3, nav: !1, dots: !0, smartSpeed: 500, autoplay: !1, margin: 30, responsive: { 320: { items: 1 }, 992: { items: 3 },1200:{items:4} } }),
            e(w).length &&
                e(w).owlCarousel({
                    loop: !0,
                    rtl: true,
                    items: 5,
                    nav: !0,
                    dots: !1,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 20,
                    autoHeight: !0,
                    navText: ["<i class='la la-arrow-right'></i>", "<i class='la la-arrow-left'></i>"],
                     responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 } },
                }),
            e(k).length && e(k).owlCarousel({ loop: !0, items: 1,rtl: true, nav: !0, dots: !1, smartSpeed: 500, autoplay: !1, margin: 20, autoHeight: !0, navText: ["<i class='la la-arrow-right'></i>", "<i class='la la-arrow-left'></i>"] }),
            e(C).length &&
                e(C).owlCarousel({
                    loop: !0,
                    items: 3,
                    rtl: true,
                    nav: !0,
                    dots: !1,
                    smartSpeed: 500,
                    autoplay: !1,
                    margin: 20,
                    autoHeight: !0,
                    navText: ["<i class='la la-arrow-right'></i>", "<i class='la la-arrow-left'></i>"],
                     responsive: { 320: { items: 1 }, 767: { items: 2 }, 992: { items: 3 }, 1025: { items: 4 } },
                }),
            e('[data-toggle="tooltip"]').tooltip(),
            s.on("click", ".portfolio-filter li", function () {
                var t = e(this).attr("data-filter");
                e(S).isotope({ filter: t }), e(".portfolio-filter li").removeClass("active"), e(this).addClass("active");
            }),
            e(S).length && e(S).isotope({ itemSelector: ".generic-portfolio-item", percentPosition: !0, masonry: { columnWidth: ".generic-portfolio-item", horizontalOrder: !0 } }),
            e(x).length && e(x).fancybox(),
            e(y).length && e(y).tooltipster({ contentCloning: !0, interactive: !0, side: "right", delay: 100, animation: "swing" }),
            e(b).length &&
                e(b).summernote({
                    height: 300,
                    lang: 'fa-IR'
                }),
            e(q).length && e(q).emojioneArea({ pickerPosition: "top" }),
            e(H).length && e(H).counterUp({ delay: 10, time: 1e3 }),
            e(L).length && e(L).tagsinput({ tagClass: "badge badge-info", maxTags: 3 }),
            e(".curriculum-sidebar-list > .course-item-link").on("click", function () {
                var t = e(this);
                t.addClass("active"), t.siblings().removeClass("active"), t.is(".active-resource") ? e(".lecture-viewer-text-wrap").addClass("active") : t.not(".active-resource") && e(".lecture-viewer-text-wrap").removeClass("active");
            }),
            s.on("click", ".sidebar-close", function () {
                e(".course-dashboard-sidebar-column, .course-dashboard-column, .sidebar-open").addClass("active");
            }),
            s.on("click", ".sidebar-open", function () {
                e(".course-dashboard-sidebar-column, .course-dashboard-column, .sidebar-open").removeClass("active");
            }),
            s.on("click", ".ask-new-question-btn", function () {
                e(".new-question-wrap, .question-overview-result-wrap").addClass("active");
            }),
            s.on("click", ".question-meta-content, .question-replay-btn", function () {
                e(".replay-question-wrap, .question-overview-result-wrap").addClass("active");
            }),
            s.on("click", ".back-to-question-btn", function () {
                e(".new-question-wrap, .question-overview-result-wrap, .replay-question-wrap").removeClass("active");
            }),
            s.on("click", ".swapping-btn", function () {
                var t = e(this);
                t.text() === t.data("text-swap") ? t.text(t.data("text-original")) : t.text(t.data("text-swap"));
            }),
            s.on("click", ".collection-link", function () {
                e(this).children(".collection-icon").toggleClass("active");
            }),
            // e(f).length && e(f).selectpicker({ liveSearch: !0, liveSearchPlaceholder: "جستجو", liveSearchStyle: "contains", size: 5 }),
            // s.on("click", ".share-toggle", function () {
            //     var t = e(this);
            //     t.parent().find(".social-icons").toggleClass("social-active"), t.toggleClass("share-toggle-active");
            // }),
            e(".dropdown-btn").on("click", function (t) {
                t.preventDefault(), e(this).next(".dropdown-menu-wrap").fadeToggle(100), t.stopPropagation();
            }),
            s.on("click", function (t) {
                var a = e(".dropdown");
                a === t.target || a.has(t.target).length || e(".dropdown-menu-wrap").fadeOut(100);
            }),
            e(I).length &&
                e(I).on("click", function () {
                    var t = e(this),
                        a = t.parent().find(".qtyInput").val();
                    if (t.hasClass("qtyInc")) var o = parseFloat(a) + 1;
                    else o = a > 0 ? parseFloat(a) - 1 : 0;
                    t.parent().find(".qtyInput").val(o);
                });
        for (var O = document.querySelectorAll(".payment-tab-toggle > input"), A = 0; A < O.length; A++) O[A].addEventListener("change", E);
        function E(e) {
            for (var t = document.querySelectorAll(".payment-tab"), a = 0; a < t.length; a++) t[a].classList.remove("is-active");
            e.target.parentNode.parentNode.classList.add("is-active");
        }
        const F = document.querySelector(".copy-input"),
            N = document.querySelector(".copy-btn"),
            U = document.querySelector(".success-message");
        e(N).on("click", function () {
            F.select(),
                document.execCommand("copy"),
                F.blur(),
                U.classList.add("active"),
                setTimeout(function () {
                    U.classList.remove("active");
                }, 2e3);
        }),
            e(j).length && e(j).intlTelInput({ separateDialCode: !0, utilsScript: "js/utils.js" }),
            e(z).length && e(z).MultiFile({ accept: "pdf, doc, docx, rtf, html, odf, zip" }),
            e(M).length && e(M).Lazy();
        var B,
            Q = document.querySelector("#send-message-btn"),
            W = e(".contact-form"),
            Y = e(".contact-success-message");
        function _(e) {
            (Q.innerHTML = "Send Message"),
                Y.fadeIn().removeClass("alert-danger").addClass("alert-success"),
                Y.text(e),
                setTimeout(function () {
                    Y.fadeOut();
                }, 3e3),
                W.find('input:not([type="submit"]), textarea').val("");
        }
        function G(e) {
            (Q.innerHTML = "ارسال پیام"),
                Y.fadeIn().removeClass("alert-success").addClass("alert-danger"),
                Y.text(e.responseText),
                setTimeout(function () {
                    Y.fadeOut();
                }, 3e3);
        }
        W.submit(function (t) {
            t.preventDefault(),
                (B = e(this).serialize()),
                (Q.innerHTML = "در حال ارسال..."),
                setTimeout(function () {
                    e.ajax({ type: "POST", url: W.attr("action"), data: B })
                        .done(_)
                        .fail(G);
                }, 2e3);
        });
        const J = document.querySelectorAll(".theme-picker-btn"),
            K = window.matchMedia("(prefers-color-scheme: dark)"),
            R = localStorage.getItem("theme");
        "dark" === R ? document.body.classList.toggle("dark-theme") : "light" === R && document.body.classList.toggle("light-theme"),
            J.forEach(function (e) {
                e &&
                    e.addEventListener("click", function () {
                        if (K.matches) {
                            document.body.classList.toggle("light-theme");
                            var e = document.body.classList.contains("light-theme") ? "light" : "dark";
                        } else {
                            document.body.classList.toggle("dark-theme");
                            e = document.body.classList.contains("dark-theme") ? "dark" : "light";
                        }
                        localStorage.setItem("theme", e);
                    });
            }),
            n.on("click", function () {
                var t = e(".password-field");
                e(this).toggleClass("active"), "password" === t.attr("type") ? t.attr("type", "text") : t.attr("type", "password");
            }),
            e(P).length &&
                e(P).each(function () {
                    e(this)
                        .find(".skillbar-bar")
                        .animate({ width: e(this).attr("data-percent") }, 6e3);
                });
    });
})(jQuery);
