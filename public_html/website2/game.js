const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-text"));

/* for the loader */
const loader = document.getElementById('loader');
const game = document.getElementById('game');



/* const questionCounterText = document.getElementById('questionCounter'); */

const progressText = document.getElementById('progressText');
const progressBarFull = document.getElementById('progressBarFull');

const scoreText = document.getElementById('score');



let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuestions = [];


let questions = []; 


/* we can also use fetch("questons.json") for fetching questions from our json file */
fetch("https://opentdb.com/api.php?amount=49&category=23&difficulty=medium&type=multiple").then(res =>{
        return res.json();
    }).then(
    loadedQuestions =>{
        console.log(loadedQuestions.results);
        /* questions = loadedQuestions;
        startGame(); */

        /* transform the api questions in our format of question */

        questions = loadedQuestions.results.map(loadedQuestion =>{
            const formattedQuestion = {
                question: loadedQuestion.question
                
            };

            /* console.log(loadedQuestions.question); */
            const answerChoices = [ ... loadedQuestion.incorrect_answers];
            formattedQuestion.answer = Math.floor(Math.random()*3)+1;
            /* console.log(formattedQuestion.answer); */

            answerChoices.splice(formattedQuestion.answer-1,0,loadedQuestion.correct_answer);

            answerChoices.forEach((choice,index)=>{
                formattedQuestion["choice" + (index +1)] = choice;
            });
            return formattedQuestion;
        });

        
        startGame();
        


    }).catch(err =>{
        alert("there is some problem in loading questions. please Try later!");
    });




const CURRECT_BONUS = 10;
const PENALITY = -5;
const luckyBonus = Math.floor(Math.random()*100);
const MAX_QUEATIONS= 5;

startGame = () => {
    questionCounter=0;
    score=0;
    availableQuestions= [...questions]; 
   
    getNewQuestion();
    game.classList.remove('hidden');
        loader.classList.add('hidden');

};

getNewQuestion=()=>{
    if(availableQuestions.length===0 || questionCounter >= MAX_QUEATIONS ){
        localStorage.setItem('mostRecentScore',score + luckyBonus);
        localStorage.setItem('luckyBonus', luckyBonus);
        return window.location.assign('end.html');


        
    }
    questionCounter++;

    progressText.innerText = "Question: "+questionCounter + "/" + MAX_QUEATIONS;

    let percentage = (questionCounter / MAX_QUEATIONS)*100;

    progressBarFull.style.width = percentage+"%";

    /* progressBarFull.style.width = "${(questionCounter / MAX_QUEATIONS)*100}%"; */
    /* questionCounterText.innerText = questionCounter + "/" + MAX_QUEATIONS; */

    

    /* progressText.innerText = 'Question: '+ questionCounter + "/" + MAX_QUEATIONS; */
     /* questionDounterText.innerText = "${questionCounter} / ${MAX_QUEATIONS}; */


    /* console.log((questionCounter/MAX_QUEATIONS)*100); */


    


    console.log(progressBarFull.style.width); 


    const questionInex = Math.floor(Math.random()*availableQuestions.length);
    currentQuestion=availableQuestions[questionInex];
    question.innerText=currentQuestion.question;

    choices.forEach(choice => {
        const number = choice.dataset["number"];
        choice.innerText = currentQuestion["choice" + number];
    });

    availableQuestions.splice(questionInex,1);
    console.log(availableQuestions);
    acceptingAnswers=true;
};

choices.forEach(choice =>{
    choice.addEventListener('click',e=>{
        if(!acceptingAnswers)
        {
            return;
        }
        acceptingAnswers=false;
        const selectedChoice = e.target;
        const selectedAnswer = selectedChoice.dataset['number'];
        console.log(selectedAnswer);

        const classToApply = selectedAnswer==currentQuestion.answer?'correct':'incorrect';

        if(classToApply==="correct"){
            incrementScore(CURRECT_BONUS);
        }

        else{
            incrementScore(PENALITY);
        }


        selectedChoice.parentElement.classList.add(classToApply);

        setTimeout(()=>{
            selectedChoice.parentElement.classList.remove(classToApply);
            getNewQuestion();
        },700);
        
        
    });

});

incrementScore = num =>{
    score+=num;
    scoreText.innerText = score;
}

/* startGame(); */

