<?php
include 'config.php';
include 'include/function.php';
session_start();

// $id = isset($_GET['role_level']) ? $_GET['role_level'] : '';



 if($_SESSION['role_level'] != 'admin'){
        echo "Unauthorized user. Access denied.";      
        header("location:login.php");
  } 
 
  
  if(isset($_GET["accept-cookies"])){
    setcookie("accept-cookies", $_SESSION['username'], time()+31556925);
    header("location:admin.php");
  }
 
  
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
    $limit = 10;  
    if (isset($_GET["page"])) 
    {
	$page  = $_GET["page"]; 
    } 
    else
    { 
	$page=1;
    };  
    $start_from = ($page-1) * $limit; 
    $query = "SELECT count(userid) as countuser FROM `user` ";
    $result = $conn->query($query);
    $rowcount = $result->fetch();
    $countuser = $rowcount['countuser']; 
    
    if(isset($_POST["faculty"])){
        $name = $_POST['txtfaculty'];
        addfaculty($name,$conn);
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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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

            .page-link{
                color: grey!important;
            }
        </style>
    </head>
    
    <body>
    
        <form method='post' action='admin.php' enctype='multipart/form-data'>
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
            <?php
    if(!isset($_COOKIE["accept-cookies"])){
        ?>         
                    
                    <div class="cookie-banner" style="display: block;z-index: 1;padding: 0;">
                        <div class="container">
                            <p> Before browse our site, please accept our <a href="https://www.cookiesandyou.com/" target="blank" >cookies policy </a>
                                <span class="cookie-button" style="padding: 1px;"><a href="?accept-cookies" style="color: white; padding: 13px;">OK! Continue</a></span></p>             
                            
                        </div>
                    </div>
        <?php
         }
        ?>
                    <!-- page title area end -->
                    <div class="main-content-inner">
                        <!-- sales report area start -->
                        <div class="sales-report-area mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">User Request</h4>                                        
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <h2><?php echo getnotification($conn) ?></h2>
                                                <span><a href="javascript:void(0)" id="myButton"><i class="fa fa-long-arrow-right"></i></a></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-users"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Total students</h4>
                                                
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <h2><?php echo gettotalstudent($conn) ?></h2>
                                                <span><a href="javascript:void(0)" id="myButton1"><i class="fa fa-long-arrow-right"></i></a></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-report">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-lock"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Change Password</h4>
                                                
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                
                                                <span><a href="javascript:void(0)" id="myButton2"><i class="fa fa-long-arrow-right"></i></a></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- sales report area end -->
                        <div class="row">
                            <div class="col-lg-12 mt-5">
                                <!-- Main -->
                                
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                    <div class="col">
                                        <h4 class="header-title" style="margin: 21px;">All User</h4>
                                    </div>
                                    <div class="col-7">
                                    <div class="search-user">
                                        <div class="row">
                                        <div class="col" style="margin-right: -31px;">
                                        <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Search..." aria-label="Search" align="left" style="width: 100%;">
                                        </div>
                                        <div class="col-3">
                                        <select class="custom-select" required name="filterby" id="filterby" style="height: calc(2.25rem + 8px);" >
                                            <option value="" disabled selected>Filter by</option>
                                            <option value="UserName">Username</option>
                                            <option value="FacultyName">Faculty</option>
                                            <option value="UserRole">Role</option>
                                        </select>
                                        </div>

                                        <div class="col-2" style="margin-right: -21px;">
                                        <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit" style="max-width: 100%; width: 100%;position: relative;left: -29px;">
                                        Search
                                        </button>
                                       </div>
                                       </form>
                                       <div class="col-2">
                                       <button class="btn btn-outline-danger ml-2 my-2 my-sm-0" onclick='location.href ="admin.php"' style="max-width: 100%; width: 100%;position: relative;left: -29px;">
                                        Clear
                                       </button>
                                        </div>
                                        </div>
                                       
                                     </div>
                                    </div>
                                    </div>
                                        <div class="single-table"  id="employee_table">
                                            <div class="table-responsive" >
                                                <table class="table table-hover progress-table text-center">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Username</th>                                                    
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Faculty</th>
                                                            <th scope="col">User Role</th>   
                                                            <th scope="col">Action</th>   
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                            <?php
                                            
                                            
                                            if(isset($_POST["search"]))
                                            {
                                                if($_POST["filterby"] == "UserName")
                                                {
                                                    $query = "SELECT * FROM  user INNER JOIN faculty on user.FacultyID = faculty.FacultyID WHERE UserName LIKE  '%".$_POST["search"]."%' ORDER BY UserId";  
                                                }
                                                else if ($_POST["filterby"] == "FacultyName")
                                                {
                                                    $query = "SELECT * FROM  user INNER JOIN faculty on user.FacultyID = faculty.FacultyID WHERE FacultyName LIKE  '%".$_POST["search"]."%' ORDER BY UserId";   
                                                }
                                                else if ($_POST["filterby"] == "UserRole")
                                                {
                                                    $query = "SELECT * FROM  user INNER JOIN faculty on user.FacultyID = faculty.FacultyID WHERE UserRole LIKE  '%".$_POST["search"]."%' ORDER BY UserId"; 
                                                }
                                            }    
                                            else 
                                            {
                                                $query = "SELECT * FROM  user INNER JOIN faculty on user.FacultyID = faculty.FacultyID ORDER BY UserId ASC LIMIT $start_from, $limit";
                                            }

                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){    
                                                        $article[] = array(               
                                                            "FI" => $row["UserId"],
                                                            "UN" => $row["UserName"],
                                                            "FE" => $row["UserEmail"],
                                                            "FN" => $row["FacultyName"],
                                                            "UR" => $row["UserRole"],
                                                             ) ; 

                                                                echo "<td>".$row['UserId']."</td>";
                                                                echo "<td>".$row['UserName']."</td>"; 
                                                                echo "<td>".$row['UserEmail']."</td>";
                                                                echo "<td>".$row['FacultyName']."</td>"; 
                                                                echo "<td>".$row['UserRole']."</th>"; 
                                                                $newrowid=urlsafe_b64encode($row['UserId']);
                                                                echo "<td><a href=edituser.php?id='".$newrowid."'><i class='fa fa-edit'></i></a></td>"; 
                                                            echo "</tr>";
                                                     
                                                    }
                                                } else {
                                                    echo "No results";
                                                }

                            
                                                
	  ?>
                                                            
                                                            <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal"  >
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="dash"></div>
                                                                
                                                                
                                                            </div>
                                                        </div>                          
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>     
                                        
                                        
                                        
                                        </tbody>
                                        
                                        </table>
                                    </div>
                                    <nav aria-label="page-nav" style="margin-top: 20px;">
                    <?php 
                        
                        $query1 = "SELECT COUNT(UserId) FROM user";
                        $result1 = $conn->query($query1);
                        $row_db = $result1->fetch();
                        $total_records = $row_db[0];  
                        $total_pages = ceil($countuser / $limit); 
                    if(isset($_POST["search"]))
                    {

                    }
                    else
                    {

                    
                        /* echo  $total_pages; */
                        if($page == 1)
                        {
                            echo $pagLink = "<ul class='pagination'><li class='page-item'><a class='page-link' href='admin.php?page=".($page)."'>Previous</a></li>";  
                        }
                        else 
                        {
                            echo $pagLink = "<ul class='pagination'><li class='page-item'><a class='page-link' href='admin.php?page=".($page-1)."'>Previous</a></li>";  
                        }
     
                        for ($i=1; $i<=$total_pages; $i++) 
                        {       
                          echo  $pagLink = "<li class='page-item'><a class='page-link' href='admin.php?page=".$i."'>".$i."</a></li>";	
                        }
                        if($page<$total_pages)
                        {
                            echo $pagLink = "<li class='page-item'><a class='page-link' href='admin.php?page=".($page+1)."'>Next</a></li></ul>";
                        }
                        else 
                        {
                            echo $pagLink = "<li class='page-item'><a class='page-link' href='admin.php?page=".($page)."'>Next</a></li></ul>";
                        }    
                    }                     

                    ?>
                                    </nav>
                                </div>
                                <br><br>
                                
                            </div>
                        </div>
                        <!--  -->
                        
                        
                        <!-- CHOOSE ONE TO USE -->
                    </div>
                </div>         
                
                
                
                
                <!-- button srea start -->
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <!-- Main -->
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">All Faculty</h4>
                                <div class="single-table"  id="employee_table">
                                    <div class="table-responsive" >
                                    <form method='post' action='admin.php' enctype='multipart/form-data'>
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">Faculty</th>
                                                    <th scope="col"> Name</th>                                                    
                                                    <th scope="col">Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                            <?php 
                                                $query = "SELECT * FROM  faculty WHERE FacultyID != 5";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){    
                                                        $article[] = array(               
                                                            "fid" => $row["FacultyID"],
                                                            "fname" => $row["FacultyName"]
                                                             ) ; 

                                                                echo "<th scope='row'>".$row['FacultyID']."</th>";
                                                                echo "<td>".$row['FacultyName']."</td>"; 
                                                                echo "<td><a href='javascript:void(0)' data-toggle='modal' data-target='#exampleModal' data-whatever='".$row['FacultyID']."'><i class='fa fa-edit'></i></a>                                                               
                                                                </td>"; 
                                                               
                                                            echo "</tr>";
                                                     
                                                    }
                                                } else {
                                                    echo "No results";
                                                }

                            
                                                
	  ?>
                                 
                                                    <!-- Modal -->
                                            <div class="modal fade" id="exampleModal"  >
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="dash"></div>
                                                        
                                                        
                                                    </div>
                                                </div>                          
                                                
                                            </div>
                                    </div>
                                </div>      
                                </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                        <br><br>
                        
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
    }</script>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "editdata.php",
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
<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "userlist.php";
    };

    document.getElementById("myButton1").onclick = function () {
        location.href = "user.php";
    };

    document.getElementById("myButton2").onclick = function () {
        location.href = "admin-profile.php";
    };
</script>
</body>

</html>
