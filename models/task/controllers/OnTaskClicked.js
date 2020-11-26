document.querySelectorAll('.sprint-content > ul > li').forEach(
  function (task) {
    task.addEventListener(
      'click',
      function () {
        if (task.classList.contains('dropped')) {
          task.classList.remove('dropped')
        } else {
          if (document.querySelector('.task-information .button-wrapper').childNodes.length > 0) {
            document.querySelector('.task-information .button-wrapper').removeChild(document.querySelector('.task-information .button-wrapper').childNodes[0])
          }
          window.$.get(
            '../controllers/GetTask.php', {
              id: task.id.split('-')[1]
            },
            function (returnedData) {
              if (document.querySelector('.selected-task') === task || document.querySelector('.selected-task') === null) {
                task.classList.toggle('selected-task')
                document.querySelector('.backlog-content').classList.toggle('col-12')
                document.querySelector('.backlog-content').classList.toggle('col-8')
                document.querySelector('.task-information').classList.toggle('col-4')
                document.querySelector('.task-information').classList.toggle('hidden')
              } else {
                document.querySelector('.selected-task').classList.toggle('selected-task')
                task.classList.toggle('selected-task')
              }
              document.querySelector('.task-information .task-id').innerHTML = returnedData[0]
              document.querySelector('.task-information-title').value = returnedData[1]
              document.querySelector('.task-information-description').value = ''
              if (returnedData[2] !== null) {
                document.querySelector('.task-information-description').value = returnedData[2]
              }
              document.querySelector('.task-information-dod').value = ''
              if (returnedData[3] !== null) {
                document.querySelector('.task-information-dod').value = returnedData[3]
              }
              document.querySelector('.task-information-cost').value = ''
              if (returnedData[4] !== null) {
                document.querySelector('.task-information-cost').value = returnedData[4]
              }

              document.querySelector('.related-issues-dropdown').innerHTML = "";
              if (returnedData[5] !== null) {
                let array = returnedData[5].split(',');
                let defaultOption = document.createElement('option')
                defaultOption.selected = "selected"
                defaultOption.disabled = true
                defaultOption.hidden = true
                document.querySelector('.related-issues-dropdown').appendChild(defaultOption)

                for (let i = 0; i < array.length; i++) {
                  let newOption = document.createElement('option')
                  newOption.appendChild(document.createTextNode(array[i]));
                  document.querySelector('.related-issues-dropdown').appendChild(newOption)
                }
                document.querySelector('.related-issues-dropdown').addEventListener('change', function () {
                  issuesDropDownChange()
                })
              }

              document.querySelector('.related-tasks-dropdown').innerHTML = "";
              if (returnedData[6] !== null) {
                let array = returnedData[6].split(',');
                let defaultOption = document.createElement('option')
                defaultOption.selected = "selected"
                defaultOption.disabled = true
                defaultOption.hidden = true
                document.querySelector('.related-tasks-dropdown').appendChild(defaultOption)
                for (let i = 0; i < array.length; i++) {
                  let newOption = document.createElement('option')
                  newOption.id = i;
                  newOption.appendChild(document.createTextNode(array[i]));
                  document.querySelector('.related-tasks-dropdown').appendChild(newOption)
                }
                document.querySelector('.related-tasks-dropdown').addEventListener('change', function () {
                  tasksDropDownChange()
                })
              }

              document.querySelector(".selected-issues-dependency").innerHTML = ""
              if (returnedData[7] !== null && returnedData[8] !== "") {
                let array = returnedData[7].split(',');
                for (let i = 0; i < array.length; i++) {
                  let value = array[i]
                  let newElem = document.createElement('span')
                  let removeButton = document.createElement("i")
              
                  newElem.innerHTML = value
                  newElem.id = "issues-selected-" + value
                  newElem.classList.add("issue-selected")
              
                  removeButton.className = "fas fa-times issues"
                  removeButton.id = "remove-issue-" + value
                  removeButton.name = "rmvButton"
              
                  document.querySelector('.selected-issues-dependency').appendChild(removeButton)
                  document.querySelector('.selected-issues-dependency').appendChild(newElem)
              
                  removeButton.addEventListener('click', function (removeB) {
                    removeIssueSelected(removeButton.id, newElem.id)
                  })
                }
              }

              document.querySelector(".selected-task-dependency").innerHTML = ""
              if (returnedData[8] !== null && returnedData[8] !== "") {
                let array = returnedData[8].split(',');
                for (let i = 0; i < array.length; i++) {
                  let value = array[i]
                  let newElem = document.createElement('span')
                  let removeButton = document.createElement("i")

                  newElem.innerHTML = value
                  newElem.id = "task-selected-" + value
                  newElem.classList.add("task-selected")

                  removeButton.className = "fas fa-times tasks"
                  removeButton.id = "remove-button-" + value
                  removeButton.name = "rmvButton"

                  document.querySelector('.selected-task-dependency').appendChild(removeButton)
                  document.querySelector('.selected-task-dependency').appendChild(newElem)

                  removeButton.addEventListener('click', function (removeB) {
                    removeTaskSelected(removeButton.id, newElem.id)
                  })
                }
              }

              document.querySelector('.task-information-description').style.height = 'auto'
              document.querySelector('.task-information-description').style.height = (16 + document.querySelector('.task-information-description').scrollHeight) + 'px'

              document.querySelector('.task-information-title').style.height = 'auto'
              document.querySelector('.task-information-title').style.height = (16 + document.querySelector('.task-information-title').scrollHeight) + 'px'

              document.querySelector('.task-information-dod').style.height = 'auto'
              document.querySelector('.task-information-dod').style.height = (16 + document.querySelector('.task-information-dod').scrollHeight) + 'px'
            }
          )
          createUpdateButton(this)
        }
      }
    )
  }
)

function createUpdateButton(element) {
  const button = document.createElement('button')
  button.classList.add('btn', 'btn-success')
  button.innerHTML = 'Modifier'
  document.querySelector('.task-information .button-wrapper').appendChild(button)
  document.querySelector('.task-information button').addEventListener('click', buttonClickListener)
}

window.onclick = function (event) {
  let isInSprint = false
  document.querySelectorAll('.sprint-content').forEach(element => {
    if (element.contains(event.target)) {
      isInSprint = true
    }
  })

  if (event.target !== document.querySelector('.task-information') &&
    !document.querySelector('.task-information').contains(event.target) &&
    !isInSprint && event.target.name != "rmvButton") {
    if (!document.querySelector('.task-information').classList.contains('hidden')) {
      document.querySelector('.selected-task').classList.toggle('selected-task')
      document.querySelector('.backlog-content').classList.toggle('col-12')
      document.querySelector('.backlog-content').classList.toggle('col-8')
      document.querySelector('.task-information').classList.toggle('col-4')
      document.querySelector('.task-information').classList.toggle('hidden')
      document.querySelector('.selected-task-dependency').innerHTML = ""
      document.querySelector('.selected-issues-dependency').innerHTML = ""
    }
  }
}

function buttonClickListener() {

  if (document.querySelector(".selected-issues-dependency").innerHTML !== "") {
    let putRequest = '../controllers/UpdateTask.php?id=' + document.querySelector('.task-information .task-id').innerHTML
    putRequest += '&title=' + document.querySelector('.task-information-title').value
    putRequest += '&description=' + document.querySelector('.task-information-description').value
    putRequest += '&dod=' + document.querySelector('.task-information-dod').value
    putRequest += '&duration=' + document.querySelector('.task-information-cost').value
    putRequest += '&parents='

    var parent_tasks = document.querySelectorAll('.task-selected');
    let request = ""

    for (var i = 0; i < parent_tasks.length; i++) {
      request += parent_tasks[i].innerHTML + ','
    }

    putRequest += request.substring(0, request.length - 1)
    putRequest += '&issues='
    var issues_dependencies = document.querySelectorAll('.issue-selected');

    request = ""

    for (var j = 0; j < issues_dependencies.length; j++) {
      request += issues_dependencies[j].innerHTML + ','
    }

    putRequest += request.substring(0, request.length - 1)

    window.$.put(
      putRequest, {},
      function (returnedData) {
        location.reload()
      }
    )
  } else {
    alert("La tâche doit au moins dépendre d'une issue avant d'être enregistrée")
  }
}

function issuesDropDownChange() {
  let value = document.querySelector('.related-issues-dropdown').value

  if (!document.body.contains(document.getElementById("issues-selected-" + value))) {

    let newElem = document.createElement('span')
    let removeButton = document.createElement("i")

    newElem.innerHTML = value
    newElem.id = "issues-selected-" + value
    newElem.classList.add("issue-selected")

    removeButton.className = "fas fa-times issues"
    removeButton.id = "remove-issue-" + value
    removeButton.name = "rmvButton"

    document.querySelector('.selected-issues-dependency').appendChild(removeButton)
    document.querySelector('.selected-issues-dependency').appendChild(newElem)

    removeButton.addEventListener('click', function (removeB) {
      removeIssueSelected(removeButton.id, newElem.id)
    })
  }
}

function tasksDropDownChange() {

  let value = document.querySelector('.related-tasks-dropdown').value

  if (!document.body.contains(document.getElementById("task-selected-" + value))) {

    let newElem = document.createElement('span')
    let removeButton = document.createElement("i")

    newElem.innerHTML = value
    newElem.id = "task-selected-" + value
    newElem.classList.add("task-selected")

    removeButton.className = "fas fa-times tasks"
    removeButton.id = "remove-button-" + value
    removeButton.name = "rmvButton"

    document.querySelector('.selected-task-dependency').appendChild(removeButton)
    document.querySelector('.selected-task-dependency').appendChild(newElem)

    removeButton.addEventListener('click', function (removeB) {
      removeTaskSelected(removeButton.id, newElem.id)
    })
  }
}

function removeTaskSelected(idButton, idTask) {
  let myElem = document.getElementById(idButton).parentNode
  myElem.removeChild(document.getElementById(idButton))
  myElem.removeChild(document.getElementById(idTask))
}

function removeIssueSelected(idButton, idIssue) {
  let myElem = document.getElementById(idButton).parentNode
  myElem.removeChild(document.getElementById(idButton))
  myElem.removeChild(document.getElementById(idIssue))
}