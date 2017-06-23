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

  var group_permalink = $(".js-group-info").data("group-permalink");
  if (group_permalink) {
    var href = group_permalink + "group_invite_by_url/";
    $(".js-congratulations-more-invite-button").append(
      $("<p>").append(
       $("<a>").addClass("button").attr("href", href).text("Invite friends")
      )
    );
  }

  function isScrolledIntoView(el) {
    var rect = el.getBoundingClientRect();
    var isVisible = (rect.top >= 0) && (rect.bottom <= window.innerHeight);
    return isVisible;
  }

});
