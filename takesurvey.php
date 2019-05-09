<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>


<div class="container">

    <?php
    $surveyid = $_GET["id"];

    $con=mysqli_connect("127.0.0.1","root","","final");

    $survey="SELECT surveyName,surveyType,createdBy,endDate,dateCreated
    FROM survey
    WHERE surveyID= '".$surveyid."'";



    $surveyres = mysqli_query($con,$survey);
    $surveyrow = mysqli_fetch_assoc($surveyres);



    if ($surveyres)
    {
        $site=$_SERVER["PHP_SELF"];
        echo "<form class='form-horizontal' data-toggle='validator' role='form' action='takesurveyinput.php' method='post'>";
        echo "<fieldset>";
        $username="SELECT first_name,last_name
        FROM user
        WHERE userID= '".$surveyrow["createdBy"]."'";

        $useres = mysqli_query($con,$username);
        $userow = mysqli_fetch_assoc($useres);


        if(mysqli_affected_rows($con)==1)
        {
            $newDate = date('d-m-Y', strtotime($surveyrow["dateCreated"]. " + {$surveyrow["endDate"]} days"));

            echo "<div class='s-docs-section'>
            <div class='row'>
                <div class='col-lg-6 col-lg-offset-3 text-center'>
                    <div class='page-header'>
                        <h1 id='forms'>" .$surveyrow["surveyName"]."</h1>
                        <h5 id='forms'>Type - " .$surveyrow["surveyType"]. "</h5>
                        <h5 id='forms'>Deadline - " .$newDate. "</h5>
                        <h5 id='forms'>Created By - " .$userow["first_name"]. " ".$userow["last_name"]."</h5>
                    </div>
                </div>
            </div>
        </div>";
    }
}

$question = "SELECT questionID,question
FROM question
WHERE  surveyID = '".$surveyid."'";

$questionres = mysqli_query($con,$question);
$q=1;
echo "
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <div class='well bs-component'>
            ";
            while($questionrow = mysqli_fetch_assoc($questionres))
            {
                echo "<div class='form-group'>";
                echo "<label class='col-md-12 col-xs-12' style='background-color: #18bc9c; color: #ffffff; text-align: left'>$q - ".$questionrow["question"]."</label>

                <div class='col-md-12'>";


                    $answer = "SELECT answerID,answer
                    FROM answer
                    WHERE questionID= ".$questionrow["questionID"]."
                    ";

                    $answerres = mysqli_query($con,$answer);



                    while($answerrow = mysqli_fetch_assoc($answerres))
                    {

                        echo "
                        <div class='radio'>
                            <label>
                                <input type='radio' name='answerof".$questionrow["questionID"]."'  value='".$answerrow["answerID"]."'>".$answerrow["answer"]."<br>
                            </label>
                        </div>
                        ";

                    }
                    echo "
                </div>
            </div>
            ";
            echo "<input type='text' name='answer".$q."' value='".$questionrow["questionID"]."' hidden><br>";
            $q++;
        }
        $q--;
        echo"<input type='text' name='surveyno' value='".$surveyid."' hidden>";
        echo"<input type='text' name='questiono' value='".$q."' hidden>";

        echo"<br><div style='text-align: center'><input type='submit' name='submitted' class='btn btn-primary' value='Submit'></div>";
        echo "</fieldset>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        ?>

    </div>

    <?php require "footer.php"; ?>