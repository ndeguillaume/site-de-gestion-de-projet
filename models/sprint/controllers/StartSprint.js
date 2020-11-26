document.querySelectorAll('.start-sprint').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function () {
        const modal = document.createElement('div')
        const sprintId = this.parentNode.parentNode.parentNode.id.split('-')[1]
        const modalContent = document.createElement('div')
        const modalHeader = document.createElement('div')
        const modalBody = document.createElement('div')
        const modalFooter = document.createElement('div')

        const inputDateStart = document.createElement('input')
        const inputHourStart = document.createElement('input')
        const inputDateEnd = document.createElement('input')
        const inputHourEnd = document.createElement('input')

        const labelDateStart = document.createElement('Label')
        const labelHourStart = document.createElement('label')
        const labelDateEnd = document.createElement('label')
        const labelHourEnd = document.createElement('label')

        const today = new Date()
        const currentYear = today.getFullYear()
        const currentMonth = ('0' + (today.getMonth() + 1)).slice(-2)
        const currentDay = ('0' + today.getDate()).slice(-2)
        const currentHour = ('0' + today.getHours()).slice(-2)
        const currentMinute = ('0' + today.getMinutes()).slice(-2)
        inputDateStart.type = 'date'
        inputDateStart.name = 'date-start'
        inputDateStart.id = 'date-start'
        inputDateStart.disabled = 'true'
        inputDateEnd.id = 'date-end'
        inputDateStart.setAttribute('value', currentYear + '-' + currentMonth + '-' + currentDay)

        inputHourStart.type = 'time'
        inputHourStart.name = 'hour-start'
        inputHourStart.id = 'hour-start'
        inputHourStart.disabled = 'true'
        inputHourStart.setAttribute('value', currentHour + ':' + currentMinute)

        inputDateEnd.type = 'date'
        inputDateEnd.name = 'date-end'
        inputDateEnd.setAttribute('value', currentYear + '-' + currentMonth + '-' + currentDay)

        inputHourEnd.type = 'time'
        inputHourEnd.name = 'hour-start'
        inputHourEnd.id = 'hour-start'
        inputHourEnd.setAttribute('value', currentHour + ':' + currentMinute)

        labelDateStart.className = 'modal-label'
        labelDateStart.htmlFor = 'date-start'
        labelDateStart.innerHTML = 'Date de début : '

        labelHourStart.className = 'modal-label'
        labelHourStart.htmlFor = 'hour-start'
        labelHourStart.innerHTML = 'Heure de début : '

        labelDateEnd.className = 'modal-label'
        labelDateEnd.htmlFor = 'date-end'
        labelDateEnd.innerHTML = 'Date de fin : '

        labelHourEnd.className = 'modal-label'
        labelHourEnd.htmlFor = 'hour-end'
        labelHourEnd.innerHTML = 'Heure de fin : '

        modal.id = 'start-sprint-modal'
        modal.className = 'modal'
        modalContent.className = 'modal-content'
        modalHeader.className = 'modal-header'
        modalBody.className = 'modal-body'
        modalFooter.className = 'modal-footer'
        const startDiv = document.createElement('div')
        startDiv.id = 'start-div-modal'
        startDiv.appendChild(labelDateStart)
        startDiv.appendChild(inputDateStart)
        startDiv.appendChild(labelHourStart)
        startDiv.appendChild(inputHourStart)
        const endDiv = document.createElement('div')
        endDiv.id = 'end-div-modal'
        endDiv.appendChild(labelDateEnd)
        endDiv.appendChild(inputDateEnd)
        endDiv.appendChild(labelHourEnd)
        endDiv.appendChild(inputHourEnd)
        const headerContent = document.createElement('h1')
        const headerNode = document.createTextNode('Démarrer le sprint')
        const bodyContent = document.createElement('div')
        const validationButton = document.createElement('button')
        const cancelButton = document.createElement('button')

        validationButton.innerHTML = 'Lancer'
        validationButton.className = 'validation-button'
        cancelButton.innerHTML = 'Annuler'
        cancelButton.className = 'cancel-button'

        validationButton.classList.add('btn', 'btn-danger')
        cancelButton.classList.add('btn', 'btn-light')

        headerContent.appendChild(headerNode)
        bodyContent.appendChild(startDiv)
        bodyContent.appendChild(endDiv)
        modalHeader.appendChild(headerContent)
        modalBody.appendChild(bodyContent)

        modalFooter.appendChild(cancelButton)
        modalFooter.appendChild(validationButton)
        modalContent.appendChild(modalHeader)
        modalContent.appendChild(modalBody)
        modalContent.appendChild(modalFooter)
        modal.appendChild(modalContent)

        const body = document.querySelector('body')
        body.appendChild(modal)
        modal.style.display = 'block'

        window.onclick = function (event) {
          if (event.target === modal) {
            modal.style.display = 'none'
          }
        }

        cancelButton.addEventListener(
          'click',
          function (e) {
            modal.style.display = 'none'
          }
        )

        inputDateEnd.addEventListener(
          'click',
          function (e) {
            inputDateEnd.removeAttribute('style')
          }
        )

        validationButton.addEventListener(
          'click',
          function (e) {
            const startDate = new Date(inputDateStart.value + ' ' + inputHourStart.value)
            const endDate = new Date(inputDateEnd.value + ' ' + inputHourEnd.value)
            if (Object.prototype.toString.call(endDate) === '[object Date]') {
              if (isNaN(endDate.getTime())) {
                inputDateEnd.style.boxShadow = '0 0 3px 2px red'
              } else {
                if (startDate >= endDate) {
                  inputDateEnd.style.boxShadow = '0 0 3px 2px red'
                } else {
                  window.$.post(
                    '../../sprint/controllers/StartSprint.php',
                    {
                      id: sprintId,
                      begin_date: inputDateStart.value + ' ' + inputHourStart.value,
                      end_date: inputDateEnd.value + ' ' + inputHourEnd.value
                    },
                    function (returnedData) {
                      console.log(returnedData)
                      location.reload()
                    }
                  )
                  modal.style.display = 'none'
                }
              }
            } else {
              inputDateEnd.style.boxShadow = '0 0 3px 2px red'
            }
          }
        )
      }
    )
  }
)
