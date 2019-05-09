<?php
/**
 * Created by PhpStorm.
 * User: Fahim
 * Date: 4/6/2015
 * Time: 8:30 PM
 */

require 'dbConnect.php';

/*$db->select(
    'surveyName, type, createdBy, dateCreated, endDate, surveyFor',
    'survey'
);*//*
$db->query(
    'SELECT userID, firstName, ID, Dept, lastName,
    FROM user
    WHERE userType = ?',
    array("Teacher"));*/
$db->select(
    'userID, firstName, ID, Dept, lastName',
    'user',
    'userType = ?',
    array("Teacher"));
//$rows = array();
$rowsEdited = array();

while ($row = $db->fetch_assoc()) {

    $row['firstName']= $row['firstName']." ". $row['lastName'];

    //$rows[] = $row;
    $rowsEdited[] = array_values($row);
}

echo json_encode($rowsEdited);