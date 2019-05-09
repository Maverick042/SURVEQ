<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>

<?php 

$survey_id = $_GET['id'];
$con=mysqli_connect("127.0.0.1","root","","final");

/******** getting answers of  question *******************/
function getAnswers($id,$con){
	$answer = "SELECT answerID,answer
	FROM answer
	WHERE questionID= ".$id;

	$answerres = mysqli_query($con,$answer);
	return $answerres;

}


/******** getting questions of survey *******************/
function getQuestions($id,$con){
	$answer = "SELECT questionID,question
	FROM question
	WHERE surveyID= ".$id;

	$answerres = mysqli_query($con,$answer);
	return $answerres;

}

function getSurveyInfo($id,$con){
	$answer = "SELECT surveyID,surveyName,endDate
	FROM survey
	WHERE surveyID= ".$id;

	$answerres = mysqli_query($con,$answer);
	return $answerres;

}

$questions = getQuestions($survey_id,$con);
$surveyInfo = getSurveyInfo($survey_id,$con);
$survey     = mysqli_fetch_assoc($surveyInfo);

?>

<div class="container">

	<h1><?php echo $survey['surveyName'];?></h1>
	<p>You have <strong><?php echo $survey['endDate'];?></strong> mins to finish the quiz</p>
	<form role="form" action="quizresult.php" method="post">
		<?php $qcount =0;?>
		<?php while ($q = mysqli_fetch_assoc($questions)){?>
		
		<div class= 'qblock' style="margin-bottom:20px;">
			<div class="question">
				<label><?php echo ++$qcount.")".$q['question']; ?> </label>

				<?php $ans= getAnswers($q['questionID'],$con)?>
				<?php
				$options = [];
				while ($a = mysqli_fetch_assoc($ans)){

					$options[]=$a;
					

				}
				shuffle($options);
				
				?>






				<div class="options" style="margin-left:10px;">
					<?php foreach ($options as $val){?>
					<label class="radio" >
						<input type="radio" name="q-<?php echo $q['questionID']?>" value="<?php echo $val['answerID'];?>"   > 
						<?php echo $val['answer']; ?>
					</label>
					<?php } ?>
				</div>

			</div>
		</div>
		<?php } //end of outer while?>
		<label>Enter you email </label>
		<input type="email" name="email">
		<input type="hidden" name="surveyID" value="<?php echo $survey_id;?>">
		<input type="hidden" name="surveyName" value="<?php echo $survey['surveyName'];?>">
		<hr>
		<button type="submit" class="btn btn-default">Finish</button>
		

	</form>
</div>







<?php require "footer.php" ?>