<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>

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
if($surveyrow['createdBy']!= $_SESSION['ID']){
    header("Location:takesurvey.php?id=".$surveyid);
}


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
    <?php $count=0; ?>
    
    <?php while ($qrow = mysqli_fetch_assoc($questionres)){ ?>

    <?php $count++; ?>
    <?php  $ansres = getAnswers($qrow['questionID'],$con); ?>

    <div class="question" style="margin-bottom:40px;font-size:23px;">
        <span class="qtext" style="margin-bottom:20px;"> <?php echo $count.")".$qrow['question']; ?> </span>

        <?php while ($arow = mysqli_fetch_assoc($ansres)){ ?>
        <div class="answer" style="margin-top:10px;">
            <div class="result">
                <span class="glyphicon glyphicon-record"></span>
                <?php echo($arow['answer']); ?>
            </div>
        </div>
        <?php }//end of inner while ?>


        <!-- Edit Buttons -->
        <div style="margin-top:10px;">
            <a href='surveysingleqedit.php?qid=<?php echo $qrow['questionID'];?>' class='btn btn-info editBtn' role="button">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href='#' class='btn btn-info delBtn' role="button"><span class="glyphicon glyphicon-remove"></span></a>
        </div>

    </div>
    <?php } //end of outer while ?>

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit <?php echo $surveyrow['surveyName']; ?></h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="email">Question</label>
                            <input type="email" class="form-control" id="email" value="hello?">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="pwd" value="howdy">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="pwd" value="hi">
                        </div>

                        <button type="submit" class="btn btn-default">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div>
        <label> Share quiz link:   </label>
        <input type="text" class="form-control" value= "localhost/final/takequiz.php?id=<?php echo $surveyid;?>"?>
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