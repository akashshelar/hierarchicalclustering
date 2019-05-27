<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
	die("connection failed" . mysqli_error($con));
}
else
{
	$city=mysqli_real_escape_string($con,$_POST['city']);
	$district=mysqli_real_escape_string($con,$_POST['district']);
	$difficulty=mysqli_real_escape_string($con,$_POST['difficulty']);
	$endurance=mysqli_real_escape_string($con,$_POST['endurance']);
	$month=mysqli_real_escape_string($con,$_POST['month']);
	$trek_type=mysqli_real_escape_string($con,$_POST['trek_type']);
	$gender=mysqli_real_escape_string($con,$_POST['gender']);
	$email = $_SESSION['sess_user'];
	$sql = "INSERT INTO preference(city,district,difficulty,endurance,month,trek_type,gender,email)VALUES ('$city','$district','$difficulty','$endurance','$month','$trek_type','$gender','".$email."')";
	
		if(!mysqli_query($con,$sql))
		{	
			die('error:'.mysqli_error($con));
		}
		else
		{
			$sql_max = "select max(preference_id) as maxid from preference where city='".$city."' and district='".$district."' and difficulty='".$difficulty."' and endurance='".$endurance."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$gender."'";
			
			$result1 = $con->query($sql_max);
			$row1 = $result1->fetch_array(MYSQLI_ASSOC);
			$maxid = $row1['maxid'];
			
			
			/*----- check in preference table for same data ------*/
			$sql_check = "select preference_id as pid from preference where district='".$district."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$gender."' AND preference_id NOT IN ( '".$maxid."' )" ; 
			
			$result = $con->query($sql_check);
			$pre_id_arr = array();
			while($rown = $result->fetch_array()){					
					$pre_id_arr[] = $rown['pid'];
			}
			$pre_ids = implode(',',$pre_id_arr);
			$counts = $result->num_rows;
			
			if($counts>0){
				
				/*---- count group_preference table for same preference_id ----*/
				 $sql_gp = "select groups_id from groups_preference where preference_id in ('".$pre_ids."')";
				
				$result2 = $con->query($sql_gp);
				$row2 = $result2->fetch_array(MYSQLI_ASSOC);
				
				$countgp = $result2->num_rows;
				if($countgp==0)
				{
					$sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
					if ($con->query($sql_newg) === TRUE) {
						$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";

						$resmaxgid = $con->query($getmaxgid);
						$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
						$maxgid = $rowmgid['maxgid'];

						$insgp = "insert into groups_preference(group_id,preference_id) values ('".$maxgid."','".$maxid."')";
						$resgp = $con->query($insgp);
						/*---------------------------------------------------------------------------------------------------------------------------*/
						$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."'  ";
						$rescntstr = $con->query($strcnt);
						$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
						$cnt = $rowcnt['cnt'];
						
						if($cnt > 3 ){
							$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
							$resupdp = $con->query($updp);
						}
						/*---------------------------------------------------------------------------------------------------------------------------*/
						
					}
				}
				else{
					$gpid = $row2['groups_id'];
					
					$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$gpid."','".$maxid."')";
					$resgp = $con->query($insgp);
					
					/*---------------------------------------------------------------------------------------------------------------------------*/
						$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$gpid."'  ";
						$rescntstr = $con->query($strcnt);
						$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
						$cnt = $rowcnt['cnt'];
						
						if($cnt > 3 ){
							$updp = "update groups set is_active=1 where group_id = '".$gpid."'";
							$resupdp = $con->query($updp);
						}
						/*---------------------------------------------------------------------------------------------------------------------------*/
					
				}
			}
			else{
				 $sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
				if ($con->query($sql_newg) === TRUE) {
					$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";

					$resmaxgid = $con->query($getmaxgid);
					$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
					$maxgid = $rowmgid['maxgid'];

					$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$maxgid."','".$maxid."')"; 
					$resgp = $con->query($insgp);
					/*---------------------------------------------------------------------------------------------------------------------------*/
					$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."' ";
					$rescntstr = $con->query($strcnt);
					$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
					$cnt = $rowcnt['cnt'];
					
					if($cnt > 3 ){
						$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
						$resupdp = $con->query($updp);
					}
					/*---------------------------------------------------------------------------------------------------------------------------*/
				}
			}
			$json['code'] = 200;
			$json['data'] = "Preference created successfully";
	
			header('location:SelectTrek.php');
		}
}
mysqli_close($con);
?>