function handleCarts(username) {
  $("#permission-" + username).on("click", function () {
    if ($("#password-" + username).val().length < 1) {
      $("#password-finished-" + username).text("password won't update.");
    } else {
      $("#password-finished-" + username).text("");
    }
  });

  $("#password-" + username).on("keyup", function () {
    if (
      $("#password-" + username).val().length > 6 ||
      $("#password-" + username).val().length == 0
    ) {
      $("#submit-" + username).prop("disabled", false);
      $("#password-finished-" + username).text("");
    } else {
      $("#submit-" + username).prop("disabled", true);
      $("#password-finished-" + username).text("password is too short");
    }
  });

  $("#delete-" + username).on("click", function () {
    $.getJSON(
      "/api/user_api.php",
      { req: "delete", username: username },
      function (data, textStatus, jqXHR) {
        $("#admin-cart-" + username).hide("slow", function () {
          $("#admin-cart-" + username).remove();
        });
      }
    );
  });
}
