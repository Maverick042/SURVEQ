<?php 
/**
* Created by PhpStorm.
* User: TAWSIF R CHOUDHURY
* Date: 2/13/2016
* Time: 4:52 PM
*/

require "dbconnect.php";
$surveyID = $_GET['id'];



//var_dump($_POST);
$count = 1;
$target = $_POST['ca'];
$question = $_POST['question'];
$marks  = $_POST['marks'];
$options = $_POST['options'];
$rightans;

//saving quiz question 
$db->insert(
	'question',
	array(
		'surveyID'   =>  $surveyID,
		'question'   =>  $question,


		));

$newqid = $db->insert_id();



foreach ($options as $key => $val){
	if($count==$target){
		$rightans = $val;
		
		//save right answer
		$db->insert(
			'answer',
			array(
				'questionID'   =>  $newqid,
				'answer'       =>  $val


				));

		//get last saved answer id
		$newansid = $db->insert_id();
		//var_dump($newansid);

		//enter the id in the other table along with marks 
		$db->insert(
			'carec',
			array(
				'answerID'         =>  $newansid,
				'questionID'       =>  $newqid,
				'marks'            =>  $marks


				));


	}
	else {
		$db->insert(
			'answer',
			array(

				'questionID'   =>  $newqid,
				'answer'       =>  $val
				));
	}
	$count++;
} //end of foreach loop

//var_dump($rightans);
//redirecting 
header("Location: quizquestion.php?id=".$surveyID);

?>
