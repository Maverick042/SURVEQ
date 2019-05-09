<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>
<?php

$con=mysqli_connect("127.0.0.1","root","","final");

/***********fetching the edit question***********/
$question = "SELECT questionID,question
FROM question
WHERE  questionID = '".$_GET['qid']."'";

$questionres = mysqli_query($con,$question);


/******** getting answers of edit question *******************/
function getAnswers($id,$con){
    $answer = "SELECT answerID,answer
    FROM answer
    WHERE questionID= ".$id;

    $answerres = mysqli_query($con,$answer);
    return $answerres;

}

/******** getting answers of edit question *******************/
function getCorrectAnswers($con){
    $answer = "SELECT answerID,answer
    FROM answer
    WHERE questionID= ".$_GET['qid'];

    $answerres = mysqli_query($con,$answer);
    return $answerres;

}
?>

<?php if(empty($_POST)) ?>

<form role="form" action="qsave_quiz.php" method="post">
    <?php $count=0; ?>

    <?php while ($qrow = mysqli_fetch_assoc($questionres)){ ?>


    <?php  $ansres = getAnswers($_GET['qid'],$con); ?>


    <div class="form-group">
        <label for="email">Question:</label>
        <input type="text" name=q-<?php echo $_GET['qid']; ?> class="form-control" id="email" value="<?php echo $qrow['question']; ?>">
    </div>
    <hr>
    <?php $ansCount=0;?>
    <?php while ($arow = mysqli_fetch_assoc($ansres)){ ?>
    
    <div class="answer form-group">
        <label for="">Answer:<?php echo ++$ansCount; ?></label>
        <input type="text" name=ans-<?php echo $arow['answerID']; ?> class="form-control" id="email" value="<?php echo($arow['answer']); ?>">

    </div>

</div>
<?php }//end of inner while ?>
<?php $ansCount=0;?>


<hr>
<div class="form-group">
    <label>Choose Correct Answer</label>
    <?php  $ansres = getAnswers($_GET['qid'],$con); ?>
    <?php while ($arow = mysqli_fetch_assoc($ansres)){ ?>
    
    <?php if($arow['answerID']== $_SESSION['cansID']){?>
    <div class="radio">
        <label><input type="radio" checked="checked" name="cans"  value="<?php echo($arow['answerID']); ?>"><?php echo($arow['answer']); ?></label>
    </div>
    <?php } else{ ?>
    <div class="radio">
        <label><input type="radio" name="cans"  value="<?php echo($arow['answerID']); ?>"><?php echo($arow['answer']); ?></label>
    </div>
    <?php } ?>
</div>
<?php }//end of inner while ?>
</div>
<hr>
<div class="form-group">
    <label>Marks</label>
    <input type="text" class="form-control" name="mark" value="<?php echo $_SESSION['canmark']; ?>" ?> 
</div>


<!-- Submit Buttons -->
<button type="submit" class="btn btn-default">Save</button>



</form>
<?php } //end of outer while ?>


<?php require "footer.php"; ?>
