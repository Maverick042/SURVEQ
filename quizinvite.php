<?php
require "header.php";
require "checkloginstatus.php";
require "Errorclass.php";
?>



<?php 
$con=mysqli_connect("127.0.0.1","root","","final");
$survey_id = $_GET['id'];

if(isset($_POST['list'])){
	$mail_list = $_POST['list'];
	$mail_list = explode(",",$mail_list);
	


	//creating sql list 
	$attach_string	=" email= '".$mail_list[0]."'";
	array_shift($mail_list);

	
	foreach ($mail_list as $val){

		$attach_string .= " OR email='".trim($val)."'";
	}
	//var_dump($attach_string);

	$sql = "SELECT *
	FROM user
	WHERE ".$attach_string; 

	$records = mysqli_query($con,$sql);


	if($records->num_rows < 1){
		$e = new ErrorMsg();
		$exit = true; $include_footer = true;
		$e->generateErrorDiv('No such registered users found',$exit,$include_footer);

	}


	while($row = mysqli_fetch_assoc($records)){



		$db->insert(
			'quizinvite',
			array(
				'senderID'      => $_SESSION['ID'],
				'userID'        => $row['userID'],
				'surveyID'      => $survey_id,
				)
			);
	}



	$e = new ErrorMsg();
	if ($db->affected_rows < 1)
		$screen_msg = "No such users are registered with the given emails";
	else
		$screen_msg = "Invitations sent successfully";


	?>

	<div class="container" style="font-size:40px;color:red;margin-bottom:200px;"> 
		<?php echo $screen_msg; ?> 
	</div>


	<?php 

	require "footer.php";
	exit();


}//end of outer if 

?>


<div class="container"> 
	<form role="form" method="post" action="quizinvite.php?id=<?php echo $survey_id;?>">
		<div class="form-group">
			<label for="comment" >Type a comma seperated list of emails for invite.
				Example (abc@survey.com,xyz@survey.com..)

			</label>
			<textarea class="form-control" rows="5" id="comment" name="list"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>