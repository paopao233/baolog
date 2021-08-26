$(".zd-plane-title").click(function(a) {
    $(this).hasClass("zd-plane-title-zk") ? ($(this).removeClass("zd-plane-title-zk"), $(this).next().slideUp()) : ($(this).addClass("zd-plane-title-zk"), $(this).next().slideDown())
});