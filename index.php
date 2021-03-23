<?php
include 'config.php';
include 'include/function.php';
session_start();

// $page = $_SERVER['PHP_SELF'];
// $sec = "10";

?>
<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Spatial by TEMPLATED</title>
		<meta charset="utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		   <!-- Core theme CSS (includes Bootstrap)-->		  
        <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">		
		<link rel="stylesheet" href="assets/css/themify-icons.css">	
		
		<!-- style css -->
		
		<link rel="stylesheet" href="assets/css/default-css.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/responsive.css">
		<!-- modernizr css -->
		<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
                 
        
	</head>
	<body class="landing">
	<form method='post' action='index.php' enctype='multipart/form-data'>
		<!-- Header -->

			<header id="header" class="alt">
				<h1><strong><a href="index.html">UOG</a></strong>Dashboard</h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="generic.html">Login</a></li>
						<li><a href="elements.html">Register</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<h2>Student!</h2>
				<p>Welcome to magazine <br /> publish</p>
				<ul class="actions">
					<li><a href="#" class="button special big">Get Started</a></li>
				</ul>
			</section>

			<!-- One -->
				<section id="one" class="wrapper style1">
					<div class="container 75%">
						<div class="row 200%">
						    <!-- page title area end -->
							<div class="main-content-inner">
             
             <div class="row">
                 <!-- nav tab start -->
                 <div class="col">
                     <div class="card">
                         <div class="card-body">
							 
						 <ul class="nav nav-tabs" id="myTab" role="tablist">
                             <?php
                                 foreach(getallfaculty($conn) as $f){
                                 echo"     
                                 <li class='nav-item'>
                                     <a class='nav-link' id='home-tab' data-toggle='tab' href='#{$f['id']}' role='tab' aria-controls='home' aria-selected='true'>{$f['fname']}</a>
                                 </li>            
                                  ";}
                                  ?>                                   
                             </ul>
                             <div class="tab-content mt-3" id="myTabContent">
                                 <?php
                                     foreach(getallfaculty($conn) as $f){
                                         $tt=$f['id'];
                                         ?>
                                       
                                     <div class='tab-pane fade show' id=<?php echo $f['id'] ?> role='tabpanel' aria-labelledby='home-tab'>
                                     <!-- <p><?php //echo $f['fname'] ?></p> -->
                                         <div class="col-36 mb-3">
                                              <!-- <button type="button" onclick="window.location.href='zip.php?facultyid=' + $tt" class="btn btn-primary">Download all published submission</button> -->
                                             
                                         </div>
                                             <!-- Start of foreach funcion of get article per faculty  -->
                                             <?php
                                              //Get students selected posts.
                                                 $article= getallarticleperfaculty($f['id'],$conn);
                                                 //Loop through the $article array IF it is an array.
                                                     if(is_array($article)){
                                                         foreach($article as $view){ 
                                                             ?>
                                                               <div class="card gedf-card">
                                                                 <div class="card-header text-white bg-dark">
                                                                     <div class="d-flex justify-content-between align-items-center">
                                                                         <div class="d-flex justify-content-between align-items-center">
                                                                             <div class="mr-2">
                                                                                 <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                                                             </div>
                                                                             <div class="ml-2">
                                                                                 <div class="h5 m-0"><?php echo $view['studentemail'] ?></div>
                                                                                 <div class="h7 text-muted"><?php echo "Student Submission ID: ".$view['stusub']."" ; ?></div>
                                                                                 
                                                                             </div>
                                                                         
                                                                         </div>
                                                                         <div>
                                                                             
                                                                         <br>
                                                                         </div>
                                                                     </div>

                                                                 </div>
                                                                 <div class="card-body">
                                                                     <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php echo $view['datetime'] ?></div>
                                                                     <a class="card-link" >
                                                                         <h5 class="card-title"><?php echo $view['articletitle'] ?></h5>
                                                                     </a>
                                                                     <!-- Image /////-->
                                                                     <div class="photo-gallery"> 
                                                                         <?php                            
                                                                         $view['image'] = trim($view['image'],'\,');
                                                                         $temp = explode(',',$view['image'] );                         
                                                                         $s = array_filter($temp); 

                                                                         foreach($s as $key => $ew){  
                                                                         ?> 
                                                                             <a href="image/<?php echo $ew; ?>" data-lightbox="photos" class ="mt-2 mb-5">
                                                                             <img src="image/<?php echo $ew; ?>" class="img-fluid img-thumbnail" width="200px" height="200px" /> </a>                           
                                                                             
                                                                         <?php  ; }  ?> 
                                                                     </div>
                                                                     <!-- End Image /////-->
                                                                     <p class="card-text"><?php echo $view['desc'] ?></p>    
                                                                     <p class="card-text"><?php getdocument($view['document'] , $conn) ?></p>                                                                       </p>
                                                                 </div>
                                                                 <div class="card-footer">                        
                                                                     <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>  
                                                                     
                                                                 </div>
                                                             </div>
                                                             <!-- Post /////-->


                                             <?php }}?> 
                                             <!-- End of foreach funcion of get article per faculty  -->
                                     </div>   
                                                 
                                     <?php 
                                     } //End of foreach faculty
                                     
                                 ?> 
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
         </div>
     </div>
     <!-- main content area end -->
						</div>
					</div>
				</section>

		
			

			<!-- Four -->
				<section id="four" class="wrapper style3 special">
					<div class="container">
						<header class="major">
							<h2>Guest</h2>
							<p>Choose your Faculty</p>
						</header>
						<ul class="actions">
							<li><a href="#" class="button special big">Get in touch</a></li>
						</ul>
					</div>
				</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook"></a></li>
						<li><a href="#" class="icon fa-twitter"></a></li>
						<li><a href="#" class="icon fa-instagram"></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; UOG</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	<script>

$(document).ready(function()
{
    function refresh()
    {
        var div = $('#card-body'),
            divHtml = div.html();

        div.html(divHtml);
    }

    setInterval(function()
    {
        refresh()
    }, 5000); //300000 is 5minutes in ms
})
	</script>

	</body>
</html>