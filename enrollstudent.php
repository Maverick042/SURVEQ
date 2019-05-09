<?php
/**
 * Created by PhpStorm.
 * User: Fahim
 * Date: 4/6/2015
 * Time: 11:12 PM
 */
require "dbconnect.php" ;
require 'plugins/zebrasession/Zebra_Session.php';
$link = $db->get_link();
$session = new Zebra_Session($link, 'sEcUr1tY_c0dE');


$db->select(
    'userID',
    'user',
    'ID = ?',
    array($_SESSION['ID'])
);

$rows = array();

while ($row = $db->fetch_assoc()) {
    $rows[] = $row;
}

$db->insert(
    'enroll',
    array(
        'teacherID'   =>  $_GET["id"],
        'studentID'   =>  $rows[0]['userID'],
        'confirmed'   =>  "No",
    ));


header("Location:enroll.php");
?>