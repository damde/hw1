const tbody = document.querySelector("#res")

function onResponseToJSON(response) {
    return response.json()
}

fetch("api/reservations.php").then(onResponseToJSON).then((response) => {

    for (let reservation of response) {
        let thR = document.createElement("tr")
        let tdO = document.createElement("td")
        let tdT = document.createElement("td")
        let tdH = document.createElement("td")
        let tdF = document.createElement("td")
        tdO.textContent = reservation.dataPrenotazione
        tdT.textContent = reservation.dataInizio
        tdH.textContent = reservation.dataFine
        tdF.textContent = ((new Date(reservation.dataFine) - new Date(reservation.dataInizio)) / 1000 / 60 / 60 / 24 + 1) * reservation.prezzoTotale

        thR.appendChild(tdO)
        thR.appendChild(tdT)
        thR.appendChild(tdH)
        thR.appendChild(tdF)

        tbody.appendChild(thR)
    }
})