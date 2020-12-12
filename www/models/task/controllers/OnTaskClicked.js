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
              if (returnedData[5] !== null) {
                $("#related-issues-dropdown").selectpicker();
                $("#related-issues-dropdown").empty();

                let array = returnedData[5].split(',');
                for (let i = 0; i < array.length; i++) {
                  $("#related-issues-dropdown").append("<option>"+array[i]+"</option>");
                }
                $("#related-issues-dropdown").selectpicker("refresh");
              }

              if (returnedData[6] !== null) {
                $("#related-tasks-dropdown").selectpicker();
                $("#related-tasks-dropdown").empty();

                let array = returnedData[6].split(',');
                for (let i = 0; i < array.length; i++) {
                  $("#related-tasks-dropdown").append("<option>"+array[i]+"</option>");
                }
                $("#related-tasks-dropdown").selectpicker("refresh");
              }

              if (returnedData[7] !== null && returnedData[7] !== "") {
                $('#related-issues-dropdown').selectpicker();
                let array = returnedData[7].split(',');                
                for (let i = 0; i < array.length; i++) {
                  $('#related-issues-dropdown').selectpicker('val', array);
                }
              }

              if (returnedData[8] !== null && returnedData[8] !== "") {
                $('#related-tasks-dropdown').selectpicker();
                let array = returnedData[8].split(',');                
                for (let i = 0; i < array.length; i++) {
                  $('#related-tasks-dropdown').selectpicker('val', array);
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
  button.id = "modify-button"
  button.innerHTML = 'Modifier'
  document.querySelector('.task-information .button-wrapper').appendChild(button)
  document.querySelector('.task-information #modify-button').addEventListener('click', buttonClickListener)
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

    }
  }
}

function buttonClickListener() {

  if (document.querySelector(".related-issues-dropdown .filter-option-inner-inner").innerText !== "Nothing selected") {
    let putRequest = '../controllers/UpdateTask.php?id=' + document.querySelector('.task-information .task-id').innerHTML
    putRequest += '&title=' + document.querySelector('.task-information-title').value
    putRequest += '&description=' + document.querySelector('.task-information-description').value
    putRequest += '&dod=' + document.querySelector('.task-information-dod').value
    putRequest += '&duration=' + document.querySelector('.task-information-cost').value
    putRequest += '&parents='
    let request = document.querySelector(".related-tasks-dropdown .filter-option-inner-inner").innerText;
    request = request.replace(" ", "");
    putRequest += request
    putRequest += '&issues='
    request = document.querySelector(".related-issues-dropdown .filter-option-inner-inner").innerText
    request = request.replace(" ", "");
    putRequest += request

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
