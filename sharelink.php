<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>


    <style>
        #sharelinkurl{
            color: #blue;
        }
    </style>



    <div class='row'>
        <div class='col-lg-6 col-lg-offset-3 text-center'>
            <div class='page-header'>
                <h1>Hola! Now you can share the link with your friends!</h1>

            </div>
        </div>
    </div>



<?php





//fetching the survey

$surveyid = $_GET["id"];
$_SESSION['current_survey'] = $surveyid;
$con=mysqli_connect("127.0.0.1","root","","final");

/***********fetching the survey ***********/
$survey="SELECT surveyID,surveyName,surveyType,createdBy,endDate,dateCreated
FROM survey
WHERE surveyID= '".$surveyid."'";

$surveyres = mysqli_query($con,$survey);
$surveyrow = mysqli_fetch_assoc($surveyres);


//redirecting to edit quiz page
if($surveyrow['surveyType']=="Quiz"){
    header("Location:editquiz.php?id=".$surveyid);
}


//redirecting to takequiz page if appropriate
//if($surveyrow['createdBy']!= $_SESSION['ID']){
//    header("Location:takesurvey.php?id=".$surveyid);
//}


/***********fetching the survey questions***********/
$question = "SELECT questionID,question
FROM question
WHERE  surveyID = '".$surveyrow['surveyID']."'";

$questionres = mysqli_query($con,$question);

//var_dump($questionres);


/**********fetching the answers of survey question*********/

function getAnswers($id,$con){
    $answer = "SELECT answerID,answer
    FROM answer
    WHERE questionID= '.$id.'
    ";

    $answerres = mysqli_query($con,$answer);
    return $answerres;


}

/********* Test Loop *****************/

/* while ($qrow = mysqli_fetch_assoc($questionres)){
    //echo $qrow['question'];
    $ansres = getAnswers($qrow['questionID'],$con);
    while ($arow = mysqli_fetch_assoc($ansres)){
        //echo($arow['answer']);
    }
} */
?>







    <div class="container">


        <!-- Modal -->


        <div>
            <label> Share quiz link:   </label>
            <input  id="sharelinkurl" type="text" class="form-control" value= "localhost/final/takequiz.php?id=<?php echo $surveyid;?>"?>
        </div>

        <div style="margin-top:30px;">
            <a class="btn btn-primary" href="quizinvite.php?id=<?php echo $surveyid;?>">Invite</a>
        </div>


    </div>

    <!--   <script>
           $(".editBtn").click(function(){
               alert($(".editBtn").closest("form").closest(".questionBlock").html());
               //alert(question);
               //$('#myModal').modal('show');
           });
       </script>-->
<?php require "footer.php"; ?>