let addTaskTest = true;
document.querySelectorAll('.button-validate-wrapper > button').forEach(
  function (testScenario) {
    testScenario.addEventListener("click", function (e) {
      e.stopPropagation();
      const testScenarioId = this.parentElement.previousElementSibling.previousElementSibling.innerHTML
      const that = this;
      const cancelButton = document.createElement('button')
      const validateButton = document.createElement('button')
      const modal = document.createElement('div')
      window.$.get(
        '../controllers/GetTestScenario.php',
        {
          id: testScenarioId
        },
        function (returnedData) {

          const modalContent = document.createElement('div')
          const modalHeader = document.createElement('div')
          const modalBody = document.createElement('div')
          const modalFooter = document.createElement('div')
          modal.id = 'test-scenario-modal'
          modal.className = 'modal'
          modalContent.className = 'modal-content'
          modalHeader.className = 'modal-header'
          modalBody.className = 'modal-body'
          modalFooter.className = 'modal-footer'
          const headerContent = document.createElement('h1');
          headerContent.innerHTML = "Valider le scénario ";
          const testScenarioTitle = that.parentElement.previousElementSibling.innerHTML;
          const modalScenarioId = document.createElement("span");
          modalScenarioId.classList.add("test-scenario-id");
          modalScenarioId.innerHTML = testScenarioId;
          const bodyContent = document.createElement('div')
          validateButton.innerHTML = 'Valider'
          validateButton.className = 'validate-button'
          cancelButton.innerHTML = 'Annuler'
          cancelButton.className = 'cancel-button'
          validateButton.classList.add('btn', 'btn-success')
          cancelButton.classList.add('btn', 'btn-light')

          const titleDiv = document.createElement('div')
          titleDiv.classList.add('modal-content-title')
          const titleTitle = document.createElement('h3');
          titleTitle.innerHTML = "Titre";
          const titleP = document.createElement('p')
          titleP.innerHTML = testScenarioTitle
          titleDiv.appendChild(titleTitle)
          titleDiv.appendChild(titleP)
          bodyContent.appendChild(titleDiv)

          const descriptionDiv = document.createElement('div')
          descriptionDiv.classList.add('modal-content-description')
          const descriptionTitle = document.createElement('h3');
          descriptionTitle.innerHTML = "Description";
          const descriptionP = document.createElement('p')
          if (returnedData[2] === "" || returnedData[2] === null) {
            descriptionP.innerHTML = "Pas de description"
          }
          else {
            descriptionP.innerHTML = returnedData[2];
          }
          descriptionDiv.appendChild(descriptionTitle)
          descriptionDiv.appendChild(descriptionP)
          bodyContent.appendChild(descriptionDiv)
          headerContent.appendChild(modalScenarioId)

          const typeDiv = document.createElement('div')
          typeDiv.classList.add('modal-content-type')
          const typeTitle = document.createElement('h3');
          typeTitle.innerHTML = "Type du test";
          typeDiv.appendChild(typeTitle)

          const radioUnitaryInput = document.createElement('div');
          radioUnitaryInput.innerHTML = '<input type="radio" name="type-test"/>';
          radioUnitaryInput.firstChild.checked = true;
          const unitaryLabel = document.createElement('label')
          unitaryLabel.innerHTML = "unitaire"
          typeDiv.appendChild(radioUnitaryInput)
          typeDiv.appendChild(unitaryLabel)

          const radioE2EInput = document.createElement('div');
          radioE2EInput.innerHTML = '<input type="radio" name="type-test" />';
          const E2ELabel = document.createElement('label')
          E2ELabel.innerHTML = "e2e"
          typeDiv.appendChild(radioE2EInput)
          typeDiv.appendChild(E2ELabel)

          bodyContent.appendChild(typeDiv)

          const relatedTaskDiv = document.createElement('div')
          relatedTaskDiv.classList.add('modal-content-related')
          const relatedTaskTitle = document.createElement('h3');
          relatedTaskTitle.innerHTML = "Tâche associée";
          let relatedTaskSelect = document.createElement('select')
          titleP.innerHTML = testScenarioTitle
          relatedTaskDiv.appendChild(relatedTaskTitle)
          relatedTaskDiv.appendChild(relatedTaskSelect)
          bodyContent.appendChild(relatedTaskDiv)

          radioUnitaryInput.firstChild.addEventListener("click", function () {
            relatedTaskDiv.removeChild(relatedTaskSelect)
            relatedTaskSelect = document.createElement("select")
            relatedTaskDiv.appendChild(relatedTaskSelect)
            displayRelatedTaskCategory(relatedTaskDiv, relatedTaskSelect)
            addTaskTest = true;
          })

          radioE2EInput.firstChild.addEventListener("click", function () {
            relatedTaskDiv.removeChild(relatedTaskSelect)
            relatedTaskSelect = document.createElement("select")
            relatedTaskDiv.appendChild(relatedTaskSelect)
            displayRelatedIssueCategory(relatedTaskDiv, relatedTaskSelect)
            addTaskTest = false;
          })


          displayRelatedTaskCategory(relatedTaskDiv, relatedTaskSelect)
          modalHeader.appendChild(headerContent)
          modalBody.appendChild(bodyContent)
          modalFooter.appendChild(cancelButton)
          modalFooter.appendChild(validateButton)
          modalContent.appendChild(modalHeader)
          modalContent.appendChild(modalBody)
          modalContent.appendChild(modalFooter)
          modal.appendChild(modalContent)

          const body = document.querySelector('body')
          body.appendChild(modal)
          modal.style.display = 'block'
        })

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

      validateButton.addEventListener(
        'click',
        function (e) {
          let testTitle = document.querySelector('.modal-content-title p').innerHTML;
          let testRelatedIssue = document.querySelector('.modal-content-related select').value.split(" ")[0].split("#")[1];

          if (addTaskTest) {
            window.$.post(
              '../controllers/CreateTest.php',
              {
                title: testTitle,
                fk_task_id: testRelatedIssue,
                fk_test_scenario_id: testScenarioId,
                fk_issue_id: "NULL"
              },
              function (returnedData) {
                location.reload()
              }
            )
          } 
          else {
            window.$.post(
              '../controllers/CreateTest.php',
              {
                title: testTitle,
                fk_issue_id: testRelatedIssue,
                fk_test_scenario_id: testScenarioId,
                fk_task_id: "NULL"
              },
              function (returnedData) {
                location.reload()
              }
            )
          }
        }
      )
    })
  }
);

function displayRelatedTaskCategory(relatedTaskDiv, relatedTaskSelect) {
  window.$.get(
    '../../task/controllers/GetTasksWithoutTest.php',
    {},
    function (returnedData) {
      relatedTaskDiv.querySelector("h3").innerHTML = "Tâche associée"
      for (task in returnedData) {
        let option = document.createElement('option')
        option.text = "#" + returnedData[task][0] + " : " + returnedData[task][1]
        relatedTaskSelect.add(option)
      }
    })
}

function displayRelatedIssueCategory(relatedTaskDiv, relatedTaskSelect) {
  window.$.get(
    '../../issue/controllers/GetIssuesWithoutTest.php',
    {},
    function (returnedData) {
      relatedTaskDiv.querySelector("h3").innerHTML = "Issue associée"
      for (issue in returnedData) {
        let option = document.createElement('option')
        option.text = "#" + returnedData[issue][0] + " : " + returnedData[issue][1]
        relatedTaskSelect.add(option)
      }
    })
}