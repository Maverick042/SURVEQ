<?php
/**
 * Created by PhpStorm.
 * User: TAWSIF R CHOUDHURY
 * Date: 2/13/2016
 * Time: 2:39 PM
 */
require "dbconnect.php";
$con=mysqli_connect("127.0.0.1","root","","final");


foreach($_POST as $key=> $val){
    list($ajaira,$id) = explode("-",$key);
        if($key[0]=='q') { //element is a question

            //preparing sql
            $sql = 'UPDATE question
            SET question="'.$val.'"
            WHERE questionID='.$id;

            //executing query
            mysqli_query($con,$sql);
        }
        else { //array element is answer
            //preparing sql
            $sql = 'UPDATE answer
            SET answer="'.$val.'"
            WHERE answerID='.$id;

            //executing query
            mysqli_query($con,$sql);

        }
        //var_dump($sql);
        echo mysqli_affected_rows($con);

    }

//var_dump($_SESSION['current_survey']);
    header('Location: editsurvey.php?id='.$_SESSION['current_survey']);
    ?>
