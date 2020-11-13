$(function() {
    $(".sprint:not(.ended-sprint) .sortable").sortable();

    let tag;
    $(".sprint:not(.ended-sprint) .sprint-content > div").draggable({
        connectToSortable: ".sprint:not(.ended-sprint) .sortable",
        revert: true,
        start: function(event, ui) {
            tag = this.parentElement.parentElement;
        },
        stop: function(event, ui) {
            event.stopPropagation();
            if (tag !== this.parentElement.parentElement) {
                $.put('../controllers/UpdateIssue.php?id=' + this.classList[0].split("-")[1] + '&sprint_id=' + this.parentElement.parentElement.id.split("-")[1], {},
                    function(returnedData) {
                        console.log(returnedData);
                        location.reload();
                    }
                );
            }
        }
    });
});