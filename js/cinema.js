let seanse
fetch('times.php')
    .then(function (response) {
        return response.json()
    }).then(function (data) {
        seanse = data

        fetch('films.php')
            .then(function (response) {
                return response.json()
            }).then(function (data) {
                console.log("data: ", data)
                console.log("seanse: ", seanse)

                for (let i = 0; i < data.length; i++) {
                    let divWithFilm = document.createElement("div")
                    let img = document.createElement("img")
                    let divForTimes = document.createElement("div")

                    img.classList.add("film-img")
                    img.src = "./img/films/" + data[i].img

                    divWithFilm.appendChild(img)

                    for (let z = 0; z < seanse.length; z++) {
                        if (seanse[z].id_film == data[i].id_film) {
                            let filmTime = document.createElement("div")

                            let a = document.createElement("a")

                            filmTime.classList.add("film-time")
                            filmTime.innerHTML = seanse[z].hour + " " + seanse[z].date
                            a.href = "seats.php?id=" + seanse[z].id

                            a.appendChild(filmTime)
                            divWithFilm.appendChild(a)
                        }
                    }

                    divWithFilm.classList.add("film")

                    document.getElementById("films").appendChild(divWithFilm)
                }
            })
    })