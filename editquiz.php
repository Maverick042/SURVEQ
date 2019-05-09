<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>

<?php
/*********************** Declaring Functions *********************************/
function noCondition(){ // show that nothing exists and then stop code execution
    echo "
    <div style='font-size:40px;color:red;margin-left:30%;margin-bottom:20%;'>
        <em><strong> Data doesn't exist</strong></em>
    </div>";
    require "footer.php";
    exit();
}

/**********fetching the answers of survey question*********/

function getAnswers($id,$con){
    $answer = "SELECT answerID,answer
    FROM answer
    WHERE questionID= ".$id;

    $answerres = mysqli_query($con,$answer);
    return $answerres;


}

/**********fetching the correct answers of quiz *********/
function getCorrectAnswer($qid,$con){
    $answer = "SELECT answerID,marks
    FROM carec
    WHERE questionID= ".$qid."
    ";

    $answerres = mysqli_query($con,$answer);

    $ansrow =  mysqli_fetch_assoc($answerres);
    return $ansrow;
}

/***************************** END OF FUNCTION DECLARATION ********************************/

//fetching the survey

$surveyid = $_GET["id"];
$_SESSION['current_survey'] = $surveyid;
$con=mysqli_connect("127.0.0.1","root","","final");

/***********fetching the quiz ***********/
$survey="SELECT surveyID,surveyName,surveyType,createdBy,endDate,dateCreated
FROM survey
WHERE surveyID= '".$surveyid."'";

$surveyres = mysqli_query($con,$survey);
$surveyrow = mysqli_fetch_assoc($surveyres);


//redirecting if survey doesn't exist
if (!isset($surveyrow)){
    noCondition();
}



/***********fetching the quiz questions***********/
$question = "SELECT questionID,question
FROM question
WHERE  surveyID = '".$surveyrow['surveyID']."'";

$questionres = mysqli_query($con,$question);



//redirecting if question doesn't exist
if($questionres->num_rows === 0){
    noCondition();
}




/********* Test Loop *****************/

/*while ($qrow = mysqli_fetch_assoc($questionres)){
    echo $qrow['question'];
    $ansres = getAnswers($qrow['questionID'],$con);

    while ($arow = mysqli_fetch_assoc($ansres)){
        echo($arow['answer']."---");
        
    }
    
    echo"<br>";
    var_dump(getCorrectAnswer($qrow['questionID'],$con));
    echo"<hr>";

}*/ 

?>







<div class="container">
    <?php $count=0; ?>
    
    <?php while ($qrow = mysqli_fetch_assoc($questionres)){ ?>

    <?php $count++; ?>
    <?php  $ansres = getAnswers($qrow['questionID'],$con); ?>
    <?php $qid=$qrow['questionID'];?>
    <?php $cans = getCorrectAnswer($qid,$con);?>

    <div class="question" style="margin-bottom:40px;font-size:23px;">
        <span class="qtext"> <?php echo $count.")".$qrow['question']; ?>
            (Marks-<?php echo $cans['marks'];?>)
        </span>

        <?php while ($arow = mysqli_fetch_assoc($ansres)){ ?>
        <div class="answer" style="margin-bottom:20px;">
            <div class="result" style="margin-top:10px;">
                <span class="glyphicon glyphicon-record"></span>
                <?php echo($arow['answer']); ?>
                <?php
                if($arow['answerID']==$cans['answerID']){
                    $_SESSION['cansID'] = $cans['answerID'];
                    $_SESSION['canmark'] = $cans['marks'];
                    echo "(correct)";

                } ?>

            </div>
        </div>
        <?php }//end of inner while ?>


        <!-- Edit Buttons -->
        <div style="margin-top:10px;">
            <a href='surveysingleqedit_quiz.php?qid=<?php echo $qrow['questionID'];?>' class='btn btn-info editBtn' role="button">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href='#' class='btn btn-info delBtn' role="button"><span class="glyphicon glyphicon-remove"></span></a>
        </div>


    </div>
    <?php } //end of outer while ?>


    <div>
        <label> Share quiz link:   </label>
        <input type="text" class="form-control" value= "localhost/final/takequiz.php?id=<?php echo $surveyid;?>"?>
    </div>

    <div style="margin-top:30px;"> 
        <a class="btn btn-primary" href="quizinvite.php?id=<?php echo $surveyid;?>">Invite</a>
    </div>



</div>


<?php require "footer.php"; ?>