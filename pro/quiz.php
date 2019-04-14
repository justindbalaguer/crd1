<?php
    require 'header.php';
    require 'user/user.session.php';
    require 'includes/dbh.inc.php';
?>
    <main>
    <div class="container">
        <?php
            if (isset($_SESSION['id'])) {
                echo '<p>Hello, ' .$_SESSION['username'].'</p>';
            }
        ?>
          <!--Logout Form-->
            <form class="form-horizontal" action="includes/logout.inc.php" method="post">
              <div class="form-group">
                <div class="col-sm-offset-0 col-sm-10">
                  <button type="submit" name="logout-submit" class="btn btn-default">Logout</button>
                </div>
              </div>
            </form>

            <div class='container'>
            <div id='questions_content'></div><!-- Dom container of questionnaire -->
            <input type='hidden' id='questions_counter' value='0'><!-- Counter of exam questions-->
            </div>

            <?php
             // require 'includes/load-quiz.inc.php';
            ?>
            <div id="count" style="position:absolute; Top:10%; Left:50%; border: 2px solid blue; ">Start</div>
            <script type="text/javascript">
            var ccount = 30;
                 var t, count = 30;
function quiz_timer() {
   
  document.getElementById('count').innerHTML=count;

  if (count === 0){
    document.getElementById('count').innerHTML='Done';
    // or...
    alert("You're out of time!");
    window.location = "quiz.php?";
  } else {
  count--;
t = setTimeout("quiz_timer()", 1000);
}
}

function reset_timer() {
    clearTimeout(t);
    count = ccount;
    quiz_timer();

}

function remove_timer() {
    var elem = document.querySelector('#count');
elem.parentNode.removeChild(elem);
}

quiz_timer();

$(document).ready(function(){ /* onload */

/* Initialize question json data*/
load_questions();

/* Delete questionnaire session when logout*/
$('button[name=logout-submit]').click(function(){
 localStorage.clear();
});

});





function load_questions(){
 var n=localStorage.getItem("quiz_data"); /* if  question JSON data is available*/
if(!n){
fetch_questions();    /*Get Questions*/
}
else{
console.log("already loaded"); //item will be removed if score is submitted
display_each_questions(); /*Question display mechanism*/
setAllAnswers(); /*Set answered questions history*/
}

}




/*Fetch questions from API */
function fetch_questions(){
 $.ajax({
    url:"questions_api.php", /*Generates json for questions*/
    success:function(data){
        localStorage.setItem("quiz_data",data); /*Save quiz data*/
        localStorage.setItem("quiz_answer_data","[]"); /* Initialize quiz answer data storage*/
        display_each_questions(); /* Show all questions*/
        setAllAnswers(); /*Sets user answer (by default it is set to null)*/
    },
    error:function(err){
        alert("Network Problem");
    }
 });
}




/*Creates a virtual DOM to display questions in the APP shell*/
function display_each_questions(){
var n=JSON.parse(localStorage.getItem("quiz_data"));
var str="";
for(var x=0;x<n.length;x++){ /*Loop all div*/

str+=`
<div class='setcont' id='setcont${x}' style='display:none;'>
 <h1>Question</h1><br>

<input type='hidden' id='form_id${x}' value='${n[x].id}'/>
<div class='row'>
<div class='col-sm-12'><h4>${x+1}. ${n[x].question}</h4></div>
</div>
<div class='row'>
<div class='col-sm-12'>
<input type='radio' class='c_${x}_1' id='c${x}' name='c${x}' value='1' /><label style='font-weight: normal' for='c1'>${n[x].choice1}</label><br/>
<input type='radio' class='c_${x}_2' id='c${x}' name='c${x}' value='2'  /><label style='font-weight: normal' for='c1'>${n[x].choice2}</label><br/>
<input type='radio' class='c_${x}_3' id='c${x}' name='c${x}' value='3'  /><label style='font-weight: normal' for='c1'>${n[x].choice3}</label><br/>
<input type='radio' class='c_${x}_4' id='c${x}' name='c${x}' value='4'  /><label style='font-weight: normal' for='c1'>${n[x].choice4}</label><br/>


</div>
</div>

<div class='row'>
<div class='col-sm-12' align='right'>`;

str+=(x==0)?"":`<button onclick='setcont(${x-1})'>Back</button>`; /* Returns to previous page*/

str+=(x==(n.length-1))?`<button onclick='set_answer(${x}); remove_timer();'>Submit</button>`:`<button onclick='set_answer(${x}); reset_timer();'>Next</button>`; /*Proceeds to next question*/

str+=`
</div>
</div>

</div>
`;


}


$('#questions_content').html(``+str+`<div class='setcont' id='setcontN' style='display:none;'></div>`);
$('#questions_counter').val(n.length); /*Set row counter*/
setTimeout(function(){ setcont(0); },1000);
}



async function get_set_Answer(id){ /*Gets the correct answer*/
 var n=JSON.parse(localStorage.getItem("quiz_answer_data"));
    for(var y=0;y<n.length;y++){
        if(n[y].id==id){
          return  n[y].answer;
        }
    }
    return 0;

}



async function setAllAnswers(){ /*Sets the checked answers from the question options*/
var counter=parseInt($('#questions_counter').val());
var dat=[];
for(var y=0;y<counter;y++){
var question_id=$('#form_id'+y).val();
var answered=await get_set_Answer(question_id); /* Gets the right answer*/
if(answered!=0){
$('.c_'+y+'_'+answered+'').prop("checked",true); /*Checks the option of the answered question*/
}


}


}



function setcont(n){ /*Responsible for next page and previous page navigation */
    if(n<0){ n=0; }
    $('.setcont').hide(); /*Hides div*/
    $('#setcont'+n).show(); /*Shows current div*/
}



function set_answer(x){ /* Auto saves selected answers */
console.log(`------------------`);

var answer_n=$('#c'+x+':checked').val(); /* Checked option assignment*/
if(answer_n){ /* if has answer*/

var counter=parseInt($('#questions_counter').val());
var dat=[];
for(var y=0;y<counter;y++){ /* Loops all answer*/
var question_id=$('#form_id'+y).val();
var answer=$('#c'+y+':checked').val();
console.log(`id=${question_id}: answer=${answer}`);
var answered=0;

dat[y]={id:question_id,answer:answer}; /*JSON representation of saving the answer */

}

localStorage.setItem("quiz_answer_data",JSON.stringify(dat)); /* Cache storage of answer*/


var counter=parseInt($('#questions_counter').val()); /* gets number of questions*/
if(x==(counter-1)){ /* If question div is the last div */

console.log("Submit!");
calculate_score(); /*Compures the score*/
}
else{

setTimeout(function(){
setcont(x+1);  /*Go to next question*/
setAllAnswers();   /*Remembers answers*/
},700); /*Delay for 700 milli seconds*/

}




}
else{
    alert("Select an answer");
}

}






async function calculate_score(){ /*Computes score*/
var quiz_data=JSON.parse(localStorage.getItem("quiz_data")); /*Gets quiz data json*/
var ans=JSON.parse( localStorage.getItem("quiz_answer_data")); /*Gets answers data json*/

var count_correct=0;

var total_quiz_num=quiz_data.length; /* Number of items in the quiz */

 for(var x=0;x<quiz_data.length;x++){

var q_answer=await get_set_Answer(quiz_data[x].id); /*Gets correct answer*/
var c_answer=quiz_data[x].answer; /*gets the user answer*/
if(q_answer==c_answer){ count_correct+=1; } /* Counter of scores*/


console.log(`q_answer=${q_answer} : c_answer=${c_answer}`);


}

console.log(`Correct: ${count_correct}`); //shows number of correct answer




//Saving of correct answer
$.ajax({
    url:"quiz_submit_api.php", /*API that does the heavy lifting of saving the scores*/
    method:"POST",
    data:{ count_correct:count_correct }, /*Pass values to API*/
    success:function(data){
        var n=JSON.parse(data);
        if(n.msg==""){
        console.log(data);


/*******Display result(optional)*************/
var final_score=count_correct; /*FINAL SCORE*/
var average=(parseInt(final_score)/parseInt(total_quiz_num))*100;


/* PASSFAIL CODE CAN BE HERE*/
var passfail="";


if(average<=100 && average >=80){ passfail="You Passed"; }
else if(average<80){ passfail="You Failed"; }
/* else etch. */


var button=`<button onclick='window.print()'>Print</button>`; /*Virtual dom for printing sample*/
/* you can also hide other elements to only print the needed parts*/

        $('.setcont').hide();
        $('#setcontN').show();
           $('#setcontN').html(`
               <div class='container'>
               <div><h4>Results</h4></div>
               <div><h3>Name: ${n.username}</h3></div>
               <div><h3>Score: ${count_correct}</h3></div>
               <div><h2>${passfail}</h2></div>
               <!--
                YOU CAN PUT VIRTUAL DOM HERE IF YOU WANT
                ${button} /*Sets the html button to print*/
               -->
               </div>
            `);
/********************/


           localStorage.clear(); /*Resets questionnaire*/


        }

    },
    error:function(err){
        alert("Network Error");
    }
});


}


</script>

        </div>
    </main>
<?php
    require 'footer.php';
?>
