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
                    divForTimes.classList.add("divForTimes")

                    img.classList.add("film-img")
                    img.src = "./img/films/" + data[i].img

                    divWithFilm.innerHTML = "<p>" + data[i].title + "</p>"

                    divWithFilm.appendChild(img)

                    for (let z = 0; z < seanse.length; z++) {
                        if (seanse[z].id_film == data[i].id_film) {
                            let a = document.createElement("a")

                            a.innerHTML = "<span>" + seanse[z].hour + "</span><span>" + seanse[z].date + "</span>"
                            a.href = "seats.php?id=" + seanse[z].id

                            divForTimes.appendChild(a)
                        }
                    }

                    divWithFilm.classList.add("film")
                    divWithFilm.appendChild(divForTimes)

                    document.getElementById("films").appendChild(divWithFilm)
                }
            })
    })