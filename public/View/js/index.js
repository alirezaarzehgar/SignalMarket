$(".icon").on("click", function () {
  var el = $("#topNavbar");
  if (!el.hasClass("responsive")) {
    el.addClass("responsive");
  } else {
    el.removeClass("responsive");
  }
});
