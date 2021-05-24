function goBack() {
    window.location.replace("home.php")
}

function onResponseToJSON(response) {
    return response.json()
}

function seeDates() {
    fetch("api/checkSession.php")
        .then(onResponseToJSON)
        .then((json) => {
            if (json["ok"]) {
                const datesDiv = document.querySelector("#dates")
                const startDateInput = document.createElement("input")
                startDateInput.type = "date"
                const endDateInput = document.createElement("input")
                endDateInput.type = "date"
                const buttonSearch = document.createElement("button")
                buttonSearch.textContent = "Verifica disponibilitá"
                datesDiv.appendChild(startDateInput)
                datesDiv.appendChild(endDateInput)
                datesDiv.appendChild(buttonSearch)
                const params = new URLSearchParams(window.location.search)
                buttonSearch.addEventListener("click", () => {
                    if (startDateInput.value && endDateInput.value) {
                        fetch(`api/checkAvailability.php?startDate=${startDateInput.value}&endDate=${endDateInput.value}&hotel=${params.get("id")}`)
                            .then(onResponseToJSON)
                            .then((response) => {
                                const resultDiv = document.querySelector("#result");
                                resultDiv.innerHTML = ""
                                const table = document.createElement("table")
                                const thead = document.createElement("thead");
                                const tbody = document.createElement("tbody")
                                let tr = document.createElement("tr")
                                let thO = document.createElement("th")
                                let thT = document.createElement("th")
                                let thTh = document.createElement("th")

                                thO.textContent = "Tipo";
                                thT.textContent = "Prezzo"
                                thTh.textContent = "Azione"

                                tr.appendChild(thO)
                                tr.appendChild(thT)
                                tr.appendChild(thTh)
                                thead.appendChild(tr)

                                for (let room of response) {
                                    let thR = document.createElement("tr")
                                    let tdO = document.createElement("td")
                                    let tdT = document.createElement("td")
                                    let tdH = document.createElement("td")
                                    let button = document.createElement("button")
                                    button.textContent = "Prenota"
                                    button.addEventListener("click", () => {
                                        
                                        fetch(`api/makeReservation.php??startDate=${startDateInput.value}&endDate=${endDateInput.value}&room=${room.IDStanza}`)
                                            .then(onResponseToJSON)
                                            .then((response) => {
                                                if (response["ok"]) {
                                                    alert("Prenotazione aggiunta");
                                                    window.location.replace("home.php")
                                                } else{
                                                    alert(`Impossibile completare la prenotazione: ${response["msg"]}`)
                                                }
                                            })
                                    })
                                    tdO.textContent = `${room.tipo}`
                                    tdT.textContent = `${room.prezzo} euro`
                                    tdH.appendChild(button)
                                    thR.appendChild(tdO)
                                    thR.appendChild(tdT)
                                    thR.appendChild(tdH)
                                    tbody.appendChild(thR)
                                }
                                table.appendChild(thead)
                                table.appendChild(tbody)
                                resultDiv.appendChild(table)
                            })
                    }
                })
            } else {
                window.location.replace("login.php");
            }
        })
}