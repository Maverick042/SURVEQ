<?php
if(!isset($_SESSION['ID'])){

	?>
	<div class="container" style="font-size:40px;color:red;margin-bottom:200px;"> 
		You must be logged-in to view this page 
	</div>
	<?php 

	require "footer.php";
	exit();

}


?>