<?php
include 'config.php';
include 'include/function.php';
session_start();

 if($_SESSION['role_level'] != 'guest'){
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
  }

//   if(isset($_GET["accept-cookies"])){
//     setcookie("accept-cookies", $_SESSION['username'], time()+31556925);
//     header("location:guest.php");
//   }

    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    

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
    <title>Guest</title>
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
    <!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->
   
    <style>
   
         .container p {
         text-decoration: none;
         color: #ffffff;
         padding: 5px 10px;
         font-size: 14px;
         line-height: 40px;
            
        }

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


        
   
    </style>
</head>

<body>

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <!-- <div class="loader"></div> -->
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div hide class="page-container sbar_collapsed">
        <!-- sidebar menu area start -->
        
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content" >
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?php echo "Guest Dashboard "; ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="guest.php">Home</a></li>
                                <li ><span><?php echo "Faculty of $facu "; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
      
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
            
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        
                        <div class="card" >
                            
                            <div class="card-body" >                                
                                <h4 class="header-title">Selected Articles</h4>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="text" class="form-control" id="str" value=<?php echo $fac ?> hidden=true>
                                </div>

                                <div id="link_wrapper">
                                </div>
                                
                             
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                  
                </div>
            </div>
        </div>
        <!-- main content area end -->
    
    </div>
    <!-- page container area end -->
  
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
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- <script>
    if($('.cookie-banner').length){
        $('.cookie-banner').slideDown(800);
    }</script> -->

</body>

</html>
<script>
function loadXMLDoc() {
  
  var str=document.getElementById("str").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("link_wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "guest_refresh.php?q="+str, true);  
  xhttp.send();
}

setInterval(function(){
    loadXMLDoc();
},1000);

window.onload =loadXMLDoc;
</script>