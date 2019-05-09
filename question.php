<?php require "header.php"; ?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #34495e; text-align: center; color:white; padding: 10px; margin-top: 10px;text-transform: uppercase" >

               <?php
               $db->select(
                'surveyName, surveyType, dateCreated',
                'survey',
                'surveyID = ?',
                array($_GET['id'])
                );

               $rows = array();

               while ($row = $db->fetch_assoc()) {
                $rows[] = $row;
            }
            echo "<h2 style='color: white'>Survey Name - ".$rows[0]['surveyName']. "</h2>";
            echo "<p style='color: white'>Type - ".$rows[0]['surveyType']. "</p>";
            echo "<p style='color: white'>Date - ".$rows[0]['dateCreated']. "</p>";

            echo "<a href='index.php' class='btn btn-success btn-lg'>Create</a>";
            ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div style="background-color: #ecf0f1;  margin-top: 10px; padding: 10px ">
            <form method="post" action="savequestion.php?id=<?php echo $_GET['id'] ?>">
                <label>Question</label>
                <br>
                <input type="text" name="question">
                <hr>
                <label>Answers</label>
                <div class="input_fields_wrap">
                    <button class="add_field_button btn btn-warning" style="margin-bottom: 10px">Add More Answer Field</button>
                    <br>
                    <div style="margin-top: 5px"><input type="text" name="options[]"></div>
                </div>



                <button type="submit" class="btn btn-primary" style="text-align: center">Save</button>
            </form>
        </div>
    </div>


    <div class="col-md-6">
        <div style="background-color: #95a5a6; margin-top: 10px; padding: 10px">

            <?php
            $db->select(
                'question, questionID',
                'question',
                'surveyID = ?',
                array($_GET['id'])
                );

            $rows = array();
            $q=0;
            while ($row = $db->fetch_assoc()) {
                $rows[] = $row;
                echo "<h4>Question: ". $rows[$q]['question'] . "</h4>";
            //print_r($rows);
                $a=0;
                $db2->select(
                    'answer',
                    'answer',
                    'questionID = ?',
                    array($rows[$q]['questionID'])
                    );

                $rows2 = array();
                $b = 1;
                while ($row2 = $db2->fetch_assoc()) {
                    $rows2[] = $row2;
                    echo "<h5>".$b.") - ".$rows2[$a]['answer']. "</h5>";
$a++;
$b++;
}
        //print_r($rows2);
echo "<hr>";
$q++;
}

?>

</div>
</div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div style="margin-top: 5px"><input type="text" name="options[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>

<?php require "footer.php"; ?>