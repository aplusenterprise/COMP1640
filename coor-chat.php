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
    
</head>

<body>
<form method='post' action='coor-chat.php' enctype='multipart/form-data'>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'header-coor.php' ?>
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
                            <a class="dropdown-item" href="change-password.php">Change Password</a>                                  
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

                                <div id="user_details"></div>

                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover progress-table text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Student</th>    
                                                    <th scope="col">Email</th>                                                 
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>  
                                            <?php 
                                                $query = "SELECT * FROM  user WHERE FacultyID = $fac AND UserRole='student'";
                                                $result = $conn->query($query);

                                                if($result->rowCount() > 0){
                                                    while($row = $result->fetch()){ 
                                                     
                                                        echo "<tr>";                                                                                                     
                                                        echo "<th scope='row'>".$row['UserId']."</th>";
                                                        echo "<td>".$row['UserName']."</td>";  
                                                        echo "<td>".$row['UserEmail']."</td>";  
                                                        echo "<td><button type='button' class='btn btn-flat btn-primary btn-xs start_chat' data-touserid=".$row['UserId']." data-tousername=".$row['UserName'].">Start Chat</button></td>";  
                                                          
                                                        echo "</tr>";
                                                        
                                                    }
                                                } else {
                                                    echo "No results";
                                                }

                                                
	  ?>
                                                
                                                    
                                                
                                            </tbody>
                                        </table>
                                       
                                    </div>
                                </div>
                                <br><br>
                                
                            </div>
                        </div>
                        
                        <!-- CHOOSE ONE TO USE -->
                         <div class="card">
                            <div class="card-body">
                            
                                <div class="single-table">
                                <div id="user_model_details"></div>
                           
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
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- Chat Box -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">       
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   $(document).ready(function(){

    setInterval(function(){
    update_last_activity();       
    update_chat_history_data();
   
}, 1000);


function update_last_activity()
{
$.ajax({
    url:"update_last_activity.php",
    success:function()
    {

    }
})
}
  
 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });

 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    $('#chat_message_'+to_user_id).val('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });
 function fetch_user_chat_history(to_user_id)
        {
        $.ajax({
        url:"fetch_user_chat_history.php",
        method:"POST",
        data:{to_user_id:to_user_id},
        success:function(data){
            $('#chat_history_'+to_user_id).html(data);
        }
        })
 }

 
    function update_chat_history_data()
    {
    $('.chat_history').each(function(){
    var to_user_id = $(this).data('touserid');
    fetch_user_chat_history(to_user_id);
    });
    }
});
 
 </script>
</body>

</html>
