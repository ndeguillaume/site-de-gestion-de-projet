document.querySelectorAll('.add-issue').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function () {
        if (document.querySelector('#new-issue') !== null) {
          document.querySelector('#new-issue').remove()
        }
        const newIssue = document.createElement('div')
        const input = document.createElement('textarea')
        input.class = 'input-issue-title'
        input.maxLength = '255'
        input.style.width = '100%'
        input.style.backgroundColor = '#444'
        input.style.color = 'whitesmoke'
        input.style.border = 'none'
        input.style.resize = 'none'
        input.style.padding = '5px 10px 5px 10px'
        input.style.height = '34px'
        input.style.marginTop = '10px'
        input.style.fontSize = '16px'
        input.style.overflow = 'hidden'
        input.rows = '1'
        newIssue.id = ('new-issue')
        newIssue.appendChild(input)
        const numberOfIssues = document.querySelector('#' + this.parentElement.parentElement.previousSibling.id + ' ul').childElementCount
        const orderInSprint = numberOfIssues + 1
        this.parentElement.parentElement.previousSibling.appendChild(newIssue)

        const sprintId = (this.parentElement.parentElement.parentElement.id).split('-')[1]

        input.addEventListener(
          'click',
          function (e) {
            e.stopPropagation()
          }
        )

        input.addEventListener(
          'keydown',
          function (e) {
            if (e.key === 'Enter') {
              window.$.post(
                '../controllers/CreateIssue.php',
                {
                  title: input.value,
                  sprintId: sprintId,
                  orderInSprint: orderInSprint
                },
                function (returnedData) {
                  console.log(returnedData)
                  location.reload()
                }
              )
              document.querySelector('#new-issue').remove()
            } else {
              this.style.height = 'auto'
              this.style.height = this.scrollHeight + 'px'
            }
          }
        )
        input.focus()
      }
    )
  }
)
