<?php
include 'config.php';
include 'include/function.php';
session_start();
 if($_SESSION['role_level'] != 'marketingmanager')
 {
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
 } 
 $fac=$_SESSION['faculty'];
 $d=$_SESSION['username'];

 if (isset($_POST['zipped'])) {
    $files = array();
  

$sql = "SELECT * FROM submission 
    INNER JOIN studentsubmission ON studentsubmission.SubmissionID = submission.SubmissionID    
    WHERE submission.FacultyID= '1' AND studentsubmission.StudentSubmissionStatus='1'";


$result = $conn->query($sql); 
    if($result->rowCount() > 0){
        $rowno = 0;
        while($row = $result->fetch()){   
       
        if($row['Image_url'] == "Image url"){
            $row['Document_url'] = trim($row['Document_url'],'\,');
            $temp = explode(',',$row['Document_url'] );                         
            $s = array_filter($temp);
            foreach($s as $key => $ew){ 
                $submissionlink = 'document/'.$row['Document_url'].'';
             }

           
        }else{
            
            $row['Image_url'] = trim($row['Image_url'],'\,');
            $temp = explode(',',$row['Image_url'] );                         
            $s = array_filter($temp);
            foreach($s as $key => $ew){ 
                $submissionlink = 'image/'.$row['Image_url'].'';
             }

        };
        array_push($files, $submissionlink);
        
    }
}
    
   
    }
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<form method='post' action='manager.php' enctype='multipart/form-data'>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'header-manager.php' ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        
                    </div>
                    <!-- profile info & task notification -->
                
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d;?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a> -->
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                     $getIndex=0;
                                        foreach(getallfaculty($conn) as $f){
                                            $getIndex++;
                                            $tt=$f['id'];
                                            ?>
                                          
                                        <div class='tab-pane fade show <?php if($getIndex == 1){echo 'active';} ?>' id=<?php echo $f['id'] ?> role='tabpanel' aria-labelledby='home-tab'>
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
    <!-- page container area end -->

    <!-- offset area end -->
    <!-- jquery latest version -->
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
</body>

</html>
