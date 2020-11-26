window.$(function () {
  let draggedIssueId
  let droppedSprintId
  let startingSprintId
  window.$('.sprint:not(.ended-sprint) > .sprint-content > ul').sortable({
    connectWith: '.connectedSortable',
    placeholder: 'highlight',
    axis: 'y',
    cursor: 'grabbing',
    start: function () {
      startingSprintId = window.$(this).parent().attr('id')
    },
    update: function (event, ui) {
      draggedIssueId = ui.item.attr('id')
      document.querySelector('#' + draggedIssueId).classList.add('dropped')

      droppedSprintId = window.$(this).parent().attr('id')
      if (droppedSprintId === 'backlog-sortable') droppedSprintId = 'sprint-undefined'
      window.$.put('../controllers/UpdateIssue.php?id=' + draggedIssueId.split('-')[1] + '&sprint_id=' + droppedSprintId.split('-')[1], {},
        function (returnedData) {
          console.log(returnedData)
        }
      )
      const startingSprintIssues = document.querySelectorAll('#' + startingSprintId + ' > ul > li')
      let counter = 0;
      [].forEach.call(startingSprintIssues, (e) => {
        counter++
        window.$.put('../controllers/UpdateOrderInSprint.php?id=' + e.id.split('-')[1] + '&order_in_sprint=' + counter, {},
          function (returnedData) {
            console.log(returnedData)
          }
        )
      })
      let parentElementId = document.querySelector('#' + startingSprintId).parentElement.id
      document.querySelector('#' + parentElementId + ' .nb-of-issues').innerText = counter
      if (droppedSprintId === 'sprint-undefined') { droppedSprintId = 'backlog-sortable' }
      if (droppedSprintId !== startingSprintId) {
        const droppedSprintIssues = document.querySelectorAll('#' + droppedSprintId + ' > ul > li')
        counter = 0;
        [].forEach.call(droppedSprintIssues, (e) => {
          counter++
          window.$.put('../controllers/UpdateOrderInSprint.php?id=' + e.id.split('-')[1] + '&order_in_sprint=' + counter, {},
            function (returnedData) {
              console.log(returnedData)
            }
          )
        })
        parentElementId = document.querySelector('#' + droppedSprintId).parentElement.id
        document.querySelector('#' + parentElementId + ' .nb-of-issues').innerText = counter
      }
    }
  }).disableSelection()
})
