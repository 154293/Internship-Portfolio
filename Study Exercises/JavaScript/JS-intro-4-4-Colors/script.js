let kleur = document.getElementById('colorInput');

function kleurtje() {
    document.body.style.backgroundColor = kleur.value;     //function to change background color
}

function titles() {                                        //function to change title colors
    console.log("click");
    const alleHeaders = document.querySelectorAll('h1');
    for (const header of alleHeaders) {
        header.style.color = kleur.value;
    }
}

const achtergrond = document.querySelector('#achtergrondKleur');
achtergrond.addEventListener("click", kleurtje);                    //button for background color

const titels = document.querySelector('#titels');
titels.addEventListener("click", titles);                  //button for title color

const beide = document.querySelector('#beide');   //button that combines both event listeners
beide.addEventListener("click", () => {
    kleurtje();
    titles();
});
