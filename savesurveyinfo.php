<?php
require "dbconnect.php" ;
$db->select(
    'userID',
    'user',
    'userID = ?',
    array($_SESSION['ID'])
    );
$rows = array();
while ($row = $db->fetch_assoc()) {
    $rows[] = $row;
}
$db->insert(
    'survey',
    array(
        'surveyName'   =>  $_POST["surveyName"],
        'surveyType'   =>  $_POST["surveyType"],
        'createdBy'   =>  $rows[0]["userID"],
        'dateCreated'   =>  date("Y-m-d"),
        'endDate'   =>  $_POST["endDate"]
        ));
$newSurveyID = $db->insert_id();
if($_GET["stype"]=="Quiz")
    {$a = "quizquestion.php?id=" . $newSurveyID;}
else
    {$a = "question.php?id=" . $newSurveyID;}

header("Location:" . $a);
?>