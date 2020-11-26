document.querySelectorAll('.sprint-content > ul > li').forEach(
    function (testScenario) {
      testScenario.addEventListener(
        'click',
        function () {
          let thisHasTest = this.lastChild.classList[0] === "button-validate-wrapper"
          if (document.querySelector('.test-scenario-information .button-wrapper').childNodes.length > 0) {
            document.querySelector('.test-scenario-information .button-wrapper').removeChild(document.querySelector('.test-scenario-information .button-wrapper').childNodes[0])
            }
            window.$.get(
              '../controllers/GetTestScenario.php',
              {
                id: testScenario.id.split('-')[2]
              },
              function (returnedData) {
                if (document.querySelector('.selected-test-scenario') === testScenario || document.querySelector('.selected-test-scenario') === null) {
                  testScenario.classList.toggle('selected-test-scenario')
                  document.querySelector('.test-scenario-content').classList.toggle('col-12')
                  document.querySelector('.test-scenario-content').classList.toggle('col-8')
                  document.querySelector('.test-scenario-information').classList.toggle('col-4')
                  document.querySelector('.test-scenario-information').classList.toggle('hidden')
                } else {
                  document.querySelector('.selected-test-scenario').classList.toggle('selected-test-scenario')
                  testScenario.classList.toggle('selected-test-scenario')
                }
                document.querySelector('.test-scenario-information .test-scenario-id').innerHTML = returnedData[0]
                document.querySelector('.test-scenario-information-title').value = returnedData[1]
                document.querySelector('.test-scenario-information-description').value = ''
                if (returnedData[2] !== null) {
                  document.querySelector('.test-scenario-information-description').value = returnedData[2]
                }
  
                document.querySelector('.test-scenario-information-description').style.height = 'auto'
                document.querySelector('.test-scenario-information-description').style.height = (16 + document.querySelector('.test-scenario-information-description').scrollHeight) + 'px'
  
                document.querySelector('.test-scenario-information-title').style.height = 'auto'
                document.querySelector('.test-scenario-information-title').style.height = (16 + document.querySelector('.test-scenario-information-title').scrollHeight) + 'px'
              }
            )
            if (thisHasTest)
            {
              createUpdateButton();
              $(".test-scenario-information-title").prop("disabled", false);
              $(".test-scenario-information-description").prop("disabled", false);
            } else {
              $(".test-scenario-information-title").prop("disabled",true);
              $(".test-scenario-information-description").prop("disabled",true);
            }
        }
      )
    }
  )

  function createUpdateButton() {
    const button = document.createElement('button')
    button.classList.add('btn', 'btn-success')
    button.innerHTML = 'Modifier'
    document.querySelector('.test-scenario-information .button-wrapper').appendChild(button)
    document.querySelector('.test-scenario-information button').addEventListener('click', buttonClickListener)
}
  
  window.onclick = function (event) {
    let isInSprint = false
    document.querySelectorAll('.sprint-content').forEach(element => {
      if (element.contains(event.target)) {
        isInSprint = true
      }
    })
    if (event.target !== document.querySelector('.test-scenario-information') &&
          !document.querySelector('.test-scenario-information').contains(event.target)&&
          !isInSprint) {
      if (!document.querySelector('.test-scenario-information').classList.contains('hidden')) {
        document.querySelector('.selected-test-scenario').classList.toggle('selected-test-scenario')
        document.querySelector('.backlog-content').classList.toggle('col-12')
        document.querySelector('.backlog-content').classList.toggle('col-8')
        document.querySelector('.test-scenario-information').classList.toggle('col-4')
        document.querySelector('.test-scenario-information').classList.toggle('hidden')
      }
      if (event.target.parentElement !== document.querySelector('.input-test-scenario-title') &&
      document.querySelector('#new-test-scenario') !== null) {
      let isAddIssue = false
      document.querySelectorAll('.add-test-scenario').forEach(element => {
        if (element === event.target) {
          isAddIssue = true
        }
      })
      if (!isAddIssue) {
        document.querySelector('#new-test-scenario').remove()
      }
    }
    }
  }
  
  function buttonClickListener(){
    let putRequest = '../controllers/UpdateTestScenario.php?id=' + document.querySelector('.test-scenario-information .test-scenario-id').innerHTML
    putRequest += '&title=' + document.querySelector('.test-scenario-information-title').value
    putRequest += '&description=' + document.querySelector('.test-scenario-information-description').value
    window.$.put(
      putRequest,{},
      function (returnedData) {
        location.reload()
      }
    )
  }

  function textAreaAdjust(element)
{
    element.style.height = 'auto'
    element.style.height = (16 + element.scrollHeight) + 'px'
}