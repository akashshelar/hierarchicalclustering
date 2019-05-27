<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');

if(!$con)
{
	die("connection failed" . mysqli_error($con));
}

?>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	<meta content="width=device-width, initial-scale=1" name="viewport" /><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>TrekSocial</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" /><!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/custom.css" rel="stylesheet" />
	<link href="css/basic-template.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /><!-- BootstrapValidator CSS -->
	<link href="css/bootstrapValidator.min.css" rel="stylesheet" /><!-- jQuery and Bootstrap JS --><script src="js/jquery.min.js" type="text/javascript"></script><script src="js/bootstrap.min.js" type="text/javascript"></script><!-- BootstrapValidator --><script src="js/bootstrapValidator.min.js" type="text/javascript"></script><script src="js/custom.js" type="text/javascript"></script>
    <style>
	.col-lg-9
	{
		margin-bottom:100px;
	}
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container clearfix">
<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><a href="index.php"><img class="img-rounded" src="img/TrekSocial_Trial.jpg" /> </a></div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-left">
	<li class="active"><a href="index.php">Home</a></li>
	<li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
    <?php 
	if(isset($_SESSION['sess_user']) && $_SESSION['sess_user'] != '')
	{ ?>
	<li><a href="logout.php">Logout</a></li>	
	<?php }
	?>
</ul>
</div>
</div>
</div>
<?php
$widthclass = '';
if(isset($_SESSION['sess_user']) && $_SESSION['sess_user'] != ''){ 
$widthclass = "col-lg-9"; 
?>
<div class="col-lg-3">
<div class="jumbotron">
<style>
.show_menu {
display: block !important;
}
.submenu {
display: none;
}
</style>
<ul type="square">
	<li><font color="Blue" font="" size="4"><a href="UserPreference.php" target="_top">Set Preferences</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="ViewDestinations.php" target="_top">View destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Groups.php" target="_top">View your groups</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Rate_Review.php" target="_top">Rate and Review Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Suggestdestination.php" target="_top">Suggest New Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="feedback.php" target="_top">Write to us</a></font></li>
	<li onclick='openDropDown()'><font color="Blue" font="" size="4"><a href="javascript:void(0);" target="_top">Settings</a></font>
    	<ul id='drpdwn' class='submenu'>
        	<li><font color="Blue" font="" size="4"><a href="Editprofile.php" target="_top">Edit Profile</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="ChangePassword.php" target="_top">Change Password</a></font></li>
            <li onClick="Deactivate_account('<?php echo $_SESSION['sess_user']; ?>')"><font color="Blue" font="" size="4"><a href="javascript:void(0);" target="_top">Deactivate Account</a></font></li>
        </ul>
    </li>
	
</ul>
<script>
function openDropDown()
{
	$('#drpdwn').toggleClass('show_menu');
} 
</script>
<?php } ?>
</div>
</div>
<div class="<?php echo $widthclass; ?> container col-lg-9">
<div class="row">
<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/alang.jpg" /> </a>

<h3>Alang Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 5 <br />
Endurance Level on scale of 1(low) to 5(high): 4 <br />
Height of fort: 4852 ft.<br />
District: Nashik<br />
Distance from Mumbai: 145 km approx.<br />
Distance from Pune: 175 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#AlangFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/madan.jpg" /> </a>

<h3>Madangad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 4 <br />
Endurance Level on scale of 1(low) to 5(high): 4 <br />
Height of fort: 4841 ft.<br />
District: Nashik<br />
Distance from Mumbai: 145 km approx.<br />
Distance from Pune: 175 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#MadanFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/kulang.jpg" /> </a>

<h3>Kulang Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 4 <br />
Endurance Level on scale of 1(low) to 5(high): 4 <br />
Height of fort: 4822 ft.<br />
District: Nashik<br />
Distance from Mumbai: 145 km approx.<br />
Distance from Pune: 175 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#KulangFortInfo">Know More..</a></div>
</div>
&nbsp;

<div class="row">
<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/sinhagad.jpg" /> </a>

<h3>Sinhagad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 2 <br />
Endurance Level on scale of 1(low) to 5(high): 1 <br />
Height of fort: 4429 ft.<br />
District: Pune<br />
Distance from Mumbai: 180 km approx.<br />
Distance from Pune: 32 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#SinhagadFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/ratangad.jpg" /> </a>

<h3>Ratangad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 2 <br />
Endurance Level on scale of 1(low) to 5(high): 2 <br />
Height of fort: 4255 ft.<br />
District: Ahmednagar<br />
Distance from Mumbai: 160 km approx.<br />
Distance from Pune: 190 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#RatangadFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/rajgad.jpg" /> </a>

<h3>Rajgad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 5 <br />
Endurance Level on scale of 1(low) to 5(high): 4 <br />
Height of fort: 4620 ft.<br />
District: Pune<br />
Distance from Mumbai: 211 km approx.<br />
Distance from Pune: 51.7 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#RajgadFortInfo">Know More..</a></div>
</div>
&nbsp;

<div class="row">
<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/torna.jpg" /> </a>

<h3>Torna Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 4 <br />
Endurance Level on scale of 1(low) to 5(high): 3 <br />
Height of fort: 4603 ft.<br />
District: Pune<br />
Distance from Mumbai: 212.6 km approx.<br />
Distance from Pune: 51 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#TornaFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/raigad.jpg" /> </a>

<h3>Raigad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 4 <br />
Endurance Level on scale of 1(low) to 5(high): 4 <br />
Height of fort: 4400 ft.<br />
District: Raigad<br />
Distance from Mumbai: 169 km approx.<br />
Distance from Pune: 131.4 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#RaigadFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/harishchandragad.jpeg"/> </a>

<h3>Harishchandragad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 3 <br />
Endurance Level on scale of 1(low) to 5(high): 3 <br />
Height of fort: 4700 ft.<br />
District: Ahmednagar<br />
Distance from Mumbai: 175.5 km approx.<br />
Distance from Pune: 174.8 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#HarishchandragadFortInfo">Know More..</a></div>
</div>
&nbsp;

<div class="row">
<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/panhala.jpg" /> </a>

<h3>Panhala Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 3<br />
Endurance Level on scale of 1(low) to 5(high): 2 <br />
Height of fort: 2772 ft.<br />
District: Kolhapur<br />
Distance from Mumbai: 382.9 km approx.<br />
Distance from Pune: 240 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#PanhalaFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/pratapgad.jpg" /> </a>

<h3>Pratapgad Fort</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 1 <br />
Endurance Level on scale of 1(low) to 5(high): 1 <br />
Height of fort: 3200 ft.<br />
District: Ahmednagar<br />
Distance from Mumbai: 192.1 km approx.<br />
Distance from Pune: 163.3 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#PratapgadFortInfo">Know More..</a></div>

<div class="col-md-4"><a class="thumbnail" href="#"><img src="img/kalsubai.jpg" /> </a>

<h3>Kalsubai Peak</h3>

<p>Difficulty Level on scale of 1(low) to 5(high): 5 <br />
Endurance Level on scale of 1(low) to 5(high): 5 <br />
Height of fort: 5400 ft.<br />
District: Nashik <br />
Distance from Mumbai: 152.8 km approx.<br />
Distance from Pune: 169.9 km approx.</p>
<a class="btn btn-success" data-toggle="modal" href="#KalsubaiPeakInfo">Know More..</a></div>
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
</div>
<!-- About Us Modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="AboutUs" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">About Us</h4>
</div>

<div class="modal-body">
<p>We are organising trek and adventure tours</p>
</div>

<div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="index.php">Okay</a></div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="AlangFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Alang Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/alang.jpg" /> </a>

<p>Fort (also Alangad) is a fort in Nashik district, Maharashtra, India. It is one of the three forts, the others beingMadangad and Kulang, in the Kalsubai range of the Western Ghats. They are the most difficult to reach forts in Nasik District. A dense forest cover make these treks difficult. These three forts are a little neglected due to very heavy rains in the area and a difficult confusing path to the forts. The top of the fort is a huge plateau. On the fort, there are two caves, a small temple and 11 water cisterns. Remnants of buildings are spread over the fort. Kalasubai, Aundh Fort, Patta and Bitangad are to the east of the fort, Harihar, Trymbakgad and Anjaneri to its north and Harishchandragad, Aajobagad, Khutta (pinnacle), Ratangad and Katrabai to its south.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="MadanFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Madan Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/madan.jpg" /> </a>

<p>Madangad is a fort in the Nashik region of Maharashtra, India in the Kalsubai range.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="KulangFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Kulang Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/kulang.jpg" /> </a>

<p>Kulang is a fort in the Nashik region of Maharashtra, India in the Kalsubai range.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="SinhagadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Sinhagad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/sinhagad.jpg" /> </a>

<p>Sinhagad(The Lion&#39;s Fort), is a fortress located roughly 30 kilometres southwest of the city of Pune,India. Previously called Kondhana, the fort has been the site of many important battles, most notably the Battle of Sinhagad in 1671. It was also strategically located at the centre of a string of other forts such as Rajgad, Purandar and Torna. Perched on an isolated cliff of the Bhuleswar range of the Sahyadri Mountains, it is situated on a hill rising 700 metres above sea level. Given natural protection by its very steep slopes, the walls and bastions were constructed at only key places; it has two gates &ndash; the Kalyan Darwaza in the south-east and the Pune Darwaza in the north-east. This fort has had quite a long history, It was called &#39;Kondana&#39; after the sage Kaundinya. The Kaundinyeshwar temple, the caves and the carvings indicate that this fort had probably been built two thousand years back. It was captured from the Koli tribal chieftain,Nag Naik, by Muhammad bin Tughlaq in 1328 AD</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="RatangadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Ratangad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/ratangad.jpg" /> </a>

<p>Ratangad is a fort in Ratan Wadi, Maharashtra, India, overlooking the locale of Bhandardara, one of the oldest artificial catchment area. The fort is about 2000 years old. Ratangad has a natural rock peak with a cavity in it at the top which is called &#39;Nedhe&#39; or &#39;Eye of the Needle&#39;. The fort has four gates Ganesh, Hanuman, Konkan and Trimbak. It also has many wells on the top. Ratangad was captured by Chhatrapati Shivaji Raje Bhosle. The base village Ratanwadi has an Amruteshwar temple which is famous for its carvings. The fort is origin for the river Pravara/Amrutvahini. The Bhandardara dam(arthar dam) is built on this river. The main attraction at Ratanwadi is the Amruteshwar temple dating back to the Hemadpant Era - roughly from the eighth century. The base village Ratanwadi is approached by boat from Bhandardara. By boat, it is a 6 km journey and further it is a 4 km walk till Ratanwadi.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="RajgadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Rajgad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/rajgad.jpg" /> </a>

<p>Rajgad (literally meaning Royal Fort) is one of the forts in the Pune district of Maharashtra state in India. The fort is around 1,400 m (4,600 ft) above sea level. Formerly known as Murumdev, it was capital of the Maratha Empire during the rule of Chhatrapati Shivaji Maharaj for almost 26 years, after which he moved the capital to Raigad Fort. Treasure found at an adjacent fort was used to fortify this hill. The diameter of the fort at the base is 40 km (25 mi) making it difficult for anybody to lay siege to it, adding to its strategic value. The fort is a significant site for trekkers and adventurous tourists to visit. Specially after the monsoon, this place becomes one of most sought after trekking destinations for trekkers from the Pune and Mumbai area. As it is a huge fort, exploring all the sights and spots on the fort becomes difficult in a day and hence visitors prefer an overnight stay on the fort to get ample time to explore all the part of the fort.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="TornaFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Torna Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/torna.jpg" /> </a>

<p>Torna Fort also known as Prachandagad is a large fort located in Pune district in the state of Maharashtra, India. It is historically significant because it is the first fort captured by Shivaji Maharaj in 1643, at the age of 16 forming the nucleus of theMaratha empire. The hill has an elevation of 1,403 metres (4,603 ft) above sea level, making it the highest hill-fort in the district. The name derives from Prachanda (Marathi for huge or massive) and gad (Marathi for fort). This fort is believed to have been constructed by the Shaiva Panth, followers of the Hindu god Shiva, in the 13th century. AMenghai Devi temple, also referred to as the Tornaji temple, is situated near the entrance of the fort. In 1643, Shivaji Maharaj captured this fort at the age of sixteen, thus making it one of the first forts that would become the Maratha empire. Shivaji renamed the fort &#39; &#39;Prachandagad&#39; &#39; as Torna, and constructed several monuments and towers within it. In the 18th century, the Mughal empire briefly gained control of this fort after assassination of Shivaji Maharaj&#39;s son Sambhaji.Aurangzeb, then Mughal emperor, renamed this fort Futulgaib in recognition of the difficult defense the Mughals had to overcome to capture this fort. It was restored to the Maratha confederacy by the Treaty of Purandar.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="RaigadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Raigad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/raigad.jpg" /> </a>

<p>Raigad is a hill fort situated in the Mahad, Raigad district of Maharashtra, India. The fort was built by Chandrarao More in 1030. Its ruins today consist of the queen&#39;s quarters: six chambers, with each chamber having its own private restroom. The main palace was constructed using wood, of which only the bases of pillars remain. Ruins of three watch towers can be seen directly in front of the palace grounds overlooking an artificial lake called Ganga Sagar Lake created next to the fort. It also has a view of the execution point called Takmak Tok, a cliff from which the sentenced prisoners were thrown to their death. The area is now fenced off. The fort also has ruins of the market, and it has such structure that one can shop even while riding on a horse. Shivaji had seized the fort in 1656, then the fort of Rairi, from the royal house of Chandrarrao Mores, a junior or Cadet dynasty to descended from the ancient Mauryaimperial dynasty. The last More king (or raja) was a feudatory of the Sultan of Bijapur. Shivaji renovated and expanded the fort of Rairi and renamed it Raigad (the King&#39;s Fort). It became the capital of Shivaji&#39;s kingdom.[citation needed] The Maratha king [Shivaji Maharaj] built this fort and made his capital in 1674 when he was crowned King of a Maratha Kingdom which later developed into the Maratha Empire eventually covering majority of modern-day India.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="HarishchandragadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Harishchandragad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/harishchandragad.jpeg"/> </a>

<p>Harishchandragad is said to be from 6th century during the rule of Kalachari dynasty.The fort is ancient, proves of microlithic man have been found here Ancient scriptures (vedh puranas) like Matsyapurana,Agnipurana and Skandapurana include many descriptions about the fort.Their are cliffs named as Taramati and Rohidas,they have no connection with Ayodhya. Their are caves which has carvings of lord Vishnu which are made in 11th century.In 14th century sage changdev used to meditate here.Their are various cultural diversities in the surrounding of the fort based on the various constructions on the fort.The fort is built in medieval period based on the carvings of temples of Nageshwar in Harishchandreshwar temple and is related to Shiva,Shakta or Naath. Marathas captured the fort in 1747 from the Mughals.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="PanhalaFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Panhala Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/panhala.jpg" /> </a>

<p>Panhala fort (also known as Panhalgad, Pahalla and Panalla (literally &quot;the home of serpents&quot;)), is located in Panhala, 20 kilometres northwest of Kolhapur in Maharashtra, India. It is strategically located looking over a pass in the Sahyadri mountain range which was a major trade route from Bijapur in the interior of Maharashtra to the coastal areas. Due to its strategic location, it was the centre of several skirmishes in the Deccan involving the Marathas, the Mughals and the British East India Company, the most notable being the Battle of Pavan Khind. Here, the queen regent of Kolhapur State, Tarabai, spent her formative years. Several parts of the fort and the structures within are still intact. Panhala fort was built between 1178 and 1209 CE, one of 15 forts (others including Bavda,Bhudargad, Satara, and Vishalgad) built by the Shilahara ruler Bhoja II. It is said that aphorismKahaan Raja Bhoj, kahan Gangu Teli is associated with this fort. A copper plate found in Satara shows that Raja Bhoja held court at Panhala from 1191&ndash;1192 CE. About 1209&ndash;10, Bhoja Raja was defeated by Singhana (1209&ndash;1247), the most powerful of the Devgiri Yadavas, and the fort subsequently passed into the hands of the Yadavas. Apparently it was not well looked after and it passed through several local chiefs. In 1376 inscriptions record the settlement of Nabhapur to the south-east of the fort. In 1659, after the death of the Bijapur general Afzul Khan, in the ensuing confusion Shivaji Maharaj took Panhala from Bijapur. In May 1660, to win back the fort from Shivaji, Adil Shah II (1656&ndash;1672) of Bijapur sent his army under the command of Siddi Johar to lay siege to Panhala. Shivaji Maharaj fought back and they could not take the fort. The siege continued for 5 months, at the end of which all provisions in the fort were exhausted and Shivaji Maharaj was on the verge of being captured.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="PratapgadFortInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Pratapgad Fort</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/pratapgad.jpg" /> </a>

<p>Pratapgad literally &#39;Valour Fort&#39; is a large fort located in Satara district, in the Western Indian state of Maharashtra. Significant as the site of the Battle of Pratapgad, the fort is now a popular tourist destination. Pratapgad fort is located 15 kilometres (9.3 mi) from Poladpur and 23 kilometres (14 mi) west of Mahabaleshwar, a popularhill station in the area. The fort stands 1,080 metres (3,540 ft) above sea level and is built on a spur which overlooks the road between the villages of Par and Kinesvar. The Maratha king Shivaji commissioned Moropant Trimbak Pingle, his prime minister, to undertake the construction of this fort in order to defend the banks of the Nira and the Koyna rivers, and to defend the Par pass. It was completed in 1656. The Battle of Pratapgad between Shivaji and Afzal Khan was fought below the rampants of this fort on November 10, 1659. This was the first major test of the fledgling kingdom&#39;s army, and set the stage of the establishment of the Maratha empire. Pratapgad continued to be involved in regional politics. Sakharam Bapu, a well-known minister of Pune, was confined by his rival Nana Phadnis in Pratapgad in 1778.</p>
</div>
</div>
</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="KalsubaiPeakInfo" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center">Kalsubai Peak</h4>
</div>

<div class="modal-body"><a class="thumbnail" href="#"><img src="img/kalsubai.jpg" /> </a>

<p>Kalsubai is a mountain (1646 meters) of the Sahyadris range located in the Indian state of Maharashtra. Its summit situated at an elevation of 5400 feet is the highest point in Maharashtra which earns it the much glorified title of the &#39;Everest of Maharashtra&#39;. The mountain range lies within the Kalsubai Harishchandragad Wild-life Sanctuary. It is visited throughout the year by avid trekkers, kalsubai temple devotees and wild-life enthusiasts alike. The peak along with the adjoining hills spans along a downward-slanting east to west axis eventually merging with the formidable escarpment of the western ghats at almost right angles.Along its length they form a natural boundary demarcating the Igatpuri Taluka, Nashik district at its north from the Akole Taluka, Ahmednagar district at its south.The mountain itself lies on the Deccan Plateau with its base at an elevation of 587 meters (1926 feet) above mean sea level. The mountain along with adjoining hills forms an enormous catchment area for the Arthur Lake which it overlooks.</p>
</div>
</div>
</div>
</div>
</body>
</html>