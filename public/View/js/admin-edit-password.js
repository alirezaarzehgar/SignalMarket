$("#password").on("keyup", function () {
  if ($("#password").val().length > 6) {
    $("#submit").prop("disabled", false);
    $("#password-finished").text("");
  } else {
    $("#submit").prop("disabled", true);
    $("#password-finished").text("password is too short");
  }
});
