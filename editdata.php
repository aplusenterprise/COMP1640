<?php
 include 'config.php';
 include 'include/function.php';
 session_start();
    $id = $_GET['id'];
	

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$name = $_POST['name'];
    	

		$sql = "UPDATE faculty SET `FacultyID` = '$id', `FacultyName` = '$name' WHERE FacultyID=$id";
		 // Prepare statement
		 $stmt = $conn->prepare($sql);
		 $stmt->execute();
    	header("location:faculty.php");
    }


	$stmt = "SELECT * FROM faculty WHERE FacultyID=:id" ;
	$statement = $conn->prepare($stmt);
	$statement->execute([':id' => $id] );
	$person = $statement->fetch(PDO::FETCH_OBJ);
	$load2= $person->FacultyID;
    $load3= $person->FacultyName; 

?>
<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

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
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
			<label for="id">Faculty ID</label>
			<input type="text" class="form-control" id="id" name="id" value="<?php echo $load2 ?>" readonly="true"/>

		</div>
		<div class="form-group">
			<label for="name">Faculty Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $load3 ?>" required/>
		</div>
		
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>