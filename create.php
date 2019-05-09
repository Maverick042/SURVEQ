<?php
require "header.php";
?>

<div class="bs-docs-section">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            <div class="page-header">
                <h1 id="forms">Create</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            <div class="well bs-component">

                <form class="form-horizontal" data-toggle="validator" role="form" action="savesurveyinfo.php?stype=<?php echo $_GET["stype"]?>"  method="post">
                    <fieldset>
                        <legend>Information</legend>
                        <div class="form-group">
                            <label for="surveyType" class="col-lg-2 control-label">Type</label>
                            <div class="col-lg-10">
                                <select class="form-control" id="surveyType"  name="surveyType" required>
                                    <option <?php if($_GET["stype"]=="Survey"){echo "selected";}?>>Survey</option>
                                    <option <?php if($_GET["stype"]=="Quiz"){echo "selected";}?>>Quiz</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surveyName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="surveyName" placeholder="" name="surveyName" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php if ($_GET['stype'] == "Quiz"){?>
                            <label for="endDate" class="col-lg-2 control-label">Duration</label>
                            <?php } ?>
                            <?php if ($_GET['stype'] != "Quiz"){?>
                            <label for="endDate" class="col-lg-2 control-label">Duration</label>
                            <?php } ?>
                            <div class="col-lg-10">
                                <input type="number" min = "1" class="form-control" id="endDate" placeholder="in days or minutes" name="endDate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="index.php" class="btn btn-info " role="button" >Cancel</a>
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>