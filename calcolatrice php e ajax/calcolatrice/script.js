var content="";

function add(num)
{
    if (num == "pa")
    {
        content +=   "(";
        document.getElementById("box").value = content;
        return;

    }
    if (num == "pc")
    {
        content += ")"
        document.getElementById("box").value = content;
        return;

    }
    content += num;
    document.getElementById("box").value = content;
}

function clearEntry()
{
    content = content.slice(0, -1);
    document.getElementById("box").value = content;
}

function allClear()
{
    content = "";
    document.getElementById("box").value = content;
}

function equalsRequest()
{
    let request = new XMLHttpRequest();
    let data = "content=" + encodeURIComponent(content); // si assicura che i dati mandati al server siano URL-Ready e nel formato corretto
    request.open("POST", "server.php", true); // Apre la richista 
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function () { // quando è pronto
        if (request.readyState === 4 && request.status === 200) { // se tutto va bene
            document.getElementById("box").value = request.responseText; // riprendi i dati e mettili nel risultato
        }                                                               // riprendi dait, manda dati - togli cera, metti cera: manco karate kid
    };
    request.send(data); // manda dati
}