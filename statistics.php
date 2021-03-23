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

  
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Statistic</title>
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
  
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Load JQuery-->
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
	<!--Load Paul Irish’s Debounced resize plug-in-->
	<script src="js/debounce.js"></script>
  
    
   
</head>

<body>
<form method='post' action='statistics.php' enctype='multipart/form-data'>
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
                  <!-- bar chart start -->
                  <div class="row">
                    <div class="col-lg-6 mt-5">                    
                        <div class="card">
                            <div class="card-body">
                            <div id="piechart" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="piechart2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card ">
                            <div class="card-body">
                                <div id="columnchart_material" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="columnchart_material2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="columnchart_material3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="columnchart_material4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bar chart end -->
            
        
               
        
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(chart2);

      function chart2() {

        var data = google.visualization.arrayToDataTable([
            ['students', 'contribution'],
         <?php
         $sqlpie = "SELECT  FacultyName, COUNT(studentsubmission.studentsubmissionID) AS total FROM submission 
         INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
         INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
         WHERE AcademicYear ='2020' GROUP BY submission.FacultyID, submission.AcademicYear";
         $fire = $conn->query($sqlpie);
         while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
            echo"['".$result['FacultyName']."',".$result['total']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Percentage of Contribution per faculty(Academic Year: 2020)',
           height: '500', 
           colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      
    </script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(chart2);

      function chart2() {

        var data = google.visualization.arrayToDataTable([
            ['students', 'contribution'],
         <?php
         $sqlpie = "SELECT  FacultyName, COUNT(studentsubmission.studentsubmissionID) AS total FROM submission 
         INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
         INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
         WHERE AcademicYear =YEAR(CURDATE()) GROUP BY submission.FacultyID, submission.AcademicYear";
         $fire = $conn->query($sqlpie);
         while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
            echo"['".$result['FacultyName']."',".$result['total']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Percentage of Contribution per faculty(Academic Year: 2021)',
           height: '500', 
           colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
      
      
    </script>
  

        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Faculty', 'Total Contributions'],
            <?php 
            $sqlpie = "SELECT  FacultyName, COUNT(studentsubmission.studentsubmissionID) AS total FROM submission 
            INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
            INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
            WHERE AcademicYear ='2020' GROUP BY submission.FacultyID, submission.AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['FacultyName']."',".$result['total']."],";
            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Total Contributions per Faculty (Academic Year: 2020)', 
                height: 400,
                bar: {groupWidth: "30%"},  
                colors: ['#FBBC05'],               
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},                
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material"));
            chart.draw(data, options);
    }
 </script>

<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Faculty', 'Total Contributions'],
            <?php 
            $sqlpie = "SELECT  FacultyName, COUNT(studentsubmission.studentsubmissionID) AS total FROM submission 
            INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
            INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
            WHERE AcademicYear =YEAR(CURDATE()) GROUP BY submission.FacultyID, submission.AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['FacultyName']."',".$result['total']."],";
            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Total Contributions per Faculty (Academic Year: 2021)',
                height: 400,
                bar: {groupWidth: "30%"},                 
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
                colors: ['#FBBC05'],
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material2"));
            chart.draw(data, options);
    }
 </script>

<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Faculty', 'Total Contributions'],
            <?php 
            $sqlpie = "SELECT  FacultyName, COUNT(user.UserId) AS total FROM submission 
            INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
            INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
            INNER JOIN user ON faculty.FacultyID = user.FacultyID
            WHERE AcademicYear ='2020' AND UserRole='student' GROUP BY submission.FacultyID, submission.AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['FacultyName']."',".$result['total']."],";
            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Number of Contributors per Faculty (Academic Year: 2020)',
                height: 400,
                bar: {groupWidth: "30%"},                 
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
                colors: ['#74317D'],
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material3"));
            chart.draw(data, options);
    }
 </script>

<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Faculty', 'Total Contributions'],
            <?php 
            $sqlpie = "SELECT  FacultyName, COUNT(user.UserId) AS total FROM submission 
            INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
            INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
            INNER JOIN user ON faculty.FacultyID = user.FacultyID
            WHERE AcademicYear =YEAR(CURDATE()) AND UserRole='student' GROUP BY submission.FacultyID, submission.AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['FacultyName']."',".$result['total']."],";
            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Number of Contributors per Faculty (Academic Year: 2021)',
                height: 400,
                bar: {groupWidth: "30%"},                 
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
                colors: ['#74317D'],
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material4"));
            chart.draw(data, options);
    }
 </script>
</body>

</html>
