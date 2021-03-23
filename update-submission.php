<?php
 include 'config.php';
 include 'include/function.php';
 require "phpmailer/PHPMailerAutoload.php";
 session_start();


 if($_SESSION['role_level'] != 'admin'){
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
  } 
  //Getting the url parameters    
     $query_string = '?'.$_SERVER['QUERY_STRING']; 
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    
    
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
    
    $id = urlsafe_b64decode($_GET['id']);
    if (isset($_POST['add'])) {
        $year= $_POST['year'];
        $cdate= $_POST['finaldate'];
        $sd= $_POST['startdate'];
        $cd= $_POST['closuredate'];
        $sname= $_POST['name'];
        $sdesc= $_POST['desc'];
        
        $timestamp = strtotime($cdate);
        $getyear = date('Y', $timestamp);      
        $timestamp2 = strtotime($cd);
        $getyear2 = date('Y', $timestamp2);
        $timestamp3 = strtotime($sd);
        $getyear3 = date('Y', $timestamp3);


        $start_time = new DateTimeImmutable($sd);
        $final_time = new DateTimeImmutable($cdate);
        $closure_time = new DateTimeImmutable($cd);
        
        if(!isset($_POST['name']) || trim($_POST['name']) == '')
        {
            echo '<script>alert("Error! Invalid Name")</script>';     
        }

        else if(!isset($_POST['desc']) || trim($_POST['desc']) == '')
        {
        echo '<script>alert("Error! Invalid Description")</script>';     
        }

        else if(!isset($_POST['finaldate']) || trim($_POST['finaldate']) == '')
        {
        echo '<script>alert("Error! Invalid finaldate")</script>';     
        }

        else if(!isset($_POST['startdate']) || trim($_POST['startdate']) == '')
        {
        echo '<script>alert("Error! Invalid startdate")</script>';     
        }

        else if(!isset($_POST['closuredate']) || trim($_POST['closuredate']) == '')
        {
        echo '<script>alert("Error! Invalid closuredate")</script>';     
        }


          
       else if ($getyear != $year){
            echo '<script>alert("Error! Invalid Year")</script>';            
        }

        else if ($getyear2 != $year){
             echo '<script>alert("Error! Invalid Year")</script>';   
        }

        else if ($getyear3 != $year){
            echo '<script>alert("Error! Invalid Year")</script>';   
        }

        else if ($closure_time <= $start_time){
            echo '<script>alert("Error! Date must not less than stardate")</script>';            
        }

        else if ($final_time <= $start_time){
            echo '<script>alert("Error! Date must not less than stardate")</script>';            
        }

        else if ($start_time == $closure_time){
            echo '<script>alert("Error! Start time and Closure time should not be same")</script>';         
        }

        else if ($start_time == $final_time){
            echo '<script>alert("Error! Start time and Final time should not be same")</script>';         
        }

        
        else {
        $sql = "UPDATE submission SET SubmissionName=:sname, SubmissionDescription=:sdesc, SubmissionStartDate=:sd,SubmissionClosureDate=:cd, SubmissionFinalDate=:fd
        WHERE SubmissionID=:id"  ;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);   
        $stmt->bindParam(":fd", $cdate);
        $stmt->bindParam(":sname", $sname);   
        $stmt->bindParam(":sdesc", $sdesc);
        $stmt->bindParam(":cd", $cd);
        $stmt->bindParam(":sd", $sd);
                         
        if($stmt->execute()){
            header("location:closure-date.php");
        }
      }
		 
    
    
    }


    $stmt = "SELECT * , DATE_FORMAT(SubmissionFinalDate, '%Y-%m-%dT%H:%i') AS custom_date,  DATE_FORMAT(SubmissionStartDate, '%Y-%m-%dT%H:%i') AS str_date
    , DATE_FORMAT(SubmissionClosureDate, '%Y-%m-%dT%H:%i') AS clos_date  FROM submission WHERE SubmissionID=:id" ;
    $statement = $conn->prepare($stmt);
    $statement->execute([':id' => $id] );
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $load2= $data->SubmissionID;
    $load3= $data->SubmissionName; 
    $load4= $data->SubmissionDescription;
    $load5= $data->AcademicYear; 
    $load6= $data->str_date;
    $load7= $data->clos_date; 
    $load8= $data->SubmissionFinalDate;
    $load9= $data->FacultyID; 
    $load10= $data->custom_date; 

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($load9));
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
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
 <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    
    <link rel="stylesheet" href="assets/css/yearpicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Moment Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

</head>

<body>

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
                            <h4 class="page-title pull-left">Admin Dashboard</h4>
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
                    <div class="col-12 mt-5">
                        
                        <!-- CHOOSE ONE TO USE -->
                        <form method='post' action='<?php echo $_SERVER['PHP_SELF'] .$query_string; ?>' enctype='multipart/form-data'>
                         <div class="card">
                            <div class="card-body">
                            <h4 class="header-title">Update Submission</h4>
                            <span><?php 	if(isset($msg))
                                                {
                                                foreach($msg as $error)
                                                {
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                    <strong>ERROR! <?php echo $error; ?></strong>		
                                                    </div>
                                                
                                                    <?php 
                                                }
                                            }	               
                                    ?> <?php if(!empty($response)) { ?>
                                            <!-- Error message -->
                                                <div class="alert alert-danger <?php echo $response["status"]; ?>
                                                    ">
                                                    <?php echo $response["message"]; ?>
                                                </div>
                                                <?php }?></span>
                                    <div class="single-table">
                                    <div class="form-group">   
                                        <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Faculty</label>                               
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" name="faculty" id="faculty" value="<?php echo $facu;?>"  readonly="true">
                                                   
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="datepicker1" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Academic Year</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                        
                                        <input class="yearpicker form-control" type="text" id="datepicker1" name="year"  value="<?php echo $load5;?>" autocomplete="off" readonly="true">
                                        </div>
                                </div>      
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $load3;?>" autocomplete="off" >
                                        </div>
                                </div>

                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" name="desc" id="desc" value="<?php echo $load4;?>">
                                    </div>
                            </div>
                               
                                <div class="form-group">
                                            <label for="example-datetime-local-input1" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Start Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="example-datetime-local-input1" name="startdate" value="<?php echo $load6?>" >
                                            </div>
                                 </div>
                                 <div class="form-group">
                                            <label for="example-datetime-local-input2" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Closure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="example-datetime-local-input2"  value="<?php echo $load7?>" name="closuredate" >
                                            </div>
                                 </div>
                                 
                                 <div class="form-group">
                                            <label for="example-datetime-local-input3" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Final Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="txtdate" name="finaldate" 
                                            value="<?php echo htmlentities($load10);?>" >                                           
                                            </div>
                                 </div>
                            
                                                         
                                <div class="form-group">                                
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button type="submit" name="add" class="btn btn-success btn-md mb-3">Save Changes</button> -->
                                        <?php echo disableSubmissionBtn($id,$conn); ?>
                                    </div>
                                    
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

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    


</body>
</html>


