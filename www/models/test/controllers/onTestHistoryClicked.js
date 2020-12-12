document.querySelectorAll('.test-history').forEach(function (button) {
    button.addEventListener("click", function () {
        let test_id = this.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML.split(" ")[0];
        let that = this;    
        window.$.get(
            '../controllers/GetTestHistory.php',
            {
                id: test_id
            },
            function (returnedData) {
                const modal = document.createElement('div')
                const modalContent = document.createElement('div')
                const modalHeader = document.createElement('div')
                const modalBody = document.createElement('div')
                const modalFooter = document.createElement('div')
                modal.id = 'test-history-modal'
                modal.className = 'modal'
                modalContent.className = 'modal-content'
                modalHeader.className = 'modal-header'
                modalBody.className = 'modal-body'
                modalFooter.className = 'modal-footer'
                const headerContent = document.createElement('h1')
                headerContent.innerHTML = "Historique"
                const bodyContent = document.createElement('div')
                const cancelButton = document.createElement('button')
                cancelButton.innerHTML = 'Fermer'
                cancelButton.className = 'cancel-button'
                cancelButton.classList.add('btn', 'btn-light')
                modalHeader.appendChild(headerContent)
                modalBody.appendChild(bodyContent)
                modalFooter.appendChild(cancelButton)
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

                let historyTitle = "<p><b>" + that.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML + "</b></p>";
                let historyContent =
                    "<div class='modal-table'>" +
                    "<table>" +
                    "<tr>" +
                    "<th>Date</th>" +
                    "<th>Résultat</th>" +
                    "</tr>"

                    let successCpt = 0;
                    let historyCpt = 0;
                for (row in returnedData) {
                    let date = returnedData[row]['date'].split(".")[0]
                    let res = returnedData[row]['res']

                    if (res === "true") {
                        res = "Succès"
                        successCpt++;
                    }
                    else {
                        res = "Échec"
                    }
                    historyCpt++;

                    historyContent += 
                        "<tr>" +
                        "<td>" + date + "</td>" +
                        "<td>" + res + "</td>" +
                        "</tr>"
                }
                 historyContent += "</table></div>"
                 let historySuccessRate = "<p>Succès du test : " + successCpt + "/" + historyCpt + "</p>"
                 bodyContent.innerHTML = historyTitle + historySuccessRate + historyContent
            })
    })
})