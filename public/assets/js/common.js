$.AMUI.progress.start();

$(window).on("load", function () {
    $.AMUI.progress.done();
})

/**
 * 4秒钟后，自动隐藏flash信息
 */
var hideFlash = function () {
    $(".am-alert").fadeOut("slow");
}
setTimeout(hideFlash, 4000);