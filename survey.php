<?php
require "header.php"; ?>
<div class="container" style="margin-top: 10px">

<table id="tableList" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Survey Name</th>
        <th>Type Of Survey</th>
        <th>Created By</th>
        <th>User Type</th>
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
        <th>User Type</th>
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

        // DataTable
        var table = $('#tableList').DataTable({
            "ajax": {
                "url": "getsurveylist.php",
                "dataSrc": ""
            },
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": "<button id='take'>Take</button> " +
                "<button id='view'>View</button>"

            } ]

        });

        $('#tableList tbody').on( 'click', 'button#take', function () {
            var data = table.row($(this).parents('tr')).data();
            //alert( data[1] + "'s ID is: " + data[0] );
            window.location = "takesurvey.php?id=" + data[0];
        } );

        $('#tableList tbody').on( 'click', 'button#view', function () {
            var data = table.row($(this).parents('tr')).data();
            //alert( data[1] + "'s ID is: " + data[0] );
            window.location = "viewsurvey.php?id=" + data[0];
        } );

        // Setup - add a text input to each footer cell
        $('#tableList tfoot th').each( function () {
            var title = $('#tableList thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%" />' );
        } );


        // Apply the search
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


<?

require "footer.php"; ?>