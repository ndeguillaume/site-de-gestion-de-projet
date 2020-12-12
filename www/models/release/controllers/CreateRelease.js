document.querySelector('.add-release').addEventListener('click',
  function () {
    window.$.get(
      '../controllers/GetRelease.php',
      function (returnedData) {
        const modal = document.createElement('div')
        const modalContent = document.createElement('div')
        const modalHeader = document.createElement('div')
        const modalBody = document.createElement('div')
        const modalFooter = document.createElement('div')

        modal.id = 'create-release-modal'
        modal.className = 'modal'
        modalContent.className = 'modal-content'
        modalHeader.className = 'modal-header'
        modalBody.className = 'modal-body'
        modalFooter.className = 'modal-footer'

        const selectedIssues = document.createElement('div')
        const validateButton = document.createElement('button')
        const cancelButton = document.createElement('button')
        const inputFile = document.createElement('input')
        validateButton.innerHTML = 'Valider'
        validateButton.className = 'validate-button'
        cancelButton.innerHTML = 'Annuler'
        cancelButton.className = 'cancel-button'


        selectedIssues.id = "selected-issues"
        validateButton.classList.add('btn', 'btn-success')
        cancelButton.classList.add('btn', 'btn-light')
        inputFile.type = 'file'
        inputFile.id = 'newRelease'
        inputFile.accept = '.zip,.rar,.7zip,.tar.gz'
        if (returnedData[3] !== null && returnedData[3] !== "") {

          const headerContent = document.createElement('h1')
          const headerNode = document.createTextNode('Ajouter une release')
          const bodyContent = document.createElement('p')
          const inputFile = document.createElement('input')
          const radioButton1 = document.createElement('input')
          const radioButton2 = document.createElement('input')
          const radioButton3 = document.createElement('input')
          const label1 = document.createElement('label')
          const label2 = document.createElement('label')
          const label3 = document.createElement('label')
          const label4 = document.createElement('label')

          inputFile.type = 'file'
          inputFile.id = 'newRelease'
          inputFile.accept = '.zip,.rar,.7zip,.tar.gz'
          radioButton1.type = 'radio'
          radioButton1.id = 'radio-majeure'
          radioButton1.name = "radio-button-version"
          radioButton1.checked = true
          label1.htmlFor = 'majeure'
          radioButton2.type = 'radio'
          radioButton2.id = 'radio-mineure'
          radioButton2.name = "radio-button-version"
          label2.htmlFor = 'mineure'
          radioButton3.type = 'radio'
          radioButton3.id = 'radio-patch'
          radioButton3.name = "radio-button-version"
          label3.htmlFor = 'patch'
          label4.htmlFor = "dropdown"

          label1.appendChild(document.createTextNode('Version majeure'))
          label2.appendChild(document.createTextNode('Version mineure'))
          label3.appendChild(document.createTextNode('Patch'))
          label4.appendChild(document.createTextNode('Issues terminées : '))

          headerContent.appendChild(headerNode)
          modalHeader.appendChild(headerContent)
          modalBody.appendChild(bodyContent)

          modalBody.appendChild(inputFile)
          modalBody.appendChild(document.createElement('div'))
          modalBody.appendChild(radioButton1)
          modalBody.appendChild(label1)
          modalBody.appendChild(document.createElement('div'))
          modalBody.appendChild(radioButton2)
          modalBody.appendChild(label2)
          modalBody.appendChild(document.createElement('div'))
          modalBody.appendChild(radioButton3)
          modalBody.appendChild(label3)
          modalBody.appendChild(document.createElement('div'))
          modalBody.appendChild(label4)
          modalBody.appendChild(selectedIssues)
          modalBody.appendChild(validateButton)

          modalFooter.appendChild(cancelButton)
          modalFooter.appendChild(validateButton)
          modalContent.appendChild(modalHeader)
          modalContent.appendChild(modalBody)
          modalContent.appendChild(modalFooter)
          modal.appendChild(modalContent)
          returnedData[3].split(",").forEach(addRelatedIssue);
        } else {
          const headerContent = document.createElement('h1')
          const headerNode = document.createTextNode('Créer un patch')
          const bodyContent = document.createElement('p')
          const bodyNode = document.createTextNode('Voulez-vous créer un patch ?')

          headerContent.appendChild(headerNode)
          bodyContent.appendChild(bodyNode)
          modalHeader.appendChild(headerContent)
          modalBody.appendChild(bodyContent)
          modalBody.appendChild(inputFile)
          modalBody.appendChild(validateButton)

          modalFooter.appendChild(cancelButton)
          modalFooter.appendChild(validateButton)
          modalContent.appendChild(modalHeader)
          modalContent.appendChild(modalBody)
          modalContent.appendChild(modalFooter)
          modal.appendChild(modalContent)
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

        validateButton.addEventListener(
          'click',
          function (e) {
            var fileToSend = new FormData()
            let major, minor, patch;
            major = parseInt(returnedData[0])
            minor = parseInt(returnedData[1])
            patch = parseInt(returnedData[2])
            if (returnedData[3] !== "") {
              if (returnedData[0] !== "") {
                if (document.getElementById("radio-majeure").checked) {
                  major++
                  minor = 0
                  patch = 0
                } else if (document.getElementById("radio-mineure").checked) {
                  minor++
                  patch = 0
                } else {
                  patch++
                }
              } else {
                major = 1
                minor = 0
                patch = 0
              }
            }
            else {
              patch++
            }

            let selected_issues = document.querySelectorAll('.issue-selected');
            let finishedIssues = "";
            for (var i = 0; i < selected_issues.length; i++) {
              finishedIssues += selected_issues[i].innerHTML + ','
            }
            let finished_issues = finishedIssues.substring(0, finishedIssues.length - 1)

            fileToSend.append("release", document.getElementById("newRelease").files[0])
            fileToSend.append("major", major)
            fileToSend.append("minor", minor)
            fileToSend.append("patch", patch)
            fileToSend.append("finished_issues", finished_issues)

            if (finished_issues !== "" || returnedData[3] == "") {
              $.ajax({
                url: '../controllers/CreateRelease.php',
                type: "POST",
                data: fileToSend,
                processData: false,
                contentType: false,
                success: function (response) {
                  console.log(response)
                  location.reload()
                },
                error: function (errorThrown) {
                  console.log(errorThrown)
                  alert("La release n'a pas pu être enregistrée, vérifiez le fichier que vous souhaitez ajouter")
                }
              })
            } else {
              alert("Vous devez lier des issues terminées à cette release !")
            }

            modal.style.display = 'none'
            body.removeChild(modal);
          }

        )

        cancelButton.addEventListener(
          'click',
          function (e) {
            modal.style.display = 'none'
            body.removeChild(modal);
          }
        )

        function addRelatedIssue(value, index) {
          let newElem = document.createElement('span')
          let removeButton = document.createElement("i")

          newElem.innerHTML = value
          newElem.id = "issues-selected-" + value
          newElem.classList.add("issue-selected")

          removeButton.className = "fas fa-times issues"
          removeButton.id = "remove-issue-" + value
          removeButton.name = "rmvButton"

          selectedIssues.appendChild(removeButton)
          selectedIssues.appendChild(newElem)

          removeButton.addEventListener('click', function (removeB) {
            removeIssueSelected(removeButton.id, newElem.id)
          })
        }
      }
    )
  })

function removeIssueSelected(idButton, idIssue) {
  let myElem = document.getElementById(idButton).parentNode
  myElem.removeChild(document.getElementById(idButton))
  myElem.removeChild(document.getElementById(idIssue))
}