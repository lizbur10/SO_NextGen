  //Start hover text
  //"mousemove" code came from: http://www.alessioatzeni.com/blog/simple-tooltip-with-jquery-only-text/
    $("[class^=tribe-events-category-] a").hover(function() {
      $(this).parent().after("<div class='hover-text'>Here's some info about this outing.</div>");
      },
    function() {
      $(this).parent().parent().find("div.hover-text").remove();
    });
  /*    }).mousemove(function(e) {
            var mousex = e.pageX + 20; //Get X coordinates
            var mousey = e.pageY + 10; //Get Y coordinates
            $('.hover-text')
            .css({ top: mousey, left: mousex });
      }
  );
  */
  //End hover text

  //Registration UI
  $(".register-button").click(function() {
    $("#outing-registration").removeClass("visually-hidden");
    $("#background-overlay").removeClass("visually-hidden");
  });

  $("#rsvp-button").click(function() {
    $("#outing-registration").addClass("visually-hidden");
    alert("Thanks for registering!");
  });

  $("#cancel-button").click(function() {
    document.execCommand('Stop');
  });

  //End of registration UI