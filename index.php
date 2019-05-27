<?php 
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
	die("connection failed" . mysqli_error($con));
}
$message = '';
if(isset($_GET['msg']))
{
	if($_GET['msg'] == 2)
	{
		$message = '<div class="alert alert-danger fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
			Invalid <strong>Username</strong> Or <strong>Password</strong>.
		</div>';
	}
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Trek Social</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/custom.css" rel="stylesheet">
		<link href="../css/basic-template.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- BootstrapValidator CSS -->
      <link href="../css/bootstrapValidator.min.css" rel="stylesheet"/>
	
    <!-- jQuery and Bootstrap JS -->
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js" type="text/javascript"></script>
		
    <!-- BootstrapValidator -->
       <script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>
    
  </head>
  
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container clearfix">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
			
		<a href="index.php">
			<img class="img-rounded" src="../img/TrekSocial_Trial.jpg" />
		</a>
		</div>

			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
					<li><a href="ViewDestinations.php">Destinations</a></li>
				</ul>
			</div>
		</div>
		</div>

<div class="container">
	<center><?php if($message != ''){ echo $message; }?></center>
	<div class="jumbotron text-center">
		<h1>TrekSocial</h1>
		<p>Reconnect with yourself</p>
		<a class="btn btn-success" data-toggle="modal" href="#Login">Login</a> 
		<!--<a class="btn btn-success" data-toggle="modal" href="#SignUp">SignUp</a>-->
	</div>

	<div class="row">
		<div class="col-md-4">
		<a class="thumbnail" href="#"><img src="../img/10_new.jpg" /> 
		</a>
			<h3>Top Destinations</h3>
			<p>We have handpicked the best trekking locations for your thrilling and memorable adventure that you can cherish for a lifetime.</p>
			
		</div>

		<div class="col-md-4">
		    <a href="#" class="thumbnail">
			<img src="../img/2_new.jpg"></img>
		     </a>
		    <h3> Easy Travel</h3>
		    <p> We have collaborated with top travel companies to make your travelling experiences to these trekking location comfortable and stress free.</p>
		    
		</div>

		<div class="col-md-4">
		    <a href="#" class="thumbnail">
			<img src="../img/9_new.jpg"></img>
		    </a>
		    <h3> World Class Instructors</h3>
		    <p>We provide well trained and certified trek instructors and guides on our treks, who ensure that you have an impeccable trekking experience.</p>
		    
		</div>
	</div>
</div>

<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
	<div class="container">
		<p class="navbar-brand col-xs-4">TrekSocial &copy </p>
		<div class="navbar-text pull-right" float:left>		
			<a href="https://www.facebook.com/login/" target="blank"><i class="fa fa-facebook-square fa-2x"></i> </a>
			<a href="https://twitter.com/login" target="blank"><i class="fa fa-twitter-square fa-2x"></i> </a>
			<a href="https://plus.google.com/" target="blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
		</div>
	</div>
</div>

<!-- About Us Modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="AboutUs" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		    
			<div class="modal-header">
				<button class="close" data-dismiss="modal" type="button">
					<span aria-hidden="true">&times;</span> 
					<span class="sr-only">Close</span>
				</button>
				<h4 align="center">About Us</h4>
		    </div>
			
			<div class="modal-body">
				<p>We are organising trek and adventure tours</p>
			</div>
		     		
			<div class="modal-footer">
				<a href="index.php" class="btn btn-success" data-dimiss="modal">Okay</a>
		    </div>
			
		</div>
	</div>
</div>

<!-- Login Form Modal Begins -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="Login" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
		<div class="modal-header">
			<button class="close" data-dismiss="modal" type="button">
				<span aria-hidden="true">&times;</span> 
				<span class="sr-only">Close</span>
			</button>


			<h4 align="center" class="modal-title" id="LoginLabel">Login</h4>
		</div>
		
<!--Login Form Code Begins -->

<div class="modal-body">
	<form action="login.php" class="form-horizontal" id="LForm" method="POST" role="form">&nbsp;
	<div class="form-group">
		<label class="col-sm-2 control-label" for="email">Email</label>
		<div class="col-sm-8">
			<input class="form-control" id="email" name="email" placeholder="Email" type="text" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="password">Password</label>
		<div class="col-sm-8">
			<input class="form-control" id="password" name="password" placeholder="Password" type="password" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="checkbox">
			<label><input type="checkbox" /> Remember me</label>
			</div>
		</div>
	</div>
		
<!--Login Form Code Ends -->

		<div class="modal-footer">
			<button class="btn btn-success" type="submit">Login</button>
		</div>
	</form>
</div>
	
</div>
</div>
</div>
<!--Login Form Modal Ends -->

<!--SignUp Form Modal begins -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="SignUp" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

	<div class="modal-header">
		<button class="close" data-dismiss="modal" type="button">
			<span aria-hidden="true">&times;</span> 
			<span class="sr-only">Close</span>
		</button>
		<h4 align="center" class="modal-title" id="SignUpLabel">SignUp</h4>
	</div>
	
<!--SignUp Form begins -->

	<div class="modal-body">
	<form action="Signup.php" class="form-horizontal" id="SForm" method="POST" role="form">
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputName">Name</label>
			<div class="col-sm-10">
				<input class="form-control" name="name" placeholder="Your Name" required="" type="text" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputAge">Age</label>
			<div class="col-sm-10">
				<input class="form-control" name="age" placeholder="Your Age" type="text" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputGender">Gender</label>
			<div class="col-sm-10">
				<input name="gender" type="radio" value="Male" />&nbsp;Male &nbsp; &nbsp; &nbsp; 
				<input name="gender" type="radio" value="Female" />&nbsp;Female
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputEmail">Email</label>
			<div class="col-sm-10">
				<input class="form-control" name="email" placeholder="Email" type="text" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputPassword">Password</label>
			<div class="col-sm-10">
				<input class="form-control" name="password" placeholder="Your Password" type="password" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="confirmPassword">Confirm Password</label>
			<div class="col-sm-10">
				<input class="form-control" name="confirmpassword" placeholder="Re Enter Password" type="password" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputPhone">Phone</label>
			<div class="col-sm-10">
				<input class="form-control" name="phone" placeholder="Your Contact Number" type="text" />
			</div>
		</div>
		
<!--SignUp Form ends -->

		<div class="modal-footer">
			<button class="btn btn-success" type="submit">SignUp</button>
		</div>
	</form>
	</div>
	
</div>
</div>
</div>

</body>

<script type="text/javascript">
	$(document).ready(function () {
		var validator = $("#LForm").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove", 
				validating: "glyphicon glyphicon-refresh"
			}, 
			fields : {
				email :{
					message : "Email Address required",
					validators : {
						notEmpty : {
							message : "Please provide a valid Email address"
						}, 
						stringLength: {
							min : 6, 
							max: 35,
							message: "Email Address must be between 6 and 35 characters long"
						},
						emailAddress: {
							message: "Email Address was invalid"
						}
					}
				},
				password : {
					validators: {
						notEmpty : {
							message : "Password required"
						},
						stringLength : {
							min: 5,
							max: 10,
							
							
							
							message: "Password must be at least 8 characters long"
						}, 
						different : {
							field : "email", 
							message: "Email address and Password should not match"
						}
					}
				}
			}
		});
		
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		var james = $("#SForm").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove", 
				validating: "glyphicon glyphicon-refresh"
			}, 
			fields : {
				name: {
					validators : {
						notEmpty : {
						message:"Name required"
					     },
						 stringLength : {
							min: 4,
							max: 85,
							message: "Enter Name"
						}
					}
				},				
				age : {
				  validators : {
					notEmpty : {
					message:"Age required"
					},
					stringLength : {
							min: 2,
							max: 2,
							message: "Enter valid age"
						}
					 }
				},
				gender : {
				  validators : {
					notEmpty : {
					    message:"Gender required"
					  }
				     }
				},
				email :{
					message : "Email Address is required",
					validators : {
						notEmpty : {
							message : "Please provide a valid Email Address"
						}, 
						stringLength: {
							min : 6, 
							max: 35,
							message: "Email Address must be between 6 and 35 characters long"
						},
						emailAddress: {
							message: "Email Address was invalid"
						}
					}
				}, 
				password : {
					validators: {
						notEmpty : {
							message : "Password required"
						},
						stringLength : {
							min: 5,
							max: 10,
							message: "Password must be at least 8 characters long"
						}, 
						different : {
							field : "email", 
							message: "Email Address and Password should not match"
						}
					}
				},
				confirmpassword : {
					validators: {
						identical: {
						    field: "password",
						    message: "The Password and its confirmation do not match"
						},
						notEmpty : {
							message : "Password required"
						},
						stringLength : {
							min: 5,
							max: 10,
							message: "Password must be at least 8 characters long"
						}, 
						different : {
							field : "email", 
							message: "Email Address and Password should not match"
						}

				         }
				},
				phone : {
					validators: {
						
						notEmpty : {
						message : "Phone Number required"
					},
					stringLength : {
						min: 10,
						max: 12,
						message: "Phone Number must be 10 or 12 characters long"
                                        }
				  }
				}
			}
		});
		
	});
</script>

</html>