$(function() {
    "use strict";
    var url = window.location + "";
    var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
    var element = $('ul#sidebarnav a').filter(function() {
        return this.href === url || this.href === path; 
    });

    element.parentsUntil(".sidebar-nav").each(function () {
        if ($(this).is("li") && $(this).children("a").length !== 0) {
            $(this).children("a").addClass("active");
            $(this).parent("ul#sidebarnav").length === 0
                ? $(this).addClass("active")
                : $(this).addClass("selected");
        } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
            $(this).addClass("selected");
        } else if ($(this).is("ul")) {
            $(this).addClass('in');
        }
    });

    element.addClass("active");

    // Menangani klik pada semua link di sidebar
    $('#sidebarnav a').on('click', function (e) {
        var submenu = $(this).next("ul");
        if (submenu.length > 0) {
            e.preventDefault(); // Mencegah navigasi ke tautan "#" jika memiliki submenu
            
            if (submenu.hasClass("in")) {
                // Jika submenu sudah terbuka, tutup
                submenu.removeClass("in").slideUp();
                $(this).removeClass("active");
            } else {
                // Jika submenu tertutup, tutup semua yang lain lalu buka yang diklik
                $('#sidebarnav ul.in').removeClass("in").slideUp();
                $('#sidebarnav a.active').removeClass("active");
                submenu.addClass("in").slideDown();
                $(this).addClass("active");
            }
        }
    });

    // Untuk mencegah link utama dengan class "has-arrow" langsung navigasi
    $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
        e.preventDefault();
    });
});
