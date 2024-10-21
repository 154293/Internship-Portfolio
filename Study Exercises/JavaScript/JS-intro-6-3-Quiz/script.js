const antwoorden = [
    "Parijs",
    8,
    "IJsselmeer",
    ["Volkswagen", "Audi", "Opel", "Porsche", "BMW", "Mercedes"],             //array with answers
    ["Texel", "Vlieland", "Terschelling", "Ameland", "Schiermonnikoog"],
];

const vragen = [
    "Wat is de hoofdstad van Frankrijk?",
    "Hoeveel poten heeft een spin?",
    "Wat is het grootste meer van Nederland?",             //array with questions
    "Wat is een Duits automerk?",
    "Noem een Waddeneiland",
];

for (let x = 0; x < vragen.length; x++) {            //for loop that generates the questions
    const element = vragen[x];
    let vraagElement = document.createElement('h3');
    vraagElement.innerHTML = element;
    document.body.insertBefore(vraagElement, document.querySelector("#antwoorden"));
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.classList.add('quiz');
    document.body.insertBefore(input, document.querySelector('#antwoorden'));
}

const vraagElementen = document.querySelectorAll('.quiz');
const klik = document.querySelector('#knop');
klik.addEventListener("click", checkAnswers);

var punten = 0;
function correct(element) {            //function to turn correct elements green and increment points
    element.style.backgroundColor = 'green';
    punten++;
}

function checkAnswers() {
    for (let i = 0; i < vraagElementen.length; i++) {
        const element = vraagElementen[i];
        if (Array.isArray(antwoorden[i])) {
            if (antwoorden[i].includes(vraagElementen[i].value)) {          //if answer contains array, it checks the array of answers
                correct(element);
            } else {
                element.style.backgroundColor = 'red';
            }
        } else if (element.value == antwoorden[i]) {        // if it's not an array, it directly checks the right answer
            correct(element);                               //correct answers are colored green and increment score through the function
        } else {
            element.style.backgroundColor = 'red';          //incorrect answers are colored red
        }
    }
    const cijfer = document.querySelector('#uitkomst');
    cijfer.innerHTML = "Je hebt " + punten + " gescoord";                //displays total score
}
