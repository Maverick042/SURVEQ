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

            // get survey creator details
            $username="SELECT firstName,lastName
        FROM user
        WHERE userID= '".$surveyrow["createdBy"]."'";

            $useres = mysqli_query($con,$username);
            $userow = mysqli_fetch_assoc($useres);

            // if survey creator exists
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
                        <h5 id='forms'>Created By - " .$userow["firstName"]. " ".$userow["lastName"]."</h5>
                    </div>
                    </div>
                </div>
                </div>";
            }
        }


        //fetching the survey questions
        $question = "SELECT questionID,question
        FROM question
        WHERE  surveyID = '".$surveyid."'";

        $questionres = mysqli_query($con,$question);
        //var_dump($questionres->fetch_assoc());
        $q=1;
        ?>
        <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='well bs-component'>
        <?php
        while($questionrow = mysqli_fetch_assoc($questionres))
        { ?>

            <div class='form-group'>
            <label class='col-md-12 col-xs-12 questionBlock' style='background-color: #18bc9c; color: #ffffff; text-align: left'><?php echo $q."-". $questionrow['question'];?></label>

            <div class='col-md-12 answerBlock'>

       <?php
        //getting the answers associated with the survey
            $answer = "SELECT answerID,answer
        FROM answer
        WHERE questionID= ".$questionrow["questionID"]."
        ";

            $answerres = mysqli_query($con,$answer);



            while($answerrow = mysqli_fetch_assoc($answerres))
            {
            ?>


                <div class='answers'>
                <span class="glyphicon glyphicon-record"></span>
                <?php echo $answerrow["answer"];?>

                </div>

            <?php } ?>


                 </div> <!--End of div answerBlock -->
                 </div> <!--End of formgroup div-->

              <?php
                  $q++;

        $q--;




        $qid  = $questionrow["questionID"];

        ?>


        <a href='#' class='btn btn-info editBtn' role="button">
        <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a href='#' class='btn btn-info delBtn' role="button"><span class="glyphicon glyphicon-remove"></span></a>"
        </form>

     <?php   }//end of outer while ?>




        ?>


            </div> <!-- End of div class= wellbs-component -->
          </div> <!-- End of div class= col-md-6 -->
        </div><!-- End of div class= row-->


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group">
                                <label for="email">Question</label>
                                <input type="email" class="form-control" id="email" value="hello?">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="pwd" value="howdy">
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" id="pwd" value="hi">
                            </div>

                            <button type="submit" class="btn btn-default">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>







    <script>
        $(".editBtn").click(function(){
            alert($(".editBtn").closest("form").closest(".questionBlock").html());
            //alert(question);
            //$('#myModal').modal('show');
        });
    </script>
<?php require "footer.php"; ?>