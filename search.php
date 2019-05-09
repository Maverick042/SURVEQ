<?php require "header.php"; 
require "checkloginstatus.php"?>
<?php
$db->select(
    '*',
    'survey',
    'createdBy = ?',
    array($_SESSION['ID'])
    );

$record = $db->returned_rows;
if($record < 1){
    ?>
    <div class="container" style="font-size:25px;margin-bottom:100px;"> 
        No quiz or survey has been created by you yet.Click links below to create:
        <hr>
        <a href="create.php?stype=Survey" class="btn btn-buynow btn-inline">New Survey</a>
        <a href="create.php?stype=Quiz" class="btn btn-buynow">New Quiz</a>
    </div>

    <?php

   // require "footer.php";
   // exit();
} ?>

<div class="container" style="margin-top: 10px">
    <table id="tableList" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Survey Name</th>
                <th>Type Of Survey</th>
                <th>Created By</th>
                <th>Date Created</th>
                <th>End Date</th>
                <th>Survey For</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>ID</th>
                <th>Survey Name</th>
                <th>Type Of Survey</th>
                <th>Created By</th>
                <th>Date Created</th>
                <th>End Date</th>
                <th>Survey For</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tableList').DataTable({
            "ajax": {
                "url": "getsurveylist.php",
                "dataSrc": ""
            },
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": "<button id='take'>EDIT</button> " +
                "<button id='view'>View</button>"
                +
                "<button id='share'>Share Link</button>"
                +
                "<button id='take'>Take</button>"

            } ]
        });
        $('#tableList tbody').on( 'click', 'button#take', function () {
            var data = table.row($(this).parents('tr')).data();
            window.location = "editsurvey.php?id=" + data[0];
        } );
        $('#tableList tbody').on( 'click', 'button#view', function () {
            var data = table.row($(this).parents('tr')).data();

            if(data[2]=="Survey"){
                window.location = "viewsurvey.php?id=" + data[0];
            }
            else{
                window.location = "quizstat.php?id=" + data[0];
            }


        } );
        $('#tableList tbody').on( 'click', 'button#share', function () {
            var data = table.row($(this).parents('tr')).data();
            window.location = "sharelink.php?id=" + data[0];
        } );

        $('#tableList tbody').on( 'click', 'button#take', function () {
            var data = table.row($(this).parents('tr')).data();

            if(data[2]=="Survey"){
                window.location = "takesurvey.php?id=" + data[0];
            }
            else{
                window.location = "takequiz.php?id=" + data[0];
            }


        } );











        $('#tableList tfoot th').each( function () {
            var title = $('#tableList thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%" />' );
        } );
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                .column( colIdx )
                .search( this.value.replace(/;/g, "|"), true, false )
                .draw();
            } );
        } );
        $('#button').click( function () {
            alert( table.rows('.active').data().length +' row(s) selected' );
        } );
    } );
</script>
<?php require "footer.php"; ?>
