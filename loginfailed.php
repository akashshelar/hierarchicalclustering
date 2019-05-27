<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top"role="navigation">
	<div class="container clearfix">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>

		<img src="img/Incredible_Final_Small.jpg" class="img-rounded"></img> 
		</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-left">
		    <li class="active"><a href="#">Home</a></li>
		    <li><a href="#AboutUs" data-toggle="modal">About Us</a></li>
		    <li><a href="#">Preferences</a></li>

		<li class="dropdown">
			<a href="#"  class="dropdown-toggle" data-toggle="dropdown">Destinations
				<b class="caret"> </b>
			</a>
		<ul class="dropdown-menu">
		    <li class="dropdown-header">Maharashtra</li>
		    <li><a href="#">Pune</a></li>
		    <li><a href="#">Mumbai</a></li>
		    <li><a href="#">Nashik</a></li>
		    <li class="dropdown-header">United States</li>
		    <li><a href="#">Los Angeles</a></li>
		    <li><a href="#">Las Vegas</a></li>
		    <li><a href="#">San Francisco</a></li>
		</ul>
		</li>
	</div>
	</div>
    </div>

<div class="container">
	<div class="jumbotron text-center"> 
	    <h1>TrekSocial</h1>
	    <p>Trek with strangers, like never before</p>
	    <a href="#Login" class="btn btn-success" data-toggle="modal">Login</a>
	    <a href="#SignUp" class="btn btn-success"  data-toggle="modal">SignUp</a>
	</div>

	<div class="row">
		<div class="col-md-4">
		   <a href="#" class="thumbnail">
			<img src="img/10.jpg"></img>
		   </a>
		    <h3>View Destinations</h3>
		    <p>View all the top destinations for trekking and find out more about them</p>
		    <a href="#" class="btn btn-success">Know More..</a>
		</div>

		<div class="col-md-4">
		    <a href="#" class="thumbnail">
			<img src="img/2.jpg"></img>
		     </a>
		    <h3>Our Collaborators</h3>
		    <p>The trek organization and transportation facility will</p>
		    <a href="#" class="btn btn-success">Know More..</a>
		</div>

		<div class="col-md-4">
		    <a href="#" class="thumbnail">
			<img src="img/9.jpg"></img>
		    </a>
		    <h3>Ae Yo</h3>
		    <p>Yo wanna know more.</p>
		    <a href="#" class="btn btn-success">Hell Yeah</a>
		</div>
	</div>
</div>

<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
<div class="container">
<p class="navbar-brand">TrekSocial 2016 &copy </p>
<div class="navbar-text pull-right" float:left>		
		<a href="https://www.facebook.com/login/" target="blank"><i class="fa fa-facebook-square fa-2x"></i> </a>
		<a href="https://twitter.com/login" target="blank"><i class="fa fa-twitter-square fa-2x"></i> </a>
		<a href="https://plus.google.com/" target="blank"><i class="fa fa-google-plus-square fa-2x"></i> </a>
	</div>
</div>
</div>

<div class="modal fade" id="AboutUs" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		     <div class="modal-header">
		      <h4 align="center">About Us</h4>
		      </div>
			<div class="modal-body">
			<p>We're organising trek and adventure tours</p>
			</div>
		     		 <div class="modal-footer">
		      		<a class="btn btn-success" data-dimiss="modal">Hell Yeah</a>
		     		</div>
		      </div>
		</div>
	</div>
</div>

<!-- Login Form Modal Begins -->
<div class="modal fade" id="Login" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

		<div class="modal-header">
		     <button type="button" class="close" 
                   	     data-dismiss="modal">
                       	     <span aria-hidden="true">&times;</span>
                       	     <span class="sr-only">Close</span>
                		     </button>
                			<h4 class="modal-title" id="LoginLabel" align="center">Login</h4>
		</div>
			
<!--Login Form Code Begins -->
<form method="POST" action="login.php" class="form-horizontal" role="form"  id="login">
&nbsp;
                                                     <div class="form-group">
    				<div class="col-sm-8">
      				<h3>Please Re-enter your Email and password </h3>
    				</div>
  			</div>
  			<div class="form-group">
    				<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    				<div class="col-sm-8">
      				<input type="text" class="form-control" name="email" placeholder="Email">
    				</div>
  			</div>
  				

			<div class="form-group">
    			<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    				<div class="col-sm-8">
      				<input type="password" class="form-control" name="password" placeholder="Password">
  				</div>
  			</div>


  			<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-8">
      					<div class="checkbox">
        						<label>
          						<input type="checkbox"> Remember me
        						</label>
      					</div>
    				</div>
  			</div>


  	<!--		<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
      				<button type="submit" class="btn btn-success">Sign in</button>
    				</div>
  			</div>    -->

<!--Login Form Code Ends -->

				<div class="modal-footer" >
				<button type="submit" class="btn btn-success" >Login</button>
		      <!--		<a class="btn btn-success" data-dimiss="modal">Login</a>    -->
		     		</div>
		 </div>
	</div>
</div>
</form>    
<!--Login Form Modal Ends -->

<!--SignUp Form Modal begins -->
<div class="modal fade" id="SignUp" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">  
		     	<button type="button" class="close" 
                   	      	data-dismiss="modal">
                       	      	<span aria-hidden="true">&times;</span>
                       	      	<span class="sr-only">Close</span>
                		     	</button>
                				<h4 class="modal-title" id="SignUpLabel" align="center">SignUp</h4>		      
			</div>

<!--SignUp Form begins -->
<div class="modal-body">
	 <form method="POST" action="addcheck.php" class="form-horizontal" role="form"  id="signup">
		<div class="form-group">
    				<label for="inputName" class="col-sm-2 control-label">Name</label>
    				<div class="col-sm-10">
       				<input type="text" class="form-control"  name="name" placeholder="Your Name">
    				</div>
  			</div>

                                     <div class="form-group">
    				<label for="inputAge" class="col-sm-2 control-label">Age</label>
    				<div class="col-sm-10">
      				<input type="text" class="form-control" name="age" placeholder="Your Age">
    				</div>
  			</div>

		<div class="form-group">
    				<label for="inputGender" class="col-sm-2 control-label">Gender</label>
    				<div class="col-sm-10">
      				<input type="text" class="form-control" name="gender" placeholder="Your Gender">
    				</div>
  			</div>

		<div class="form-group">
    				<label for="inputEmail" class="col-sm-2 control-label">Email</label>
    				<div class="col-sm-10">
      				<input type="text" class="form-control" name="email" placeholder="Email">
    				</div>
  			</div>

		<div class="form-group">
    				<label for="inputPassword" class="col-sm-2 control-label">Password</label>
    				<div class="col-sm-10">
      				<input type="password" class="form-control" name="password" placeholder="Your Password">
    				</div>
  			</div>

		<div class="form-group">
    				<label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>
    				<div class="col-sm-10">
      				<input type="password" class="form-control" name="password" placeholder="Re Enter Password">
    				</div>
  			</div>

		<div class="form-group">
    				<label for="inputPhone" class="col-sm-2 control-label">Phone</label>
    				<div class="col-sm-10">
      				<input type="text" class="form-control" name="phone" placeholder="Your Contact Number">
    				</div>
  		</div>
	
</div>

<!--SignUp Form ends -->


<div class="modal-footer" >
				<button type="submit" class="btn btn-success"  id="submit">SignUp</button>
		      <!--		<a class="btn btn-success" data-dimiss="modal">SignUp</a>    -->
		     		</div>
		 </div>
	</div>
</div>
</form>
<!--SignUp Form Modal ends -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
