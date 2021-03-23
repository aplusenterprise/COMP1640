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
    <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js”></script>&gt;
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
 
<style>

.grid {
  background: white;
  margin: 0 0 $pad 0;
  
  &:after {
    /* Or @extend clearfix */
    content: "";
    display: table;
    clear: both;
  }
}

[class*='col-'] {
  float: left;
  padding-right: $pad;
  .grid &:last-of-type {
    padding-right: 0;
  }
}
.col-2-3 {
  width: 66.66%;
}
.col-1-3 {
  width: 33.33%;
}
.col-1-2 {
  width: 50%;
}
.col-1-4 {
  width: 25%;
}
.col-1-8 {
  width: 12.5%;
}

/* Opt-in outside padding */
.grid-pad {
  padding: $pad 0 $pad $pad;
  [class*='col-']:last-of-type {
    padding-right: $pad;
  }
}
.chart {
  width: 100%; 
  height: 600px;
  padding:20px;
  
  margin-right: -100px; 

}

/* Use a media query to add a breakpoint at 800px: */
@media screen and (max-width: 800px) {
   .chart {
    width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
@media screen and   (max-width: 480px) {
    #grid {
        top: 50%; /* IMPORTANT */
        left: 50%; /* IMPORTANT */
        display: block;
        position: absolute;
        background: url(images/background.png) no-repeat center center;
        width: 750px;
        height: 417px;

        margin-top: -208.5px; /* HALF OF THE HEIGHT */
        margin-left: -375px; /* HALF OF THE WIDTH */
    }
}
</style>
</head>

<body>
<form method='post' action='report2.php' enctype='multipart/form-data'>
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
         <!-- Start Content -->

         <!-- visitor graph area start -->
         <div class="card mt-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-5">
                            <h4 class="header-title mb-0">Visitor Graph</h4>                            
                        </div>
                        <!-- TAble -->
                        <div class="table-responsive" >
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">Academic Year</th>
                                                    <th scope="col">Contribution Without Comments</th>    
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
                                                  WHERE `StudentSubmissionTime` + INTERVAL 14 DAY < NOW() AND  comment.CommentDetail IS NULL
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
                        <!-- ENd table -->
                        <div class="grid">
                            <div class="col-1-2">
                                <div id="visitor_graph" class="chart"></div>
                            </div>
                          
                            </div>
                        
                        </div>
                        <!-- <div id="visitor_graph"></div> -->
                        
                    </div>
                </div>


         <!-- End Content -->
                <!-- visitor graph area start -->
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-5">
                            <h4 class="header-title mb-0">Visitor Graph</h4>                            
                        </div>
                        <!-- TAble -->
                        <div class="table-responsive" >
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">Academic Year</th>
                                                    <th scope="col">Contribution Without Comments</th>    
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
                        <!-- ENd table -->
                        <div class="grid">
                            <div class="col-1-2">
                                <div id="barchart_material" class="chart"></div>
                            </div>
                            
                            </div>
                        
                        </div>
                        
                        
                    </div>
                </div>


         <!-- End Content -->
         
  
        </div>
    </div>
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
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Academic Year');
            data.addColumn('number', 'Without Comment');
          
            for(i = 0; i < my_2d.length; i++)
              data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);              
             var options = {
            title: 'plus2net.com Sales Profit',
            hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
            };

            var chart = new google.charts.Bar(document.getElementById('visitor_graph'));
            chart.draw(data, options);
        }

       
    
    </script>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
    google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Academic Year');
            data.addColumn('number', 'Without Comment after 14 Days');
          
            for(i = 0; i < comm.length; i++)
              data.addRow([comm[i][0], parseInt(comm[i][1])]);    

              var options = {
                title: 'plus2net.com Sales Profit',           
                vAxis: {minValue: 0}
            };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        

      }
    </script>
</body>

</html>
