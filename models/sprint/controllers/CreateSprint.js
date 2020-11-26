document.querySelectorAll('.add-sprint').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function () {
        window.$.post(
          '../../sprint/controllers/CreateSprint.php',
          '',
          function (returnedData) {
            console.log(returnedData)
            location.reload()
          }
        )
      }
    )
  }
)
