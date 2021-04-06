function onSubjectKeyUp() {
  if ($("#subject").val().length < 1) {
    $("#introduction_to_product").prop("disabled", true);
  } else {
    $("#introduction_to_product").prop("disabled", false);
  }
}

function onIntroductionToProductKeyUp() {
  if ($("#introduction_to_product").val().length < 5) {
    $("#photo_dir_path").prop("disabled", true);
  } else {
    $("#photo_dir_path").prop("disabled", false);
  }
}

function onChangePhotoDirPath() {
  $("#new").prop("disabled", false);
}

function onNewKeyUp() {}

function deleteProduct(id) {
  $.post(
    "/api/product_api.php",
    { req: "delete", id: id },
    function (data, textStatus, jqXHR) {
      var statsus = JSON.parse(data).status;

      if (statsus == 200) {
        $("#admin-cart-" + id).hide("slow", function () {
          $("#admin-cart-" + id).remove();
        });
      }
    }
  );
}

function accetpProduct(id) {
  $.post(
    "/api/product_api.php",
    {
      req: "accept",
      id: id,
      date: $("#get-date-" + id).val(),
      price: $("#get-price-" + id).val(),
    },
    function (data, textStatus, jqXHR) {
      var statsus = JSON.parse(data).status;

      if (statsus == 200) {
        location.reload();
      }
    }
  );
}

function handleUIOverally(id) {
  $("#list-" + id).on("mouseover", async function () {
    $("#overally-" + id).css("height", "100%");

    $("#overally-" + id).on("mouseleave", function () {
      $("#overally-" + id).css("height", "0%");
    });
  });
}
