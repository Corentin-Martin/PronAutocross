const play = {

    form: document.querySelector(".playform"),
    all: [
        MaxiSprint =  document.querySelector(".MaxiSprint"),
        TourismeCup =  document.querySelector(".TourismeCup"),
        SprintGirls =  document.querySelector(".SprintGirls"),
        BuggyCup =  document.querySelector(".BuggyCup"),
        JuniorSprint =  document.querySelector(".JuniorSprint"),
        MaxiTourisme =  document.querySelector(".MaxiTourisme"),
        Buggy1600 =  document.querySelector(".Buggy1600"),
        SuperSprint =  document.querySelector(".SuperSprint"),
        SuperBuggy =  document.querySelector(".SuperBuggy"),
        EndBloc =  document.querySelector(".endbloc"),
    ],

    answer: [],

    init: function () {

        while (play.form.firstChild) {
            play.form.removeChild(play.form.firstChild);
        }

        play.form.appendChild(play.all[0]);

        play.game();

    },

    game: function() {
        for (let i = 0; i < play.all.length; i++) {

            const radios = play.all[i].querySelectorAll(".radio");

            for (const btn of radios) {
                btn.addEventListener("click", play.handleNext);
            }
            
        }

        if (play.form.childNodes[0] === document.querySelector(".endbloc")) {
            let maxi = document.createElement("input");

            maxi.setAttribute("type", "hidden");

            maxi.setAttribute("name", "MaxiSprint");

            maxi.setAttribute("value", play.answer[0]);

            document.querySelector(".endbloc").appendChild(maxi);

            let tourisme = document.createElement("input");

            tourisme.setAttribute("type", "hidden");

            tourisme.setAttribute("name", "TourismeCup");

            tourisme.setAttribute("value", play.answer[1]);

            document.querySelector(".endbloc").appendChild(tourisme);

            let girls = document.createElement("input");

            girls.setAttribute("type", "hidden");

            girls.setAttribute("name", "SprintGirls");

            girls.setAttribute("value", play.answer[2]);

            document.querySelector(".endbloc").appendChild(girls);

            let cup = document.createElement("input");

            cup.setAttribute("type", "hidden");

            cup.setAttribute("name", "BuggyCup");

            cup.setAttribute("value", play.answer[3]);

            document.querySelector(".endbloc").appendChild(cup);

            let junior = document.createElement("input");

            junior.setAttribute("type", "hidden");

            junior.setAttribute("name", "JuniorSprint");

            junior.setAttribute("value", play.answer[4]);

            document.querySelector(".endbloc").appendChild(junior);

            let maxiT = document.createElement("input");

            maxiT.setAttribute("type", "hidden");

            maxiT.setAttribute("name", "MaxiTourisme");

            maxiT.setAttribute("value", play.answer[5]);

            document.querySelector(".endbloc").appendChild(maxiT);

            let b16 = document.createElement("input");

            b16.setAttribute("type", "hidden");

            b16.setAttribute("name", "Buggy1600");

            b16.setAttribute("value", play.answer[6]);

            document.querySelector(".endbloc").appendChild(b16);

            let superS = document.createElement("input");

            superS.setAttribute("type", "hidden");

            superS.setAttribute("name", "SuperSprint");

            superS.setAttribute("value", play.answer[7]);

            document.querySelector(".endbloc").appendChild(superS);

            let superB = document.createElement("input");

            superB.setAttribute("type", "hidden");

            superB.setAttribute("name", "SuperBuggy");

            superB.setAttribute("value", play.answer[8]);

            document.querySelector(".endbloc").appendChild(superB);

        }

    },

    handleNext: function() {

        const buttons = document.querySelectorAll(".next");

        for (const btn of buttons) {
            btn.classList.remove("d-none");
            btn.addEventListener('click', play.handleSuite)
        }

        
    },

    handleSuite: function() {
        play.answer.push(document.querySelector('input:checked').value);
                for (const div of play.all) {
            let $i = 0;
            if (play.form.childNodes[0] === div) {
                let newPlay = play.all[$i+1];
                console.log(div);
                play.form.replaceChild(newPlay, play.form.childNodes[0]);
                play.all.shift();
                play.game();
                break;
            }
            $i++;
        }
    }

    

    
}

document.addEventListener('DOMContentLoaded', play.init);

