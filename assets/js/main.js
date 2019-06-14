// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function logout() {
  $.ajax({
    type: 'POST',
    url: 'src/Controllers/AuthenticationController.php',
    datatype: 'text',
    data: 'fid=3',
    success: function (response) {
      $(location).attr('href', './index.php');
    },
    error: function (jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
      } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
        msg = 'Time out error.';
      } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
      } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      alert(msg);
    }
  });
}