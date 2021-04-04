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

function registredHandleCarts(username) {
  $("#permission-" + username).on("click", function () {
    if ($("#password-" + username).val().length < 1) {
      $("#password-finished-" + username).text("password won't update.");
    } else {
      $("#password-finished-" + username).text("");
    }
  });
}
