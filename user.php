<?php
include 'config.php';
include 'include/function.php';
session_start();
 if($_SESSION['role_level'] != 'admin')
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


?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
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
    <!-- Table bootstrap -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
 <!-- Table bootstrap -->
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
<style>
.nav-tabs .nav-link{
    text-transform: capitalize!important;
}
</style>



</head>

<body> 
<form method='post' action='user.php' enctype='multipart/form-data'>
    
    <!-- preloader area start -->
    
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
                            
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d;?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner mt-5">
                <!-- button srea start -->            
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                            <!-- tab -->
                            <div class="row">
                            <div class="col">
                            <h2 class="header-title" style="font-size: 20px;text-transform: uppercase;">
                            Manage Users
                            </h2>
                            </div>
                            <div class="col-5" style="float: right;">
                            <button type="button" id=myButton class="btn btn-primary btn-sm pull-right">Add New User</button>
                            </div>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php
                                $selection=0;
                                    foreach(getallroles($conn) as $f){
                                        $selection++;
                                        if ($selection == 1){
                                        echo"     
                                    <li class='nav-item'>
                                    
                                        <a class='nav-link active show' id='home-tab' data-toggle='tab' href='#{$f['role']}' role='tab' aria-controls='home' aria-selected='false'>{$f['role']}</a>
                                    </li>            
                                     ";
                                    }
                                else
                            {
                                echo"     
                                <li class='nav-item'>
                                
                                    <a class='nav-link' id='home-tab' data-toggle='tab' href='#{$f['role']}' role='tab' aria-controls='home' aria-selected='false'>{$f['role']}</a>
                                </li>            
                                 ";  
                            }}
                                     ?>                                   
                                </ul>
                                <br>
                                <br>
                                
                                <div class="tab-content mt-3" id="myTabContent">
                                    <?php
                                        $getIndex=0;
                                        foreach(getallroles($conn) as $f){
                                            
                                            $getIndex++;
                                            $tt=$f['role'];
                                            ?>
                                          
                                        <div class='tab-pane fade show <?php if ($getIndex == 1){echo 'active';}?>' id=<?php echo $f['role'] ?> role='tabpanel' aria-labelledby='home-tab'>
                                        <!-- <p><?php //echo $f['fname'] ?></p> -->
                                           
                                                <!-- Start of foreach funcion of get article per faculty  -->
                                              

                                                        <div class="single-table">
                                                              <!-- Primary table start -->
                                                        <div class="col-12" style="margin-top: -3em;">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                  
                                                                    <table class="table">                                                                      
                                                                        <thead>
                                                                        <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Username</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Faculty</th>
                                                                        <th scope="col">Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php echo getalluserrole($f['role'],$conn); ?>
                                                                        </tbody>
                                                                    </table>
                                                                                                                                    
                                                                  
         
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Primary table end -->
                                                            </div>
                                                                <!-- Post /////-->


                                                <?php ?> 
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
<script>
        document.getElementById("myButton").onclick = function () {
        location.href = "add-user.php";
    };
</script>
  
</body>

</html>
