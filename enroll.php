<?php
require "header.php"; ?>
    <div class="container" style="margin-top: 10px">
        <div>
        <table id="tableList" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Teacher Name</th>
                <th>ID</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>ID</th>
                <th>Teacher Name</th>
                <th>ID</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
        </div>
        <div style="margin-top: 10px">
            <?php
            if(isset($_SESSION['ID']))
            {
           /* SELECT u.userID,u.ID,e.teacherID,e.studentID, t.firstName, t.lastName
            FROM user u, enroll e, user t
            WHERE u.ID = 1130829042 AND u.userID = e.studentID AND e.confirmed = "Yes" AND e.teacherID = t.userID*/


            $sql = "SELECT u.userID,u.ID,e.teacherID,e.studentID, t.firstName, t.lastName
            FROM user u, enroll e, user t
            WHERE u.ID = '". $_SESSION['ID']. "' AND u.userID = e.studentID AND e.confirmed = 'Yes' AND e.teacherID = t.userID";
            ?>
            <div class="col-md-6 col-md-offset-3">
                <?php
                $result = mysqli_query($con,$sql);
                echo "<p style='text-align: center;background-color: #18bc9c; color: #ffffff'>";
                echo "Enrolled Under <br>";
                echo "</p>";
                if ($result)
                {
                    if(mysqli_affected_rows($con)>=1)
                    {
                        echo "

        <table class='table table-bordered' >
        <thead>
        <tr>
            <th>Serial</th>
            <th>Survey Name</th>
        </tr>
        </thead>
        ";
                        $x = 1;
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>
            <td>" . $x . "</td>
            <td>" . $row["firstName"] . $row["lastName"]."</td>

        </tr>";
                            $x++;
                        }

                        echo "
        </table>";

                    }
                    else
                    {
                        echo "<p style='text-align: center;color: #dd0000'>";
                        echo "List Empty!! <br>";
                        echo "</p>";
                    }



                }
                }
                ?>
        </div>
    </div>

    <script>

        $(document).ready(function() {

            // DataTable
            var table = $('#tableList').DataTable({
                "ajax": {
                    "url": "getteacherlist.php",
                    "dataSrc": ""
                },
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button  id='enroll'>Enroll</button> "

                } ]

            });

            $('#tableList tbody').on( 'click', 'button#enroll', function () {
                var data = table.row($(this).parents('tr')).data();
                //alert( data[1] + "'s ID is: " + data[0] );
                window.location = "enrollstudent.php?id=" + data[0];
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