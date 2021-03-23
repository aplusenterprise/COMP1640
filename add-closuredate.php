<?php
include 'config.php';
include 'include/function.php';
session_start();


 if($_SESSION['role_level'] != 'admin'){
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
      
    


  
    if(isset($_POST["add"])){
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $year = $_POST['year'];
        $start = $_POST['startdate'];
        $closure =$_POST['closuredate'];
        $final = $_POST['finaldate'];
        $faculty = $_POST['faculty'];
        $submissionID = generateId($conn);

        $timestamp = strtotime($start);
        $getyear = date('Y', $timestamp);
        $timestamp2 = strtotime($closure);
        $getyear2 = date('Y', $timestamp2);
        $timestamp3 = strtotime($final);
        $getyear3 = date('Y', $timestamp3);

        $start_time = new DateTimeImmutable($start);
        $final_time = new DateTimeImmutable($final);
        $closure_time = new DateTimeImmutable($closure);

             if(!isset($_POST['name']) || trim($_POST['name']) == '')
                {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Enter Name!");
               }
               
              
          
                else if ($final_time <= $start_time){
                 $response = array(
                   "status" => "alert-danger",
                   "message" => "Error! Final Date must not less than Stardate"
                );
              // echo '<script>alert("Error! Final Date must not less than Stardate")</script>';            
            }
    
            else if ($closure_time <= $start_time){
                $response = array(
                    "status" => "alert-danger",
                   "message" => "Error! Closure Date must not less than Start date"
                );
                // echo '<script>alert("Error! Closure Date must not less than Start date")</script>';         
            }


            

          
            else{

                    $stmt = $conn->prepare("SELECT COUNT(*) FROM submission WHERE FacultyID = :fid AND AcademicYear = :year");
                    $stmt->execute(array(':fid'  => $faculty,':year' => $year));
                    $count = $stmt->fetchColumn();
                    
                    if ($count > 0) {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Submission already exist for the selected Faculty on that Year. Please select different Year!"
                        );
                        
                    } 	
                    
                    else if ($getyear != $year){
                            $response = array(
                                "status" => "alert-danger",
                                "message" => "Start date doesnt meet the year selected"
                            );
                        }

                    else if ($getyear2 != $year){
                            $response = array(
                                "status" => "alert-danger",
                                "message" => "Closure date doesnt meet the year selected"
                            );
                        }

                        else if ($getyear3 != $year){
                            $response = array(
                                "status" => "alert-danger",
                                "message" => "Final date doesnt meet the year selected"
                            );
                        }

                

                    

                        else		{	

                                    
                                $sql = "INSERT INTO submission (SubmissionID,SubmissionName, SubmissionDescription, AcademicYear, SubmissionStartDate, SubmissionClosureDate, SubmissionFinalDate, FacultyID) 
                                VALUES (:sid,:name, :desc, :year, :start, :closure, :final, :faculty)";
                                $stmt = $conn->prepare($sql);
                            
                                //Bind our variables.
                                $stmt->bindParam(':sid', $submissionID);
                                $stmt->bindParam(':name', $name);
                                $stmt->bindParam(':desc', $desc);
                                $stmt->bindParam(':year', $year);							
                                $stmt->bindParam(':start', $start);
                                $stmt->bindParam(':closure', $closure);
                                $stmt->bindParam(':final', $final);
                                $stmt->bindParam(':faculty', $faculty);
                            
                                //Execute the statement and insert the new account.
                                $result = $stmt->execute();

                                //If the signup process is successful.
                                if($result == 1){						
                                    
                                    header("location: closure-date.php");
                                } else {
                                    //echo "some error occured";
                                    $invalid_err="<div class='alert alert-danger'> some error occured</div>";
                                    
                                }	
                            }
                        

          
               
    }
       
    
   }
      
  
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
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        $(document).ready(function () {
            $("#example-datetime-local-input3").datepicker({
                minDate: 0
            });
        });
    </script>
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
                        <form method='post' action='add-closuredate.php' enctype='multipart/form-data' name="EditForm"  onsubmit="return GEEKFORGEEKS()">
                         <div class="card">
                            <div class="card-body">
                            <h4 class="header-title">Add New Submission</h4>
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
                                            <select name="faculty" class="form-control" id="faculty" >
                                                    <?php
                                                    $que = "SELECT FacultyID, FacultyName  FROM faculty WHERE FacultyID != '5'";
                                                    $result = $conn->prepare($que);                            
                                                    $result->execute(); 
                                                    $spec = $result->fetchAll();    ?>       
                                                    <option value="">Select Faculty</option>                  

                                                    <?php foreach ($spec as $row): ?>                                                
                                                        <option value="<?php echo htmlentities($row['FacultyID']);?>">
                                                        <?php echo htmlentities($row['FacultyName']);?>
                                                    <?php endforeach ?>  
                                            </select>
                                           
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="datepicker1" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Academic Year</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                        
                                        <input class="yearpicker form-control" type="text" id="datepicker1" name="year" maxlength="4" autocomplete="off" >
                                      
                                        </div>
                                </div>      
                                <div class="form-group">
                                
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" >
                                           
                                        </div>
                                       
                                       
                                </div>

                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" name="desc" id="desc" autocomplete="off" >
                                     
                                    </div>
                            </div>
                               
                                <div class="form-group">
                                            <label for="example-datetime-local-input1" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Start Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="example-datetime-local-input1" name="startdate" >
                                        

                                            </div>
                                 </div>
                                 <div class="form-group">
                                            <label for="example-datetime-local-input2" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Closure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="example-datetime-local-input2" name="closuredate" >
                                        <span> <?php if(!empty($error['closure'])){ echo $error['closure']; } ?></span>

                                            </div>
                                 </div>
                                 
                                 <div class="form-group">
                                            <label for="example-datetime-local-input3" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Final Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input class="form-control" type="datetime-local"  id="example-datetime-local-input3" name="finaldate" >
                                      

                                            </div>
                                 </div>
                            
                                                         
                                <div class="form-group">                                
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="add" class="btn btn-success btn-md mb-3">Add</button>
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


    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="assets/js/yearpicker.js"></script>
  



    <script>
      $(document).ready(function() {
        $(".yearpicker").yearpicker({
            format      :   "YYYY",
           viewMode    :   "years",           
          startYear: 2021,
          endYear: 2030
        });
      });

            function GEEKFORGEEKS() { 
                var fac =  
                    document.forms["EditForm"]["faculty"]; 
                var year =  
                    document.forms["EditForm"]["datepicker1"]; 
                var name =  
                    document.forms["EditForm"]["name"]; 
                var desc =  
                    document.forms["EditForm"]["desc"]; 
                var d1 =  
                    document.forms["EditForm"]["example-datetime-local-input1"]; 
                var d2 =  
                    document.forms["EditForm"]["example-datetime-local-input2"]; 
                var d3 =  
                    document.forms["EditForm"]["example-datetime-local-input3"];


                if (fac.selectedIndex < 1) { 
                    alert("Please select faculty."); 
                    fac.focus(); 
                    return false; 
                } 
              
               else if (year.value == "") { 
                    window.alert("Please enter academic year."); 
                    year.focus(); 
                    return false; 
                } 

                 
                else if (name.value == "") { 
                    window.alert("Please enter name."); 
                      name.focus(); 
                    return false; 
                } 
             
  
                else if (desc.value == "") { 
                    window.alert("Please enter description"); 
                    desc.focus(); 
                    return false; 
                } 
  
                else if (d1.value == "") { 
                    window.alert( 
                      "Please enter start date."); 
                      d1.focus(); 
                    return false; 
                }

                else if (d2.value == "") { 
                    window.alert( 
                      "Please enter closure date."); 
                      d2.focus(); 
                    return false; 
                }

                else if (d3.value == "") { 
                    window.alert( 
                      "Please enter final date."); 
                      d3.focus(); 
                    return false; 
                }

              

                    
               
                return true; 
            } 
      
    </script>
</body>
</html>


