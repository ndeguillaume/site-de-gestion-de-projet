document.querySelectorAll(".add-task").forEach(function(button) {
    button.addEventListener("click", function() {
        if (document.querySelector("#new-task") !== null) {
            document.querySelector("#new-task").remove();
        }
        let newTask = document.createElement("div");
        let cancel = document.createElement("i");
        let input = document.createElement("input");
        cancel.classList.add("fas", "fa-times");
        cancel.id = "cancel-delete-task";

        newTask.id = ("new-task");
        newTask.appendChild(input);
        newTask.appendChild(cancel);
        adding_task = newTask;

        this.parentElement.parentElement.previousSibling.appendChild(newTask);

        let sprint_id = (this.parentElement.parentElement.parentElement.id).split("-")[1];
        cancel.addEventListener("click", function() {
            document.querySelector("#new-task").remove();
        });

        input.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                $.post('../controllers/CreateTask.php', {
                        title: input.value
                    },
                    function(returnedData) {
                        console.log(returnedData);
                        location.reload();
                    }
                );

                document.querySelector("#new-task").remove();
            }
        })

        input.focus();
    })
});