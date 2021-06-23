const userName = document.getElementById('userName');
const saveScoreBtn = document.getElementById('saveScoreBtn');
const finalScore = document.getElementById('finalScore');
const luckyBonus = document.getElementById('luckyBonus');

const mostRecentScore = localStorage.getItem('mostRecentScore');
const Lucky = localStorage.getItem('luckyBonus');

const highScores = JSON.parse(localStorage.getItem("highScores")) || [];
const MAX_HIGH_SCORES = 5;

console.log(highScores);

finalScore.innerText = 'Final Score: '+ mostRecentScore;
luckyBonus.innerText = "Congratts!!, You Got " + Lucky +  " Lucky Bonus.";
userName.addEventListener('keyup',()=> {
    
    saveScoreBtn.disabled = !userName.value;
}); 

saveHighScore = e =>{
    console.log("Clicked the button save");
    e.preventDefault();

    const score = {
        score: mostRecentScore ,
        
        name: userName.value,
    };

    highScores.push(score);
    highScores.sort((a,b)=>b.score-a.score);
    highScores.splice(5);

    localStorage.setItem('highScores',JSON.stringify(highScores));
    window.location.assign('index.html');
    console.log(highScores);
}; 