<?php
require "dbconnect.php" ;
date_default_timezone_set("Asia/Dhaka");
?>

<?php
$questions = $_POST['questiono'];
$surveyno = $_POST['surveyno'];
$join = date("Y/m/d");
$con=mysqli_connect("127.0.0.1","root","","final");
for($i=1;$i<=$questions;$i++)
{
    $questionid = $_POST['answer'.$i.''];
    $questionid = substr($questionid,0,7);


    $answer = $_POST['answerof'.$questionid];


    $sql = "INSERT INTO answerselected(userID,questionID,answerID)
    VALUES('".$_SESSION['ID']."','".$questionid."','".$answer."')";

    if (mysqli_query($con,$sql))
    {
        if(mysqli_affected_rows($con)==1)
        {

        }

    }



}
$sql = "INSERT INTO surveytaken(surveyID,userID,whenTaken)
VALUES('".$surveyno."','".$_SESSION['ID']."','".$join."')";

if (mysqli_query($con,$sql))
{

    if(mysqli_affected_rows($con)==1)
    {
        header('Location: index.php');
    }

}


?>