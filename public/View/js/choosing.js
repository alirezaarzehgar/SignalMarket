function handleUIOverally(id) {
  $("#list-" + id).on("mouseover", async function () {
    $("#overally-" + id).css("height", "100%");

    $("#overally-" + id).on("mouseleave", function () {
      if ($("#date-" + id).is(":focus")) {
        $("#overally-" + id).css("height", "100%");
      } else {
        $("#overally-" + id).css("height", "0%");
      }
    });
  });
}

function chooseAProduct(id) {}
