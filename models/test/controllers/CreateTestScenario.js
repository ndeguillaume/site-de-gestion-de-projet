document.querySelectorAll('.add-test-scenario').forEach(
    function (button) {
      button.addEventListener(
        'click',
        function () {
          if (document.querySelector('#new-test-scenario') !== null) {
            document.querySelector('#new-test-scenario').remove()
          }
          const newTestScenario = document.createElement('div')
          const input = document.createElement('textarea')
          input.class = 'input-test-scenario-title'
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
          newTestScenario.id = ('new-test-scenario')
          newTestScenario.appendChild(input)
          this.parentElement.parentElement.previousSibling.appendChild(newTestScenario)
  
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
                  '../controllers/CreateTestScenario.php',
                  {
                    title: input.value,
                  },
                  function (returnedData) {
                    console.log(returnedData)
                    location.reload()
                  }
                )
                document.querySelector('#new-test-scenario').remove()
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
  