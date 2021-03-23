<?php
include 'config.php';
include 'include/function.php';
session_start();


 if($_SESSION['role_level'] != 'coordinator'){
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
  } 
  
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
  
    if(isset($_POST['save'])){

        
        $stmt = $conn->prepare("SELECT * FROM user WHERE UserId = ?");
        $stmt->execute([$user]);
        $row = $stmt->fetch();

        if ($user && password_verify($_POST['pass1'], $row['UserPassword']))
        {

            if( $_POST['pass2'] == $_POST['pass3']){

            $passwordHash = password_hash($_POST['pass2'], PASSWORD_DEFAULT);		
            $sql = "UPDATE user SET UserPassword=:p
            WHERE UserId=:id"  ;
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $user);   
            $stmt->bindParam(":p", $passwordHash);                             
            $stmt->execute();
            echo "<script>
            alert('Password changed sucessfully!');
            </script>";

            }
            else
            {
                echo "<script>
                alert('Error! New Password and confirm password does not match!');
                </script>";

            }

        } else {
            echo "<script>
            alert('Wrong Password. Please enter your current password correctly');            
            </script>"; 
        }

    }
     
  ?>
  
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
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
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body>
<form method='post' action='change-password.php'  onsubmit="return GEEKFORGEEKS()" name="adminfrm" enctype='multipart/form-data'>
    <!-- preloader area start -->
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
                                <!-- <li><a href="admin.php">Home</a></li>
                                -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <!-- page title area end -->
            <div class="main-content-inner">
                <!-- button srea start -->
              <div class="row">
                    <div class="col-lg-12 mt-5">
              <!-- Main -->
                        
                         <div class="card">
                            <div class="card-body">
                            <h4 class="header-title">Change Password</h4>

                            <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Current Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="password" class="form-control" name="pass1" id="pass1" >
                                        </div>
                                </div>

                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">New Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="password" class="form-control" name="pass2" id="pass2" > 
                                    </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Confirm Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="password" class="form-control" name="pass3" id="pass3" >
                                    </div>
                            </div>
                            <div class="form-group">                                
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="save" class="btn btn-success btn-md mb-3" >Save Changes</button>                                       
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
    <!-- Chat Box -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">       
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script> 
            function GEEKFORGEEKS() { 
                var pass1s =  
                    document.forms["adminfrm"]["pass1"]; 
                var pass2s =  
                    document.forms["adminfrm"]["pass2"]; 
                var pass3s =  
                    document.forms["adminfrm"]["pass3"]; 
             

  
               if (pass1s.value == "") { 
                    window.alert("Please enter current password."); 
                    pass1s.focus(); 
                    return false; 
                } 

                else if (pass2s.value == "") { 
                    window.alert("Please enter new password"); 
                    pass2s.focus(); 
                    return false; 
                } 
  
                else if (pass3s.value == "") { 
                    window.alert( 
                      "Please enter confirm password."); 
                      pass3s.focus(); 
                    return false; 
                }

              

                    
               
                return true; 
            } 

         
            
     



        </script> 
</body>

</html>
