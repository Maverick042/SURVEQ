<?php
/**
 * Created by PhpStorm.
 * User: Fahim
 * Date: 4/23/2015
 * Time: 11:12 PM
 */
require "dbconnect.php" ;
require 'plugins/zebrasession/Zebra_Session.php';
$link = $db->get_link();
$session = new Zebra_Session($link, 'sEcUr1tY_c0dE');

$db->query(
    'SELECT userID
    FROM user
    WHERE ID = ?',
    array($_SESSION["ID"]));

//$rows = array();
$rowsEdited = array();

$row = $db->fetch_assoc();
    //$rows[] = $row;
    $rowsEdited[] = array_values($row);

  /*  $db->query(
        'UPDATE answer.answer AS choice, COUNT(answerselected.userID) AS people
    FROM answer
    INNER JOIN answerselected
    ON ? = answer.questionID AND ? = answerselected.questionID AND answer.answerID = answerselected.answerID
    GROUP BY answer.answerID',
        array($qID,$qID));*/

$db->update(
    'enroll',
    array(
        'confirmed'   =>  "Yes",
    ),
    'teacherID = ? AND studentID = ?',
    array($row["userID"], $_GET["id"])
);

$newQuestionID = $db->insert_id();


header("Location:enrollteach.php");
?>