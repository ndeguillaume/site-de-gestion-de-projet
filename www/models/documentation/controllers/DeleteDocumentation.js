document.querySelectorAll('.delete-documentation').forEach(
  function (button) {
    button.addEventListener(
      'click',
      function (e) {
        e.stopPropagation()
        const modal = document.createElement('div')
        const modalContent = document.createElement('div')
        const modalHeader = document.createElement('div')
        const modalBody = document.createElement('div')
        const modalFooter = document.createElement('div')
        modal.id = 'documentation-modal'
        modal.className = 'modal'
        modalContent.className = 'modal-content'
        modalHeader.className = 'modal-header'
        modalBody.className = 'modal-body'
        modalFooter.className = 'modal-footer'
        const headerContent = document.createElement('h1')
        const headerNode = document.createTextNode("Supprimer la documentation");
        const bodyContent = document.createElement('p')
        const deleteButton = document.createElement('button')
        const cancelButton = document.createElement('button')
        deleteButton.innerHTML = 'Supprimer'
        deleteButton.className = 'delete-button'
        cancelButton.innerHTML = 'Annuler'
        cancelButton.className = 'cancel-button'
        deleteButton.classList.add('btn', 'btn-danger')
        cancelButton.classList.add('btn', 'btn-light')
        headerContent.appendChild(headerNode)
        modalHeader.appendChild(headerContent)
        modalBody.appendChild(bodyContent)
        modalFooter.appendChild(cancelButton)
        modalFooter.appendChild(deleteButton)
        modalContent.appendChild(modalHeader)
        modalContent.appendChild(modalBody)
        modalContent.appendChild(modalFooter)
        modal.appendChild(modalContent)
        doc_type = this.parentElement.classList[0].split("-")[0]
        if (doc_type === "user") {
          bodyContent.innerHTML = "Vous allez définitivement supprimer la documentation utilisateur"
        }
        else {
          bodyContent.innerHTML = "Vous allez définitivement supprimer la documentation d'installation"
        }
        const body = document.querySelector('body')
        body.appendChild(modal)
        modal.style.display = 'block'

        window.onclick = function (event) {
          if (event.target === modal) {
            modal.style.display = 'none'
            body.removeChild(modal);
          }
        }

        cancelButton.addEventListener(
          'click',
          function (e) {
            modal.style.display = 'none'
            body.removeChild(modal);
          }
        )

        deleteButton.addEventListener(
          'click',
          function (e) {
            window.$.delete(
              '../controllers/DeleteDocumentation.php?type=' + doc_type,
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
