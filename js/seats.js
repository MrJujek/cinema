let choosen = []
let del = []
let id = getIdOfFilm()
var $_GET = giveGet()
let id_film = $_GET.id
let reserved
console.log($_GET.id)

function dele() {
    let d = new FormData()
    console.log("d1: ", d)
    d.append('del', JSON.stringify(del))
    console.log("d2: ", d)
    console.log("del: ", del);
    if (del.length > 0) {
        fetch('./del.php', {
            method: 'POST',
            body: d,
        })
            .then(res => {
                console.log(res);
                location.reload();
            })
    }
}
document.getElementById("book").addEventListener("click", function (e) {
    let a = new FormData()
    a.append('choosen', JSON.stringify(choosen))
    console.log(a)
    if (choosen.length > 0) {
        fetch('./book.php', {
            method: 'POST',
            body: a,
        })
            .then(res => {
                console.log(res);
                location.reload();
            })
    }
})
fetch('reserved.php')
    .then(function (response) {

        return response.json()
    }).then(function (data) {
        console.log(data)
        reserved = data
        fetch('films.php')
            .then(function (response) {

                return response.json()
            }).then(function (data) {

                for (let i = 0; i < 15; i++) {
                    let row = document.createElement("div")
                    row.classList.add("row")

                    for (var z = 0; z < 20; z++) {
                        let tmp = false
                        let div = document.createElement("div")
                        div.setAttribute("row", i)
                        div.setAttribute("seat", z)
                        div.className = "seat"

                        for (let f = 0; f < reserved.length; f++) {

                            if ((reserved[f].id == id || id == 5) && id_film == reserved[f].id_film && i == reserved[f].row && z == reserved[f].seat) {
                                div.style.backgroundColor = "green"

                                break
                            } else if (reserved[f].id != id && id_film == reserved[f].id_film && i == reserved[f].row && z == reserved[f].seat) {
                                div.style.backgroundColor = "red"
                                tmp = true
                                break
                            } else {
                                div.style.backgroundColor = "white"
                            }
                        }

                        if (tmp == false) {
                            div.addEventListener("click", function (e) {

                                console.log(e.target.style.backgroundColor)

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
                                    for (var i = 0; i < choosen.length; i++) {
                                        if (choosen[i].row == e.target.getAttribute("row") && choosen[i].seat == e.target.getAttribute("seat")) {
                                            choosen.splice(i, 1)
                                        }


                                    }
                                } else if (e.target.style.backgroundColor == "green") {
                                    del.push({
                                        id: id,
                                        row: e.target.getAttribute("row"),
                                        seat: e.target.getAttribute("seat"),
                                        id_film: id_film
                                    })
                                    dele()
                                }

                                console.log(choosen)
                            })
                        }
                        row.appendChild(div)
                    }
                    document.getElementById("seats").appendChild(row)
                }
            })
    })