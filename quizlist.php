<?php 
require "header.php";
$con=mysqli_connect("127.0.0.1","root","","final");
?>


<?php 
if(!isset( $_SESSION['ID'] )){
	?>
	<div class="container" style="font-size:40px;color:red;margin-bottom:200px;"> 
		You're required to login to access this page.
	</div>

	<?php

	require "footer.php";
	exit();
}




$userID = $_SESSION['ID']; 


//**************FUNCTION DECLARATION***************
function getName($userID, $con){
	$sql = "SELECT first_name,last_name
	FROM user 
	WHERE userID ='".$userID."'";

	$result = mysqli_query($con,$sql);
	$row    = mysqli_fetch_assoc($result);


	if(!empty($row))
		return $row['first_name']." ". $row['last_name'];
	else 
		return false;
}

function getSurveyDetails($surveyID,$con){
	$sql = "SELECT surveyName,dateCreated,endDate
	FROM survey
	WHERE surveyID ='".$surveyID."'";
	

	$result = mysqli_query($con,$sql);
	$row    = mysqli_fetch_assoc($result);

	if(!empty($row))
		return $row; 
	else 
		return false;

}


//check if this user has any been invited for any survey 

$criteria = $userID; 
$db->select(
	'*',
	'quizinvite',
	'userID = ?',
	array($criteria)
	);

$records = $db->fetch_assoc_all();



//********* IF nothing is found is database then script shows appropriate message and terminates***********************
if(empty($records)){
	?>


	<div class="container" style="font-size:40px;color:red;margin-bottom:200px;"> 
		You've no quiz invites at the moment.
	</div>

	<?php

	require "footer.php";
	exit();
}
?>






<?php


//forech each row get 
//who invited, when invited, survey name, survey duration,surveytaking link 

$res  = [];
$seperator = "|";




foreach ($records as $row){
	$resString = "";
	$senderID  = $row['senderID'];
	$resString .= getName($senderID,$con).$seperator;
	$resString .= $row['when'].$seperator; 

	$info = getSurveyDetails($row['surveyID'],$con); //survey_info 

	$resString .= $info['surveyName'].$seperator.$info['dateCreated'].$seperator.$info['endDate'].$seperator;
	$resString .= "takequiz.php?id=".$row['surveyID'];

	$res[] = $resString;
	
}
?>

<div class="container">

	<?php //who invited, when invited, survey name, survey end date, survey duration,surveytaking link ?>
	<?php foreach ($res as $key=>$val){ ?>
	
	<?php	list($who_invited,$when_invited,
		$survey_name, $survey_end_date,$survey_duration,
		$surveytaking_link)= explode($seperator,$val); ?> 


		<div class= "msg" style="font-size:20px;word-spacing:10px;"> 
			<span>You have been invited by <span style="color:#4d0026;"><strong><?php echo $who_invited; ?></strong></span> </span>
			<span> on <?php echo $when_invited; ?>  </span>
			<span> for the quiz 
				<span style="color: #ff8533;">
					<a href= "<?php echo $surveytaking_link;?>" style="text-decoration:underline;">
						<strong><?php echo $survey_name;?></strong>
					</a>


				</span>
			</span>












		</div>
		<hr>

		<?php } ?> 
	</div>


	<?php 
	require "footer.php";
	?>