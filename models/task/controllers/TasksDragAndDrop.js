$(function() {
    $(".kanban-sortable").sortable();

    let tag;
    let task_id;
    $(".column-body > div > div").draggable({
        connectToSortable: ".kanban-sortable",
        revert: true,
        start: function(event, ui) {
            tag = this.parentElement.parentElement;
            task_id = this.parentElement.id.split("-")[1];
        },
        stop: function(event, ui) {
            if (tag !== this.parentElement) {
                $.put('../controllers/UpdateTask.php?id=' + task_id + '&category=' + this.parentElement.id.split("-")[0], {},
                    function(returnedData) {
                        console.log(returnedData);
                        location.reload();
                    }
                );
            }
        }
    });
});