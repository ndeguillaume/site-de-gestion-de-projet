var $issue_select = {
    "La plus basse" : "lowest",
    "Basse" : "low",
    "Moyenne" : "medium",
    "Haute" : "high",
    "La plus haute" : "highest"
}

document.querySelectorAll(".sprint-content > div").forEach(function(issue) {
    issue.addEventListener("click", function() {

        if(document.querySelector(".issue-information .button-wrapper").childNodes.length > 0) {
            document.querySelector(".issue-information .button-wrapper").removeChild(document.querySelector(".issue-information .button-wrapper").childNodes[0])
        }
        if (!this.parentElement.parentElement.classList.contains("ended-sprint")) {
            let button = document.createElement("button");
            button.classList.add("btn", "btn-success");
            button.innerHTML = "Modifier";
            document.querySelector(".issue-information .button-wrapper").appendChild(button);
            document.querySelector(".issue-information button").addEventListener("click", buttonClickListener);
        }

        $.get('../controllers/GetIssue.php', {
            id: issue.classList[0].split("-")[1],
            sprint_id: issue.parentElement.parentElement.id.split("-")[1]
        },
        function(returnedData) {
            if (document.querySelector(".selected-issue") === issue || document.querySelector(".selected-issue") === null) {
                issue.classList.toggle("selected-issue");
                document.querySelector(".backlog-content").classList.toggle("d-table-cell");
                document.querySelector(".issue-information").classList.toggle("d-table-cell");
                document.querySelector(".issue-information").classList.toggle("hidden");
            } 
            else {
                document.querySelector(".selected-issue").classList.toggle("selected-issue");
                issue.classList.toggle("selected-issue");
            }
            document.querySelector(".issue-information .issue-id").innerHTML = returnedData[0];
            document.querySelector(".issue-information .issue-title").value = returnedData[1];
            if (returnedData[2] !== null) {
                document.querySelector(".issue-information .issue-description").value = returnedData[2];
            } 
            else {
                document.querySelector(".issue-information .issue-description").value = "";
            }
            if (returnedData[3] !== null) {
                document.querySelector(".issue-information .issue-cost").value = returnedData[3];
            }
            else {
                document.querySelector(".issue-information .issue-cost").value = "";
            }

            if (returnedData[4] !== null) {
                document.querySelector(".issue-priority").value = returnedData[4];
            } 
            else {
                document.querySelector(".issue-priority").value = "medium";
            }
        }
    );
    })
})

function buttonClickListener() {
    $.put('../controllers/UpdateIssue.php?id=' + document.querySelector(".issue-information .issue-id").innerHTML + '&title=' + document.querySelector(".issue-information .issue-title").value + '&description=' + document.querySelector(".issue-information .issue-description").value + '&cost=' + document.querySelector(".issue-information .issue-cost").value + '&priority=' + $issue_select[$(".issue-information .issue-priority option:selected").text()], {},
    function(returnedData) {
        location.reload();
    }
);
} 