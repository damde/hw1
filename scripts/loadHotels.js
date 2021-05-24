let all = false

function addHotel(hotel) {
    const element = document.createElement("div")
    element.classList.add(["card"]);
    const idA = document.createElement("span")
    idA.innerText = hotel.id
    idA.style.display = "none"
    const imageDiv = document.createElement("div")
    imageDiv.classList.add(["image"])
    const image = document.createElement("img")
    image.src = hotel.image
    imageDiv.appendChild(image)
    const text = document.createElement("h3")
    text.classList.add("text");
    text.textContent = hotel.denomination
    const description = document.createElement("h5")
    description.textContent = hotel.description.substring(0, 128) + "..."
    element.appendChild(imageDiv)
    element.appendChild(text)
    element.appendChild(description)
    const button = document.createElement("button")
    element.appendChild(button)
    element.appendChild(idA)
    button.textContent = "Clicca qui per maggiori informazioni e prenotare";
    button.addEventListener("click", cardButton)

    products.appendChild(element)
}

function cardButton(event) {
    window.location.replace(`hotel.php?id=${event.target.parentNode.querySelector("span").textContent}`)
}

function onResponseToJSON(response) {
    return response.json()
}

function addHotels(json) {
    document.getElementById("products").innerHTML = ""
    for (let hotel of json) {
        const payload = {
            id: hotel.id,
            denomination: hotel.denomination,
            description: hotel.description,
            image: hotel.image,
            address: hotel.address
        }
        addHotel(payload)
    }
}



function fetchData(i) {
    fetch(`api/hotels.php?i=${i}`)
        .then(onResponseToJSON)
        .then(addHotels)
}

fetchData(3)

document.getElementById("all").addEventListener("click", (event) => {
    if (!all) {
        event.target.textContent = "Mostra meno"
        fetchData(-1)
    } else {
        event.target.textContent = "Mostra tutti"
        fetchData(3)
    }
    all = !all
})