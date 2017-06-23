jQuery(function($) {
  "use strict";

  $(".js-congratulations-more-button").on("click", function() {
    var item = $(this).data("item");
    var textbox = $(".js-congratulations-more-item")
      .hide()
      .filter(function() { return $(this).data("item") == item; });
    textbox.show();
    if (! isScrolledIntoView(textbox[0])) {
      textbox[0].scrollIntoView({behavior: "smooth"});
    }
  });



  function isScrolledIntoView(el) {
    var rect = el.getBoundingClientRect();
    var isVisible = (rect.top >= 0) && (rect.bottom <= window.innerHeight);
    return isVisible;
  }
});
