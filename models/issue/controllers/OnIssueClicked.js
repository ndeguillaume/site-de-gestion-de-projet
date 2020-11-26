const issueSelect = {
  'La plus basse': 'lowest',
  Basse: 'low',
  Moyenne: 'medium',
  Haute: 'high',
  'La plus haute': 'highest'
}

document.querySelectorAll('.sprint-content > ul > li').forEach(function (issue) {
  issue.addEventListener('click', function () {
    if (issue.classList.contains('dropped')) {
      issue.classList.remove('dropped')
    } else {
      if (document.querySelector('.issue-information .button-wrapper').childNodes.length > 0) {
        document.querySelector('.issue-information .button-wrapper').removeChild(document.querySelector('.issue-information .button-wrapper').childNodes[0])
      }
      window.$.get(
        '../controllers/GetIssue.php',
        {
          id: issue.id.split('-')[1]
        },
        function (returnedData) {
          if (document.querySelector('.selected-issue') === issue || document.querySelector('.selected-issue') === null) {
            issue.classList.toggle('selected-issue')
            document.querySelector('.backlog-content').classList.toggle('col-12')
            document.querySelector('.backlog-content').classList.toggle('col-8')
            document.querySelector('.issue-information').classList.toggle('col-4')
            document.querySelector('.issue-information').classList.toggle('hidden')
          } else {
            document.querySelector('.selected-issue').classList.toggle('selected-issue')
            issue.classList.toggle('selected-issue')
          }
          document.querySelector('.issue-information .issue-id').innerHTML = returnedData[0]
          document.querySelector('.issue-information-title').value = returnedData[1]
          document.querySelector('.issue-information-description').value = ''
          if (returnedData[2] !== null) {
            document.querySelector('.issue-information-description').value = returnedData[2]
          }
          document.querySelector('.issue-information-cost').value = ''
          if (returnedData[3] !== null) {
            document.querySelector('.issue-information-cost').value = returnedData[3]
          }
          document.querySelector('.issue-information-priority').value = 'medium'
          if (returnedData[4] !== null) {
            document.querySelector('.issue-information-priority').value = returnedData[4]
          }

          document.querySelector('.issue-information-description').style.height = 'auto'
          document.querySelector('.issue-information-description').style.height = (16 + document.querySelector('.issue-information-description').scrollHeight) + 'px'

          document.querySelector('.issue-information-title').style.height = 'auto'
          document.querySelector('.issue-information-title').style.height = (16 + document.querySelector('.issue-information-title').scrollHeight) + 'px'
        }
      )
      toggleIssueInfoInputAccess(this)
    }
  })
})

function toggleIssueInfoInputAccess (element) {
  if (!element.parentElement.parentElement.parentElement.classList.contains('ended-sprint')) {
    const button = document.createElement('button')
    button.classList.add('btn', 'btn-success')
    button.innerHTML = 'Modifier'
    document.querySelector('.issue-information .button-wrapper').appendChild(button)
    document.querySelector('.issue-information button').addEventListener('click', buttonClickListener)
    document.querySelector('.issue-information-title').disabled = false
    document.querySelector('.issue-information-description').disabled = false
    document.querySelector('.issue-information-cost').disabled = false
    document.querySelector('.issue-information-priority').disabled = false
  } else {
    document.querySelector('.issue-information-title').disabled = true
    document.querySelector('.issue-information-description').disabled = true
    document.querySelector('.issue-information-cost').disabled = true
    document.querySelector('.issue-information-priority').disabled = true
  }
}

window.onclick = function (event) {
  let isInSprint = false
  document.querySelectorAll('.sprint-content').forEach(element => {
    if (element.contains(event.target)) {
      isInSprint = true
    }
  })
  if (event.target !== document.querySelector('.issue-information') &&
        !document.querySelector('.issue-information').contains(event.target) &&
        !isInSprint) {
    if (!document.querySelector('.issue-information').classList.contains('hidden')) {
      document.querySelector('.selected-issue').classList.toggle('selected-issue')
      document.querySelector('.backlog-content').classList.toggle('col-12')
      document.querySelector('.backlog-content').classList.toggle('col-8')
      document.querySelector('.issue-information').classList.toggle('hidden')
    }
  }
  if (event.target.parentElement !== document.querySelector('.input-issue-title') &&
    document.querySelector('#new-issue') !== null) {
    let isAddIssue = false
    document.querySelectorAll('.add-issue').forEach(element => {
      if (element === event.target) {
        isAddIssue = true
      }
    })
    if (!isAddIssue) {
      document.querySelector('#new-issue').remove()
    }
  }
}

/* eslint-disable */
function textAreaAdjust(element)
{
    element.style.height = 'auto'
    element.style.height = (16 + element.scrollHeight) + 'px'
}
/* eslint-enable */

function buttonClickListener () {
  window.$.put(
    '../controllers/UpdateIssue.php?id=' + document.querySelector('.issue-information .issue-id').innerHTML + '&title=' + document.querySelector('.issue-information-title').value + '&description=' + document.querySelector('.issue-information-description').value + '&cost=' + document.querySelector('.issue-information-cost').value + '&priority=' + issueSelect[window.$('.issue-information-priority option:selected').text()],
    {},
    function (returnedData) {
      location.reload()
    }
  )
}
