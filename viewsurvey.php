<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/2015
 * Time: 10:49 PM
 */

require "header.php"; ?>

<style>

.slice1 .amcharts-pie-slice {
  fill: #2ecc71 !important;
}
</style>




<div class="container">
    <?php
    $surveyid = $_GET["id"];


    $con=mysqli_connect("127.0.0.1","root","","final");

    $db->select(
        '*',
        'survey',
        'surveyID = ?',
        array($surveyid)
        );
    $surveyres=$surveyrow = $db->fetch_assoc(); 

//    if($surveyrow['surveyType'] == "Quiz"){
//        header("Location: quizstat.php?id=".$surveyid);
//    }
    
    /*$survey="SELECT *
    FROM survey
    WHERE surveyID= '".$surveyid."'
    ";*/



    //$surveyres = mysqli_query($con,$survey);   var_dump($surveyres);
    //$surveyrow = mysqli_fetch_assoc($surveyres);

    /***** TEST *********/
   //var_dump($surveyid);

    //redirecting to takequiz page if appropriate
//    if($surveyrow['createdBy']!= $_SESSION['ID']){
//        header("Location:takesurvey.php?id=".$surveyid);
//    }

    

    if ($surveyres)
    {
        $site=$_SERVER["PHP_SELF"];

        
        /*$username="SELECT firstName,lastName
        FROM user
        WHERE userID= '".$surveyrow["createdBy"]."'";

        $useres = mysqli_query($con,$username);
        $userow = mysqli_fetch_assoc($useres);*/


        $db->select(
            '*',
            'user',
            'userID = ?',
            array($surveyrow['createdBy'])
            );
        $userres=$userow = $db->fetch_assoc(); 
        
        if(true)
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

/**** TEST ****/
   // var_dump($questionres);

$q=1;


    //****************** CHART ***********************************//
echo "
<div class='row'>
    <div class='col-lg-6 col-lg-offset-3'>
        <div class='well bs-component'>
            ";
            while($questionrow = mysqli_fetch_assoc($questionres)) {
                echo "<label class='col-lg-12 col-xs-12 control-label' style='background-color: #18bc9c; color: #ffffff; text-align: left'>" . $questionrow["question"] . "</label>
                ";
                ?>
                <script type="text/javascript">

                    AmCharts.loadJSON = function(url) {
                                // create the request
                                if (window.XMLHttpRequest) {
                                    // IE7+, Firefox, Chrome, Opera, Safari
                                    var request = new XMLHttpRequest();
                                } else {
                                    // code for IE6, IE5
                                    var request = new ActiveXObject('Microsoft.XMLHTTP');
                                }

                                // load it
                                // the last "false" parameter ensures that our code will wait before the
                                // data is loaded
                                request.open('GET', url, false);
                                request.send();

                                // parse adn return the output
                                return eval(request.responseText);
                            };

                            var chartData = AmCharts.loadJSON('getanswer.php?qid=<?php echo $questionrow["questionID"];?>');

                            var chart<?php echo $questionrow['questionID']?> = AmCharts.makeChart("chartdiv<?php echo $questionrow['questionID'];?>", {
                                "type": "pie",
                                "theme": "dark",
                                "dataProvider" : chartData,
                                "titleField": "choice",
                                "valueField": "people",
                                "colors":["#2ecc71","#e74c3c","#f1c40f","#34495e","#9b59b6"],


                                "export": {
                                    "enabled": true,
                                    "libs": {
                                        "path": "plugins/charts/amcharts/plugins/export/libs/"
                                    }
                                }
                            });


                        </script>


                        <div id="chartdiv<?php echo $questionrow['questionID']?>" style="width: 100%; height: 400px;"></div>
                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>