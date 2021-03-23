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
        $closure = $_POST['closuredate'];
        $final = $_POST['finaldate'];
        $faculty = $_POST['faculty'];
        $submissionID = generateId($conn);

        $timestamp = strtotime($start);
        $getyear = date('Y', $timestamp);
        $timestamp2 = strtotime($closure);
        $getyear2 = date('Y', $timestamp2);
        $timestamp3 = strtotime($final);
        $getyear3 = date('Y', $timestamp3);


                $stmt = $conn->prepare("SELECT COUNT(*) FROM submission WHERE FacultyID = :fid AND AcademicYear = :year");
                $stmt->execute(array(':fid'  => $faculty,':year' => $year));
                $count = $stmt->fetchColumn();
                
                if ($count > 0) {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "A submission already exist for the selected Faculty on that Year. Please select different Year!"
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
              <!-- Main -->
                         <div class="card">
                            <div class="card-body">
                                <h4 class="header-title" style="font-size: 20px;text-transform: uppercase;">Manage Submission 
                                    <button type="button" id=myButton class="btn btn-primary btn-sm pull-right">Add New Submission</button><br></h4>
                               <br><br>
                                <div class="single-table">
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" >
                                        <thead class="text-capitalize">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>                                                    
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Year</th>                                                    
                                                    <th scope="col">Start</th>
                                                    <th scope="col">Closure</th>
                                                    <th scope="col">Final</th>
                                                    <th scope="col">Faculty</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $query = "SELECT * FROM  submission INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID  ;";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){  
                                                        echo "<tr>";                                                          
                                                                echo "<th scope='row'>".$row['SubmissionID']."</th>";
                                                                echo "<td>".$row['SubmissionName']."</td>";  
                                                                echo "<td>".$row['SubmissionDescription']."</td>";  
                                                                echo "<td>".$row['AcademicYear']."</td>";  
                                                                echo "<td>".$row['SubmissionStartDate']."</td>"; 
                                                                echo "<td>".$row['SubmissionClosureDate']."</td>";  
                                                                echo "<td>".$row['SubmissionFinalDate']."</td>"; 
                                                                echo "<td>".$row['FacultyName']."</td>"; 
                                                                // echo '<td><a href="delete.php?type=closure&id='.$row['SubmissionID'].'">Delete</a>
                                                                // </td>'; 
                                                                echo "<td>
                                                                <ul class='d-flex justify-content-center'>                                                                 
                                                                    <li class='mr-3'> <a href='update-submission.php?id=".urlsafe_b64encode($row['SubmissionID'])."'><i class='fa fa-edit'></i></a></li>
                                                                    <li> <a href='delete.php?type=closure&id=".urlsafe_b64encode($row['SubmissionID'])."'><i class='ti-trash'></i></a></li>
                                                                </ul>
                                                                </td>"; 
                                                                
                                                            }
                                                        } else {
                                                            echo "No results";
                                                        }
                                                    	 ?>
                                                </tr>
                                                    
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                
                            </div>
                        </div>
                        
                    
        </div>
        <!-- main content area end -->
         
     </form>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal"  >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="dash"></div>

                                            
         </div>
         </div></div>
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





<script>
    document.getElementById("myButton").onclick = function () {
location.href = "add-closuredate.php";
    };
    
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editsubmission.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>

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
    </script>
</body>
</html>


