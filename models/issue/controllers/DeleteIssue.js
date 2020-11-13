document.querySelectorAll(".delete-issue").forEach(function(button){
    button.addEventListener("click",function(e){
        e.stopPropagation();
        let modal = document.createElement("div");
        let modal_content = document.createElement("div");
        let modal_header = document.createElement("div");
        let modal_body = document.createElement("div");
        let modal_footer = document.createElement("div");
        modal.id = "issue-modal";
        modal.className = "modal";
        modal_content.className = "modal-content";
        modal_header.className = "modal-header";
        modal_body.className = "modal-body";
        modal_footer.className = "modal-footer";
        let header_content = document.createElement("h1");
        let issue_id = this.nextSibling.innerHTML;
        let issue_title = this.nextSibling.nextSibling.innerHTML;
        let header_node = document.createTextNode("Supprimer l'issue "+issue_id+"?");
        let body_content = document.createElement("p");
        let body_node = document.createTextNode("Vous allez définitivement supprimer l'issue suivante : \n"+issue_title);
        let delete_button = document.createElement("button");
        let cancel_button = document.createElement("button");
        delete_button.innerHTML = "Supprimer";
        delete_button.className = "delete-button"
        cancel_button.innerHTML = "Annuler";
        cancel_button.className = "cancel-button";
        delete_button.classList.add("btn", "btn-danger");
        cancel_button.classList.add("btn", "btn-light");
        header_content.appendChild(header_node);
        body_content.appendChild(body_node);
        modal_header.appendChild(header_content);
        modal_body.appendChild(body_content);
        modal_footer.appendChild(cancel_button);
        modal_footer.appendChild(delete_button);
        modal_content.appendChild(modal_header);
        modal_content.appendChild(modal_body);
        modal_content.appendChild(modal_footer);
        modal.appendChild(modal_content);

        let body = document.querySelector("body");
        body.appendChild(modal);
        modal.style.display = "block";

        window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
        }

        cancel_button.addEventListener("click", function(e) {
            modal.style.display = "none";
        });

        delete_button.addEventListener("click", function(e) {
            $.delete('../controllers/DeleteIssue.php?id=' + issue_id, {}, 
                    function(returnedData){
                            console.log(returnedData);
                            location.reload();
                    }
            );
        });
    })
});