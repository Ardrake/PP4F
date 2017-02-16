//Hard coded images copied into img folder
//[img, correct Answer #, Option 1, Option 2, Option 3, Option 4]
var questions = [
      ['assets/imgs/animal_1.jpg', '1', "Vache", "Chien", "Cheval", "Poule", 'assets/son/animal_1.wav']
    
    , ['assets/imgs/animal_2.jpg', '2', "Lapin", "Cheval", "Cochon", "Vache", 'assets/son/animal_2.wav']
    
    , ['assets/imgs/animal_3.jpg', '1', "Cochon", "Vache", "Lapin", "Chien", 'assets/son/animal_3.wav']

    , ['assets/imgs/animal_4.jpg', '4', "Cheval", "Poule", "Chat", "Ane", 'assets/son/animal_4.wav']

    , ['assets/imgs/animal_5.jpg', '4', "Chien", "Chat", "Poule", "Lapin", 'assets/son/animal_5.wav']

    , ['assets/imgs/animal_6.jpg', '3', "Chat", "Lapin", "Poule", "Cheval", 'assets/son/animal_6.wav']

];

var qNo = 0;
var correct = 0;
var cnt = 0;
var corectAnswer = 0;
var answer = '';

function NextQuestion(response) {
    correctAnswer = questions[qNo][1];
    var temp = parseInt(correctAnswer, 10) + 1;
    
    answer = questions[qNo][temp];
    
    document.getElementById('answer').innerHTML = answer;     
    
    if ((qNo < questions.length) && (response == correctAnswer)) {
        correct++;
        var snd = new Audio(questions[qNo][6]);
        snd.play();
    }
    else {
        var snd = new Audio('assets/son/erreur.wav');
        snd.play();
    }
    qNo++;
    if (qNo < questions.length) {
        document.getElementById('Pic').src = questions[qNo][0];
        cnt++;
        UpdateOptions();
    } else {
        
        finishModal(correct, qNo);
    }
}

function UpdateOptions() {
    document.getElementById('qNo').innerHTML = 'Question ' + (qNo + 1) + ' sur ' + (questions.length);
    document.getElementById('opt1').innerHTML = questions[qNo][2];
    document.getElementById('opt2').innerHTML = questions[qNo][3];
    document.getElementById('opt3').innerHTML = questions[qNo][4];
    document.getElementById('opt4').innerHTML = questions[qNo][5];
}

function randOrd() {
    return (Math.round(Math.random()) - 0.5);
}

function calculateOpinion(correct, total){
    var frac = (correct/total);
    var lowerThreshold = 0.10;
    var threshold = 0.50;
    var upperThreshold = 0.90;
    
    if(correct == 0 && total > 0){
        return('Lachez pas vous y arriverez');
    }
    
    if((frac <= threshold) && frac > lowerThreshold){
        return ('Les animaux de la ferme sont difficle mais on re-essauie...');
    }
    if(frac >= threshold && frac < upperThreshold){
        return ('Bravo vous y etes quasiment.');
    }
    if(frac >= upperThreshold){
        return ("Bon travail vous avez reussi");
    }
}

function finishModal(correctScore, totalQuestions) {
    $('#myModal').modal('show');
    $(".modal-body").text('vous avez ' + correctScore + ' sur ' + totalQuestions);
    $(".modal-body-2").text(calculateOpinion(correctScore, totalQuestions));

    ev.preventDefault();
}

onload = function () {
    questions = questions.sort(randOrd);
    document.getElementById('Pic').src = questions[0][0];
    UpdateOptions();
}