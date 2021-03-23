<?php
include 'config.php';
include 'include/function.php';
session_start();
 if($_SESSION['role_level'] != 'coordinator')
 {
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
 } 
    
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];

 
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
   


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    print_r( $_POST['name']);
    if ($name == "publish") {
        $sql = "UPDATE studentsubmission SET StudentSubmissionStatus = 1 WHERE studentsubmissionID=  '$id' ";
         $stmt= $conn->prepare($sql);

        if ($conn->query($sql) === TRUE) {
            echo "Record published dated successfully";
        } else {
            echo "Error updating record: $id" . $conn->error;
        }
    } 
    
    else {
        $sql = "UPDATE studentsubmission SET StudentSubmissionStatus = 0 WHERE studentsubmissionID=  '$id' ";

        if ($conn->query($sql) === TRUE) {
            echo "Record unpublish successfully ";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}



?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Coordinator</title>
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
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body> 
<form method='post' action='coordinator.php' enctype='multipart/form-data'>
    
    <!-- preloader area start -->
    
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'header-coor.php' ?>
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
                            <h4 class="page-title pull-left">Dashboard </h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span><?php echo "Faculty of $facu"; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d;?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                 <a class="dropdown-item" href="change-password.php">Change Password</a>                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- button srea start -->            
                <div class="row justify-content-md-center">
                <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Submission</h4>  
                                <div class="single-table">
                                    <div class="table-responsive">      
                                    <table id="dataTable" >
                                        <thead class="bg-light text-uppercase">
                                                <tr>
                                                <th >Student</th>                                                
                                                <th > Article</th>                                                 
                                                <th>Date</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                                </tr>
                                        </thead>
                                            

                                            <?php    
                                            getsubmission($fac, $conn) ;    
	                                        ?>
                                            
                                        </table>
                                    </div>
                                    </div>
                                    </div> </div>
                            </div>
                        </div>
             
                        
                       <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Published Articles</h4>                                 
                                <div class="single-table">                                    
                                    <table id="dataTable2">
                                    <thead class="bg-light text-uppercase">
                                                <tr>
                                                  <th>Student</th>                                               
                                                <th>Article</th>
                                                <!-- <th>Document</th>
                                                <th>Image</th> -->
                                                <th>Date</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                              
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php                                          
                                            getpublish($fac, $conn);
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                
           
             
            <!-- -->
        </div>
        <!-- main content area end -->
        </div>
     </form>
    </div>
    <!-- page container area end -->
    <script src="main.js"></script>
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
