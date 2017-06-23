jQuery(function($) {
  "use strict";

  $(".js-congratulations-more-button").on("click", function() {
    var item = $(this).data("item");
    var textbox = $(".js-congratulations-more-item")
      .hide()
      .filter(function() { return $(this).data("item") == item; });
    textbox.show();
    textbox[0].scrollIntoView({behavior: "smooth"});
  });


});
