window.$(
  function () {
    let taskId
    window.$('.column-body > div').sortable(
      {
        connectWith: '.kanban-sortable',
        placeholder: 'highlight',
        cursor: 'grabbing',
        containment: '.container',
        start: function (event, ui) {
          taskId = ui.item.attr('id').split('-')[1]
        },
        receive: function (event, ui) {
          const category = this.parentElement.id.split('-')[0]
          window.$.put(
            '../controllers/UpdateTask.php?id=' + taskId + '&category=' + category,
            {},
            function (returnedData) {
              console.log(returnedData)
            }
          )
        }
      }
    ).disableSelection()
  }
)
