<?php
include 'config.php';
include 'include/function.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />        
        <title>Landing Page</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">      
        <link rel="stylesheet" href="assets/css/slicknav.min.css">             
        <!-- style css -->
        <link rel="stylesheet" href="assets/css/typography.css">
        <link rel="stylesheet" href="assets/css/default-css.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- modernizr css -->
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
        
    </head>
    <body id="page-top">
    <form method='post' action='index.php' enctype='multipart/form-data'>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">University</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">Login</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                
                <!-- Masthead Avatar Image
                <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" />-->
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase ">Student Affairs</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                 <a class="btn btn-xl btn-outline-light" href="login.php">
                      Login Now
                    </a>
            </div>
        </header>
       
        <div class="container">
            <div class="row">
                <div class="container d-flex align-items-center flex-column">
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
                                              <a href="zip.php?facultyid=<?php echo $f['id']; ?>" class="btn btn-m btn-primary mb-3">Download as zip <i class="fa fa-file-archive-o"></i></a>
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
                                                                             <div class="float-right">
                                                                                 <?php 
                                                                                 $published = checkpublished($view['stusub'],$conn);
                                                                                     if ($published == 1) {
                                                                                         echo '<span class="badge badge-pill badge-success">Published</span>';
                                                                                     }
                                                                                     else {
                                                                                         echo '<span class="badge badge-pill badge-danger">Unpublished</span>';
                                                                                     }
                                                                                 ?>  
                                                                             </div>
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
                                                                     <?php
                                                                 //getting coordinator username
                                                                 $cor = getCoordinatorName($fac,$conn);   
                                                                 viewcomment($view['stusub'],$cor , $conn)
                                                                     ?>      
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
        </div>
  
        
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            2215 John Daniel Drive
                            <br />
                            Clark, MO 65243
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About Freelancer</h4>
                        <p class="lead mb-0">
                            Freelance is a free to use, MIT licensed Bootstrap theme created by
                            <a href="http://startbootstrap.com">Start Bootstrap</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright © Your Website 2020</small></div>
        </div>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
  
     
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/jquery.slicknav.min.js"></script>

        <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        <!-- others plugins -->
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
