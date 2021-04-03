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

  $("#submit-" + username).on("click", function (param) {
    $.get(
      "/api/admin_api.php",
      {
        req: "update",
        username: username,
        password: $("#password-" + username).val(),
        permission: $("#permission-" + username).val(),
      },
      function (data, textStatus, jqXHR) {
        var json = JSON.parse(data);
        var newPermission = json.permission;

        $("#password-" + username).val("");

        $("#permission-" + username).val(newPermission);

        if (newPermission == 0) {
          $("#access-image-" + username).attr(
            "src",
            "/public/View/img/limited.png"
          );

          $("#intro-" + username).text("he has no access");
        }

        if (newPermission == 2) {
          $("#access-image-" + username).attr(
            "src",
            "/public/View/img/read-access.png"
          );

          $("#intro-" + username).text("Just can see another admins");
        }

        if (newPermission == 6) {
          $("#access-image-" + username).attr(
            "src",
            "/public/View/img/write-access.png"
          );

          $("#intro-" + username).html(
            "Super admin.<br>" +
              "He can: <br>" +
              "<ul>" +
              "<li>Create new admin</li>" +
              "<li>Edit exist admins</li>" +
              "<li>Delete exist admins</li>" +
              "</ul>"
          );
        }
      }
    );
  });
}
