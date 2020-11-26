document.querySelectorAll('.sprint-content > ul > li').forEach(
  function (issue) {
    window.$.get(
      '../controllers/GetIssue.php',
      {
        id: issue.id.split('-')[1]
      },
      function (returnedData) {
        if (document.querySelector('#' + issue.id + ' .issue-title').scrollHeight > 24) {
          const hoverbar = document.createElement('div')
          const hoverbarContent = document.createElement('div')
          const triangleUp = document.createElement('div')
          hoverbar.className = 'hoverbar'
          hoverbar.id = 'hoverbar-' + returnedData[0]
          hoverbarContent.className = 'hoverbar-content'
          hoverbarContent.id = 'hoverbar-content-' + returnedData[0]
          hoverbarContent.innerText = returnedData[1]
          triangleUp.className = 'triangle-up'
          hoverbar.appendChild(triangleUp)
          hoverbar.appendChild(hoverbarContent)
          issue.appendChild(hoverbar)
          triangleUp.style.top = window.$('#' + issue.id).height() / 2 - 5 + 'px'
          hoverbarContent.style.top = window.$('#' + issue.id).height() / 2 - 5 + 'px'
        }
      }
    )
  }
)
