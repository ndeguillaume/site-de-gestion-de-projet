document.querySelectorAll(".start-sprint").forEach(function (button) {
    button.addEventListener("click", function () {

        let modal = document.createElement("div");
        let sprint_id = this.parentNode.parentNode.id.split("-")[1];
        let modal_content = document.createElement("div");
        let modal_header = document.createElement("div");
        let modal_body = document.createElement("div");
        let modal_footer = document.createElement("div");

        let inputStart = document.createElement("input");
        
        let inputEnd = document.createElement("input");

        let labelStart = document.createElement("Label");
        let labelEnd = document.createElement("Label");

        inputStart.name = "start";
        inputStart.id = "start";
        inputStart.disabled = "true";
        let today = new Date();
        inputStart.setAttribute("value", today.getDate()+'/'+today.getMonth()+'/'+today.getFullYear());

        inputEnd.type = "date";
        inputEnd.name = "end";
        inputEnd.id = "end";

        labelStart.htmlFor = "start";
        labelStart.innerHTML = "Début : ";

        labelEnd.htmlFor = "end";
        labelEnd.innerHTML = "Fin : ";

        modal.id = "start-sprint-modal";
        modal.className = "modal";
        modal_content.className = "modal-content";
        modal_header.className = "modal-header";
        modal_body.className = "modal-body";
        modal_footer.className = "modal-footer";

        let header_content = document.createElement("h1");
        let header_node = document.createTextNode("Démarrer le sprint");
        let body_content = document.createElement("p");

        let body_node = document.createTextNode("Renseigner les dates");
        let validation_button = document.createElement("button");
        let cancel_button = document.createElement("button");

        validation_button.innerHTML = "Lancer";
        validation_button.className = "validation-button"
        cancel_button.innerHTML = "Annuler";
        cancel_button.className = "cancel-button";

        validation_button.classList.add("btn", "btn-danger");
        cancel_button.classList.add("btn", "btn-light");

        header_content.appendChild(header_node);
        body_content.appendChild(body_node);
        modal_header.appendChild(header_content);
        modal_body.appendChild(body_content);
        modal_body.appendChild(labelStart);
        modal_body.appendChild(inputStart);
        modal_body.appendChild(document.createElement("p"));
        modal_body.appendChild(labelEnd);
        modal_body.appendChild(inputEnd);

        modal_footer.appendChild(cancel_button);
        modal_footer.appendChild(validation_button);
        modal_content.appendChild(modal_header);
        modal_content.appendChild(modal_body);
        modal_content.appendChild(modal_footer);
        modal.appendChild(modal_content);


        let body = document.querySelector("body");
        body.appendChild(modal);
        modal.style.display = "block";

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        

        cancel_button.addEventListener("click", function (e) {
            modal.style.display = "none";
        });
        
        validation_button.addEventListener("click", function (e) {
            let date = today.setDate(today.getMinutes() - 1);
            date = (today.getFullYear+"-"+today.getMonth+"-"+today.getDay+" "+today.getHours+":"+today.getMinutes+":"+(today.getSeconds-1));
            $.post('../../sprint/controllers/StartSprint.php', {
                    id: sprint_id,
                    begin_date: date,
                    end_date: inputEnd.value
                },
                function (returnedData) {
                    console.log(returnedData);
                    location.reload();
                }
            );
            modal.style.display = "none";
        });
    })
});