function handleCarts(username) {
  $("#permission-" + username).on("click", function () {
    if ($("#password-" + username).val().length < 1) {
      $("#password-finished-" + username).text("password won't update.");
    } else {
      $("#password-finished-" + username).text("");
    }
  });
