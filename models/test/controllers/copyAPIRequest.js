document.querySelectorAll('.API-request').forEach(function (button) {
    button.addEventListener("click", function () {
        const textToCopy = document.createElement('textarea')
        textToCopy.value = 'var xhr = new XMLHttpRequest();\nxhr.open("PUT", "http://127.0.0.1/models/test/controllers/UpdateTest.php", true);\nxhr.setRequestHeader("Content-Type", "application/json");\nvar data = JSON.stringify({"id": "' + button.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] + '", "result": {result}});\nxhr.send(data);'
        textToCopy.setAttribute('readonly', '')
        textToCopy.style.left = '-9999px';
        document.body.appendChild(textToCopy);
        textToCopy.select();
        document.execCommand('copy');
        document.body.removeChild(textToCopy)
    })
})

document.querySelectorAll('.fa-question-circle').forEach(function (question) {
    let tooltip
    let timeoutid
    const rectY = question.getBoundingClientRect().top + window.pageYOffset - document.documentElement.clientTop;
    const rectX = question.getBoundingClientRect().left
    question.addEventListener("mouseover", function () {
        clearTimeout(timeoutid)
        tooltip = document.createElement("div")
        tooltip.classList.add("api-tooltip")
        const tooltipContent = document.createElement("p")
        tooltipContent.innerHTML = 'Appuyer sur le bouton <i>API</i> à droite copie dans le presse papier les lignes suivantes <pre>var xhr = new XMLHttpRequest();<br/>xhr.open("PUT", "http://127.0.0.1/models/test/controllers/UpdateTest.php", true);<br/>xhr.setRequestHeader("Content-Type", "application/json");<br/>var data = JSON.stringify({"id": "' + question.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] + '", "result": {result}});<br/>xhr.send(data);</pre> Ajoutez ces lignes à la fin du fichier de test qui correspond à <b>' + question.previousElementSibling.innerHTML + '</b> et remplacez la variable {result} par le résultat du test'
        tooltip.appendChild(tooltipContent)
        document.body.appendChild(tooltip)
        tooltip.style.top = rectY - tooltip.offsetHeight / 2 + 'px';
        tooltip.style.left = rectX - tooltip.offsetWidth - 50 + 'px';

        tooltip.addEventListener("mouseover", function () {
            clearTimeout(timeoutid)
        })

        tooltip.addEventListener("mouseout", function () {
            timeoutid = setInterval(function () {
                tooltip.parentElement.removeChild(tooltip)
                clearTimeout(timeoutid);
            }, 250)
        })
    })


    question.addEventListener("mouseout", function () {
        timeoutid = setInterval(function () {
            tooltip.parentElement.removeChild(tooltip)
            clearTimeout(timeoutid);
        }, 250)
    })
})