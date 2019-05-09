<?php 
require "header.php";
$con=mysqli_connect("127.0.0.1","root","","final");


//checking if user is logged in 

if(!isset($_SESSION['ID'])){
	?>

	<div class="container">
		<div class="result" style="font-size:40px;color:red;margin-bottom:200px;">
			You must be logged in to take the quiz
		</div>
	</div>

	<?php
	require "footer.php";
	exit();
}

?>

<?php 
/************Declaring Imp Function *********************/


/******** getting correct answers question *******************/
function getCorrectAnswers($id,$con){
	$answer = "SELECT answerID,marks
	FROM carec
	WHERE questionID= ".$id;

	$answerres = mysqli_query($con,$answer);
	return $answerres;

}

function getCorrectQuizAnswers($id,$con){
	$answer = "SELECT answer
	FROM answer
	WHERE answerID= ".$id;

	$answerres = mysqli_query($con,$answer);
	return $answerres;

}
function getName($userID, $con){
	$sql = "SELECT first_name,last_name
	FROM user 
	WHERE userID ='".$userID."'";

	$result = mysqli_query($con,$sql);
	$row    = mysqli_fetch_assoc($result);


	if(!empty($row))
		return $row['first_name']." ". $row['last_name'];
	else 
		return false;
}




?>

<?php


$score = 0;
$total  = 0;
$anslist = [];
foreach($_POST as $key=>$val){
	if($key != "email" && $key != "surveyID" && $key != "surveyName" ){
		list($flag,$qid)=explode("-",$key);

	//getting correct answer details for this question
		$ansarray = getCorrectAnswers($qid,$con);
		$carray   = mysqli_fetch_assoc($ansarray);

		$caID     = $carray['answerID'];
		$camarks     = $carray['marks'];




		///echo $caID."-".$key."-".$val."<br>";

    //incrementing total
		$total+=$camarks;

    //incrementing if answer matches 
		if ($val == $caID){
			$score+=$camarks;
		}
	}

}

//marks percentage 
$percent =  $score/$total; 
$percent =  $percent*100;
$percent = (int)$percent;
//$percent = "'". $percent . "'";

$email = $_POST['email'];
//$email = "'". $email. "'";

//$uname = getName($_SESSION['ID'],$con);  //uname = full user name


$surveyID = $_POST['surveyID'];


//saving quiz result in db

$db->insert(
	'surveystat',
	array(
		
		'marks'      => $percent,
		'surveyID'   => $surveyID,
		'userID'     => $_SESSION['ID'],
		'username'   => getName($_SESSION['ID'],$con),
		'quiz_name'  => $_POST['surveyName'],

		)
	);



//throwing HTML
	?>
	<div class="container">
		<div class="result" style="font-size:40px;">
			You have scored <?php echo $score; ?> out of <?php echo $total;?>
		</div>
	</div>


	<?
	require "footer.php"
	?>