<?php 
class ErrorMsg {

	var $no_login  = "You need to login to view this page";
	var $no_record = "No such record exists in database";
	var $general   = "This page is unavailable";


	function generateErrorDiv($screen_msg= "This page is unavailable",
		$exit=false,$footer=false){


		echo '<div class="container" style="font-size:40px;color:red;margin-bottom:200px;">';
		echo $screen_msg; 
		echo '</div>';


		if($footer){
			require "footer.php";

		}

		if($exit){
			exit();

		}

	}


}//end of class




?>