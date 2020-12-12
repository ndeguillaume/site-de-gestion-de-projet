document.querySelectorAll('.API-js-request').forEach(function (button) {
    button.addEventListener("click", function () {
        const textToCopy = document.createElement('textarea')
        textToCopy.value = 'var xhr = new XMLHttpRequest();\nxhr.open("POST", "http://127.0.0.1/models/test/controllers/UpdateTest.php", true);\nxhr.setRequestHeader("Content-Type", "application/json");\nvar data = JSON.stringify({"id": "' + button.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] + '", "result": {result}});\nxhr.send(data);'
        textToCopy.setAttribute('readonly', '')
        textToCopy.style.left = '-9999px';
        document.body.appendChild(textToCopy);
        textToCopy.select();
        document.execCommand('copy');
        document.body.removeChild(textToCopy)
    })
})


document.querySelectorAll('.API-php-request').forEach(function (button) {
    button.addEventListener("click", function () {
        const textToCopy = document.createElement('textarea')
        textToCopy.value = '$url = "http://webserver:80/models/test/controllers/UpdateTest.php";\n$data = array("id" => "'+ button.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] +'", "result" => {result});\n$postdata = json_encode($data);\n$ch = curl_init($url);\ncurl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);\ncurl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);\ncurl_setopt($ch, CURLOPT_POST, 1);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);\ncurl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);\ncurl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));\ncurl_exec($ch);\ncurl_close($ch);'
        textToCopy.setAttribute('readonly', '')
        textToCopy.style.left = '-9999px';
        document.body.appendChild(textToCopy);
        textToCopy.select();
        document.execCommand('copy');
        document.body.removeChild(textToCopy)
    })
})

document.querySelectorAll('.help-js').forEach(function (question) {
    let tooltip
    let timeoutid
    const rectY = question.getBoundingClientRect().top + window.pageYOffset - document.documentElement.clientTop;
    const rectX = question.getBoundingClientRect().left
    question.addEventListener("mouseover", function () {
        clearTimeout(timeoutid)
        tooltip = document.createElement("div")
        tooltip.classList.add("api-tooltip")
        const tooltipContent = document.createElement("p")
        tooltipContent.innerHTML = 'Appuyer sur le bouton <i>API JS</i> à droite copie dans le presse papier les lignes suivantes <pre>var xhr = new XMLHttpRequest();<br/>xhr.open("POST", "http://127.0.0.1/models/test/controllers/UpdateTest.php", true);<br/>xhr.setRequestHeader("Content-Type", "application/json");<br/>var data = JSON.stringify({"id": "' + question.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] + '", "result": {result}});<br/>xhr.send(data);</pre> Ajoutez ces lignes à la fin du fichier de test qui correspond à <b>' + question.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML + '</b> et remplacez la variable {result} par le résultat du test'
        tooltip.appendChild(tooltipContent)
        document.body.appendChild(tooltip)
        tooltip.style.top = rectY - tooltip.offsetHeight / 2 + 'px';
        tooltip.style.left = rectX - tooltip.offsetWidth - 70 + 'px';

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

document.querySelectorAll('.help-php').forEach(function (question) {
    let tooltip
    let timeoutid
    const rectY = question.getBoundingClientRect().top + window.pageYOffset - document.documentElement.clientTop;
    const rectX = question.getBoundingClientRect().left
    question.addEventListener("mouseover", function () {
        clearTimeout(timeoutid)
        tooltip = document.createElement("div")
        tooltip.classList.add("api-tooltip")
        const tooltipContent = document.createElement("p")
        tooltipContent.innerHTML = 'Appuyer sur le bouton <i>API PHP</i> à droite copie dans le presse papier les lignes suivantes <pre>$url = "http://webserver:80/models/test/controllers/UpdateTest.php";\n$data = array("id" => "'+ question.previousElementSibling.previousElementSibling.innerHTML.split(" ")[0] +'", "result" => {result});\n$postdata = json_encode($data);\n$ch = curl_init($url);\ncurl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);\ncurl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);\ncurl_setopt($ch, CURLOPT_POST, 1);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);\ncurl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);\ncurl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));\ncurl_exec($ch);\ncurl_close($ch);</pre>Ajoutez ces lignes à la fin du fichier de test qui correspond à <b>' + question.previousElementSibling.innerHTML + '</b> et remplacez la variable {result} par le résultat du test'
        tooltip.appendChild(tooltipContent)
        document.body.appendChild(tooltip)
        tooltip.style.top = rectY - tooltip.offsetHeight / 2 + 'px';
        tooltip.style.left = rectX - tooltip.offsetWidth - 95 + 'px';

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