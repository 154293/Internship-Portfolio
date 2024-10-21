const rockButton = document.querySelector('#rock');
const paperButton = document.querySelector('#paper');
const scissorsButton = document.querySelector('#scissors');
const playerText = document.querySelector('#playerText');
const reset = document.querySelector('#reset');           //bunch of selectors from the HTML
const winner = document.querySelector('#winner');
const choice1 = document.querySelector('#choice1');
const choice2 = document.querySelector('#choice2');

const p1 = document.querySelector('#p1');
const p2 = document.querySelector('#p2');

let playerOne;
let playerTwo;

const winstates = {
    scissors: {
        scissors: "It's a tie!",
        paper: "Player 1 wins!",        //winstates are based on the multidimensional array
        rock: "Player 2 wins!",
    },
    paper: {
        scissors: "Player 2 wins!",
        paper: "It's a tie!",
        rock: "Player 1 wins!",
    },
    rock: {
        scissors: "Player 1 wins!",
        paper: "Player 2 wins!",
        rock: "It's a tie!",
    },
};

function saveEntry(choice) {
    if (playerOne == undefined) {                  //this function saves choices
        playerOne = choice;
        p1.innerHTML = playerOne;
        document.querySelector('h1').innerText = "Player 2, choose your weapon!"
    } else {
        playerTwo = choice;
        p2.innerHTML = playerTwo;
        winner.innerHTML = winstates[playerOne][playerTwo];         //and it picks the winner when both have chosen
        choice1.innerHTML = "Player 1 chose: " + playerOne;
        choice2.innerHTML = "Player 2 chose: " + playerTwo;
    }
}

rockButton.addEventListener('click', () => saveEntry('rock'));         //buttons for the different choices
paperButton.addEventListener('click', () => saveEntry('paper'));
scissorsButton.addEventListener('click', () => saveEntry('scissors'));

function resetGame() {                  //resets game by reloading page
    window.location.reload();
}

reset.addEventListener("click", resetGame);   //function with button to reset game