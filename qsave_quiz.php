<?php
/**
 * Created by PhpStorm.
 * User: TAWSIF R CHOUDHURY
 * Date: 2/13/2016
 * Time: 2:39 PM
 */
require "dbconnect.php";
$con=mysqli_connect("127.0.0.1","root","","final");

var_dump($_POST);
$qid;
foreach($_POST as $key=> $val){
    if($key=="mark" or $key=="cans" ){
        break;
    }
    list($type,$id) = explode("-",$key);
        if($type=='q') { //element is a question

            //preparing sql
            $sql = 'UPDATE question
            SET question="'.$val.'"
            WHERE questionID='.$id;

            //setting qid for later use 
            $qid = $id; 

            //executing query
            mysqli_query($con,$sql);



        }
        if($type=='ans'){ //array element is answer

            //preparing sql
            $sql = 'UPDATE answer
            SET answer="'.$val.'"
            WHERE answerID='.$id;

            //executing query
            mysqli_query($con,$sql);



        }

    }

    $cans = $_POST['cans'];
    $mark = $_POST['mark'];



    //saving correct answer
    $sql = 'UPDATE carec
    SET answerID="'.$cans.'",
    marks="'.$mark.'"
    WHERE questionID='.$qid;

    //executing query
    mysqli_query($con,$sql);

    

    
    
//var_dump($_SESSION['current_survey']);
    header('Location: editsurvey.php?id='.$_SESSION['current_survey']);
    ?>
