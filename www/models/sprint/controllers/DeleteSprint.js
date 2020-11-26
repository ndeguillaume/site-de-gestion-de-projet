document.querySelectorAll('.delete-sprint').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function () {
        const modal = document.createElement('div')
        const modalContent = document.createElement('div')
        const modalHeader = document.createElement('div')
        const modelBody = document.createElement('div')
        const modalFooter = document.createElement('div')
        modal.id = 'sprint-modal'
        modal.className = 'modal'
        modalContent.className = 'modal-content'
        modalHeader.className = 'modal-header'
        modelBody.className = 'modal-body'
        modalFooter.className = 'modal-footer'
        const headerContent = document.createElement('h1')
        const sprintId = this.parentNode.parentNode.parentNode.parentNode.id.split('-')[1]
        const sprintTitle = this.parentNode.innerText.split('-')[0]
        const headerNode = document.createTextNode('Supprimer le sprint ' + sprintId + '?')
        const bodyContent = document.createElement('p')
        const bodyNode = document.createTextNode('Vous allez définitivement supprimer le sprint suivant : \n' + sprintTitle)
        const deleteButton = document.createElement('button')
        const cancelButton = document.createElement('button')
        deleteButton.innerHTML = 'Supprimer'
        deleteButton.className = 'delete-button'
        cancelButton.innerHTML = 'Annuler'
        cancelButton.className = 'cancel-button'
        deleteButton.classList.add('btn', 'btn-danger')
        cancelButton.classList.add('btn', 'btn-light')
        headerContent.appendChild(headerNode)
        bodyContent.appendChild(bodyNode)
        modalHeader.appendChild(headerContent)
        modelBody.appendChild(bodyContent)
        modalFooter.appendChild(cancelButton)
        modalFooter.appendChild(deleteButton)
        modalContent.appendChild(modalHeader)
        modalContent.appendChild(modelBody)
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

        deleteButton.addEventListener(
          'click',
          function (e) {
            window.$.delete(
              '../../sprint/controllers/DeleteSprint.php?id=' + sprintId,
              {},
              function (returnedData) {
                console.log(returnedData)
                location.reload()
              }
            )
          }
        )
      }
    )
  }
)
