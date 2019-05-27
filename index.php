<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

//$servername = "107.180.56.179";
$servername = "localhost";
$username = "Lifestandate";
$password = "TreckN@zional7";
$dbname = "TrekSocialDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo json_encode($conn->connect_error);
	exit;
} 
//echo "Connected successfully";

/*$sql = "CREATE TABLE fvilla_user (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
email VARCHAR(50),
is_email INT(3),
creation_date TIMESTAMP,
updated_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table fvilla_user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}*/

$task = isset($_REQUEST['task'])?$_REQUEST['task']:'';

if($task != ''){
	$myvar = $task;
	$myvar();
} else {
	$json['code'] = 500;
	$json['data'] = 'Please define the task';
	echo json_encode($json);
	exit;
}
/*if($task == 'saveUserData') {
	saveUserData();
} else if($task == 'checkLogin') {
	checkLogin();
} else if($task == 'sendOTP') {
	sendOTP();
} */


function RegisterUser()
{
    global $conn;

    if(isset($_REQUEST['username'])) { $username = $_REQUEST['username']; } else { $username = '';} ;
    if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
    if(isset($_REQUEST['password'])) { $password = $_REQUEST['password']; } else { $password = '';} ;
    if(isset($_REQUEST['gender'])) { $gender = $_REQUEST['gender']; } else { $gender = '';} ;
    if(isset($_REQUEST['age'])) { $age = $_REQUEST['age']; } else { $age = '';} ;
    if(isset($_REQUEST['phone'])) { $phone = $_REQUEST['phone']; } else { $phone = '';} ;
    //echo "<pre>";
    //print_r($_REQUEST);
    $checkUser = "SELECT * FROM signlog WHERE email = '".$email."'";
    $chk_res = $conn->query($checkUser);
    //$row = $chk_res->fetch_array(MYSQLI_ASSOC);
    $cnt_row = $chk_res->num_rows;
    if($cnt_row > 0)
    {
        $data['error'] = '1';
	$data['message'] = 'This Email-ID is already regitered.'; 
    }
    else
    {
        $create_user = "INSERT INTO signlog (name,email,password,gender,age,phone) VALUES ('".$username."','".$email."','".$password."','".$gender."','".$age."','".$phone."')";
	$ins_user = $conn->query($create_user);
        if($ins_user){
            $data['error'] = 0;
            $data['message'] = 'User created successfully.';
        }
        else
        {
            $data['error'] = '500';
            $data['message'] = "Error - ". $conn->error;
        }
    }
    echo json_encode($data);
}

function LoginUser()
{
    global $conn;

    if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
    if(isset($_REQUEST['password'])) { $password = $_REQUEST['password']; } else { $password = '';} ;
    $sql_check = "SELECT * FROM signlog WHERE email = '".$email."' AND password = '".$password."' and DELETE_FLAG = '0'";
    //echo $sql_check;
    $exec_user = $conn->query($sql_check);
    $row_count = $exec_user->num_rows;
    $row = $exec_user->fetch_array(MYSQLI_ASSOC);
    if($row_count > 0)
    {
        $data['error'] = '200';
        $data['message'] = 'Logged in successfully.';
        $data['user'] = $row;
    }
    else
    {
        $data['error'] = '500';
        $data['message'] = 'Invalid username or Password.'; 
    }
    echo json_encode($data);
}

function getUserDetail()
{
    global $conn;
	
    if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
    $sql_check = "SELECT * FROM signlog WHERE email = '".$email."'";
    //echo $sql_check;
    $exec_user = $conn->query($sql_check);
    $row_count = $exec_user->num_rows;
    $row = $exec_user->fetch_array(MYSQLI_ASSOC);
    if($row_count > 0)
    {
	$data['error'] = '200';
        $data['message'] = "Welcome, ".ucwords(strtolower($row['name']));
	$data['data'] = $row;
    }
    else
    {
	$data['error'] = '500';
	$data['message'] = "No user found wih this ID.";
    }
    echo json_encode($data);
}
function saveUserData() 
{
	global $conn;
	$is_error = false;
	$msg = '';
	//if($_REQUEST['email'] != NULL) { $email = $_REQUEST['email']; } else { $email = '';} ;
	if(isset($_REQUEST['username'])) { $username = $_REQUEST['username']; } else { $username = '';} ;
	if(isset($_REQUEST['password'])) { $password = $_REQUEST['password']; } else { $password = '';} ;
	//if(isset($_REQUEST['mobile_number'])) { $mobile_number = $_REQUEST['mobile_number']; } else { $mobile_number = '';} ;
	$mobile_number = '';
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
	
	$checkUser = "SELECT * FROM fvilla_user WHERE email = '".$email."'";
	$checkResult = $conn->query($checkUser);
	$checkResult->num_rows;
	
	if($checkResult->num_rows > 0){
		if($password == '' || $password == NULL) {
			$json['code'] = 200;
			$json['data'] = 'New user created successfully';
			echo json_encode($json);
			exit;
		} else {
			$is_error = true;
			$msg = 'already Exist user';
		}
	} else if($username == '') {
		$is_error = true;
		$msg = 'Please fill username';
	} 
	if($is_error){
		$json['code'] = 500;
		$json['data'] = $msg;
		echo json_encode($json);
		exit;
	}
	
	
	 $sql = "INSERT INTO fvilla_user (username, password, mobile_no, email, creation_date, updated_date)
	VALUES ('".$username."', '".$password."', '".$mobile_number."','".$email."',now(),now())";
	
	if ($conn->query($sql) === TRUE) {
		//echo "New record created successfully";
		$checkResult = $conn->query($checkUser);
		while($row = $checkResult->fetch_assoc()) {
			$username = $row["username"];
			$json['username'] = $username;
		}
		
		
		$json['code'] = 200;
		$json['user_id'] = $conn->insert_id;
		$json['data'] = "New user created successfully";
	} else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
		$json['code'] = 500;
		$json['data'] = $conn->error;
	}
	echo json_encode($json);
	exit;
	//return json_encode($json);

}

function SavePreference()
{
		global $conn;
		$is_error = false;
		$msg = '';
		if(isset($_REQUEST['city'])) { $city = $_REQUEST['city']; } else { $city = '';} ;
		if(isset($_REQUEST['district'])) { $district = $_REQUEST['district']; } else { $district = '';} ;
		if(isset($_REQUEST['diff_level'])) { $dif_level = $_REQUEST['diff_level']; } else { $dif_level = '';} ;
		if(isset($_REQUEST['endu_level'])) { $endu_level = $_REQUEST['endu_level']; } else { $endu_level = '';} ;
		if(isset($_REQUEST['month'])) { $month = $_REQUEST['month']; } else { $month = '';} ;
		if(isset($_REQUEST['trek_type'])) { $trek_type = $_REQUEST['trek_type']; } else { $trek_type = '';} ;
		if(isset($_REQUEST['group_type'])) { $group_type = $_REQUEST['group_type']; } else { $group_type = '';} ;
		if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
		$sql = "INSERT INTO preference(city,district,difficulty,endurance,month,trek_type,gender,email) values ('".$city."','".$district."','".$dif_level."','".$endu_level."','".$month."','".$trek_type."','".$group_type."','".$email."');";

		if ($conn->query($sql) === TRUE) {
				 $sql_max = "select max(preference_id) as maxid from preference where city='".$city."' and district='".$district."' and difficulty='".$dif_level."' and endurance='".$endu_level."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$group_type."'";

				$result1 = $conn->query($sql_max);
				$row1 = $result1->fetch_array(MYSQLI_ASSOC);
				$maxid = $row1['maxid'];
				
				
				/*----- check in preference table for same data ------*/
				 $sql_check = "select preference_id as pid from preference where district='".$district."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$group_type."' AND preference_id NOT IN ( '".$maxid."' )" ; 
				$result = $conn->query($sql_check);
				$pre_id_arr = array();
				while($rown = $result->fetch_array()){					
					$pre_id_arr[] = $rown['pid'];
				}
				$pre_ids = implode(',',$pre_id_arr);
				$counts = $result->num_rows;
				
				if($counts>0){
					
					/*---- count group_preference table for same preference_id ----*/
				 	 $sql_gp = "select groups_id from groups_preference where preference_id in ('".$pre_ids."')";
					
					$result2 = $conn->query($sql_gp);
					$row2 = $result2->fetch_array(MYSQLI_ASSOC);
					
					$countgp = $result2->num_rows;
					if($countgp==0)
					{
						$sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
						if ($conn->query($sql_newg) === TRUE) {
							$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";

							$resmaxgid = $conn->query($getmaxgid);
							$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
							$maxgid = $rowmgid['maxgid'];

							$insgp = "insert into groups_preference(group_id,preference_id) values ('".$maxgid."','".$maxid."')";
							$resgp = $conn->query($insgp);
							/*---------------------------------------------------------------------------------------------------------------------------*/
							$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."'  ";
							$rescntstr = $conn->query($strcnt);
							$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
							$cnt = $rowcnt['cnt'];
							
							if($cnt > 3 ){
								$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
								$resupdp = $conn->query($updp);
							}
							/*---------------------------------------------------------------------------------------------------------------------------*/
							
						}
					}
					else{
						$gpid = $row2['groups_id'];
						
						$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$gpid."','".$maxid."')";
						$resgp = $conn->query($insgp);
						
						/*---------------------------------------------------------------------------------------------------------------------------*/
							$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$gpid."'  ";
							$rescntstr = $conn->query($strcnt);
							$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
							$cnt = $rowcnt['cnt'];
							
							if($cnt > 3 ){
								$updp = "update groups set is_active=1 where group_id = '".$gpid."'";
								$resupdp = $conn->query($updp);
							}
							/*---------------------------------------------------------------------------------------------------------------------------*/
						
					}
				}
				else{
					$sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
					if ($conn->query($sql_newg) === TRUE) {
						$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";
						
						$resmaxgid = $conn->query($getmaxgid);
						$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
						$maxgid = $rowmgid['maxgid'];

						$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$maxgid."','".$maxid."')"; 
						$resgp = $conn->query($insgp);
						/*---------------------------------------------------------------------------------------------------------------------------*/
						$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."' ";
						$rescntstr = $conn->query($strcnt);
						$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
						$cnt = $rowcnt['cnt'];
						
						if($cnt > 3 ){
							$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
							$resupdp = $conn->query($updp);
						}
						/*---------------------------------------------------------------------------------------------------------------------------*/
					}
				}
				$json['code'] = 200;
				$json['data'] = "Preference created successfully";
		}else{
				$json['code'] = 500;
				$json['data'] = $conn->error;	
		}
		echo json_encode($json);
		exit;
}
function Send_Review_Ratings()
{
		global $conn;
		if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
		if(isset($_REQUEST['review'])) { $review= $_REQUEST['review']; } else { $review= '';} ;
		if(isset($_REQUEST['rating'])) { $rating= $_REQUEST['rating']; } else { $rating= '';} ;
		if(isset($_REQUEST['destination'])) { $dest= $_REQUEST['destination']; } else { $dest= '';} ;

		if($email!='')
		{
			$sql = "INSERT INTO review_ratings(email_id,destination,rating,review) values ('".$email."','".$dest."','".$rating."','".$review."');";
			if ($conn->query($sql) === TRUE) {
				$json['code'] = 200;
				$json['data'] = "Review and Rating submitted successfully";
			}else{
				$json['code'] = 500;
				$json['data'] = $conn->error;	
			}
		}
		else
		{
			$json['code'] = 500;
			$json['data'] = 'Invalid Email id.';
		}
		echo json_encode($json);
		exit;
}

function getRating_Review()
{
		global $conn;
		if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
		if(isset($_REQUEST['destination'])) { $destination = $_REQUEST['destination']; } else { $destination = '';} ;
		if($email!='')
		{
			$sql = "SELECT destination,rating,review FROM review_ratings WHERE destination = '".$destination."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$i=0;
				while($row = $result->fetch_assoc()) {
					$dest= $row["destination"];
					$rating= $row["rating"];
					$review= $row["review"];
					$json_data[$i]['destination'] = $dest;
					$json_data[$i]['rating'] = $rating;
					$json_data[$i]['review'] = $review;
					$i++;
				}
				$json['code'] = 500;
				$json['data'] = $json_data;
			}
			else
			{
				$json['code'] = 500;
				$json['data'] = 'No record for this email id.';
			}
		}
		else
		{
			$json['code'] = 500;
			$json['data'] = 'Invalid Email id.';
		}
		echo json_encode($json);
		exit;
}
function getgroups()
{
		global $conn;
		if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
		if($email!='')
		{
			$sql1="SELECT distinct(g.group_id) as gid,g.destination as dest,g.date as cdate,
				  g.contact as cnum ,g.result as res, g.is_active,p.district as p_dist 
				  FROM groups g 
				  LEFT JOIN groups_preference gp ON g.group_id = gp.groups_id 
				  LEFT JOIN preference p ON p.preference_id = gp.preference_id 
				  WHERE p.email = '".$email."' and g.is_active = 1";
			$result = $conn->query($sql1);
			if ($result->num_rows > 0) 
			{
				$i=0;
				
				while($row = $result->fetch_assoc()) {
					$group_id = $row["gid"];
					
					$sqld = "SELECT *
							FROM signlog s
							LEFT JOIN preference p ON s.email = p.email
							LEFT JOIN groups_preference gp ON gp.preference_id = p.preference_id
							LEFT JOIN groups g ON g.group_id = gp.groups_id
							where gp.groups_id =  '".$group_id."' 
							AND g.destination = '".$row["dest"]."' and gp.is_left = 0";
					
					$sqld_exec = $conn->query($sqld);
					$end_level = 0;
					$diff_level = 0;
					if ($sqld_exec->num_rows > 0) 
					{
						while($rowd = $sqld_exec->fetch_assoc()) 
						{
							$end_level = $end_level+$rowd['endurance'];
							$diff_level = $diff_level+$rowd['difficulty'];
						}
						$end_level = round($end_level/$sqld_exec->num_rows);
						$diff_level = round($diff_level/$sqld_exec->num_rows);
					}
					$dest_sql = "SELECT * 
								FROM destinations
								WHERE endurance = $end_level
								AND difficulty = $diff_level
								AND district =  '".$row["p_dist"]."' and is_active = 0"; 
								
					
					$dest_exec = $conn->query($dest_sql);
					
					if($dest_exec->num_rows > 0)
					{
						while($des_loop = $dest_exec->fetch_assoc()) 
						{
							$destination_name = $des_loop['destination_name'];
						}
					}
					else
					{
						$destination_name = "Pratapgad Fort";
					}
					$sqlg = "select s.name,s.age,s.gender u_gender,s.email u_mail,
							p.preference_id,p.city,p.district,p.difficulty,p.endurance,p.month,p.trek_type,p.email p_mail,p.gender p_gender,
							gp.groups_preference_id,gp.groups_id,gp.groups_id,gp.is_left
							from signlog s 
							left join preference p on s.email=p.email 
							left join groups_preference gp on gp.preference_id = p.preference_id 
							where gp.groups_id = '".$group_id."' and gp.is_left = 0 and gp.is_left = 0";
					
					$resultg = $conn->query($sqlg);
					if ($resultg->num_rows > 0) 
					{
						$memberarr =array();
						$email_arr = array();
						$gender_arr = array();
						$age_arr = array();
						while($rowg = $resultg->fetch_assoc()) {
							$memberarr[] = $rowg['name'];
							$email_arr[] = $rowg['u_mail'];
							$gender_arr[] = $rowg['u_gender'];
							$age_arr[] = $rowg['age'];
							$trektype= $rowg['trek_type'];
							$grptype= $rowg['p_gender'];
							$month=$rowg['month'];
						}
						$members = implode(',',$memberarr);
						$emails = implode(',',$email_arr);
						$genders = implode(',',$gender_arr);
						$ages = implode(',',$age_arr);
						$destination = $row["dest"];
					$date = $row["cdate"];
					//$transporter = $row["trans"];
					$contact = $row["cnum"];
					$result123 = $row["res"];
					
					$json_data[$i]['des'] = $destination_name;
					$json_data[$i]['member_count'] = $resultg->num_rows;
					$json_data[$i]['group_id'] = $group_id;
					$json_data[$i]['destination'] = $destination;
					$json_data[$i]['date'] = $date;
					$json_data[$i]['contact'] = $contact;
					$json_data[$i]['result'] = $result123;
					$json_data[$i]['member'] = $members;
					$json_data[$i]['emails'] = $emails;
					$json_data[$i]['genders'] = $genders;
					$json_data[$i]['ages'] = $ages;
					$json_data[$i]['trektype'] = $trektype;
					$json_data[$i]['grouptype'] = $grptype;
					$json_data[$i]['month'] = $month;
					$i++;
					}
					
					
				}

				$json['code'] = 500;
				$json['data'] = $json_data;
			}
			else
			{
				$json['code'] = 500;
				$json['data'] = 'No record for this email id.';
			}
		}
		else
		{
			$json['code'] = 500;
			$json['data'] = 'Invalid Email id.';
		}
		echo json_encode($json);
		exit;
}
function changepassword()
{
		global $conn;
		if(isset($_REQUEST['new_password'] )) { $new_password = $_REQUEST['new_password']; } else { $new_password = '';} ;
		if(isset($_REQUEST['old_password'] )) { $old_password = $_REQUEST['old_password']; } else { $old_password = '';} ;
		if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;

		if($email!='')
		{
				if($new_password!='' && $old_password!=''){
						$sql="UPDATE signlog  SET PASSWORD='".$new_password."' WHERE EMAIL='".$email."' and PASSWORD='".$old_password."'";
						if ($conn->query($sql) === TRUE) {
								$json['code'] = 200;
								$json['data'] = "Password updated successfully.";
						}else{
								$json['code'] = 500;
								$json['data'] = $conn->error;	
						}
				}
				else{
						$json['code'] = 500;
						$json['data'] = "Password not updated successfully.";
				}
		}
		else
		{
				$json['code'] = 500;
				$json['data'] = "Invalid EmailId";
		}
echo json_encode($json);
exit;
}

function leave_group()
{
	global $conn;
	if(isset($_REQUEST['email'])){$email = $_REQUEST['email'];}else{$email = '';};
	if(isset($_REQUEST['group_id'])){$g_id = $_REQUEST['group_id'];}else{$g_id = '';};
	
	$sql = "Select gp.groups_preference_id as gid from groups_preference gp
			left join preference p on p.preference_id = gp.preference_id
			where p.email = '".$email."' and gp.groups_id = $g_id";
	
	$resgid = $conn->query($sql);
	//$rowgid = $resgid->fetch_array(MYSQLI_ASSOC);
	while($rowd = $resgid->fetch_assoc()) 
	{
		$updp = "update groups_preference set is_left = 1 where groups_preference_id = '".$rowd['gid']."'";
		$resupdp = $conn->query($updp);
		if($resupdp)
		{
			$data['code'] = 500;
			$data['data'] = "You left the group.";
		}
		else
		{
			$data['code'] = 200;
			$data['data'] = "failed to leave the group.";
		}
	}
	echo json_encode($data);
}

function write_to_us()
{
	global $conn;
	if(isset($_REQUEST['email'])){$email = $_REQUEST['email'];}else{$email = '';};
	if(isset($_REQUEST['subject'])){$subject = $_REQUEST['subject'];}else{$subject = '';};
	if(isset($_REQUEST['comment'])){$comment = $_REQUEST['comment'];}else{$comment = '';};
	if($email !='')
	{
		$sql ="insert into write_to_us(subject,comment,email_id) values('".$subject."','".$comment."','".$email."')";
		if ($conn->query($sql) === TRUE) {
			$json['code'] = 200;
			$json['data'] = "Successfully inserted.";
		}else{
			$json['code'] = 500;
			$json['data'] = $conn->error;	
		}

	}
	else{
		$json['code'] = 500;
		$json['data'] = "Invalid EmailId";
	}
	echo json_encode($json);
	exit;
}
function deactivate_account()
{
	global $conn;
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
	if($email != '')
	{
		$sql="update signlog set delete_flag = 1 where email='".$email."'";
		if ($conn->query($sql) === TRUE) {
			$json['code'] = 200;
			$json['data'] = "Successfully deactivated.";
		}else{
			$json['code'] = 500;
			$json['data'] = $conn->error;	
		}
	}
	else
	{
		$json['code'] = 500;
		$json['data'] = "Invalid EmailId";
	}
	echo json_encode($json);
	exit;
}
function forgotpasswordmail()
{
	global $conn;
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';}
        $to = $email;
	$subject = "Trek social Forgot password";
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: <info@treksocial.in>' . "\r\n";
	if($email != '')
	{
		$sql = "select password,name from signlog where email='".$email."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) {
				$password = $row['password'];
				$name = $row['name'];
			}
                        $message = "
			<p>Hello, $name please check your password </p>
			<table>
			<tr>
			<th>Email</th>
			<th>Password</th>
			</tr>
			<tr>
			<td>".$email."</td>
			<td>".$password."</td>
			</tr>
			</table>
			";
			$send_mail = mail($to,$subject,$message,$headers);
			if($send_mail)
			{
				$json['message'] = "Password sent to selected email, please check you email address.";
			}
			else
			{
				$json['message'] = "Failed to send the password.";
			}
			$json['code'] = 200;
		}
		else{
			$json['code'] = 500;
			$json['error'] = "Invalid Email id";
		}
		
	}
	else
	{
		$json['code'] = 500;
		$json['error'] = "Invalid Email id";
	}
	echo json_encode($json);
	exit;
}
function Get_UserProfile()
{
	global $conn;
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
	if($email !=''){
		$sql = "select name,gender,age,phone from signlog where email = '".$email."'";
		$result=mysqli_query($conn,$sql);
		$data= array();
		while($row = $result->fetch_assoc()) {
			$data['name'] = $row['name'];
			$data['gender'] = $row['gender'];
			$data['age'] = $row['age'];
			$data['phone'] = $row['phone'];
		}
		$json['code'] = 200;
		$json['message'] = "Userprofile is available";
		$json['data'] = $data;
	}
	else{
		$json['code'] = 500;
		$json['error'] = "Invalid Email id";
	}
	echo json_encode($json);
	exit;
	
}
function Edit_UserProfile()
{
	global $conn;
	if(isset($_REQUEST['username'])){$username=$_REQUEST['username']; }else{$username='';};
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
	if(isset($_REQUEST['age'])) { $age= $_REQUEST['age']; } else { $age = '';} ;
	if(isset($_REQUEST['phone'])) { $phone = $_REQUEST['phone']; } else { $phone = '';} ;
	if($email != ''){
			$str = "update signlog set name='".$username."', age='".$age."', phone='".$phone."' where email='".$email."'";
	if ($conn->query($str) === TRUE) {
			$json['code'] = 200;
			$json['message'] = "Profile successfully updated.";
	}else{
			$json['code'] = 500;
			$json['message'] = $conn->error;
	}
	}
	else
	{
		$json['code'] = 500;
		$json['error'] = "Invalid Email id";
	}	
	echo json_encode($json);
	exit;
}
function checkLogin() 
{
	global $conn;
	if(isset($_REQUEST['username'])) { $username = $_REQUEST['username']; } else { $username = '';} ;
	if(isset($_REQUEST['password'] )) { $password = $_REQUEST['password']; } else { $password = '';} ;
	if(isset($_REQUEST['email'])) { $email = $_REQUEST['email']; } else { $email = '';} ;
	
	if($password != NULL and $email != NULL) {
		$sql = "SELECT username FROM fvilla_user WHERE email = '".$email."' AND password = '".$password."'";
	} else  { 
		$sql = "SELECT username FROM fvilla_user WHERE email = '".$email."'";
	}
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$username = $row["username"];
			$json['username'] = $username;
		}
		$json['code'] = 200;
		$json['data'] = $username." successfully logged in";
		
	} else {
		$json['code'] = 500;
		$json['data'] = "Invalid Username or Password";
	}
	echo json_encode($json);
	//exit;
	return json_encode($json);
}

function sendOTP()
{
	//$mobile = $_REQUEST['mobile_no'];
	global $conn;
	if($_REQUEST['user_id'] != NULL) { $user_id = $_REQUEST['user_id']; } else { $user_id = '';} ;
	if($_REQUEST['mobile_number'] != NULL) { $mobile_number = $_REQUEST['mobile_number']; } else { $mobile_number = '';} ;
	if($_REQUEST['gender'] != NULL) { $gender = $_REQUEST['gender']; } else { $gender = '';} ;
	
	if($user_id == '' or $mobile_number == ''){
		$json['code'] = 500;
		$json['data'] = "Invalid Username or Password";
		echo json_encode($json);
		exit;
	} else {
        $otp_number = sendSMS($mobile_number);
		$updateOTPsql = "UPDATE fvilla_user set OTP = '".$otp_number."' , mobile_no = '$mobile_number', gender = '$gender'  where id = '$user_id' ";
		if($conn->query($updateOTPsql) == TRUE){
			$json['code'] = 200;
			$json['data'] = "otp sended to mobile numbe";
		} else {
			$json['code'] = 500;
			$json['data'] = "Please contact Administrator";
		}
		echo json_encode($json);
		exit;

	}
	echo json_encode($json);
	exit;
}
  function sendSMS($mo_number){
        // Authorisation details.
        $username = "panurevishal@gmail.com";
        $hash = "5a3efd1cd0721aafbf95f27b0d5fd3ea8259c1e8";
        
        // Configuration variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";
        $numbers = $mo_number; // A single number or a comma-seperated list of numbers
        $generateNo = _generateRandomNumber(5);;
        $message = "OTP For fvilla is : ".$generateNo;
        
        $sender = urlencode('TXTLCL');
        $message = urlencode($message);
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        if($result){
            $return_data = json_decode($result);
            if($return_data->status == 'failure'){
                $json['code'] = 500;
                $json['data'] = $return_data->errors[0]->message;
                echo json_encode($json);
                exit;
            } else {
                return $generateNo;
            }
        } else {
            $json['code'] = 500;
            $json['data'] = "Please contact Administrator";
            echo json_encode($json);
            exit;
        }

}
function _generateRandomNumber($digits){
      return rand(pow(10, $digits-1), pow(10, $digits)-1);
}
    
function verifyOTP() 
{
	global $conn;
	if($_REQUEST['otp'] != NULL) { $otp = $_REQUEST['otp']; } else { $otp = '';} ;
	if($_REQUEST['otp'] != NULL) { $otp = $_REQUEST['otp']; } else { $otp = '';} ;
	if($_REQUEST['user_id'] != NULL) { $user_id = $_REQUEST['user_id']; } else { $user_id = '';} ;

	if($otp == '' or $user_id == ''){
		$json['code'] = 500;
		$json['data'] = "Please enter correct OTP";
		echo json_encode($json);
		exit;
	} else {
		$sql = "SELECT * FROM fvilla_user WHERE OTP = '".$otp."' AND id = '".$user_id."' and is_verify = '0'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$updateOTPsql = "UPDATE fvilla_user set is_verify = '1' where id = '$user_id' and OTP = '".$otp."'";
			if($conn->query($updateOTPsql) == TRUE){
				$json['code'] = 200;
				$json['data'] = "OTP verified";
			} 
		} else {
			$json['code'] = 500;
			$json['data'] = "No Record Found";
		}
		echo json_encode($json);
		exit;
	}
} 

function testApi(){
	
	$username = "jigar.prajapati48@gmail.com";
	$hash = "80e1534000e603979f693702900ca8f1e3d7702c";

	// Configuration variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "API Test"; // This is who the message appears to be from.
	$numbers = "44777000000"; // A single number or a comma-seperated list of numbers
	$message = "This is a test message from the PHP API script.";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	echo $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	exit;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result = curl_exec($ch); // This is the result from the API
	var_dump($result );
	curl_close($ch);
	exit('123');
	
}

function checkmail() {

/*    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "nayan thakor";
    $to = "";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
    $mail = mail($to,$subject,$message, $headers);
	if($mail){
    	echo "Test email sent";
	}
	else{
		echo "Mail not sent";
	}*/
	//$ret = exec("mail -s subject nayan.aimsinfosoft@gmail.com");
	$ret = shell_exec("sudo mail 2>&1;");
	//$ret = exec("su -c /path/to/command -s /bin/bash -l otheruser", $out, $err);
	var_dump($ret);
}


function forgotPassword() {
	global $conn;
	if(isset($_REQUEST['username'])) { $username = $_REQUEST['username']; } else { $username = '';} ;

	if($username != NULL) {
		
		$bytes = openssl_random_pseudo_bytes(4);
		$pwd = bin2hex($bytes);
		
		$qry = "select * from fvilla_user";
		$row = $conn->query($qry);
		while($res = $row->fetch_assoc())
		{
			print_r($res);
		}
		exit;
		
		$sql = "UPDATE fvilla_user SET password='$pwd' WHERE email='$username'";
		
		if ($conn->query($sql) === TRUE) {
	
			 $to = "nayan.aimsinfosoft@gmail.com";
			 $subject = "Fvilla New Password";
			 
			 $message = "<b>This is HTML message.</b>";
			 $message .= "<h1>This is headline.</h1>";
			 
			 $header = "From: hiren@aimsinfosoft.com\r\n";
			 $header = "Content-type: text/html\r\n";
			 
			 $retval = mail("$to","$subject","$message","$header");
			 //$retval  = true;
			 if($retval)
			 {
				$json['code'] = 200;
				$json['data'] = "New Password has been sent to your mail";
			 }
			 else
			 {
			    $json['code'] = 500;
				$json['data'] = "Please contact Administrator";
			 }
		 } 
		 else 
		 {
		 	 $json['code'] = 500;
			 $json['data'] = "Please contact Administrator".$conn->error;
		 }
	
	} else {
		$json['code'] = 500;
		$json['data'] = "No Record Found";
		
	}
	echo json_encode($json);
	exit;
	
}




?>