// when user scroll down. the header become sticky
export function stickyHeader() {
  $(document).ready(function () {
    var header = $("header");
    var headerOffset = header.offset().top;

    $(window).scroll(function () {
      if ($(window).scrollTop() > headerOffset) {
        header.addClass("sticky");
      } else {
        header.removeClass("sticky");
      }
    });
  });
}
