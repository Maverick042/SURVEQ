<?php
require "dbconnect.php" ;
require 'plugins/zebrasession/Zebra_Session.php';
$link = $db->get_link();
$session = new Zebra_Session($link, 'sEcUr1tY_c0dE');
date_default_timezone_set("Asia/Dhaka");

/*$db->select(
    'surveyName, type, createdBy, dateCreated, endDate, surveyFor',
    'survey'
);*/
$db->query(
    'SELECT survey.surveyID, survey.surveyName, survey.surveyType, survey.createdBy,survey.dateCreated,
    DATE_ADD(survey.dateCreated, INTERVAL survey.endDate DAY) AS endDate,
    survey.surveyFor, u.firstName, u.lastName
    FROM survey , user u, enroll, user t
    WHERE survey.createdBy = u.userID AND t.ID = ? AND enroll.teacherID = t.userID AND u.userID = enroll.studentID AND enroll.confirmed = "Yes"'
, array($_SESSION["ID"]));

//$rows = array();
$rowsEdited = array();

while ($row = $db->fetch_assoc()) {

    $row['createdBy']= $row['firstName']." ". $row['lastName'];

    //$rows[] = $row;
    $rowsEdited[] = array_values($row);
}

echo json_encode($rowsEdited);