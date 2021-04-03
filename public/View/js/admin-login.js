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
        $("#submit").prop("disabled", false);
        $("#password").prop("disabled", false);
      } else {
        $("#username-finished").text("");
        $("#submit").prop("disabled", true);
        $("#password").prop("disabled", true);
      }
    }
  );
});
