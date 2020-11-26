document.querySelectorAll('.add-task').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function () {
        if (document.querySelector('#new-task') !== null) {
          document.querySelector('#new-task').remove()
        }
        const newTask = document.createElement('div')
        const cancel = document.createElement('i')
        const input = document.createElement('input')
        cancel.classList.add('fas', 'fa-times')
        cancel.id = 'cancel-delete-task'

        newTask.id = ('new-task')
        newTask.appendChild(input)
        newTask.appendChild(cancel)

        this.parentElement.parentElement.previousSibling.appendChild(newTask)

        cancel.addEventListener(
          'click',
          function () {
            document.querySelector('#new-task').remove()
          }
        )

        input.addEventListener(
          'keypress',
          function (e) {
            if (e.key === 'Enter') {
              window.$.post(
                '../controllers/CreateTask.php',
                {
                  title: input.value
                },
                function (returnedData) {
                  console.log(returnedData)
                  location.reload()
                }
              )

              document.querySelector('#new-task').remove()
            }
          }
        )

        input.focus()
      }
    )
  }
)
