<?php
/**
 * Created by PhpStorm.
 * User: Fahim
 * Date: 4/6/2015
 * Time: 11:12 PM
 */
require "dbconnect.php" ;

//inserting question
$db->insert(
    'question',
    array(
        'surveyID'   =>  $_GET["id"],
        'question'   =>  $_POST["question"]
    ));

//getting latest inserted question id
$newQuestionID = $db->insert_id();

//inserting answers
foreach($_POST["options"] as $key => $text_field){

    $db->insert(
        'answer',
        array(
            'questionID'   =>  $newQuestionID,
            'answer'   =>  $text_field
        ));
}

header("Location:question.php?id=" . $_GET["id"]);
?>