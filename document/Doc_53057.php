<?php
include 'config.php';
include 'include/function.php';
session_start();

    if($_SESSION['role_level'] != 'student'){
            echo "Unauthorized user. Access denied.";
            die; // stop further execution
    } 

    if(isset($_GET["accept-cookies"])){
        setcookie("accept-cookies", $_SESSION['username'], time()+31556925);
        header("location:student_upload.php");
    }
           
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;

    
    

                
  ?>
  
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">      
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.form.js"></script>
    <script type="text/javascript" src="scripts/upload_image.js"></script>
    
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
   

    <style>
        .cookie-banner{
        font-family: "Century Gothic", CenturyGothic, Geneva, AppleGothic, sans-serif;        
        display:none;
        background:#333 ;
        position: fixed;
        top:0;
        left: 0;
        width: 100%;        
        box-shadow: 0px 0px 5px 0px rgb(161, 163, 164);
        text-align: center;
        padding: 1rem 2rem; 
 
        }
         .container p {
         text-decoration: none;
         color: #ffffff;
         padding: 5px 10px;
         font-size: 14px;
         line-height: 40px;
            
        }

        
        .cookie-banner .container{
        margin:0 auto;
        width:75%;
        color:#f0f0f0;
        padding: 15px;
        }

        
        .cookie-button {
            display: inline-block;
            cursor: pointer;
            padding: 0.65rem 0.85rem;
            margin-left: 0.45rem;
            color: #fff;
            font-size: 0.75rem;
            letter-spacing: 1px;
            background-image: linear-gradient(62deg, #fbab7E 0%, #f7ce68 100%);
        }
        .photo-gallery {
  color:#313437;
  background-color:#fff;
}

.photo-gallery p {
  color:#7d8285;
}

.photo-gallery h2 {
  font-weight:bold;
  margin-bottom:40px;
  padding-top:40px;
  color:inherit;
}

@media (max-width:767px) {
  .photo-gallery h2 {
    margin-bottom:25px;
    padding-top:25px;
    font-size:24px;
  }
}

.photo-gallery .intro {
  font-size:16px;
  max-width:500px;
  margin:0 auto 40px;
}

.photo-gallery .intro p {
  margin-bottom:0;
}

.photo-gallery .photos {
  padding-bottom:20px;
}

.photo-gallery .item {
  padding-bottom:30px;
}
.bg-custom{
    background: -webkit-linear-gradient(left, #8914fe 0%, #8063f5 100%);
    background: linear-gradient(to right, #8914fe 0%, #8063f5 100%);
    
}
    </style>
</head>

<body>
<form method='post' action='student_upload.php' enctype='multipart/form-data'>
    
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'sidebar.php' ?>
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
                                <li><a href="index.html">Home</a></li>
                                <li><span><?php echo "Faculty of $facu"; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(!isset($_COOKIE["accept-cookies"])){
                    ?>         
            
                    <div class="cookie-banner" style="display: block;z-index: 1;padding: 0;">
                        <div class="container">
                        <p> Before browse our site, please accept our <a href="https://www.cookiesandyou.com/" target="blank" >cookies policy </a>
                        <span class="cookie-button" ><a href="?accept-cookies" style="color: white; padding: 13px;">OK! Continue</a></span></p>             
                        

                        </div>
                    </div>
                    <?php
                    }
            ?>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- button srea start -->
              <div class="row">
                   <div class="col-lg-12 mt-5">
                       
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Ongoing Submission</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Article</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">Closure Date</th>
                                                    <th scope="col">Final Date</th>
                                                    <th scope="col">Academic Year</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $query = "SELECT * FROM  submission where FacultyID = $fac";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){ 
                                                        $res[] = array(
                                                        "ID" => $row['SubmissionID'],
                                                        "Name" => $row['SubmissionName'],
                                                        "Description" => $row['SubmissionDescription'],  
                                                        "StartDate" => $row["SubmissionStartDate"],
                                                        "ClosureDate" => $row["SubmissionClosureDate"],
                                                        "FinalDate" => $row['SubmissionFinalDate'],
                                                        "Year" => $row['AcademicYear'],
                                                        "Status" => $row['SubmissionStatus']
                                                        
                                                        );
                                                        foreach ($res as $group) {
                                                            echo "<tr class='table'>";
                                                                echo "<th scope='row'>".$group['ID']."</th>";
                                                                echo "<td>".$group['Name']."</td>";
                                                                echo "<td>".$group['Description']."</td>";  
                                                                echo "<td>".$group['StartDate']."</td>";  
                                                                echo "<td>".$group['ClosureDate']."</td>";  
                                                                echo "<td>".$group['FinalDate']."</td>"; 
                                                                echo "<td>".$group['Year']."</td>";                                                   
        
                                                            echo "</tr>";
                                                        }
                                                    }
                                                } else {
                                                    echo "No results";
                                                }

                                                
	  ?>
                                                <tr>
                                                    
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>                      
                                       <div class="form-group">                                        
                                            <?php  
                                            $x =$group['ID']; 
                                            if (isset($x)){
                                            disable($x,$fac,$conn); }
                                             ?>                                            
                                       </div>
                                    </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                          <h4 class="header-title">My Articles</h4>
                                <div class="single-table">
                                <!--- \\\\\\\Post-->

                                <?php 
                                    //Get user's posts.
                                    $posts = getstudentsArticle($user, $conn);
                                    //Loop through the $posts array IF it is an array.
                                    if(is_array($posts)){
                                    foreach($posts as $view){ 
                                ?> 
                               
                                <div class="card gedf-card">
                                    <div class="card-header text-white bg-dark">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mr-2">
                                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="h5 m-0"><?php echo $d ?></div>
                                                    <div class="h7 text-muted"><?php echo "Student Submission ID: ".$view['stusub']."" ; ?></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="dropdown">
                                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                        <div class="h6 dropdown-header">Configuration</div>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Hide</a>
                                                        <a class="dropdown-item" href="#">Report</a>
                                                    </div>
                                                </div>
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
                                <?php } } //end foreach and if statement?>
                                
                                <!-- Post /////-->
                           
                            </div>
                               </div>
                        </div>
                    </div>
                </div>
                         
                </div>
                <!-- button srea end -->
            </div>
        </div>
        <!-- main content area end -->
     </form>
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
   
    <script>
      
        if($('.cookie-banner').length){
        $('.cookie-banner').slideDown(800);
        }
        
      
</script>
        



   
</body>

</html>
