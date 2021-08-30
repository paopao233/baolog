$(".fold-plane-title").click(function(a) {
    $(this).hasClass("fold-plane-title-zk") ? ($(this).removeClass("fold-plane-title-zk"), $(this).next().slideUp()) : ($(this).addClass("fold-plane-title-zk"), $(this).next().slideDown())
});