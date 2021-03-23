<?php
require_once "config.php";
$files = array();
$facultyId = $_GET['facultyid'];

$sql = "SELECT * FROM submission
    INNER JOIN studentsubmission ON studentsubmission.SubmissionID = submission.SubmissionID
    WHERE submission.FacultyID= '$facultyId' AND studentsubmission.StudentSubmissionStatus='1' AND submission.AcademicYear= YEAR(CURDATE())";


$result = $conn->query($sql);
    if($result->rowCount() > 0){
        while($row = $result->fetch()){

            $images = explode(",", $row['Image_url']);
            $imageone = "image/" . $images[0];
		    $imagetwo = "image/" . $images[1];
		    $imagethree = "image/" . $images[2];
            $imagefour = "image/" . $images[3];
		if (!in_array($imageone, $files)){
    		array_push($files, $imageone);
		}
    	if(count($images) >= 2) {
    		if (!in_array($imagetwo, $files)){
    			array_push($files, $imagetwo);
			}
    	}
    	if(count($images) == 3) {
    		if (!in_array($imagethree, $files)){
    			array_push($files, $imagethree);
			}
    	}
        if(count($images) == 4) {
    		if (!in_array($imagefour, $files)){
    			array_push($files, $imagefour);
			}
    	}

            $documents = explode(",", $row['Document_url']);
            $doceone = "document/" . $documents[0];
		    $doctwo = "document/" . $documents[1];
		    $docthree = "document/" . $documents[2];
            $docfour = "document/" . $documents[3];
		if (!in_array($doceone, $files)){
    		array_push($files, $doceone);
		}
    	if(count($documents) >= 2) {
    		if (!in_array($doctwo, $files)){
    			array_push($files, $doctwo);
			}
    	}
    	if(count($documents) == 3) {
    		if (!in_array($docthree, $files)){
    			array_push($files, $docthree);
			}
    	}
        if(count($documents) == 4) {
    		if (!in_array($docfour, $files)){
    			array_push($files, $docfour);
			}
    	}
            $row['Document_url'] = trim($row['Document_url'],'\,');
            $temp = explode(',',$row['Document_url'] );
            $temp = array_filter($temp);
            foreach($temp as $ew){
                $submissionlink1="document/".trim( str_replace( array('[',']') ,"" ,$ew ) );

             }

            $row['Image_url'] = trim($row['Image_url'],'\,');
            $temp = explode(',',$row['Image_url'] );
            $temp = array_filter($temp);

            foreach($temp as $sq){
                $submissionlink2="image/".trim( str_replace( array('[',']') ,"" ,$sq ) );

                          }
             

        };

           array_push($files,$submissionlink1,$submissionlink2);




    }


$zip = new ZipArchive();
$zip_name = time().".zip"; // Zip name
$zip->open($zip_name,  ZipArchive::CREATE);
foreach ($files as $file) {
    $zip->addFile($file);
  }

$zip->close();

if (headers_sent()) {
    echo 'HTTP header already sent';
} else {
    if (!is_file($zip_name)) {
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        echo 'File not found';
    } else if (!is_readable($zip_name)) {
        header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
        echo 'File not readable';
    } else {
        header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
//        header("Content-Length: ".filesize($zip_name));
        header("Content-Disposition: attachment; filename=\"".basename($zip_name)."\"");
        readfile($zip_name);
        exit;
    }
}
?>