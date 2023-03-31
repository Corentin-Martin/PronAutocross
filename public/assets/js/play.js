const play = {

    form: document.querySelector(".playform"),

    all: [
        document.querySelector(".MaxiSprint"),
        document.querySelector(".TourismeCup"),
        document.querySelector(".SprintGirls"),
        document.querySelector(".BuggyCup"),
        document.querySelector(".JuniorSprint"),
        document.querySelector(".MaxiTourisme"),
        document.querySelector(".Buggy1600"),
        document.querySelector(".SuperSprint"),
        document.querySelector(".SuperBuggy"),
        document.querySelector(".endbloc"),
    ],

    category: ['MaxiSprint', 'TourismeCup', 'SprintGirls', 'BuggyCup', 'JuniorSprint', 'MaxiTourisme', 'Buggy1600', 'SuperSprint', 'SuperBuggy'],

    answer: [],

    init: function () {

        while (play.form.firstChild) {
            play.form.removeChild(play.form.firstChild);
        }

        play.game();

    },

    game: function() {
        play.form.appendChild(play.all[0]);

        const radios = play.all[0].querySelectorAll(".radio");

        for (const btn of radios) {
            btn.addEventListener("click", play.handleValidate);
        }

        if (play.form.childNodes[0] === document.querySelector(".endbloc")) {
            play.endbloc();
        }
    },

    handleValidate: function() {
        const buttons = document.querySelectorAll(".next");

        for (const btn of buttons) {
            btn.classList.remove("d-none");
            btn.addEventListener('click', play.handleNext)
        }

    },

    handleNext: function() {
        play.answer.push(document.querySelector('input:checked').value);

        play.form.removeChild(play.form.firstChild);
        play.all.shift();
        play.game();
    },

    endbloc: function() {
        for (let i = 0; i < play.answer.length; i++) {

            let input = document.createElement("input");

            input.setAttribute("type", "hidden");
            input.setAttribute("name", play.category[i]);
            input.setAttribute("value", play.answer[i]);
            document.querySelector(".endbloc").appendChild(input);
                
        }
    }
    
}

document.addEventListener('DOMContentLoaded', play.init);

