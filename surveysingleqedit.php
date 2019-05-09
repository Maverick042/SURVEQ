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
function getAnswers($con){
    $answer = "SELECT answerID,answer
    FROM answer
    WHERE questionID= ".$_GET['qid'];

    $answerres = mysqli_query($con,$answer);
    return $answerres;

}
?>

<?php if(empty($_POST)) ?>

<form role="form" action="qsave.php" method="post">
    <?php $count=0; ?>

    <?php while ($qrow = mysqli_fetch_assoc($questionres)){ ?>


    <?php  $ansres = getAnswers($con); ?>


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

<!-- Submit Buttons -->
<button type="submit" class="btn btn-default">Save</button>



</form>
<?php } //end of outer while ?>



<?php
if (!empty($_POST)){
    var_dump($_POST);
}
?>
<?php require "footer.php"; ?>
