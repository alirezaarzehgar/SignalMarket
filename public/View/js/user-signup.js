$("#username").on("keyup", function () {
  $.get(
    "/api/user_api.php",
    {
      req: "search in usernames",
      username: $("#username").val(),
    },
    function (data, textStatus, jqXHR) {
      var status = JSON.parse(data).status;

      var user = $("#username").val();

      if (status == 200) {
        $("#username-finished").text('user "' + user + '" exists.');
        $("#email").prop("disabled", true);
      } else if ($("#username").val().length < 3) {
        $("#username-finished").text("");

        $("#email").prop("disabled", true);
      } else {
        $("#username-finished").text("");
        $("#email").prop("disabled", false);
      }
    }
  );
});

$("#email").on("keyup", function () {
  $.get(
    "/api/user_api.php",
    {
      req: "search in emails",
      email: $("#email").val(),
    },
    function (data, textStatus, jqXHR) {
      var status = JSON.parse(data).status;

      var email = $("#email").val();

      if (status == 200) {
        $("#email-finished").text("this email already exists.");
        $("#password").prop("disabled", true);
      } else if ($("#email").val().length < 6) {
        $("#email-finished").text("");

        $("#password").prop("disabled", true);
      } else {
        $("#email-finished").text("");
        $("#password").prop("disabled", false);
      }
    }
  );
});

$("#password").on("keyup", function () {
  if ($("#password").val().length < 7) {
    $("#submit").prop("disabled", true);
  } else {
    $("#submit").prop("disabled", false);
  }
});
