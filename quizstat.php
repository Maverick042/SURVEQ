<?php 
require "header.php";
?>
<?php 



$con=mysqli_connect("127.0.0.1","root","","final");


//getting  survey name
$sql = 'SELECT surveyName
from  survey
where surveyID = "'.$_GET['id'].'"'; 

$nameres = mysqli_query($con,$sql);
$name    = mysqli_fetch_assoc($nameres);

$name = $name['surveyName'];


//grouping marks
$sql = 'SELECT marks,COUNT(*) as markcount FROM surveystat
WHERE surveyID= "'.$_GET['id'].'"
GROUP BY marks';



$result = mysqli_query($con,$sql); 
$num = mysqli_num_rows($result); 

if($num<1){
	?>
	<div class="container" style="color:red;font-size:40px;margin-bottom:30%;margin-top:50px;">
		No one has taken the quiz yet
	</div>
	<?php	
	include "footer.php";
	exit();


}

$total = 0;
$value=null;
while($row = mysqli_fetch_assoc($result)){
	$value [$row['marks']]  = $row['markcount'];
	$total += $row['markcount'];

}

//converting marks to percentage 
foreach($value as $key=>$val){
	$value[$key] = (int)(($val/$total)*100);
}



?>
<div class="container" style="margin-bottom:15%;">
	<div class="text-center" style="margin-bottom:30px;"> 
		<h1><strong><?php echo $name;?></strong> Stat</h1>
	</div>
	<table class="table table-hover overallStat">
		<thead>
			<tr>
				<th class ="text-center">Obtained Marks</th>
				<th class = "text-center">Scored By Students (%)</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($value as $key=>$val){ ?>
			<tr>
				<td align="center"><?php echo $key; ?> </td>
				<td align="center"><?php echo $val; ?> </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<hr>
	<br>
	<br>
	<br>

	<?Php 
	$db->select(
		'*',
		'surveystat',
		'surveyID = ?',
		array($_GET['id'])
		);

	$record = $db->returned_rows;
	

	//var_dump($user_data);


	?> 

	<table class="table table-hover overallStat">
		<thead>
			<tr>
				<th class ="text-center">Student</th>
				<th class ="text-center">Quiz</th>
				<th class = "text-center">Marks(%)</th>
				<th class = "text-center">Taken On</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row = $db->fetch_assoc()){ ?>
			<tr>
				<td align="center"><?php echo $row['username']; ?> </td>
				<td align="center"><?php echo $row['quiz_name']; ?> </td>
				<td align="center"><?php echo $row['marks']; ?> </td>
				<td align="center"><?php echo $row['when_taken']; ?> </td>
				
			</tr>
			<?php } ?>
		</tbody>
	</table>








</div>

<?php require "footer.php"?>