$("#username").on("keyup", function () {
  $.get(
    "/api/admin_api.php",
    {
      req: "search in usernames",
      username: $("#username").val(),
    },
    function (data, textStatus, jqXHR) {
      var status = JSON.parse(data).status;

      var user = $("#username").val();

      if (status == 200) {
        $("#username-finished").text('user "' + user + '" exists.');
        $("#password").prop("disabled", false);
      } else {
        $("#username-finished").text("");
        $("#password").prop("disabled", true);
      }
    }
  );
});

$("#password").on("keyup", function () {
  $.get(
    "/api/admin_api.php",
    {
      req: "search in passwords",
      username: $("#username").val(),
      password: $("#password").val(),
    },
    function (data, textStatus, jqXHR) {
      var status = JSON.parse(data).status;

      var user = $("#username").val();
      var pass = $("#password").val();

      if (status == 200) {
        $("#password-finished").text("correct password");
        $("#submit").prop("disabled", false);
      } else {
        $("#password-finished").text("");
        $("#submit").prop("disabled", true);
      }
    }
  );
});
