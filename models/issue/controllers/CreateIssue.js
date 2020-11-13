document.querySelectorAll(".add-issue").forEach(function(button) {
    button.addEventListener("click", function() {
        if (document.querySelector("#new-issue") !== null) {
            document.querySelector("#new-issue").remove();
        }
        let newIssue = document.createElement("div");
        let cancel = document.createElement("i");
        let input = document.createElement("input");
        cancel.classList.add("fas", "fa-times");
        cancel.id = "cancel-delete-issue";

        newIssue.id = ("new-issue");
        newIssue.appendChild(input);
        newIssue.appendChild(cancel);
        adding_issue = newIssue;
        this.parentElement.parentElement.previousSibling.appendChild(newIssue);

        let sprint_id = (this.parentElement.parentElement.parentElement.id).split("-")[1];
        cancel.addEventListener("click", function() {
            document.querySelector("#new-issue").remove();
        });

        input.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                $.post('../controllers/CreateIssue.php', {
                        title: input.value,
                        sprint_id: sprint_id
                    },
                    function(returnedData) {
                        console.log(returnedData);
                        location.reload();
                    }
                );

                document.querySelector("#new-issue").remove();
            }
        })

        input.focus();
    })
});