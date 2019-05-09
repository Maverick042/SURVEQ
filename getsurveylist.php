<?php
ob_start();
require 'dbconnect.php';
$db->query(
	'SELECT survey.surveyID, survey.surveyName, survey.surveyType, survey.createdBy, survey.dateCreated,
	DATE_ADD(survey.dateCreated, INTERVAL survey.endDate DAY) AS endDate, user.first_name, user.last_name
	FROM survey
	INNER JOIN user
	ON survey.createdBy = user.userID
	WHERE survey.surveyType= "Survey"
	OR(survey.surveyType="Quiz" AND survey.createdBy="'.$_SESSION['ID'].'")
	');

$rowsEdited = array();
while ($row = $db->fetch_assoc()) {
	$row['createdBy']= $row['first_name']." ". $row['last_name'];
	$rowsEdited[] = array_values($row);
}




echo json_encode($rowsEdited);