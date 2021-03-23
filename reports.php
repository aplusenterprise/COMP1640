<?php
include 'config.php';
include 'include/function.php';
session_start();
 if($_SESSION['role_level'] != 'marketingmanager')
 {
    echo "Unauthorized user. Access denied.";
    die; // stop further execution
 } 
 $fac=$_SESSION['faculty'];
 $d=$_SESSION['username'];


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
<form method='post' action='reports.php' enctype='multipart/form-data'>
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
                            <h4 class="header-title mb-0">Contributions without a comment</h4><br>
                            <table class="table table-hover progress-table text-center">
                                            <thead >
                                                <tr>
                                                    <th scope="col">Academic Year</th>
                                                    <th scope="col">Without Comments</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                            <?php 
                                                
                                                  $query = "SELECT  AcademicYear, COUNT(studentsubmission.studentsubmissionID)totalarticle,  COUNT(comment.studentsubmissionID)AS withcomment ,
                                                  (COUNT(studentsubmission.studentsubmissionID))  -(COUNT(comment.studentsubmissionID)) Nocomment,
                                                  (SELECT  COUNT(studentsubmission.StudentSubmissionID ) from studentsubmission 
                                                  LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
                                                  LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID
                                                  WHERE  comment.CommentDetail IS NULL
                                                  )after14nocomments
                                                  from studentsubmission 
                                                  LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
                                                  LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID GROUP BY AcademicYear";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){    
                                                        $article[] = array( 
                                                            $row["AcademicYear"],              
                                                            $row["Nocomment"]                                                            
                                                             ) ; 
                                                                echo "<th >".$row['AcademicYear']."</th>";
                                                                echo "<th scope='row'>".$row['Nocomment']."</th>";
                                                                
                                                                
                                                            echo "</tr>";
                                                     
                                                    }
                                                } else {
                                                    echo "No results";
                                                }
                                               // echo json_encode($article); 

                                                // Transfor PHP array to JavaScript two dimensional array 
                                                echo "<script>
                                                        var my_2d = ".json_encode($article)."
                                                </script>";
                                            ?>    
                                            </tr>  
                                        </table>        
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="chart_div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card ">
                            <div class="card-body">
                            <h4 class="header-title mb-0">Contributions without a comment after 14 days</h4><br>
                            <table class="table table-hover progress-table text-center">
                                            <thead >
                                                <tr>
                                                    <th scope="col">Academic Year</th>
                                                    <th scope="col">Without Comments</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                            <?php 
                                                
                                                $query = "SELECT AcademicYear,  COUNT(studentsubmission.StudentSubmissionID)nocommentsafter14days from studentsubmission 
                                                LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
                                                LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID
                                                WHERE `StudentSubmissionTime` + INTERVAL 14 DAY < NOW() AND  comment.CommentDetail IS NULL
                                                GROUP BY AcademicYear";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){    
                                                        $record[] = array(                                                                           
                                                            $row["AcademicYear"],
                                                            $row["nocommentsafter14days"]
                                                             ) ; 
                                                              
                                                                echo "<th scope='row'>".$row['AcademicYear']."</th>";
                                                                echo "<td>".$row['nocommentsafter14days']."</td>"; 
                                                                
                                                            echo "</tr>";
                                                     
                                                    }
                                                } else {
                                                    echo "No results";
                                                }
                                               // echo json_encode($record); 

                                                // Transfor PHP array to JavaScript two dimensional array 
                                                echo "<script>
                                                        var comm = ".json_encode($record)."
                                                </script>";
                                            ?>    
                                            </tr>  
                                        </table>      
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="barchart_material"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 mt-5">
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
                    </div> -->
                </div>
                <!-- bar chart end -->
            
        
               
        
        <!-- main content area end -->
     
    </div>
    </form>
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
   
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all bar chart activation -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        // google.charts.load('current', {packages: ['corechart', 'bar']});
        // google.charts.setOnLoadCallback(drawChart1);
        
        // function drawChart1() {

        //     // Create the data table.
        //     var data = new google.visualization.DataTable();
        //     data.addColumn('string', 'Academic Year');
        //     data.addColumn('number', 'Without Comment');
          
        //     for(i = 0; i < my_2d.length; i++)
        //       data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);  

        //       var options = {
        //         title: 'Contribution without a comment',
        //         height: 400,                          
        //         chartArea: {left:80.6, width:539.4,height:"340px"},
                
        //         vAxis: { title: 'Average mAh', gridlines: { count: 8 }, minValue: 500},
        //     };

        //     var chart = new google.charts.Bar(document.getElementById('chart_div'));
        //     chart.draw(data, options);
            
        }
     	
    </script>
     <script type="text/javascript">
    
    // google.charts.load('current', {packages: ['corechart', 'bar']});
    //   google.charts.setOnLoadCallback(drawChart);

    //   function drawChart() {
    //     var data = new google.visualization.DataTable();
    //         data.addColumn('string', 'Academic Year');
    //         data.addColumn('number', 'Without Comment after 14 Days');
          
    //         for(i = 0; i < comm.length; i++)
    //           data.addRow([comm[i][0], parseInt(comm[i][1])]);    

    //           var options = {
    //             title: 'Contribution without a comment after 14 Days',
    //             height: 400,
                             
    //             chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
    //             colors: ['#FBBC05'],
    //             vAxis: {minValue: 0}
    //         };

    //     var chart = new google.charts.Bar(document.getElementById('barchart_material'));
    //     chart.draw(data, google.charts.Bar.convertOptions(options));
        

    //   }
    </script>

<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Faculty', 'Total Contributions'],
            <?php 
             $sqlpie = "SELECT  AcademicYear, COUNT(studentsubmission.studentsubmissionID)totalarticle,  COUNT(comment.studentsubmissionID)AS withcomment ,
             (COUNT(studentsubmission.studentsubmissionID))  -(COUNT(comment.studentsubmissionID)) Nocomment,
             (SELECT  COUNT(studentsubmission.StudentSubmissionID ) from studentsubmission 
             LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
             LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID
             WHERE  comment.CommentDetail IS NULL
             )after14nocomments
             from studentsubmission 
             LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
             LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID GROUP BY AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['AcademicYear']."',".$result['Nocomment']."],";            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Contribution without a comment',
                height: 400,
                bar: {groupWidth: "30%"},                 
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
                colors: ['#74317D'],
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
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
             $sqlpie = "SELECT AcademicYear,  COUNT(studentsubmission.StudentSubmissionID)nocommentsafter14days from studentsubmission 
             LEFT JOIN submission ON  studentsubmission.SubmissionID =submission.SubmissionID 
             LEFT JOIN comment ON studentsubmission.StudentSubmissionID = comment.StudentSubmissionID
             WHERE `StudentSubmissionTime` + INTERVAL 14 DAY < NOW() AND  comment.CommentDetail IS NULL
             GROUP BY AcademicYear";
            $fire = $conn->query($sqlpie);
            while ($result = $fire->fetch(PDO::FETCH_ASSOC)){          
                echo"['".$result['AcademicYear']."',".$result['nocommentsafter14days']."],";            
            }
            ?>
    
            ]);

          
            var options = {
                title: 'Contribution without a comment after 14 days',
                height: 400,
                bar: {groupWidth: "30%"},                 
                chartArea: {left:80.6,top:20, width:539.4,height:"340px"},
                colors: ['#e0440e'],
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("barchart_material"));
            chart.draw(data, options);
    }
 </script>


</body>

</html>
