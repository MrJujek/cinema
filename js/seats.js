let choosen = []
let toDelete = []
let id = getIdOfFilm()
let $_GET = giveGet()
let id_film = $_GET.id
let reserved

function delete_reservation() {
    let formData = new FormData()
    formData.append('toDelete', JSON.stringify(toDelete))

    if (toDelete.length > 0) {
        fetch('./delete_reservation.php', {
            method: 'POST',
            body: formData,
        })
            .then((res) => {
                location.reload();
            })
    }
}

document.getElementById("book").addEventListener("click", () => {
    let formData = new FormData()
    formData.append('choosen', JSON.stringify(choosen))

    if (choosen.length > 0) {
        fetch('./book.php', {
            method: 'POST',
            body: formData
        })
            .then(() => {
                location.reload();
            })
    }
})

fetch('get_reservations.php')
    .then((response) => {
        return response.json()

    }).then((data) => {
        reserved = data

        fetch('films.php')
            .then((response) => {
                return response.json()

            }).then(() => {
                for (let i = 0; i < 15; i++) {
                    let row = document.createElement("div")
                    row.classList.add("row")

                    let rowNumber = document.createElement("div")
                    rowNumber.classList.add("rowNumber")
                    rowNumber.append(i + 1)
                    row.appendChild(rowNumber)

                    for (let z = 0; z < 20; z++) {
                        let isReserved = false
                        let div = document.createElement("div")
                        div.setAttribute("row", i)
                        div.setAttribute("seat", z)
                        div.className = "seat"

                        if (reserved) {
                            for (let f = 0; f < reserved.length; f++) {

                                if ((reserved[f].id == id || id == 1) && id_film == reserved[f].id_film && i == reserved[f].row && z == reserved[f].seat) {
                                    div.style.backgroundColor = "green"
                                    break
                                } else if (reserved[f].id != id && id_film == reserved[f].id_film && i == reserved[f].row && z == reserved[f].seat) {
                                    div.style.backgroundColor = "red"
                                    isReserved = true
                                    break
                                } else {
                                    div.style.backgroundColor = "white"
                                }
                            }
                        } else {
                            div.style.backgroundColor = "white"
                        }

                        if (isReserved == false) {
                            div.addEventListener("click", function (e) {
                                if (e.target.style.backgroundColor == "white") {
                                    e.target.style.backgroundColor = "yellow"
                                    choosen.push({
                                        id: id,
                                        row: e.target.getAttribute("row"),
                                        seat: e.target.getAttribute("seat"),
                                        id_film: id_film
                                    })
                                } else if (e.target.style.backgroundColor == "yellow") {
                                    e.target.style.backgroundColor = "white"
                                    for (let i = 0; i < choosen.length; i++) {
                                        if (choosen[i].row == e.target.getAttribute("row") && choosen[i].seat == e.target.getAttribute("seat")) {
                                            choosen.splice(i, 1)
                                        }
                                    }
                                } else if (e.target.style.backgroundColor == "green") {
                                    toDelete.push({
                                        id: id,
                                        row: e.target.getAttribute("row"),
                                        seat: e.target.getAttribute("seat"),
                                        id_film: id_film
                                    })
                                    delete_reservation()
                                }
                            })
                        }
                        row.appendChild(div)
                    }

                    let rightFill = document.createElement("div")
                    rightFill.classList.add("rowNumber")
                    row.appendChild(rightFill)

                    document.getElementById("seats").appendChild(row)
                }
            })
    })