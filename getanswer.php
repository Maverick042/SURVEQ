<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/21/2015
 * Time: 10:20 PM
 */
require 'dbConnect.php';

/*$db->select(
    'surveyName, type, createdBy, dateCreated, endDate, surveyFor',
    'survey'
);*/
$qID = $_GET["qid"];

$db->query(
    'SELECT answer.answer AS choice, COUNT(answerselected.userID) AS people
    FROM answer
    INNER JOIN answerselected
    ON ? = answer.questionID AND ? = answerselected.questionID AND answer.answerID = answerselected.answerID
    GROUP BY answer.answerID',
    array($qID,$qID));

$rows = array();
$rowsEdited = array();

while ($row = $db->fetch_assoc()) {
    $row["people"] = (int)$row["people"];

    $rowsEdited[] = array_values($row);
    $rows[] = $row;
}

echo json_encode($rows);